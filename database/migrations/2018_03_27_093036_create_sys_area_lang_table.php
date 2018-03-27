<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysAreaLangTable extends Migration
{
    protected $table = "sys_area_lang";
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
                $table->string( 'vAreaLangName' );
                $table->tinyInteger( 'iStatus' )->default( 0 );
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
