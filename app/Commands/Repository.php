<?php

namespace App\Commands;

use App\Commands\Helpers\DesignType;
use App\Commands\Helpers\MakeFile;
use Illuminate\Console\Scheduling\Schedule;

class Repository extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'pattern:repository {model_name : The model you wanna make a repo for}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'This allows you to create a repository for your models';


    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    public function getStubs()
    {
        return [
            __DIR__ . '/stubs/interface.stub',
            __DIR__ . '/stubs/eloquent.stub',
        ];
    }

    public function getModel()
    {
        /*if($this->argument('ignorecase'))
            return $this->argument('model');
        else
            return studly_case($this->argument('model'));*/
        return studly_case($this->argument('model_name'));
    }

    public function getPatternType()
    {
        return DesignType::REPOSITORY;
    }

    public function initializePatternFiles()
    {
        $interfaceContent = $this->replaceContent($this->getFilesystem()->get($this->getStubs()[0]));

        $eloquentContent = $this->replaceContent($this->getFilesystem()->get($this->getStubs()[1]));

        $this->writeFile($this->getModelName() . 'Interface', $interfaceContent);
        $this->writeFile($this->getModelName() . 'Eloquent', $eloquentContent);
    }
}
