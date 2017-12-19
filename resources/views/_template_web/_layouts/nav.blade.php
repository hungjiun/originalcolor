<?php
$menu_access = Session::get( 'menu_access' );
$menu_parent = Session::get( 'menu_parent' );
$nav_html = "";
$nav_html .= '<ul class="sidebar-menu" data-widget="tree">';
foreach ($sys_menu as $key => $var) {
    if ( !Session::get( 'access.' . $var->iId )) {
        continue;
    }
    $active = ( $menu_access == $var->iId ) ? "active" : "";
	$menu_open = ( $menu_parent [0] == $var->iId ) ? "menu-open" : "";
	$display = ( $menu_parent [0] == $var->iId ) ? 'style="display:block;"' : 'style="display:none;"';
    if ($var->bSubMenu) {
		$nav_html .= '<li class="treeview ' . $menu_open . '">';
		$nav_html .= '<a href="' . ( ( $var->vUrl != "" ) ? url( $var->vUrl ) : "#" ) . '">';
		$nav_html .= '<i class="fa ' . $var->vCss . '"></i> <span>' . trans( '_menu.' . $var->vName . '.title' ) . '</span>';
		$nav_html .= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
		$nav_html .= '</a>';
		$nav_html .= '<ul class="treeview-menu" ' . $display . '>';
        foreach ($var->second as $key2 => $var2) {
            if ( !Session::get( 'access.' . $var2->iId )) {
                continue;
            }    
            $active = ( $menu_access == $var2->iId ) ? "active" : "";
			$menu_open = ( $menu_parent [1] == $var2->iId ) ? "menu-open" : "";
			$display = ( $menu_parent [1] == $var2->iId ) ? 'style="display:block;"' : 'style="display:none;"';
            if ($var2->bSubMenu) {
                $nav_html .= '<li class="treeview ' . $menu_open . '">';
				$nav_html .= '<a href="' . ( ( $var2->vUrl != "" ) ? url( $var2->vUrl ) : "#" ) . '">';
				$nav_html .= '<i class="fa fa-circle-o"></i> <span>' . trans( '_menu.' . $var2->vName . '.title' ) . '</span>';
				$nav_html .= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
				$nav_html .= '</a>';
				$nav_html .= '<ul class="treeview-menu" ' . $display . '>';
                foreach ($var2->third as $key3 => $var3) {
                    if ( !Session::get( 'access.' . $var3->iId )) {
                        continue;
                    }
                    $active = ( $menu_access == $var3->iId ) ? "active" : "";
					$nav_html .= '<li class="' . $active . '">';
					$nav_html .= '<a href="' . ( ( $var3->vUrl != "" ) ? url( $var3->vUrl ) : "#" ) . '">';
					$nav_html .= '<i class="fa fa-circle-o"></i>' . trans( '_menu.' . $var3->vName . '.title' );
					$nav_html .= '</a>';
					$nav_html .= '</li>';
                }
                $nav_html .= '</ul>';
				$nav_html .= '</li>';
            } else {
				$nav_html .= '<li class="' . $active . '">';
				$nav_html .= '<a href="' . ( ( $var2->vUrl != "" ) ? url( $var2->vUrl ) : "#" ) . '">';
				$nav_html .= '<i class="fa fa-circle-o"></i>' . trans( '_menu.' . $var2->vName . '.title' );
				$nav_html .= '</a>';
				$nav_html .= '</li>';
			}
        }
        $nav_html .= '</ul>';
		$nav_html .= '</li>';
    } else {
		$nav_html .= '<li class="' . $active . '">';
        $nav_html .= '<a href="' . ( ( $var->vUrl != "" ) ? url( $var->vUrl ) : "#" ) . '">';
        $nav_html .= '<i class="fa ' . $var->vCss . '"></i> <span>' . trans( '_menu.' . $var->vName . '.title' ) . '</span>';
        $nav_html .= '</a>';
		$nav_html .= '</li>';
	}
}
$nav_html .= '</ul>';

echo $nav_html;
?>
