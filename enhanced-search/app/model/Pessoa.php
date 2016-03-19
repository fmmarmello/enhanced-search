<?php
	
	namespace Model;

	use Controller;
	use Lib\Util;

	class Pessoa extends \ActiveRecord\Model {

		static $table_name = 'gapo_pessoa';


        public static function findCorretor($nome) {

        	$apelido = trim(str_replace("-", " ", strtolower($nome)));
            
		   	$sql = array(

		   		'select' => 'u.PessoaID,
	   					u.Nome,
	   					u.Email,
	   					u.EmailAlternativo,
	   					u.TelResidencial,
	   					u.TelCelular,
	   					u.TelComercial,
	   					u.DtNascimento,
	   					u.DtInclusao,
	   					u.DtAlteracao,
	   					u.FlagAtivo,
	   					u.FilialID,
	   					u.apelido',

		   		'from' => 'gapo_pessoa AS u',

		   		// 'joins' => 'INNER JOIN men_menuitem AS mi ON mi.menuid = m.menuid',

		   		// 'conditions' => array('u.FlagAtivo = -1 AND u.apelido LIKE CONCAT("%", ? ,"%")', $apelido),
		   		'conditions' => array('u.FlagAtivo = -1 AND u.apelido LIKE ?', $apelido),

		   		// 'order' => 'mi.ordem ASC',

		   		// 'limit' => 999
		   	);

			$corretor = self::find('all',$sql);

            // seta em uma session e cookie
            setcookie("corretor", Util::toJSON($corretor), (time()+60*60*24*365), "/");

			// Util::dbg($corretor);
            return $corretor;
            
        }


	}
		