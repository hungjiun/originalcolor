<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarModelsLangTable extends Migration
{
    protected $table = 'car_models_lang';
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
                $table->integer( 'iCarModelId' )->default( 0 );
                $table->integer( 'iLangId' )->default(0)->comment('語系ID');
                $table->string( 'vCarModelName' )->nullable()->comment('車型名稱');
                $table->longText( 'vSummary' )->nullable()->comment('車型簡介');
                $table->longText( 'vDetail' )->nullable()->comment('車型說明');
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
