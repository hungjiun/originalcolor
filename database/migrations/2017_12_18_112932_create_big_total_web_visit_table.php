<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigTotalWebVisitTable extends Migration
{
    protected $table = 'big_total_web_visit';
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
                $table->string('vSourceID')->nullable();
                $table->string('vUserID')->nullable();
                $table->string('vRemoteAddr')->nullable();
                $table->string('vType')->nullable();
                $table->integer('iTotal')->default(0);
                $table->integer('iDateTime')->default(0);
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
