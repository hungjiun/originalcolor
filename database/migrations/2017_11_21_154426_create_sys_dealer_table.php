<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysDealerTable extends Migration
{
    protected $table = 'sys_dealer';
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
                $table->integer( 'iType' )->default( 0 )->comment('0:新增, 1:舊有');
                $table->string( 'vDealerCode' )->nullable();
                $table->integer( 'iAreaLangId' )->default( 0 );
                $table->string( 'vDealerName' )->nullable();
                $table->string( 'vDealerNameE' )->nullable();
                $table->string( 'vUrlName' )->nullable();
                $table->string( 'vDealerImg' )->nullable();
                $table->string( 'vDealerIcon' )->nullable();
                $table->string( 'vDealerTel' )->nullable();
                $table->string( 'vDealerFax' )->nullable();
                $table->string( 'vDealerEmail' )->nullable();
                $table->string( 'vDealerAddr' )->nullable();
                $table->tinyInteger( 'bLink' )->default( 0 );
                $table->string( 'vDealerLink' )->nullable();
                $table->string( 'vDealerColor' )->nullable();
                $table->string( 'vDealerFontColor' )->nullable();
                $table->string( 'vDealerCompanyUrl' )->nullable();
                $table->longText( 'vDealerDesp' )->nullable();
                $table->integer( 'iCreateTime' )->default( 0 );
                $table->integer( 'iUpdateTime' )->default( 0 );
                $table->tinyInteger( 'iStatus' )->default( 0 );
                $table->tinyInteger( 'bDel' )->default( 0 );
            } );
        } else {
            if ( !Schema::hasColumn( $this->table, 'iId' )) {
                Schema::table( $this->table, function( $table ) {
                } );
            } else {
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
        if (env( 'DB_REFRESH', false )) {
            Schema::dropIfExists( $this->table );
        }
    }
}
