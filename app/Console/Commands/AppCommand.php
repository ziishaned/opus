<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class AppCommand extends Command
{
    protected $signature = 'app-setup';

    protected $description = 'Basic app setup';

    protected $commands = [
        'config:cache',
        'migrate:refresh',
        [
            'db:seed',
            [
                '--class' => 'PermissionTableSeeder',
            ],
        ],
        [
            'db:seed',
            [
                '--class' => 'IntegrationActionsTableSeeder'
            ]
        ]
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach ($this->commands as $value) {
            if (is_array($value)) {
                $this->call($value[0], $value[1]);
            } else {
                $this->call($value);
            }
        }
    }
}
