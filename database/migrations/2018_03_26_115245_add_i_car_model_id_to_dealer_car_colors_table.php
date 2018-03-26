<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddICarModelIdToDealerCarColorsTable extends Migration
{
    protected $table = 'dealer_car_colors';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if ( Schema::hasTable( $this->table )) {
            if ( !Schema::hasColumn( $this->table, 'iCarModelId' )) {
                Schema::table( $this->table, function( $table ) {
                    $table->integer( 'iCarModelId' )->default(0)->after( 'iCarBrandId' );
                } );
            }
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
            if ( Schema::hasTable( $this->table )) {
                Schema::table( $this->table, function( $table ) {
                    $table->dropColumn( 'iCarModelId' );
                } );
            }
        }
    }
}
