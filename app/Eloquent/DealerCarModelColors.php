<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCarModelColors extends Model
{
    public $timestamps = false;
    protected $table = 'dealer_car_model_colors';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
