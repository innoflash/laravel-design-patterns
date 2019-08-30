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
        $parentPath = getcwd() . '/app' . $this->getPatternType();
        if (!$this->filesystem->isDirectory($parentPath)) {
            $this->filesystem->makeDirectory($parentPath, 0755, true);
            $this->info($this->getPatternType() . ' folder has been created!');
        } else {
            $this->info($this->getPatternType() . ' already prepared!');
        }
        $this->parentDir = $parentPath;
    }

    public static function camelCase($str, array $noStrip = [])
    {
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
        $str = trim($str);
        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        $str = lcfirst($str);

        return $str;
    }

    protected function getContent()
    {
        if (sizeof($this->namePieces) === 1)
            $this->modelNamespace = '';
        else {
            array_pop($this->namePieces);
            $this->modelNamespace = '/' . implode('/', $this->namePieces) . '/';
        }

        if ($this->getPatternType() === DesignType::REPOSITORY) {
            $interfaceContent = $this->filesystem->get($this->getStubs()[0]);
            $interfaceContent = str_replace('$namespace', $this->modelNamespace, $interfaceContent);
            $interfaceContent = str_replace('ModelName', $this->modelName, $interfaceContent);
            $interfaceContent = str_replace('$modelObject', '$' . camel_case($this->modelName), $interfaceContent);

            $this->writeFile($this->modelName . 'Interface', $interfaceContent);
            // dd($interfaceContent);
        } else {

        }
    }

    protected function writeFile(string $name, string $content)
    {

        $this->filesystem->put($this->patternDir . $name . '.php', $content);
        dd($content);
        $this->info('Pattern files created.');
    }
}