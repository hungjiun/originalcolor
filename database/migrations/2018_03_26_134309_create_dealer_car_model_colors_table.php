<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealerCarModelColorsTable extends Migration
{
    protected $table = 'dealer_car_model_colors';
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
                $table->integer( 'iDealerId' )->default( 0 )->comment('經銷商ID');
                $table->integer( 'iCarBrandId' )->default( 0 )->comment('車廠ID');
                $table->integer( 'iCarModelId' )->default( 0 )->comment('車款ID');
                $table->integer( 'iCarColorId' )->default( 0 )->comment('車色ID');
                $table->string( 'vCarModelImage' )->nullable()->comment('車款圖片');
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
        if (env( 'DB_REFRESH', false )) {
            Schema::dropIfExists( $this->table );
        }
    }
}
