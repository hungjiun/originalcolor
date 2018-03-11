<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddvCarModelImageToCarModelColorsTable extends Migration
{
    protected $table = 'car_model_colors';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if ( Schema::hasTable( $this->table )) {
            if ( !Schema::hasColumn( $this->table, 'iCarModelImage' )) {
                Schema::table( $this->table, function( $table ) {
                    $table->string( 'vCarModelImage' )->default( 0 )->after( 'iCarColorId' );
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
                    $table->dropColumn( 'vCarModelImage' );
                } );
            }
        }
    }
}
