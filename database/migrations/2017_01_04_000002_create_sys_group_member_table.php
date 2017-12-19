<?php
// php artisan make:migration create_sys_group_member_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysGroupMember;

class CreateSysGroupMemberTable extends Migration
{
    protected $table = 'sys_group_member';

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
                $table->integer( 'iGroupId' );
                $table->integer( 'iMemberId' );
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->tinyInteger( 'iStatus' )->default( 0 );
            } );
            $data_arr = [
                [
                    "iGroupId" => 1,
                    "iMemberId" => 1
                ]
            ];
            foreach ($data_arr as $key => $var) {
                $Dao = new SysGroupMember ();
                $Dao->iGroupId = $var ['iGroupId'];
                $Dao->iMemberId = $var ['iMemberId'];
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->iStatus = 1;
                $Dao->save();
            }
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
