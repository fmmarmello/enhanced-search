<?php
	namespace Model;
	use Lib\Util;
	class Menu extends \ActiveRecord\Model {
		static $table_name = 'men_menuitem';

        public static function findMenu($idMenu) {
            
		   	$sql = array(
		   		'select' => 'm.menuid,
	   					m.nome,
	   					m.descricao, 
	   					m.flagpublico,
	   					m.flagprincipal,
	   					mi.titulo,
	   					mi.menuitemid,
	   					mi.menuitempaiid,
	   					mi.link,
	   					mi.target,
	   					mi.conteudoid,
	   					NULL AS filhos',
		   		'from' => 'men_menu AS m',
		   		'joins' => 'INNER JOIN men_menuitem AS mi ON mi.menuid = m.menuid',
		   		'conditions' => array('m.flagprincipal = -1 AND mi.menuitempaiid IS NULL AND m.flagpublico = -1 AND mi.flagpublico = -1 AND m.menuid = ?', $idMenu),
		   		'order' => 'mi.ordem ASC',
		   		'limit' => 999
		   	);
			$menu = self::find('all',$sql);

			foreach ($menu as $key => $menuitem) {
				// hotfix para problemas de servidor que nao permite configurar o apache decentemente
				// no caso, o apache nao respeita a chamada dinamica dos assets, procurando na raiz da hospedagem e esse hotfix e para 'corrigir' isso.
				$menuitem->link = (strpos($menuitem->link, "http") === false) ? "/".$menuitem->link : $menuitem->link;
		
				$menuitem->filhos = self::findMenuItem($menuitem->menuitemid);
				$menuitem->filhos = (empty($menuitem->filhos)) ? null : $menuitem->filhos;
			}
			
				
            return $menu;
            
        }

        public static function findMenuItem($id) {
            
		   	$sql = array(
		   		'select' => 'm.menuid,
	   					m.nome,
	   					m.descricao, 
	   					m.flagpublico,
	   					m.flagprincipal,
	   					mi.titulo,
	   					mi.target,
	   					mi.menuitemid,
	   					mi.menuitempaiid,
	   					mi.link,
	   					mi.conteudoid,
	   					NULL AS filhos',
		   		'from' => 'men_menu AS m',
		   		'joins' => 'INNER JOIN men_menuitem AS mi ON mi.menuid = m.menuid',
		   		'conditions' => array('m.flagprincipal = ? AND m.flagpublico = -1 AND mi.flagpublico = -1 AND mi.menuitempaiid = ?', -1, $id ),
		   		'order' => 'mi.ordem ASC',
		   		'limit' => 999
		   	);
			$menu = self::find('all',$sql);
			foreach ($menu as $key => $menuitem) {
				$menuitem->filhos = self::findMenuItem($menuitem->menuitemid);
			}

			
			return $menu;
        }

	}
		