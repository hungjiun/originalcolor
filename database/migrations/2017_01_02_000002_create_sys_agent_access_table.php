<?php
// php artisan make:migration create_sys_agent_access_table
// php artisan migrate
// php artisan migrate:refresh
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SysAgentAccess;

class CreateSysAgentAccessTable extends Migration
{
    protected $table = 'sys_agent_access';

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
                $table->integer( 'iLevel' );
                $table->string( 'vAgentCode', 20 );
                $table->integer( 'iAcType' );
                $table->string( 'vAccessTitle' );
                $table->integer( 'iCreateTime' );
                $table->integer( 'iUpdateTime' );
                $table->tinyInteger( 'iStatus' )->default( 0 );
            } );

            $data_arr = [
                [
                    "iLevel" => 1,
                    "vAgentCode" => "PTW10001",
                    "iAcType" => 1,
                    "vAccessTitle" => "系統管理員"
                ],
                [
                    "iLevel" => 2,
                    "vAgentCode" => "PTW10001",
                    "iAcType" => 2,
                    "vAccessTitle" => "平台管理員"
                ],
                [
                    "iLevel" => 3,
                    "vAgentCode" => "PTW10001",
                    "iAcType" => 3,
                    "vAccessTitle" => "部門管理員"
                ],
                [
                    "iLevel" => 4,
                    "vAgentCode" => "PTW10001",
                    "iAcType" => 4,
                    "vAccessTitle" => "店家自營商"
                ],
                [
                    "iLevel" => 5,
                    "vAgentCode" => "PTW10001",
                    "iAcType" => 5,
                    "vAccessTitle" => "合作廠商"
                ],
                [
                    "iLevel" => 6,
                    "vAgentCode" => "PTW10001",
                    "iAcType" => 6,
                    "vAccessTitle" => "供貨供應商"
                ],
                [
                    "iLevel" => 999,
                    "vAgentCode" => "PTW10001",
                    "iAcType" => 999,
                    "vAccessTitle" => "一般會員"
                ],
            ];

            foreach ($data_arr as $key => $var) {
                $Dao = new SysAgentAccess ();
                $Dao->iLevel = $var ['iLevel'];
                $Dao->vAgentCode = $var ['vAgentCode'];
                $Dao->iAcType = $var ['iAcType'];
                $Dao->vAccessTitle = $var ['vAccessTitle'];
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
