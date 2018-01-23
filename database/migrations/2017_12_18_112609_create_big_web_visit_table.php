<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigWebVisitTable extends Migration
{
    protected $table = 'big_web_visit';
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
                $table->string('vUserCode')->nullable();
                $table->string('vLanguage')->nullable();
                $table->text('vUserAgent')->nullable();
                $table->string('vXForwardedFor')->nullable();
                $table->string('vBluecoatVia')->nullable();
                $table->string('vRemoteAddr')->nullable();
                $table->integer('iDateTime')->default(0);
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
