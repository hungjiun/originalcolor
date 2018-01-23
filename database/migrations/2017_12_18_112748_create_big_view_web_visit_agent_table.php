<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigViewWebVisitAgentTable extends Migration
{
    protected $table = 'big_view_web_agent';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if ( !Schema::hasTable( $this->table )) {
            Schema::create( $this->table, function( Blueprint $table ) {
                $table->increments('iId');
                $table->integer('iVisit_id')->default(0);
                $table->string('vLang')->nullable();
                $table->string('vSystem')->nullable();
                $table->string('vOS')->nullable();
                $table->string('vDevice')->nullable();
                $table->string('vBrowers')->nullable();
            });
        }
        else {

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
