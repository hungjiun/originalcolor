<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleDealer extends Model
{
    public $timestamps = false;
    protected $table = 'article_dealer';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
