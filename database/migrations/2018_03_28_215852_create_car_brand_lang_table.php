<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarBrandLangTable extends Migration
{
    protected $table = 'car_brand_lang';
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
                $table->integer( 'iCarBrandId' )->default( 0 );
                $table->integer( 'iLangId' )->default(0)->comment('語系ID');
                $table->string( 'vCarBrandName' )->nullable()->comment('車廠名稱');
                $table->longText( 'vSummary' )->nullable()->comment('車廠簡介');
                $table->integer( 'iCreateTime' )->default( 0 );
                $table->integer( 'iUpdateTime' )->default( 0 );
                $table->tinyInteger( 'iStatus' )->default( 0 );
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
