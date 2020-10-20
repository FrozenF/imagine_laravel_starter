<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository Folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        return $this->doOperation();
    }

    private function doOperation()
    {
        Artisan::call('make:repository-interface',[
            'name' => $this->argument('name').'RepositoryInterface'
        ]);

        Artisan::call('make:repository-eloquent',[
            'name' => $this->argument('name').'Repository'
        ]);

        Artisan::call('register:repository',[
            'name' => $this->argument('name').'Repository'
        ]);
    }
}
