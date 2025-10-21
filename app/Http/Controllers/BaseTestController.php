<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class BaseTestController extends Controller
{
    protected const TIME_LIMIT_MINUTES = 40;
    protected const PASSING_PERCENTAGE = 70;
    protected const SCORE_MULTIPLIER = 5;

    /**
     * Prefixo da sessão (deve ser sobrescrito nas classes filhas)
     */
    abstract protected function getSessionPrefix(): string;

    /**
     * Nome da rota para exibir questão (deve ser sobrescrito)
     */
    abstract protected function getShowRouteName(): string;

    /**
     * Nome da rota para finalizar (deve ser sobrescrito)
     */
    abstract protected function getFinishRouteName(): string;

    /**
     * Nome da view para exibir questão (deve ser sobrescrito)
     */
    abstract protected function getQuestionViewName(): string;

    /**
     * Nome da view para exibir resultado (deve ser sobrescrito)
     */
    abstract protected function getFinishViewName(): string;

    /**
     * Gera e inicia um novo teste
     */
    public function generate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'num_questions' => 'nullable|integer|min:1|max:100',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $numQuestions = $validated['num_questions'] ?? 30;
        $categoryId = $validated['category_id'] ?? null;

        $questions = $this->getRandomQuestions($numQuestions, $categoryId);

        if ($questions->isEmpty()) {
            return back()->with('error', 'Nenhuma questão encontrada para a categoria selecionada.');
        }

        $this->initializeTestSession($questions);

        $firstQuestionId = $questions->first()->id_question;

        return redirect()->route($this->getShowRouteName(), ['questionNumber' => $firstQuestionId]);
    }

    /**
     * Exibe a questão pelo id_question
     */
    public function showQuestion(string $questionNumber): Factory|View|RedirectResponse
    {
        $questionData = $this->getQuestionByIdQuestion($questionNumber);

        if (!$questionData) {
            return redirect()->route($this->getFinishRouteName());
        }

        ['question' => $question, 'currentIndex' => $currentIndex, 'sessionData' => $sessionData] = $questionData;

        $remainingTime = $this->calculateRemainingTime($sessionData['start_time']);

        if ($remainingTime === null) {
            return redirect()->route($this->getFinishRouteName());
        }

        $currentQuestionNumber = $currentIndex + 1;
        $totalQuestions = count($sessionData['question_ids_list']);
        $nextQuestionId = $sessionData['question_ids_list'][$currentIndex + 1] ?? null;

        return view($this->getQuestionViewName(), [
            'question' => $question,
            'answers' => $question->answers,
            'currentQuestionNumber' => $currentQuestionNumber,
            'totalQuestions' => $totalQuestions,
            'remainingTime' => $remainingTime,
            'progress' => $this->calculateProgress($currentQuestionNumber, $totalQuestions),
            'answeredQuestions' => count($sessionData['attempts']),
            'nextQuestionId' => $nextQuestionId,
        ]);
    }

    /**
     * Processa a resposta da questão pelo id_question
     */
    public function submitAnswer(Request $request, string $questionNumber): RedirectResponse
    {
        $validated = $request->validate([
            'answer_index' => 'required|integer|min:0|max:3'
        ]);

        $questionData = $this->getQuestionByIdQuestion($questionNumber);

        if (!$questionData) {
            return redirect()->route($this->getFinishRouteName());
        }

        ['question' => $question, 'currentIndex' => $currentIndex, 'sessionData' => $sessionData] = $questionData;

        $isCorrect = $this->validateAnswer($question, $validated['answer_index']);

        $this->saveAttempt($questionNumber, $question->id, $validated['answer_index'], $isCorrect);

        return $this->redirectToNextQuestion($currentIndex, $sessionData['question_ids_list']);
    }

    /**
     * Finaliza o teste e exibe resultados
     */
    public function finish(): Factory|View|RedirectResponse
    {
        $sessionData = $this->getTestSessionData();

        if (empty($sessionData['question_ids_list'])) {
            return redirect()->route('home')->with('error', 'Nenhum teste em andamento.');
        }

        $results = $this->calculateResults($sessionData);

        if (Auth::check()) {
            $this->saveHistory($results);
        }

        $this->clearTestSession();

        return view($this->getFinishViewName(), $results);
    }

    /**
     * Busca questão pelo id_question e valida sessão
     */
    protected function getQuestionByIdQuestion(string $questionNumber): ?array
    {
        $sessionData = $this->getTestSessionData();

        if (empty($sessionData['question_ids_list'])) {
            return null;
        }

        $currentIndex = array_search($questionNumber, $sessionData['question_ids_list']);

        if ($currentIndex === false) {
            return null;
        }

        $question = Question::with('answers')->where('id_question', $questionNumber)->first();

        if (!$question) {
            return null;
        }

        return [
            'question' => $question,
            'currentIndex' => $currentIndex,
            'sessionData' => $sessionData,
        ];
    }

    /**
     * Obtém questões aleatórias
     */
    protected function getRandomQuestions(int $limit, ?int $categoryId = null): \Illuminate\Database\Eloquent\Collection
    {

        $query = Question::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->inRandomOrder()
            ->limit($limit)
            ->get(['id', 'id_question', 'question', 'category_id']);
    }

    /**
     * Inicializa dados na sessão
     */
    protected function initializeTestSession($questions): void
    {
        $prefix = $this->getSessionPrefix();

        session([
            "{$prefix}_question_ids_list" => $questions->pluck('id_question')->toArray(),
            "{$prefix}_question_ids" => $questions->pluck('id')->toArray(),
            "{$prefix}_attempts" => [],
            "{$prefix}_start_time" => now(),
        ]);
    }

    /**
     * Obtém dados da sessão do teste
     */
    protected function getTestSessionData(): array
    {
        $prefix = $this->getSessionPrefix();

        return [
            'question_ids_list' => session("{$prefix}_question_ids_list", []),
            'question_ids' => session("{$prefix}_question_ids", []),
            'attempts' => session("{$prefix}_attempts", []),
            'start_time' => session("{$prefix}_start_time"),
        ];
    }

    /**
     * Calcula tempo restante do teste
     */
    protected function calculateRemainingTime($startTime): ?string
    {
        if (!$startTime) {
            return sprintf('%02d:00', static::TIME_LIMIT_MINUTES);
        }

        if (!($startTime instanceof Carbon)) {
            $startTime = Carbon::parse($startTime);
        }

        $elapsedSeconds = $startTime->diffInSeconds(now());
        $totalSeconds = static::TIME_LIMIT_MINUTES * 60;
        $remainingSeconds = max(0, $totalSeconds - $elapsedSeconds);

        if ($remainingSeconds === 0) {
            return null;
        }

        $minutes = floor($remainingSeconds / 60);
        $seconds = $remainingSeconds % 60;

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Calcula progresso do teste
     */
    protected function calculateProgress(int $current, int $total): float
    {
        return $total > 0 ? round(($current / $total) * 100, 1) : 0;
    }

    /**
     * Valida se a resposta está correta
     */
    protected function validateAnswer(Question $question, int $answerIndex): bool
    {
        $answer = $question->answers->first();
        if (!$answer || empty($answer->answer_text)) {
            return false;
        }

        $allAnswers = is_array($answer->answer_text)
            ? $answer->answer_text
            : json_decode($answer->answer_text, true);

        if (!is_array($allAnswers) || !isset($allAnswers[$answerIndex])) {
            return false;
        }

        return !empty($allAnswers[$answerIndex]['is_correct']);
    }

    /**
     * Salva tentativa na sessão
     */
    protected function saveAttempt(string $questionIdField, int $questionId, int $answerIndex, bool $isCorrect): void
    {
        $prefix = $this->getSessionPrefix();
        $attempts = session("{$prefix}_attempts", []);

        $attempts[$questionIdField] = [
            'question_id' => $questionId,
            'question_id_field' => $questionIdField,
            'answer_index' => $answerIndex,
            'is_correct' => $isCorrect,
            'answered_at' => now(),
        ];

        session(["{$prefix}_attempts" => $attempts]);
    }

    /**
     * Redireciona para próxima questão ou finaliza
     */
    protected function redirectToNextQuestion(int $currentIndex, array $questionIdsList): RedirectResponse
    {
        $nextIndex = $currentIndex + 1;

        if ($nextIndex < count($questionIdsList)) {
            $nextIdQuestion = $questionIdsList[$nextIndex];
            return redirect()->route($this->getShowRouteName(), ['questionNumber' => $nextIdQuestion]);
        }

        return redirect()->route($this->getFinishRouteName());
    }

    /**
     * Calcula todos os resultados do teste
     */
    protected function calculateResults(array $sessionData): array
    {
        $startTime = Carbon::parse($sessionData['start_time']);
        $elapsedSeconds = $startTime->diffInSeconds(now());

        $timeTaken = $this->formatTimeTaken($elapsedSeconds);
        $timeSpentDB = $this->formatTimeForDatabase($elapsedSeconds);

        $totalQuestions = count($sessionData['question_ids_list']);
        $correctAnswers = 0;
        $detailedResults = [];

        $questionNumber = 1;
        foreach ($sessionData['question_ids_list'] as $idQuestion) {
            $attempt = $sessionData['attempts'][$idQuestion] ?? null;

            if ($attempt) {
                $question = Question::find($attempt['question_id']);
                $isCorrect = $attempt['is_correct'] ?? false;

                if ($isCorrect) {
                    $correctAnswers++;
                }

                $detailedResults[] = [
                    'question_number' => $questionNumber,
                    'question' => $question,
                    'is_correct' => $isCorrect,
                    'selected_answer' => $attempt['answer_index'] ?? null,
                ];
            } else {
                $question = Question::where('id_question', $idQuestion)->first();

                $detailedResults[] = [
                    'question_number' => $questionNumber,
                    'question' => $question,
                    'is_correct' => false,
                    'selected_answer' => null,
                ];
            }

            $questionNumber++;
        }

        $wrongAnswers = count($sessionData['attempts']) - $correctAnswers;
        $unanswered = $totalQuestions - count($sessionData['attempts']);
        $percentage = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
        $passed = $percentage >= static::PASSING_PERCENTAGE;
        $score = $correctAnswers * static::SCORE_MULTIPLIER;

        return [
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'wrongAnswers' => $wrongAnswers,
            'unanswered' => $unanswered,
            'score' => $score,
            'percentage' => round($percentage, 2),
            'passed' => $passed,
            'timeTaken' => $timeTaken,
            'timeSpentDB' => $timeSpentDB,
            'detailedResults' => $detailedResults,
        ];
    }

    /**
     * Formata tempo gasto (MM:SS)
     */
    protected function formatTimeTaken(int $seconds): string
    {
        $minutes = floor($seconds / 60);
        $secs = $seconds % 60;

        return sprintf('%02d:%02d', $minutes, $secs);
    }

    /**
     * Formata tempo para banco de dados (HH:MM:SS)
     */
    protected function formatTimeForDatabase(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $secs);
    }

    /**
     * Salva histórico no banco de dados
     */
    protected function saveHistory(array $results): void
    {
        History::create([
            'user_id' => Auth::id(),
            'total_questions' => $results['totalQuestions'],
            'correct_answers' => $results['correctAnswers'],
            'score' => $results['score'],
            'passed' => $results['passed'],
            'time_spent' => $results['timeSpentDB'],
        ]);
    }

    /**
     * Limpa dados da sessão
     */
    protected function clearTestSession(): void
    {
        $prefix = $this->getSessionPrefix();

        session()->forget([
            "{$prefix}_question_ids_list",
            "{$prefix}_question_ids",
            "{$prefix}_attempts",
            "{$prefix}_start_time"
        ]);
    }
}
