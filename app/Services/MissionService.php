<?php

namespace App\Services;

use App\Models\User;
use App\Models\Mission;
use App\Models\UserMission;

class MissionService
{
    /**
     * Atribui missões diárias e semanais ao usuário.
     */
    public function assignMissions(User $user): void
    {
        // Missão Diária: verifica se já foi atribuída hoje
        $dailyMission = Mission::where('type', 'daily')->first();
        if ($dailyMission && !$user->userMissions()->where('mission_id', $dailyMission->id)->exists()) {
            UserMission::create([
                'user_id' => $user->id,
                'mission_id' => $dailyMission->id,
            ]);
        }

        // Missão Semanal: verifica se já foi atribuída esta semana
        $weeklyMission = Mission::where('type', 'weekly')->first();
        if ($weeklyMission && !$user->userMissions()->where('mission_id', $weeklyMission->id)->exists()) {
            UserMission::create([
                'user_id' => $user->id,
                'mission_id' => $weeklyMission->id,
            ]);
        }
    }

    /**
     * Atualiza o progresso das missões de um usuário.
     */
    public function updateProgress(User $user, int $simuladoScore): void
    {
        $activeMissions = $user->userMissions()->where('status', 'in_progress')->get();

        foreach ($activeMissions as $userMission) {
            $mission = $userMission->mission;

            switch ($mission->type) {
                case 'daily':
                    // Missão Diária: completa com 1 simulado
                    if ($user->histories()->whereDate('created_at', today())->count() >= $mission->target_value) {
                        $this->completeMission($userMission, $user);
                    }
                    break;

                case 'score':
                    // Missão de Pontuação: atualiza o progresso com a pontuação
                    $userMission->current_progress += $simuladoScore;
                    $userMission->save();
                    if ($userMission->current_progress >= $mission->target_value) {
                        $this->completeMission($userMission, $user);
                    }
                    break;
            }
        }
    }

    /**
     * Completa uma missão e recompensa o usuário.
     */
    private function completeMission(UserMission $userMission, User $user): void
    {
        $userMission->status = 'completed';
        $userMission->save();

        // Recompensa o usuário
        $user->increment('total_score', $userMission->mission->reward_xp);
    }
}
