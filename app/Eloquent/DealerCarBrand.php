<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCarBrand extends Model
{
    public $timestamps = false;
    protected $table = 'dealer_car_brand';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
