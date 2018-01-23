<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BigWebOnline;

class IdleKick extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'idle:kick';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        //$count = BigWebOnline::where ( 'iDateTime', '<', (time () - 1800) )->where ( "bOnline", "=", "1" )->count ();

        $upinfo ['bOnline'] = '0';
        BigWebOnline::where ( 'iDateTime', '<', (time () - 1800) )->where ( "bOnline", "=", "1" )->update ( $upinfo );
    }
}
