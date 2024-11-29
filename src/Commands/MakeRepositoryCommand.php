<?php

namespace LaraToolkit\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:repository')]
class MakeRepositoryCommand extends GeneratorCommand
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Create a new Repository class';

    protected $type = 'Repository';

    public function handle()
    {
        parent::handle();
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/repository.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Repositories';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $name = str_replace('\\', '/', $name);

        return $this->laravel['path'] . '/' . $name . 'Repository.php';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $stub = $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
        $modelName = $this->argument('name');
        $stub = str_replace('{{ name }}', $modelName, $stub);

        return $stub;
    }
}