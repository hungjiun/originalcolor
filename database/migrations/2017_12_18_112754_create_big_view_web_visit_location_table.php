<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigViewWebVisitLocationTable extends Migration
{
    protected $table = 'big_view_web_location';
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
                $table->string('vISOCode')->nullable();
                $table->string('vCountry')->nullable();
                $table->string('vCity')->nullable();
                $table->string('vState')->nullable();
                $table->string('vPostal_Code')->nullable();
                $table->string('vLat')->nullable();
                $table->string('vLon')->nullable();
                $table->string('vTimeZone')->nullable();
                $table->string('vContinent')->nullable();
                $table->string('vISP_domain')->nullable();
                $table->string('vISP_autonomousSystemNumber')->nullable();
                $table->string('vISP_organization')->nullable();
                $table->string('vISP_isp')->nullable();
                $table->string('vISP_autonomousSystemOrganization')->nullable();
                $table->tinyInteger('bDefault')->default(0);
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
