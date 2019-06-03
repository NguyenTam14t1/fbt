<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Group;

class MigrateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:data_static';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init data report';

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
        Group::truncate();

        foreach (config('setting.group') as $key => $value) {
            $data['name'] = $value;
            Group::create($data);
        }
    }
}
