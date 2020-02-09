<?php

namespace App\Console\Commands;

use App\Life;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateLifes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:lifes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add a new life to the no of lifes,in the life table ';

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
        DB::table('lifes')->where('no_of_lifes', '<', Life::MAXIMUM_LIFES)->increment('no_of_lifes');
    }
}
