<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarBrandLang extends Model
{
    public $timestamps = false;
    protected $table = 'car_brand_lang';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
