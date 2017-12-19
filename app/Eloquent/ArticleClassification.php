<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleClassification extends Model
{
    public $timestamps = false;
    protected $table = 'article_classification';
    protected $primaryKey = 'iId';

    /*
     *
     */
    public function __construct()
    {
    }
}
