<?php

	namespace Model;

	use Controller;
	use Lib\Util;

	class Param extends \ActiveRecord\Model {


		static $table_name = 'gapo_variavel';		


		public static function getVar($varName){

		   	$sql = array(
		   		'select' => '
		   			VariavelNome,
		   			VariavelValor ',

		   		'from' => 'gapo_variavel v',

		   		'conditions' => array('v.FlagAtivo = ? AND v.VariavelNome = "host_admin" ', -1),

		   	);

			$varValue = self::find('first', $sql);

        	return $varValue;
		}
		

		public static function getHostAdmin(){

		   	$sql = array(
		   		'select' => '
		   			VariavelNome,
		   			VariavelValor ',

		   		'from' => 'gapo_variavel v',

		   		'conditions' => array('v.FlagAtivo = ? AND v.VariavelNome = "host_admin" ', -1),

		   	);
			$varValue = self::find('first', $sql);
			return $varValue->variavelvalor;
		}

		public static function getHostAdminImv(){			
		   	$sql = array(
		   		'select' => '
		   			VariavelNome,
		   			VariavelValor ',

		   		'from' => 'gapo_variavel v',

		   		'conditions' => array('v.FlagAtivo = ? AND v.VariavelNome = "host_admin" ', -1),

		   	);
			$varValue = self::find('first', $sql);
			return $varValue->variavelvalor;
		}


		// find generico nao assocido diretamente a um emp ou imv
		public static function findQuartos(){

			$sql = "SELECT 
						it.Quartos AS NOME,
						it.Quartos AS ID,
						count(it.ImovelID) as TOTAL,
						it.ImovelAmbienteQntID, 
						it.ImovelID,
						it.Suites,
						it.BanheiroSocial,
						it.BanheiroServico,
						it.Lavabo,
						it.Dependencia,
						it.DependenciaRevertida,
						it.DependenciaReversivel,
						it.Sala,
						it.Varanda,
						it.Vagas

					FROM imv_imovelambienteqnt AS it 
					WHERE it.Quartos > 0
					GROUP BY it.Quartos
					ORDER BY it.Quartos ASC
			";
			$quartos = self::find_by_sql($sql);
			foreach ($quartos as $quarto) {

				if($quarto->nome > 1){
					$quarto->nome .= " Quartos";
				}else{
					$quarto->nome = "1 Quarto";
				}
			}

			return $quartos;
		}


		// find generico nao assocido diretamente a um emp ou imv
		public static function findNaturezas(){

			$sql = "SELECT 
						na.ImovelNaturezaID AS id,
						na.NaturezaNome AS nome

						FROM imv_imovelnatureza AS na 

						GROUP BY na.ImovelNaturezaID
						ORDER BY na.NaturezaNome ASC
				";

			$naturezas = self::find_by_sql($sql);
			foreach ($naturezas as $natureza) {
				$natureza->nome = utf8_encode($natureza->nome);
			}

			return $naturezas;

		}	


		// find generico nao assocido diretamente a um emp ou imv
		public static function findTipos(){


			$sql = "SELECT 
						it.ImovelTipoID AS ID, 
						it.Nome AS NOME,
						it.Icone,
						it.Sigla,
						it.Tipo,
						it.SubTipo,
						it.Categoria
					FROM imv_imoveltipo AS it
					ORDER BY it.Nome ASC
			";

			$tipos = self::find_by_sql($sql);
			foreach ($tipos as $tipo) {
				$tipo->nome = utf8_encode($tipo->nome);
			}
			return $tipos;
		}

		public static function closeConnection(){
            static::Table()->conn = null; 
			return static::Table()->conn; 
      	}

		
	}