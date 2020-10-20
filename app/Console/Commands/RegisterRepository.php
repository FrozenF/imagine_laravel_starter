<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\File;

class RegisterRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $file = app_path('Providers/AppServiceProvider.php');
        $find = '#register';
        $name = '\\App\\Repositories\\'.str_replace('/',"\\",$this->argument('name'));
        $insertion = '$this->app->bind('.$name.'Interface::class,'.$name.'::class);';
        $replace = $insertion."\n\t\t".$find;

        file_put_contents($file, str_replace($find,$replace,file_get_contents($file)));
    }
}
