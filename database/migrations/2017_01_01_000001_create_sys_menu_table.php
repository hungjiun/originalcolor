<?php
// php artisan make:migration create_sys_menu_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysMenuTable extends Migration
{
    protected $table = "sys_menu";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        if ( !Schema::hasTable( $this->table )) {
            //
            Schema::create( $this->table, function( Blueprint $table ) {
                $table->increments( 'iId' );
                $table->integer( 'iType' )->default( 0 );
                $table->string( 'vName', 255 );
                $table->string( 'vUrl', 255 );
                $table->string( 'vCss', 255 );
                $table->tinyInteger( 'bSubMenu' )->default( 0 );
                $table->integer( 'iParentId' )->default( 0 );
                $table->string( 'vAccess', 255 )->default( '0' );
                $table->tinyInteger( 'bOpen' )->default( 0 );
                $table->integer( 'iRank' )->default( 0 );
            } );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        //
        Schema::dropIfExists( $this->table );
    }
}
