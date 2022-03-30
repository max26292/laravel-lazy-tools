<?php

namespace Max26292\LaravelLazyTools\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 *
 */
class CreateInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Interface';
    /**
     * @var string
     */
    protected $type = 'Interface';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/interface.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath('Console/Commands/' . trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if (!is_dir(app_path('Interfaces'))) {
            mkdir(app_path() . '/Interfaces');
        }
        return is_dir(app_path('Interfaces')) ? $rootNamespace . '\\Interfaces' : $rootNamespace;
    }

//    /**
//     * Get the console command options.
//     *
//     * @return array
//     */
//    protected function getOptions()
//    {
//        return [
//            ['service', 's', InputOption::VALUE_NONE, 'Indicates if the generated interface for service'],
//            ['repository', 'r', InputOption::VALUE_NONE, 'Indicates if the generated interface for repository'],
//        ];
//    }
}
