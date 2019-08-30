<?php


namespace App\Commands\Helpers;


use Illuminate\Filesystem\Filesystem;
use LaravelZero\Framework\Commands\Command;

abstract class MakeFile extends Command
{
    abstract public function getStubs();

    abstract public function getModel();

    abstract public function getPatternType();

    protected $filesystem;

    protected $modelName;
    protected $modelNamespace;
    protected $namePieces;
    protected $patternDir;
    protected $parentDir;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    function handle()
    {
        $this->initializeDirectories();
        $this->prepareModel();
        $this->createPatternFolder();
        $this->getContent();
    }

    protected function prepareModel()
    {
        $strRlc = [
            '/',
            '//',
            '"\"'
        ];

        $fullName = str_replace($strRlc, '/', $this->getModel());
        $this->namePieces = explode('/', $fullName);
        if (sizeof($this->namePieces) === 1)
            $this->modelName = $fullName;
        else
            $this->modelName = $this->namePieces[sizeof($this->namePieces) - 1];
    }

    protected function createPatternFolder()
    {
        $patternDir = $this->parentDir . $this->modelName;
        if (!$this->filesystem->isDirectory($patternDir))
            $this->filesystem->makeDirectory($patternDir, 0755, true);
        $this->info($this->modelName . ' pattern folder created!');
        $this->patternDir = $patternDir . '/';
    }

    function initializeDirectories()
    {
        $parentPath = app_path($this->getPatternType());
        if (!$this->filesystem->isDirectory($parentPath)) {
            $this->filesystem->makeDirectory($parentPath, 0755, true);
            $this->info($this->getPatternType() . ' folder has been created!');
        } else {
            $this->info($this->getPatternType() . ' already prepared!');
        }
        $this->parentDir = $parentPath;
    }

    protected function getContent()
    {
        if (sizeof($this->namePieces) === 1)
            $this->modelNamespace = '';
        else {
            array_pop($this->namePieces);
            $this->modelNamespace = '/' . implode('/', $this->namePieces) . '/';
        }

        switch ($this->getPatternType()) {
            case DesignType::REPOSITORY:
                $interfaceContent = $this->replaceContent($this->filesystem->get($this->getStubs()[0]));

                $eloquentContent = $this->replaceContent($this->filesystem->get($this->getStubs()[1]));

                $this->writeFile($this->modelName . 'Interface', $interfaceContent);
                $this->writeFile($this->modelName . 'Eloquent', $eloquentContent);
                break;
            case DesignType::SERVICE:
                $serviceContent = $this->replaceContent($this->filesystem->get($this->getStubs()));
                $this->writeFile($this->modelName . 'Service', $serviceContent);
                break;
        }

    }

    protected function writeFile(string $name, string $content)
    {
        if (file_exists($this->patternDir . $name . '.php'))
            $this->warn($name . ' already exist');
        else {
            $this->filesystem->put($this->patternDir . $name . '.php', $content);
            $this->info($name . ' files created.');
        }
    }

    protected function replaceContent($content)
    {
        $content = str_replace('$namespace', $this->modelNamespace, $content);
        $content = str_replace('ModelName', $this->modelName, $content);
        $content = str_replace('$modelObject', '$' . camel_case($this->modelName), $content);
        return $content;
    }
}