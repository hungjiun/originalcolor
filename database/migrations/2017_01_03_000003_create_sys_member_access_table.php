<?php
// php artisan make:migration create_sys_member_access_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysMemberAccessTable extends Migration
{
    protected $table = 'sys_member_access';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        if ( !Schema::hasTable( $this->table )) {
            //
            Schema::create( $this->table, function( Blueprint $table ) {
                $table->increments( 'iId' );
                $table->integer( 'iMemberId' );
                $table->integer( 'iMenuId' );
                $table->tinyInteger( 'bOpen' )->default( 0 );
                $table->tinyInteger( 'bSet' )->default( 0 );
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
