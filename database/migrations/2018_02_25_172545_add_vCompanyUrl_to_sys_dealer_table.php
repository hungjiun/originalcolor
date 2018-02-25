<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVCompanyUrlToSysDealerTable extends Migration
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
            if ( !Schema::hasColumn( $this->table, 'vDealerCompanyUrl' )) {
                Schema::table( $this->table, function( $table ) {
                    $table->string( 'vDealerCompanyUrl' )->default( 0 )->after( 'vDealerColor' );
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
                    $table->dropColumn( 'vDealerCompanyUrl' );
                } );
            }
        }
    }
}
