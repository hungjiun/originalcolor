<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarBrandTable extends Migration
{
    protected $table = 'car_brand';
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
                $table->string( 'vlang' )->nullable()->comment('語系');
                $table->string( 'vCarBrandName' )->nullable()->comment('車廠名稱');
                $table->string( 'vCarBrandNameE' )->nullable()->comment('車廠名稱英文');
                $table->string( 'vCarBrandImg' )->nullable()->comment('車廠圖片');
                $table->string( 'vCarBrandCountry' )->nullable()->comment('車廠國家');
                $table->longText( 'vSummary' )->nullable()->comment('車廠簡介');
                $table->string( 'vCarBrandUrl' )->nullable()->comment('車廠官網URL');
                $table->integer( 'iRank' )->default( 0 );
                $table->integer( 'iCreateTime' )->default( 0 );
                $table->integer( 'iUpdateTime' )->default( 0 );
                $table->tinyInteger( 'iStatus' )->default( 0 );
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
        //
        if (env( 'DB_REFRESH', false )) {
            Schema::dropIfExists( $this->table );
        }
    }
}
