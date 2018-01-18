<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\Controller;
use App\ArticleContent;
use App\ArticleDealer;

class _PortalController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {
        $this->_init();
    }

    public function _init ()
    {
        
    }

    /*
     *
     */
    public function getArticle ( $dealerId )
    {
        $mapArticleDealer['article_dealer.iDealerId'] = $dealerId;
        $mapArticleDealer['article_dealer.iStatus'] = 1;
        $mapArticleDealer['article_dealer.bDel'] = 0;
        $mapArticleDealer['sys_dealer.bDel'] = 0;
        $mapArticleDealer['article_content.bDel'] = 0;
        $DaoArticleDealer = ArticleDealer::join( 'sys_dealer', function( $join ) {
            $join->on( 'article_dealer.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'article_content', function( $join ) {
            $join->on( 'article_dealer.iArticleId', '=', 'article_content.iId' );
        } )->where($mapArticleDealer)->select(
            'article_content.*'
        )->get();
        
        $this->view->with ( 'articleDealer', $DaoArticleDealer );
    }
}
