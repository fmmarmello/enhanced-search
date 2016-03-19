<?php
	namespace Model;
	use Lib\Util;
	class LocalBairro extends \ActiveRecord\Model {
		static $table_name = 'sil_bairro';

		public static function getImovelBairro($id){
			return self::find($id, array('select' => 'nome_original'));
		}

	}