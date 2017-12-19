<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCarColors extends Model
{
    public $timestamps = false;
    protected $table = 'dealer_car_colors';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
