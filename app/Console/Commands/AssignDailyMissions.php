<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\MissionService;
use Illuminate\Console\Command;

class AssignDailyMissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign-daily-missions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Starting to assign daily missions...');

        $missionService = new MissionService();
        $users = User::all();

        foreach ($users as $user) {
            $missionService->assignMissions($user);
        }

        $this->info('Daily missions assigned successfully!');
    }
}
