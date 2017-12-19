<?php
namespace App\Http\Controllers\_Web\Material;

use App\Http\Controllers\_Web\_WebController;
use App\SysFiles;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ImageController extends _WebController
{
    public $module = "material";
    public $action = "image";
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

        $this->func = "web." . $this->module . "." . $this->action;
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function getList ()
    {
        $iDisplayLength = Input::get( 'iDisplayLength' );
        $iDisplayStart = Input::get( 'iDisplayStart' );
        $sEcho = Input::get( 'sEcho' );
        $sort_arr = explode ( ',', Input::get( 'sColumns' ) );
        $sort_name = $sort_arr[ Input::get( 'iSortCol_0' ) ];
        $sort_dir = Input::get( 'sSortDir_0' );

        $map['bDel'] = 0;
        $count = SysFiles::where( $map )->count();
        $data_arr = SysFiles::where( $map )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vFile = $var->vFileServer . $var->vFilePath . $var->vFileName;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $count;
        $this->rtndata ['iTotalRecords'] = $count;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function getImageList ( Request $request )
    {
        $pageNumber = $request->exists( 'pageNumber' ) ? $request->input( 'pageNumber' ) : 0;
        $itemsOnPage = $request->exists( 'itemsOnPage' ) ? $request->input( 'itemsOnPage' ) : 0;
        $skipNum = ( $pageNumber - 1 ) * $itemsOnPage;

        $map['bDel'] = 0;
        $count = SysFiles::where( $map )->count();
        $data_arr = SysFiles::where( $map )->orderBy( 'iCreateTime', 'asc' )->skip( $skipNum )->take( $itemsOnPage )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->vFile = $var->vFileServer . $var->vFilePath . $var->vFileName;
            $var->vResolution = $var->iImageWidth . ' * ' . $var->iImageHeight;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['iTotalCount'] = $count;
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
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action ),
            $this->module . "." . $this->action . ".add" => url( 'web/' . $this->module . '/' . $this->action . '/add' )
        ];

        $this->func = "web." . $this->module . "." . $this->action . ".add";
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function doDel ()
    {
    }

    /*
     *
     */
    public function doDelMulti ()
    {
    }

    /*
     *
     */
    public function edit ( Request $request )
    {
        $this->breadcrumb = [
            $this->module => "#",
            $this->module . "." . $this->action => url( 'web/' . $this->module . '/' . $this->action ),
            $this->module . "." . $this->action . ".edit" => url( 'web/' . $this->module . '/' . $this->action . '/edit' )
        ];

        $this->func = "web." . $this->module . "." . $this->action . ".edit";
        $this->__initial();

        $imageId = $request->exists( 'id' ) ? $request->input( 'id' ) : 0;

        $map['iId'] = $imageId;
        $map['bDel'] = 0;
        $image = SysFiles::where( $map )->first();

        $this->view->with ( 'image', $image );
        return $this->view;
    }

    /*
     *
     */
    public function doSave ()
    {
        $id = ( Input::has( 'iId' ) ) ? Input::get( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = SysMember::where( 'iAcType', 'like', '9%' )->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if (Input::has( 'bActive' )) {
            $Dao->bActive = ( $Dao->bActive ) ? 0 : 1;
        }
        if (Input::has( 'iStatus' )) {
            $Dao->iStatus = ( $Dao->iStatus ) ? 0 : 1;
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
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
    public function doUploadCropImage ( Request $request )
    {
        if ( !Input::has( 'image' )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.upload.fail' );

            return response()->json( $this->rtndata );
        }

        $image = explode( ',', Input::get( 'image' ) );
        $data = base64_decode( $image [1] );
        $path = env( 'UPLOAD_PATH', dirname( $_SERVER ['SCRIPT_FILENAME'] ) . '/' ) . config()->get( 'config.path.userdata' ) . session()->get( 'member.vUserCode' ) . "/" . date( "Ymd" ) . "/";
        if ( !file_exists( $path )) {
            mkdir( $path, 0777, true );
        }
        $filename = uniqid() . '.jpg';
        $success = file_put_contents( $path . $filename, $data );
        if ( !$success) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.upload.fail' );

            return response()->json( $this->rtndata );
        }
        $Dao = new SysFiles ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iType = 1;
        $Dao->vFileType = "image/jpeg";
        $Dao->vFileServer = $this->_get_full_url() . "/";
        $Dao->vFilePath = config()->get( 'config.path.userdata' ) . session()->get( 'member.vUserCode' ) . "/" . date( "Ymd" ) . "/";
        $Dao->vFileName = $filename;
        $Dao->iFileSize = filesize( $path . $filename );
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            $fileid = $Dao->iId;
        }
        $rtndata = [
            'fileid' => $fileid,
            'path' => $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName
        ];
        $this->rtndata ['status'] = 1;
        $this->rtndata ['info'] = $rtndata;

        return response()->json( $this->rtndata );
    }
    /*
     *
     */
    public function doCutImage ( Request $request )
    {
        $id = $request->exists( 'id' ) ? $request->input ( 'id' ) : 0;
        $x = $request->exists( 'x' ) ? $request->input ( 'x' ) : 0;
        $y = $request->exists( 'y' ) ? $request->input ( 'y' ) : 0;
        $width = $request->exists( 'width' ) ? $request->input ( 'width' ) : 0;
        $height = $request->exists( 'height' ) ? $request->input ( 'height' ) : 0;

        $map['iId'] = $id;
        $map['bDel'] = 0;
        $image = SysFiles::where( $map )->first();
        if($image) {
            $src = env( 'UPLOAD_PATH', dirname( $_SERVER ['SCRIPT_FILENAME'] ) . '/' ) . $image->vFilePath . $image->vFileName;
            $mime = explode( '/', $image->vFileType );

            if( !$mime && ($mime[0] != "image") ) {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.save_fail' );
                return response()->json( $this->rtndata );
            }

            switch ( $mime[1] ) {
                case 'jpeg':
                    $img = imagecreatefromjpeg($src);
                    break;
                case 'png':
                    $img = imagecreatefrompng($src);
                    break;
                case 'gif':
                    $img = imagecreatefromgif($src);
                    break;
                case 'bmp':
                    $img = imagecreatefrombmp($src);
                    break;
                default:
                    $this->rtndata ['status'] = 0;
                    $this->rtndata ['message'] = trans( '_web_message.save_fail' );
                    return response()->json( $this->rtndata );
            }
            
            $img = imagecreatefromjpeg($src);
            $dest = imagecreatetruecolor($width, $height);

            imagecopyresampled($dest, $img, 0, 0, $x, $y, $width, $height, $width, $height);

            switch ( $mime[1] ) {
                case 'jpeg':
                    $quality = 100;
                    imagejpeg($dest, $src, $quality);
                    break;
                case 'png':
                    imagepng($dest, $src);
                    break;
                case 'gif':
                    imagegif($dest, $src);
                    break;
                case 'bmp':
                    imagebmp($dest, $src);
                    break;
                default:
                    $this->rtndata ['status'] = 0;
                    $this->rtndata ['message'] = trans( '_web_message.save_fail' );
                    return response()->json( $this->rtndata );
            }

            imagedestroy($img);

            $image->iImageWidth = $width;
            $image->iImageHeight = $height;
            $image->iUpDateTime = time();
            $image->save();

            $this->rtndata ['status'] = 1;
            $this->rtndata ['imageId'] = $image->iId;
            $this->rtndata ['filename'] = $image->vFileName;
            $this->rtndata ['file'] = $image->vFileServer . $image->vFilePath . $image->vFileName;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
