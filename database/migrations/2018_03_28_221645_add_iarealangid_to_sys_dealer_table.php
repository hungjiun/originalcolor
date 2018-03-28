<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIarealangidToSysDealerTable extends Migration
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
            if ( !Schema::hasColumn( $this->table, 'iAreaLangId' )) {
                Schema::table( $this->table, function( $table ) {
                    $table->integer( 'iAreaLangId' )->default(0)->after( 'vDealerCode' );
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
                    $table->dropColumn( 'iAreaLangId' );
                } );
            }
        }
    }
}
