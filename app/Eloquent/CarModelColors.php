<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModelColors extends Model
{
    public $timestamps = false;
    protected $table = 'car_model_colors';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
