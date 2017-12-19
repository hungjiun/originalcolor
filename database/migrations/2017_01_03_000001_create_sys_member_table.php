<?php
// php artisan make:migration create_sys_member_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysMember;

class CreateSysMemberTable extends Migration
{
    protected $table = 'sys_member';

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
                $table->string( 'vAgentCode', 20 );
                $table->integer( 'iUserId' )->unique();
                $table->string( 'vUserCode', 255 )->unique();
                $table->integer( "iAcType" );
                $table->string( 'vAccount', 50 )->unique();
                $table->string( 'vPassword', 255 );
                $table->string( 'vCreateIP', 255 );
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->string( 'vSessionId' )->nullable();
                $table->integer( 'iLoginTime' )->default( 0 );
                $table->tinyInteger( 'bActive' )->default( 0 );
                $table->tinyInteger( 'iStatus' )->default( 0 );
            } );
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
