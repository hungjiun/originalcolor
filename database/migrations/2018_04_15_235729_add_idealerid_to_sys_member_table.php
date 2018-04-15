<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdealeridToSysMemberTable extends Migration
{
    protected $table = 'sys_member';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if ( Schema::hasTable( $this->table )) {
            if ( !Schema::hasColumn( $this->table, 'iDealerId' )) {
                Schema::table( $this->table, function( $table ) {
                    $table->integer( 'iDealerId' )->default(0)->after( 'iAcType' );
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
                    $table->dropColumn( 'iDealerId' );
                } );
            }
        }
    }
}
