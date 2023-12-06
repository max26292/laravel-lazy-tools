<?php

namespace Max26292\LaravelLazyTools\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Repository';
    protected $type = 'Repository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/repository.stub');
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
        if (!is_dir(app_path('Repositories'))) {
            mkdir(app_path() . '/Repositories');
        }
        return is_dir(app_path('Repositories')) ? $rootNamespace . '\\Repositories' : $rootNamespace;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all',
             'a',
             InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, policy, and resource controller for the model'
            ],
            ['repository',
             'r',
             InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceModel($stub,$name)->replaceClass($stub, $name);
    }

    /**
     * @param $stub
     * @param $name
     * @return $this
     */
    protected function replaceModel(&$stub,$name){
        $repository = str_replace($this->getNamespace($name).'\\', '', $name);
        $modelName = str_replace('Repository','',$repository);

        $model = $this->qualifyModel($modelName);

        $stub = str_replace(
            '{{ model }}',
            $model,
            $stub
        );
        $stub = str_replace('{{ modelClass }}',$modelName,$stub);
        return $this;
    }
}
