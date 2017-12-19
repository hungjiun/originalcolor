<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModelType extends Model
{
    public $timestamps = false;
    protected $table = 'car_model_type';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
