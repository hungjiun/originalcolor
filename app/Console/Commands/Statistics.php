<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BigWebLimit;
use App\BigWebPageview;
use App\BigWebOnline;
use App\BigWebVisit;
use App\BigViewWebClick;
use App\BigViewWebPageview;
use App\BigViewWebAgent;
use App\BigViewWebLocation;
use App\BigViewWebVisitOnline;
use App\BigTotalWebAgent;
use App\BigTotalWebBounce;
use App\BigTotalWebClick;
use App\BigTotalWebLocation;
use App\BigTotalWebOnline;
use App\BigTotalWebPageview;
use App\BigTotalWebStaytime;
use App\BigTotalWebVisit;

class Statistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Statistics';

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
    }
}
