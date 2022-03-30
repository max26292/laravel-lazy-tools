<?php

namespace Max26292\LaravelLazyTools\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 *
 */
class CreateService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Service';
    /**
     * @var string
     */
    protected $type = 'Service';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }

        $this->createInterface();
    }

    protected function createInterface()
    {
        $interfaceName = Str::replace('Service', '', class_basename($this->argument('name')));
        $this->call('make:interface', [
            'name' => "Services/{$interfaceName}Interface",
            '-s'
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/service.stub');
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
        if (!is_dir(app_path('Services'))) {
            mkdir(app_path() . '/Services');
        }
        return is_dir(app_path('Services')) ? $rootNamespace . '\\Services' : $rootNamespace;
    }

//    /**
//     * Get the console command options.
//     *
//     * @return array
//     */
//    protected function getOptions()
//    {
//        return [
//            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, policy, and resource controller for the model'],
//            ['repository', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
//        ];
//    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        $interfaceName = Str::replace('Service', '', class_basename($this->argument('name')));
        return str_replace(['{{interface}}', '{{ interface }}'], $interfaceName, $stub);
    }

}
