<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigViewWebVisitOnlineTable extends Migration
{
    protected $table = 'big_view_web_visit_online';
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
                $table->text('vUserCode')->nullable();
                $table->string('vRemoteAddr')->nullable();
                $table->integer('iStartTime')->default(0);
                $table->integer('iEndTime')->default(0);
                $table->integer('iStayTime')->default(0);
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
