<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModelsLang extends Model
{
    public $timestamps = false;
    protected $table = 'car_models_lang';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
