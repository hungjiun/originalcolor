<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
//Logs
//$this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;
use App\LogAction;
use App\SysMenu;

class _WebController extends Controller
{
    public $func;
    public $view;
    public $sys_menu;
    public $breadcrumb = [];
	public $title = "";

    /*
     *
     */
    public function __construct ()
    {
    }

    /*
     *
     */
    public function __initial ()
    { 
        $this->view = View()->make( config()->get( 'function.' . $this->func . '.view' ) );
        session()->put( 'menu_parent', config()->get( 'function.' . $this->func . '.menu_parent' ) );
        session()->put( 'menu_access', config()->get( 'function.' . $this->func . '.menu_access' ) );
        $mapSysMenu ['iParentId'] = 0;
        $mapSysMenu ['bOpen'] = 1;
        $this->sys_menu = SysMenu::where( $mapSysMenu )->orderBy( 'iRank', 'ASC' )->get();
        foreach ($this->sys_menu as $key => $var) {
            if ($var->bSubMenu) {
                $mapSysMenu ['iParentId'] = $var->iId;
                $mapSysMenu ['bOpen'] = 1;
                $var->second = SysMenu::where( $mapSysMenu )->orderBy( 'iRank', 'ASC' )->get();
                foreach ($var->second as $key2 => $var2) {
                    if ($var2->bSubMenu) {
                        $mapSysMenu ['iParentId'] = $var2->iId;
                        $mapSysMenu ['bOpen'] = 1;
                        $var2->third = SysMenu::where( $mapSysMenu )->orderBy( 'iRank', 'ASC' )->get();
                    }
                }
            }
        }
        $this->view->with( 'sys_menu', $this->sys_menu );
        $this->view->with( 'breadcrumb', $this->breadcrumb );
		$this->view->with( 'title', $this->title );
    }

    /*
     * $action : 1.add 2.edit 3.delete
     * $value : field->value
     */
    public function _saveLogAction ( $table_name, $table_id, $action, $value )
    {
        $DaoLogAction = new LogAction();
        $DaoLogAction->iMemberId = session( 'member.iId' );
        $DaoLogAction->vTableName = $table_name;
        $DaoLogAction->iTableId = $table_id;
        $DaoLogAction->vAction = $action;
        $DaoLogAction->vValue = $value;
        $DaoLogAction->iDateTime = time();
        $DaoLogAction->save();
    }
}
