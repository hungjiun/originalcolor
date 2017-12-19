<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    public $timestamps = false;
    protected $table = 'article_content';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
