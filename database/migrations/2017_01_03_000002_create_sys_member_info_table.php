<?php
// php artisan make:migration create_sys_member_info_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysMemberInfo;

class CreateSysMemberInfoTable extends Migration
{
    protected $table = 'sys_member_info';

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
                $table->string( 'vUserImage', 255 )->nullable();
                $table->string( 'vUserName', 255 )->nullable();
                $table->string( 'vUserNameE', 255 )->nullable();
                $table->string( 'vUserTitle', 255 )->nullable();
                $table->string( 'vUserID', 255 )->nullable();
                $table->integer( 'iUserBirthday' )->default( 0 );
                $table->string( 'vUserEmail', 255 )->nullable();
                $table->string( 'vUserContact', 255 )->nullable();
                $table->string( 'vUserZipCode', 255 )->nullable();
                $table->string( 'vUserCity', 255 )->nullable();
                $table->string( 'vUserArea', 255 )->nullable();
                $table->string( 'vUserAddress', 255 )->nullable();
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
