<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarColorsLang extends Model
{
    public $timestamps = false;
    protected $table = 'car_colors_lang';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
