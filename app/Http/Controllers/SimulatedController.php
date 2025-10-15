<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Question;
use App\Models\Answer;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulatedController extends Controller
{
    public function generate(Request $request): RedirectResponse
    {
        $numQuestions = $request->input('num_questions', 30);

        $categoryId = $request->input('category_id');

        $query = Question::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);

        }

        $questionIds = $query->inRandomOrder()
        ->limit($numQuestions)
            ->pluck('id')
            ->toArray();

        if (empty($questionIds) && $categoryId) {
            return back()->with('error', 'Nenhuma questão encontrada para a categoria selecionada.');
        }

        $request->session()->put('simulated_question_ids', $questionIds);
        $request->session()->put('simulated_current', 1);
        $request->session()->put('simulated_attempts', []);
        $request->session()->put('simulated_start_time', now());

        return redirect()->route('simulated.show', ['questionNumber' => 1]);
    }

    public function showQuestion($questionNumber): Factory|View|RedirectResponse
    {
        $questionIds = session('simulated_question_ids');
        $startTime = session('simulated_start_time');

        if (!is_array($questionIds) || empty($questionIds) || !isset($questionIds[$questionNumber - 1])) {
            return redirect()->route('simulated.finish');
        }

        $question = Question::with('answers')->find($questionIds[$questionNumber - 1]);
        if (!$question) {
            return redirect()->route('simulated.finish');
        }

        // Calcula tempo restante (40 minutos)
        $remainingTime = '40:00';
        if ($startTime) {
            if (!($startTime instanceof Carbon)) {
                $startTime = Carbon::parse($startTime);
            }

            $elapsedSeconds = $startTime->diffInSeconds(now());
            $totalSeconds = 40 * 60;
            $remainingSeconds = max(0, $totalSeconds - $elapsedSeconds);

            if ($remainingSeconds === 0) {
                return redirect()->route('simulated.finish');
            }

            $minutes = floor($remainingSeconds / 60);
            $seconds = $remainingSeconds % 60;
            $remainingTime = sprintf('%02d:%02d', $minutes, $seconds);
        }

        $totalQuestions = count($questionIds);

        return view('theoretical_test.theoricalTestPage', [
            'question' => $question,
            'answers' => $question->answers,
            'currentQuestionNumber' => $questionNumber,
            'totalQuestions' => $totalQuestions,
            'remainingTime' => $remainingTime,
        ]);
    }

    public function submitAnswer(Request $request, $questionNumber): RedirectResponse
    {
        $request->validate([
            'answer_index' => 'required|integer|min:0|max:3'
        ]);

        $questionIds = session('simulated_question_ids');
        $attempts = session('simulated_attempts', []);

        if (!$questionIds || !isset($questionIds[$questionNumber - 1])) {
            return redirect()->route('simulated.finish');
        }

        $question = Question::with('answers')->find($questionIds[$questionNumber - 1]);
        if (!$question) {
            return redirect()->route('simulated.finish');
        }

        $answerIndex = $request->input('answer_index');


        $allAnswers = $question->answers->first()?->answer_text;

        if (is_array($allAnswers) && isset($allAnswers[$answerIndex])) {
            $isCorrect = filter_var($allAnswers[$answerIndex]['is_correct'] ?? false, FILTER_VALIDATE_BOOLEAN);
        } else {
            $isCorrect = false;
        }

        $attempts[$questionNumber - 1] = [
            'question_id'   => $question->id,
            'answer_index'  => $answerIndex,
            'is_correct'    => $isCorrect,
            'answered_at'   => now(),
        ];
        session()->put('simulated_attempts', $attempts);

        $totalQuestions = count($questionIds);
        if ($questionNumber < $totalQuestions) {
            return redirect()->route('simulated.show', ['questionNumber' => $questionNumber + 1]);
        }

        return redirect()->route('simulated.finish');
    }

    public function finish(): Factory|View
    {
        $startTime = session('simulated_start_time');
        $questionIds = session('simulated_question_ids', []);
        $attempts = session('simulated_attempts', []);

        $timeTaken = '00:00';
        $elapsedSeconds = 0;
        $timeSpentDB = '00:00:00';
        if ($startTime) {
            $startTime = Carbon::parse($startTime);
            $elapsedSeconds = $startTime->diffInSeconds(now());

            $minutes = floor($elapsedSeconds / 60);
            $seconds = $elapsedSeconds % 60;
            $timeTaken = sprintf('%02d:%02d', $minutes, $seconds);

            $hours = floor($elapsedSeconds / 3600);
            $dbMinutes = floor(($elapsedSeconds % 3600) / 60);
            $dbSeconds = $elapsedSeconds % 60;
            $timeSpentDB = sprintf('%02d:%02d:%02d', $hours, $dbMinutes, $dbSeconds);
        }

        $correctAnswers = 0;
        $detailedResults = [];

        foreach ($attempts as $index => $attempt) {
            $question = Question::find($attempt['question_id']);
            $isCorrect = $attempt['is_correct'] ?? false;

            if ($isCorrect) {
                $correctAnswers++;
            }

            $detailedResults[] = [
                'question_number' => $index + 1,
                'question' => $question,
                'is_correct' => $isCorrect,
                'selected_answer' => $attempt['answer_index'] ?? null,
            ];
        }

        $totalQuestions = count($questionIds);
        $wrongAnswers = $totalQuestions - $correctAnswers;
        $unanswered = $totalQuestions - count($attempts);
        $percentage = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
        $passed = $percentage >= 70;

        $scoreMultiplier = 5;
        $finalScore = $correctAnswers * $scoreMultiplier;

        if (Auth::check()) {
            History::create([
                'user_id' => Auth::id(),
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
                'score' => $finalScore,
                'passed' => $passed,
                'time_spent' => $timeSpentDB,
            ]);
        }

        session()->forget([
            'simulated_question_ids',
            'simulated_current',
            'simulated_attempts',
            'simulated_start_time'
        ]);

        return view('simulated.finish', [
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'wrongAnswers' => $wrongAnswers,
            'unanswered' => $unanswered,
            'score' => $finalScore,
            'percentage' => round($percentage, 2),
            'passed' => $passed,
            'timeTaken' => $timeTaken,
            'detailedResults' => $detailedResults,
        ]);
    }
}
