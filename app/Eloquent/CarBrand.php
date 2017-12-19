<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    public $timestamps = false;
    protected $table = 'car_brand';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
