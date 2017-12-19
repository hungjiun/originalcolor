<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleContentTable extends Migration
{
    protected $table = 'article_content';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable( $this->table )) {
            Schema::create( $this->table, function (Blueprint $table) {
                $table->increments('iId');
                $table->integer('iType')->default( 0 );
                $table->string('vTitle')->nullable();
                $table->string('vImage')->nullable();
                $table->text('vSummary')->nullable();
                $table->string('vMeta')->nullable();
                $table->string('vUrl')->nullable();
                $table->longText('vDetail')->nullable();
                $table->integer('iDate')->default( 0 );
                $table->integer('iCreateTime')->default( 0 );
                $table->integer('iUpdateTime')->default( 0 );
                $table->integer('iRank')->default( 0 );
                $table->tinyInteger( 'bShow' )->default( 0 );
                $table->integer('iStatus')->default( 0 );
                $table->tinyInteger( 'bDel' )->default( 0 );
            });
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
