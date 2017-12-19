<?php
namespace App\Http\Controllers\_Web\Article;

use App\Http\Controllers\_Web\_WebController;
use App\ArticleContent;
use App\ArticleDealer;
use App\SysDealer;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ArticleDealerController extends _WebController
{
    public $module = "article";
    public $action = "dealer";
    /*
     *
     */
    public function __construct ()
    {
    }

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action;
        $this->__initial();

        $mapDealer ['bDel'] = 0;    
        $DaoSysDealer = SysDealer::where($mapDealer)->get();

        $this->view->with ( 'dealer', $DaoSysDealer );

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $map['article_dealer.bDel'] = 0;
        $map['sys_dealer.bDel'] = 0;
        $map['article_content.bDel'] = 0;
        $data_arr = ArticleDealer::join( 'sys_dealer', function( $join ) {
            $join->on( 'article_dealer.iDealerId', '=', 'sys_dealer.iId' );
        } )->join( 'article_content', function( $join ) {
            $join->on( 'article_dealer.iArticleId', '=', 'article_content.iId' );
        } )->where($map)->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function add ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".add" => url( 'web/' . $this->module . '/' . $this->action . '/add' )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action . ".add";
        $this->__initial();

        $mapDealer ['bDel'] = 0;    
        $DaoSysDealer = SysDealer::where($mapDealer)->get();

        $this->view->with ( 'dealer', $DaoSysDealer );
        return $this->view;
    }

    /*
     *
     */
    public function getContentList ()
    {
        $iDealerId = (Input::has ( 'iDealerId' )) ? Input::get ( 'iDealerId' ) : 0;
        
        $map['bDel'] = 0;    
        $data_arr = ArticleContent::where($map)->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vImage = $this->_getFilePathById($var->vImage);
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $articles = Input::get( 'articles' );
        $article_arr = $articles  ? explode ( ',', rtrim(Input::get( 'articles' ), ",") ) : $articles;
        $iDealerId = (Input::has ( 'iDealerId' )) ? Input::get ( 'iDealerId' ) : 0;

        if($iDealerId == 0) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.dealer_empty' );

            return response()->json( $this->rtndata );  
        }

        foreach ( $article_arr as $key => $var ) {
            $map ['iArticleId'] = $var;
            $map ['iDealerId'] = $iDealerId;
            $map ['bDel'] = 0;
            $DaoArticleDealer = ArticleDealer::where ( $map )->first ();
            if( !$DaoArticleDealer ) {
                $DaoArticleDealer = new ArticleDealer ();
                $DaoArticleDealer->iDealerId = $iDealerId;
                $DaoArticleDealer->iArticleId = $var;
                $DaoArticleDealer->iRank = 1;
                $DaoArticleDealer->iStatus = 1;
                $DaoArticleDealer->iCreateTime = $DaoArticleDealer->iUpdateTime = time ();
                $DaoArticleDealer->save();
            } else {
                $DaoArticleDealer->iUpdateTime = time ();
                $DaoArticleDealer->save();
            }
        }
        
        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.add_success' );

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoArticleDealer = ArticleDealer::where( $map )->first();
        if ( !$DaoArticleDealer) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'iRank' ) ) {
            $DaoArticleDealer->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoArticleDealer->iStatus = ( $DaoArticleDealer->iStatus ) ? 0 : 1;
        }
        
        $DaoArticleDealer->iUpdateTime = time();
        if ($DaoArticleDealer->save()) {
            //Logs
            $this->_saveLogAction( $DaoArticleDealer->getTable(), $DaoArticleDealer->iId, 'edit', json_encode( $DaoArticleDealer ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doDel ( Request $request )
    {
        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoArticleDealer = ArticleDealer::where( $map )->first();
        if ( !$DaoArticleDealer) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'bDel' ) ) {
            $DaoArticleDealer->bDel = 1;
        }
        
        $DaoArticleDealer->iUpdateTime = time();
        if ($DaoArticleDealer->save()) {
            //Logs
            $this->_saveLogAction( $DaoArticleDealer->getTable(), $DaoArticleDealer->iId, 'del', json_encode( $DaoArticleDealer ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
