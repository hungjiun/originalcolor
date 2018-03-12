<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddvDealerFontColorToSysDealerTable extends Migration
{
    protected $table = 'sys_dealer';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if ( Schema::hasTable( $this->table )) {
            if ( !Schema::hasColumn( $this->table, 'vDealerFontColor' )) {
                Schema::table( $this->table, function( $table ) {
                    $table->string( 'vDealerFontColor' )->nullable()->after( 'vDealerColor' );
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
                    $table->dropColumn( 'vDealerFontColor' );
                } );
            }
        }
    }
}
