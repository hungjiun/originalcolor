<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigViewWebClickTable extends Migration
{
    protected $table = 'big_view_web_click';
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
                $table->string('vSourceID')->nullable();
                $table->string('vUserID')->nullable();
                $table->text('vReferer')->nullable();
                $table->text('vReferer2')->nullable();
                $table->string('vGroup')->nullable();
                $table->string('vMod')->nullable();
                $table->string('vFunc')->nullable();
                $table->string('vAction')->nullable();
                $table->integer('iStartTime')->default(0);
                $table->integer('iEndTime')->default(0);
                $table->integer('iCostTime')->default(0);
                $table->tinyInteger('iStates')->default(0);
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
