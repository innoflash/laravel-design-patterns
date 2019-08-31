<?php

namespace App\Commands;

use App\Commands\Helpers\DesignType;
use App\Commands\Helpers\MakeFile;
use Illuminate\Console\Scheduling\Schedule;

class Service extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'pattern:service {model_name : The model you wanna write a service for}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates a service stub for you';

    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    public function getStubs()
    {
        return __DIR__ . '/stubs/service.stub';
    }

    public function getModel()
    {
        return $this->argument('model_name');
    }

    public function getPatternType()
    {
        return DesignType::SERVICE;
    }

    public function initializePatternFiles()
    {
        $serviceContent = $this->replaceContent($this->getFilesystem()->get($this->getStubs()));
        $this->writeFile($this->getModelName() . 'Service', $serviceContent);
    }

    public function getCreatedModelFolder()
    {
        return false;
    }
}
