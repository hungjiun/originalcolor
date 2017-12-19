<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCarModels extends Model
{
    public $timestamps = false;
    protected $table = 'dealer_car_models';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
