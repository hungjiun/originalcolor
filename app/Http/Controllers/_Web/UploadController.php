<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\_LIB\UploadHandler;
use Illuminate\Support\Facades\Input;
use App\SysFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {
        parent::__construct();
    }

    /*
     *
     */
    public function doUploadImage ()
    {
        $upload_handler = new UploadHandler ();
        $file_info = $upload_handler->get_response();
        foreach ($file_info ['files'] as $key => $var) {
            if ( !isset ( $var->error )) {
                $file_id = $this->_addFile( $var );
            }
        }
    }

    /*
     *
     */
    public function doUploadImage2 ( Request $request )
    {
        $image = $_FILES['files'];

        $filenames = $image['name'];
        $filetypes = $image['type'];
        $filesizes = $image['size'];

        //$filename = date( 'YmdHis' ) . uniqid() . '.jpg';
        //$filePath = env( 'UPLOAD_PATH', dirname( $_SERVER ['SCRIPT_FILENAME'] ) . '/' ) . config ()->get ( 'config.path.userdata' ) . session ()->get ( 'member.vUserCode' ) . "/" . date ( "Ymd" ) . "/";
        $filePath = env( 'UPLOAD_PATH', dirname( $_SERVER ['SCRIPT_FILENAME'] ) . '/' ) . config ()->get ( 'config.path.userdata' );
        if ( !file_exists( $filePath )) {
            mkdir( $filePath, 0777, true );
        }
                
        $mime = explode( '/', $filetypes[0] );

        if( !$mime && ($mime[0] != "image") ) {
            $this->rtndata ['status'] = 0;
            return response()->json( $this->rtndata );
        }

        $ext = $mime[1] == "jpeg" ? "jpg" : $mime[1];
        if ($mime[1] == "jpeg") {
           $ext = "jpg";
        } else {
            $temp = explode( '+', $mime[1] );
            $ext = $temp[0];
        }

        $filename = date( 'YmdHis' ) . uniqid() . '.'. $ext;
        if( !move_uploaded_file( $image['tmp_name'][0], $filePath . '/' . $filename ) ) {
            $this->rtndata ['status'] = 0;
            return response()->json( $this->rtndata );
        } 

        $imageinfo = getimagesize( $filePath . '/' . $filename );

        //
        $Dao = new SysFiles ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iType = 1;
        $Dao->vFileType = $filetypes[0];
        $Dao->vFileServer = $this->_get_full_url() . "/";
        $Dao->vFilePath = config()->get( 'config.path.userdata' );
        $Dao->vFileName = $filename;
        $Dao->vOrigName = $filenames[0];
        $Dao->iFileSize = $filesizes[0];
        $Dao->iImageWidth = $imageinfo[0] ? $imageinfo[0] : 0;
        $Dao->iImageHeight = $imageinfo[1] ? $imageinfo[1] : 0;
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->save();

        //
        //$file['name'] = $filename;
        //$file['url'] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
        $this->rtndata['image'] = $image;
        $this->rtndata ['status'] = 1;
        $this->rtndata ['imageId'] = $Dao->iId;
        $this->rtndata ['filename'] = $Dao->vFileName;
        $this->rtndata ['file'] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
        
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doUploadImageMulti ( Request $request )
    {
        $image = $_FILES['files'];

        $filenames = $image['name'];
        $filetypes = $image['type'];
        $filesizes = $image['size'];

        //$filename = date( 'YmdHis' ) . uniqid() . '.jpg';
        $filePath = env( 'UPLOAD_PATH', dirname( $_SERVER ['SCRIPT_FILENAME'] ) . '/' ) . config ()->get ( 'config.path.userdata' ) . session ()->get ( 'member.vUserCode' ) . "/" . date ( "Ymd" ) . "/";
        
        if ( !file_exists( $filePath )) {
            mkdir( $filePath, 0777, true );
        }
        
        $files = [];
        foreach( $filenames as $key => $var) {
            $mime = explode( '/', $filetypes[$key] );

            if( !$mime =="image" ) continue;

            $ext = "jpg";
            if( $mime[1] =="jpeg" ) {
                $ext = "jpg";
            } else {
                $ext = $mime[1];
            }

            $filename = date( 'YmdHis' ) . uniqid() . '-' . $key . '.'. $ext;
            if( !move_uploaded_file( $image['tmp_name'][$key], $filePath . '/' . $filename ) ) {
                $this->rtndata ['status'] = 0;
                return response()->json( $this->rtndata );
            } 

            $imageinfo = getimagesize( $filePath . '/' . $filename );

            //
            $Dao = new SysFiles ();
            $Dao->iMemberId = session()->get( 'member.iId' );
            $Dao->iType = 1;
            $Dao->vFileType = $filetypes[$key];
            $Dao->vFileServer = $this->_get_full_url() . "/";
            $Dao->vFilePath = config()->get( 'config.path.userdata' ) . session()->get( 'member.vUserCode' ) . "/" . date( "Ymd" ) . "/";
            $Dao->vFileName = $filename;
            $Dao->vOrigName = $var;
            $Dao->iFileSize = $filesizes[$key];
            $Dao->iImageWidth = $imageinfo[0] ? $imageinfo[0] : 0;
            $Dao->iImageHeight = $imageinfo[1] ? $imageinfo[1] : 0;
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            $Dao->save();

            $files [ $key ] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
        }

        //
        //$file['name'] = $filename;
        //$file['url'] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
        //$this->rtndata['files'] = $file;
        $this->rtndata ['status'] = 1;
        $this->rtndata ['files'] = $files;
        
        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doUploadImageBase64 ()
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
    public function _addFile ( $file_info )
    {
        $Dao = new SysFiles ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iType = 2;
        $Dao->vFileType = $file_info->type;
        $tmp_arr = explode( config()->get( 'config.path.userdata' ), dirname( $file_info->url ), 2 );
        $Dao->vFileServer = $tmp_arr [0];
        $Dao->vFilePath = config()->get( 'config.path.userdata' ) . $tmp_arr [1];
        $Dao->vFileName = $file_info->name;
        $Dao->iFileSize = $file_info->size;
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->save();

        return $Dao->iId;
    }
}
