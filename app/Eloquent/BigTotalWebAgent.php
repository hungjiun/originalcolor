<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigTotalWebAgent extends Model
{
    public $timestamps = false;
    protected $connection = '';
    protected $table = 'big_total_web_agent';
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
