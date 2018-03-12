<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarColorsTable extends Migration
{
    protected $table = 'car_colors';
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
                $table->string( 'vCarColorName' )->nullable()->comment('車色名稱');
                $table->string( 'vCarColorNameE' )->nullable()->comment('車色名稱英文');
                $table->string( 'vCarColorImg' )->nullable()->comment('車色圖片');
                $table->string( 'vCarColorCode' )->nullable()->comment('色碼');
                $table->string( 'vCarColorNationalCode' )->nullable()->comment('國際編號');
                $table->integer( 'iCarBrandId' )->default( 0 )->comment('車廠ID');
                $table->string( 'vPenNumber' )->nullable()->comment('台灣編號');
                $table->longText( 'vSummary' )->nullable()->comment('車色簡介');
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
