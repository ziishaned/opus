<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class AppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app-setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Basic app setup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate:refresh');
        $this->call('db:seed', [
            '--class' => 'PermissionTableSeeder',
        ]);
    }
}
