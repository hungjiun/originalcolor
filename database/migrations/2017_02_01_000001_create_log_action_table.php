<?php
// php artisan make:migration create_log_action_table
// php artisan migrate
// php artisan migrate:refresh

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogActionTable extends Migration
{
    protected $table = "log_action";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        //
        if ( !Schema::hasTable( $this->table )) {
            //
            Schema::create( $this->table, function( Blueprint $table ) {
                $table->increments( 'iId' );
                $table->integer( 'iMemberId' );
                $table->string( 'vTableName', 255 );
                $table->integer( 'iTableId' );
                $table->string( 'vAction', 255 );
                $table->longText( 'vValue' );
                $table->integer( 'iDateTime' );
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
    public function down ()
    {
        //
        if (env( 'DB_REFRESH', false )) {
            Schema::dropIfExists( $this->table );
        }
    }
}
