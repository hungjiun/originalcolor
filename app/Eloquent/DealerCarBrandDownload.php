<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCarBrandDownload extends Model
{
    public $timestamps = false;
    protected $table = 'dealer_car_brand_download';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
