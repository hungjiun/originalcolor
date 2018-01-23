<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigWebLimit extends Model
{
    public $timestamps = false;
    protected $connection = '';
    protected $table = 'big_web_limit';
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
