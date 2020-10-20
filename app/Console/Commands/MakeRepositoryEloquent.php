<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryEloquent extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository-eloquent {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Repository Eloquent';

    protected $type = 'repository';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/repository.eloquent.plain.stub';
    }
}
