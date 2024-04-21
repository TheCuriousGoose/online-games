<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DailyCredits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credits:daily-credits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give every users everyday 10 new credits';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::select(['id', 'credits'])->get();

        foreach($users as $user){
            $user->update([
                'credits' => $user->credits + 10
            ]);
        }
    }
}
