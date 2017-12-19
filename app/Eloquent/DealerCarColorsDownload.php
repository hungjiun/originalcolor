<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCarColorsDownload extends Model
{
    public $timestamps = false;
    protected $table = 'dealer_car_colors_download';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
