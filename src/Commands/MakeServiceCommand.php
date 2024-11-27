<?php

namespace LaraToolkit\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:service')]
class MakeServiceCommand extends GeneratorCommand
{
    protected $signature = 'make:service';

    protected $description = 'Create a new Service class';

    protected $type = 'Service';

    public function handle()
    {
        parent::handle();
    }

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/service.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return is_dir(app_path('Services')) ? $rootNamespace.'\\Services' : $rootNamespace;
    }
}