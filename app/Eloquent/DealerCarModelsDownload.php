<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerCarModelsDownload extends Model
{
    public $timestamps = false;
    protected $table = 'dealer_car_models_download';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
