<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysFilesTable extends Migration
{
    protected $table = 'sys_files';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable( $this->table )) {
            //
            Schema::create( $this->table, function( Blueprint $table ) {
                $table->increments( 'iId' );
                $table->integer( 'iMemberId' )->default( 0 );
                $table->integer( 'iType' )->default( 1 );
                $table->string( 'vFileType' )->nullable();
                $table->string( 'vFileServer' )->nullable();
                $table->string( 'vFilePath' )->nullable();
                $table->string( 'vFileName' )->nullable();
                $table->string( 'vOrigName' )->nullable();
                $table->string( 'vFileTitle' )->nullable();
                $table->string( 'vFileDesp' )->nullable();
                $table->longText( 'vDetail' )->nullable();
                $table->integer( 'iFileSize' )->default( 0 );
                $table->integer( 'iImageWidth' )->default( 0 );
                $table->integer( 'iImageHeight' )->default( 0 );
                $table->integer( 'iCreateTime' )->default( 0 );
                $table->integer( 'iUpdateTime' )->default( 0 );
                $table->tinyInteger( 'bDel' )->default( 0 );
            } );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (env( 'DB_REFRESH', false )) {
            Schema::dropIfExists( $this->table );
        }
    }
}
