<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigSystemGeoipData extends Model
{
    public $timestamps = false;
    protected $connection = '';
    protected $table = 'big_system_geoip_data';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct ()
    {
        switch ($this->connection) {
            case 'center':
                $this->connection = config( 'config.center_connection' );
                break;
            default:
                $this->connection = config( 'config.mall_connection' );
        }
    }
}
