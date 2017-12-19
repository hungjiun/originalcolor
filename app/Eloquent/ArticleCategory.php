<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    public $timestamps = false;
    protected $table = 'article_category';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
