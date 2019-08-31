<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class RepoServiceComboCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'pattern:combo {model_name : The model you wanna create a repo and service for }';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates both a repository and a service for the given model_name';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->task('Creating model repository...', function () {
            $this->call("pattern:repository", ['model_name' => studly_case($this->argument('model_name'))]);
        });
        $this->warn('Repository created!');

        $this->task('Creating model service...', function () {
            $this->call("pattern:service", ['model_name' => studly_case($this->argument('model_name'))]);
        });
        $this->warn('Service created!');
    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command("pattern:repository", ['model_name' => 'TryMe'])->everyMinute();
    }
}
