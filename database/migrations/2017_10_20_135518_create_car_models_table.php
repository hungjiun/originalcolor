<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarModelsTable extends Migration
{
    protected $table = 'car_models';
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
                $table->integer( 'iUserId' )->default( 0 );
                $table->string( 'vlang' )->nullable()->comment('語系');
                $table->string( 'vCarModelName' )->nullable()->comment('車型名稱');
                $table->string( 'vCarModelNameE' )->nullable()->comment('車型名稱英文');
                $table->string( 'vCarModelImg' )->nullable()->comment('車型圖片');
                $table->integer( 'iCarModelType' )->default( 0 )->comment('車型');
                $table->string( 'vCarModelAge' )->nullable()->comment('車型年份');
                $table->integer( 'iCarBrandId' )->default( 0 )->comment('車廠ID');
                $table->longText( 'vSummary' )->nullable()->comment('車型簡介');
                $table->longText( 'vDetail' )->nullable()->comment('車型說明');
                $table->string( 'vCarModelUrl' )->nullable()->comment('車型官網URL');
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
