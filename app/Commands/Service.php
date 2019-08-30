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
    protected $signature = 'pattern:service';

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
        // TODO: Implement getStub() method.
    }

    public function getModel()
    {
        // TODO: Implement getModelName() method.
    }

    public function getPatternType()
    {
        return DesignType::SERVICE;
    }
}
