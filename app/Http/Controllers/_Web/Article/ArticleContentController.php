<?php
namespace App\Http\Controllers\_Web\Article;

use App\Http\Controllers\_Web\_WebController;
use App\ArticleContent;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ArticleContentController extends _WebController
{
    public $module = "article";
    public $action = "content";
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

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
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
    public function add ()
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".add" => url( 'web/' . $this->module . '/' . $this->action . '/add' )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action . ".add";
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $vTitle = ( Input::has( 'vTitle' ) ) ? Input::get( 'vTitle' ) : "";
        $vImage = ( Input::has( 'vImage' ) ) ? Input::get( 'vImage' ) : "";
        $vSummary = ( Input::has( 'vSummary' ) ) ? Input::get( 'vSummary' ) : "";
        $vMeta = ( Input::has( 'vMeta' ) ) ? Input::get( 'vMeta' ) : "";
        $vDetail = ( Input::has( 'vDetail' ) ) ? Input::get( 'vDetail' ) : "";

        $DaoArticleContent = new ArticleContent ();
        $DaoArticleContent->vTitle = $vTitle;
        $DaoArticleContent->vImage = $vImage;
        $DaoArticleContent->vSummary = $vSummary;
        $DaoArticleContent->vMeta = $vMeta;
        $DaoArticleContent->vDetail = $vDetail;
        $DaoArticleContent->iCreateTime = $DaoArticleContent->iUpdateTime = time();
        $DaoArticleContent->iRank = 1;
        $DaoArticleContent->iStatus = 1;
        $DaoArticleContent->bDel = 0;
        if ($DaoArticleContent->save()) {
            //Logs
            $this->_saveLogAction( $DaoArticleContent->getTable(), $DaoArticleContent->iId, 'add', json_encode( $DaoArticleContent ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function edit ( Request $request )
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action . ".edit" => url( 'web/' . $this->module . '/' . $this->action . '/edit' )
        ];

        $this->title = $this->module . "." . $this->action;

        $this->func = "web." . $this->module . "." . $this->action . ".edit";
        $this->__initial();

        $iId = ( $request->exists( 'id' ) ) ? $request->input( 'id' ) : 0;

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoArticleContent = ArticleContent::where( $map )->first();
        if ( !$DaoArticleContent) {
            $DaoArticleContent = new ArticleContent();
        }

        $DaoArticleContent->vImage = $this->_getFilePathById($DaoArticleContent->vImage);

        $this->view->with ( 'articleContent', $DaoArticleContent );
        return $this->view;
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
        $DaoArticleContent = ArticleContent::where( $map )->first();
        if ( !$DaoArticleContent) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        if ( $request->exists( 'vTitle' ) ) {
            $DaoArticleContent->vTitle = $request->input( 'vTitle' );
        }
        if ( $request->exists( 'vImage' ) ) {
            $DaoArticleContent->vImage = $request->input( 'vImage' );
        }
        if ( $request->exists( 'vSummary' ) ) {
            $DaoArticleContent->vSummary = $request->input( 'vSummary' );
        }
        if ( $request->exists( 'vMeta' ) ) {
            $DaoArticleContent->vMeta = $request->input( 'vMeta' );
        }
        if ( $request->exists( 'vDetail' ) ) {
            $DaoArticleContent->vDetail = $request->input( 'vDetail' );
        }
        if ( $request->exists( 'iRank' ) ) {
            $DaoArticleContent->iRank = $request->input( 'iRank' );
        }
        if ( $request->exists( 'iStatus' ) ) {
            $DaoArticleContent->iStatus = ( $DaoArticleContent->iStatus ) ? 0 : 1;
        }
        
        $DaoArticleContent->iUpdateTime = time();
        if ($DaoArticleContent->save()) {
            //Logs
            $this->_saveLogAction( $DaoArticleContent->getTable(), $DaoArticleContent->iId, 'edit', json_encode( $DaoArticleContent ) );
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
        $iId = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$iId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $map['iId'] = $iId;
        $map['bDel'] = 0;
        $DaoArticleContent = ArticleContent::where( $map )->first();
        if ( !$DaoArticleContent) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $DaoArticleContent->bDel = 1;
        
        $DaoArticleContent->iUpdateTime = time();
        if ($DaoArticleContent->save()) {
            //Logs
            $this->_saveLogAction( $DaoArticleContent->getTable(), $DaoArticleContent->iId, 'del', json_encode( $DaoArticleContent ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.del_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.del_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
