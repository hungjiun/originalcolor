<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModels extends Model
{
    public $timestamps = false;
    protected $table = 'car_models';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
