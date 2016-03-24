<?php

	namespace Model;

	use Controller;
	use Lib\Util;

	class LocalEstado extends \ActiveRecord\Model {

		static $table_name = 'sil_estado';


		public static function findUFs(){


			$sql = "SELECT 
						e.id AS id,
						e.nome AS nome,
						e.sigla AS sigla

						FROM sil_estado AS e
				";

			$ufs = self::find_by_sql($sql);
			foreach ($ufs as $uf) {
				$uf->nome = utf8_encode($uf->sigla);
			}

			return $ufs;

		}		

	}