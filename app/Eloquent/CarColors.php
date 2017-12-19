<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarColors extends Model
{
    public $timestamps = false;
    protected $table = 'car_colors';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
