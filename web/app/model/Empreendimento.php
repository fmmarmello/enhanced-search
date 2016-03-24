<?php
	
	namespace Model;

	use Lib\Util;

	class Empreendimento extends \ActiveRecord\Model {

		static $table_name = 'emp_empreendimento';		


		public static function EmpUrl($arrEmp){

			if (is_array($arrEmp)){
	        	foreach ($arrEmp as $oEmp) {
					// $finalidade = ($oImovel->valorvenda) ? "venda" : "locacao";
					$empreendimentoNome = str_replace("/", "-", str_replace(" ", "-", $oEmp->empreendimentonome));
					$cidadeNome = str_replace("/", "-", str_replace(" ", "-", $oEmp->cidadenome));
					$bairroNome = str_replace("/", "-", str_replace(" ", "-", $oEmp->bairronome));

	        		// $oEmp->objurl = strtolower(str_replace(" ", "-", $oEmp->empreendimentonome)."+".str_replace(" ", "-", $oEmp->cidadenome)."+". str_replace(" ", "-", $oEmp->bairronome));
	        		$oEmp->objurl = strtolower($empreendimentoNome."+".$cidadeNome."+". $bairroNome);
	        	}
	        }

        	if (is_object($arrEmp)){
				// $finalidade = ($oImovel->valorvenda) ? "venda" : "locacao";

				$empreendimentoNome = str_replace("/", "-", str_replace(" ", "-", $arrEmp->empreendimentonome));
				$cidadeNome = str_replace("/", "-", str_replace(" ", "-", $arrEmp->cidadenome));
				$bairroNome = str_replace("/", "-", str_replace(" ", "-", $arrEmp->bairronome));

        		// $arrEmp->objurl = strtolower(str_replace(" ", "-", $arrEmp->empreendimentonome)."+".str_replace(" ", "-", $arrEmp->cidade)."+". str_replace(" ", "-", $arrEmp->bairronome));
        		$arrEmp->objurl = strtolower($empreendimentoNome."+".$cidadeNome."+". $bairroNome);
        	}


        	return $arrEmp;
		}

  
		public static function showsql(){
			echo self::table()->last_sql;
			die;
		}		



		public static function findEmpreendimentos(){

			/*$sql = "SELECT 'empreendimento' AS Produto,
					'lancamentos' AS ProdutoTag,
					p.FlagPublico, 
					p.Nome AS EmpreendimentoNome, 
					p.EmpreendimentoID as ID, 
					p.EmpreendimentoStatusID as StatusID, 
					p.m2menor as m2menor, 
					p.m2maior as m2maior, 
					es.Status as StatusNome, 
					p.EmpreendimentoNaturezaID as NaturezaID, 
					en.NaturezaNome as NaturezaNome, 
					p.Localizacao AS Endereco, 
					p.MapaLatitude AS MapaLatitude, 
					p.MapaLongitude AS MapaLongitude, 
					sil_c.nome_original AS CidadeNome, 
					sil_b.nome_customizado AS BairroNome,
					p.EmpreendimentoID AS ImagemID, -- lv.LancamentoID AS ImagemID,
					NULL AS ValorVenda,
					p.EmpreendimentoID as imgorder,
					null AS imgfullurl,
					null AS imgurl,
					null as objurl,
	   				null AS tipologia, 
	   				null AS nquartos,
	   				null AS construtora, 
	   				es.Status AS estatus

					FROM emp_empreendimento p
					INNER JOIN emp_empreendimentostatus AS es ON p.EmpreendimentoStatusID=es.EmpreendimentoStatusID
					INNER JOIN emp_empreendimentonatureza AS en ON p.EmpreendimentoNaturezaID=en.EmpreendimentoNaturezaID
					-- LEFT OUTER JOIN emp_lancamentovitrine AS lv ON lv.LancamentoID = p.EmpreendimentoID					
					INNER JOIN emp_lancamento AS l ON l.EmpreendimentoID = p.EmpreendimentoID					
					INNER JOIN sil_bairro AS sil_b  ON p.sil_bairro_id  = sil_b.id
					INNER JOIN sil_cidade AS sil_c  ON p.sil_cidade_id  = sil_c.id
					-- LEFT OUTER JOIN sil_estado AS sil_e  ON p.sil_estado_id  = sil_e.id

					WHERE p.FlagPublico = -1 
					AND l.FlagPublico = -1 

					ORDER BY p.EmpreendimentoID DESC";*/

			$sql = "SELECT 'empreendimento' AS Produto,
					'lancamentos' AS ProdutoTag,
                    CAST(group_concat(distinct (ec.construtora_id)) as char) ConstrutorasID,
                    CAST(group_concat(distinct(ec.nome)) as char) construtora,
					CAST(group_concat(distinct(eq.Quantidade)) as char) AS nquartos,                    
                    CAST(group_concat(distinct (ete.EmpreendimentoTipoID)) as char) tipologiaID,
                    CAST(group_concat(distinct(et.TipoNome)) as char) tipologia,
					p.FlagPublico, 
					p.Nome AS EmpreendimentoNome, 
					p.EmpreendimentoID as ID, 
					p.EmpreendimentoStatusID as StatusID, 
					p.m2menor as m2menor, 
					p.m2maior as m2maior, 
					es.Status as StatusNome, 
					p.EmpreendimentoNaturezaID as NaturezaID, 
					en.NaturezaNome as NaturezaNome, 
					p.Localizacao AS Endereco, 
					p.MapaLatitude AS MapaLatitude, 
					p.MapaLongitude AS MapaLongitude, 
					sil_c.nome_original AS CidadeNome, 
					sil_b.nome_customizado AS BairroNome,
					p.EmpreendimentoID AS ImagemID, -- lv.LancamentoID AS ImagemID,
					NULL AS ValorVenda,
					p.EmpreendimentoID as imgorder,
					null AS imgfullurl,
					null AS imgurl,
					null as objurl,
	   				null AS tipologia, 
	   				null AS nquartos,
	   				null AS construtora, 
	   				es.Status AS estatus

					FROM emp_empreendimento p
					INNER JOIN emp_empreendimentostatus AS es ON p.EmpreendimentoStatusID=es.EmpreendimentoStatusID
					INNER JOIN emp_empreendimentonatureza AS en ON p.EmpreendimentoNaturezaID=en.EmpreendimentoNaturezaID
					-- LEFT OUTER JOIN emp_lancamentovitrine AS lv ON lv.LancamentoID = p.EmpreendimentoID					
					INNER JOIN emp_lancamento AS l ON l.EmpreendimentoID = p.EmpreendimentoID					
					INNER JOIN sil_bairro AS sil_b  ON p.sil_bairro_id  = sil_b.id
					INNER JOIN sil_cidade AS sil_c  ON p.sil_cidade_id  = sil_c.id
					-- LEFT OUTER JOIN sil_estado AS sil_e  ON p.sil_estado_id  = sil_e.id
                    left join emp_empreendimentoconstrutoraempreendimento ece on ece.empreendimento_id = p.EmpreendimentoID
                    left JOIN emp_empreendimentoconstrutora AS ec ON ece.construtora_id = ec.construtora_id                    
					LEFT JOIN emp_empreendimentoquarto AS eq ON eq.EmpreendimentoID = p.EmpreendimentoID
                    
                    left join emp_empreendimentotipoempreendimento ete on ete.EmpreendimentoID = p.EmpreendimentoID
                    left JOIN emp_empreendimentotipo AS et ON et.EmpreendimentoTipoID = ete.EmpreendimentoTipoID
                    
					WHERE p.FlagPublico = -1
					AND l.FlagPublico = -1

					group by p.EmpreendimentoID
					ORDER BY p.EmpreendimentoID DESC;";

			$empreendimentos = self::find_by_sql($sql);

			//foreach ($empreendimentos as $e) {
			//	$e->nquartos = Empreendimento::findEmpQuartos($e->id);
			//	$e->tipologia = Empreendimento::findEmpTipos($e->id);
			//	$e->construtora = Empreendimento::findEmpConstrutoras($e->id);
			//}

			$empreendimentos = Album::UrlImg($empreendimentos);
			$empreendimentos = Empreendimento::EmpUrl($empreendimentos);

			return $empreendimentos;
		}

		public static function findEmpreendimento($app, $id){

			// montagem basica das condicoes da consulta //TCK#2892
			$conditions = array(
				0 => "p.EmpreendimentoID = ?",
				1 => $id,
			);
			// filtro por origem
			$origem = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "null");
            if( strpos($origem, $app['CONFIG']['HOST_ADMIN']) === false ){
                // site normal, visitante 
				$conditions[0] .= " AND p.FlagPublico = ?";
				$conditions[] = -1;

				// filtro que nao tinha // tck2968
				$conditions[0] .= " AND l.FlagPublico = ?";
				$conditions[] = -1;

            }else {
                // link veio do gapo, admin, nao tem filtro de publicado
            }		

		   	$sql = array(
		   		'select' => ' "empreendimento" AS Produto,
		   			"lancamentos" AS ProdutoTag,
					p.FlagPublico, 
					p.Nome AS EmpreendimentoNome, 
					p.EmpreendimentoID as ID, 
					p.EmpreendimentoStatusID as StatusID, 
					p.m2menor as m2menor, 
					p.m2maior as m2maior, 
					es.Status as StatusNome, 
					p.EmpreendimentoNaturezaID as NaturezaID, 
					ete.EmpreendimentoTipoID,
					en.NaturezaNome, 
					p.Localizacao AS Endereco, 
					sil_c.nome_original AS cidade, 
					sil_c.nome_original AS CidadeNome, 
					sil_b.nome_customizado AS BairroNome,					
					sil_b.id AS BairroID, 
					
					p.MapaLatitude,
					p.MapaLongitude,

					sil_b.nome_original AS BairroNome,
					p.descricao,
					elv.legenda AS VitrineDescricao,

					p.valormenor AS valor,
					p.valormaior AS valorvenda,
					NULL AS cep,
					NULL AS estadonome,
					NULL AS condominionome,
					NULL AS nquartos,
					
					NULL AS tipo,
					NULL AS construtora,

					NULL AS objurl,
					NULL AS imgfullurl,
					NULL AS imgurl,
					NULL AS prodtitle',

		   		'from' => 'emp_empreendimento p',

		   		'joins' => 'LEFT OUTER JOIN emp_empreendimentostatus AS es ON p.EmpreendimentoStatusID=es.EmpreendimentoStatusID
							LEFT OUTER JOIN emp_empreendimentotipoempreendimento AS ete ON p.EmpreendimentoID = ete.EmpreendimentoID
							JOIN emp_empreendimentonatureza AS en ON p.EmpreendimentoNaturezaID=en.EmpreendimentoNaturezaID
							JOIN sil_bairro AS sil_b  ON p.sil_bairro_id  = sil_b.id
							JOIN sil_cidade AS sil_c  ON p.sil_cidade_id  = sil_c.id
							JOIN sil_estado AS sil_e  ON p.sil_estado_id  = sil_e.id
							LEFT OUTER JOIN emp_lancamentovitrine AS elv ON p.EmpreendimentoID = elv.LancamentoID
							JOIN emp_lancamento AS l ON l.EmpreendimentoID = p.EmpreendimentoID		
				',

		   		'conditions' => $conditions

		   	);

			$empreendimento = self::find('first',$sql);

			if(empty($empreendimento))
				return $empreendimento;


			$empreendimento->prodtitle = $empreendimento->empreendimentonome;
			$empreendimento->tipo = self::findEmpTipos($empreendimento->id);
			$empreendimento->construtora = self::findEmpConstrutoras($empreendimento->id);
			
			$empreendimento->nquartos = self::findEmpQuartos($empreendimento->id);

			$empreendimento = self::EmpUrl($empreendimento);

			// Util::dbg($empreendimento);

			$empreendimento->imgurl = Param::getHostAdmin()."_custom/empreendimento/fichatecnica/imagem/".$empreendimento->id."/".$empreendimento->id."_vitrine.jpg";

			return $empreendimento;

		}

	
		public static function findRelacionados($app, $empreendimento){
			
			$data = array();

			($empreendimento->BairroID) 	? $data['bairro'] 		= "bairro-".$empreendimento->BairroID 	: $data['bairro'] = "";
			($empreendimento->StatusID) 	? $data['status'] 		= $empreendimento->StatusID 			: $data['status'] = "";
			($empreendimento->NaturezaID) 	? $data['natureza'] 	= $empreendimento->NaturezaID 			: $data['natureza'] = "";
			$data['key'] = "2071AB51-DAD9-45BC-A7C9-57FE98E5A71D";
			/**
			*	@TO_DO:
			*
			*	nenhum filtro de empreendimento está funcionando na API
			*/

			$url = "http://webapi.inforcedata.com.br/Empreendimento/Search/?Key=".$data['key']."&pagesize=4&Regioes=".$data['bairro']."&Status=".$data['status']."&Natureza=".$data['natureza']; 
			$empreendimentos = json_decode(file_get_contents($url)); 

			return $empreendimentos;
		}

		public static function findEmpQuartos($id){

		   	$sql = array(
		   		'select' => '
		   				eq.EmpreendimentoID,
		   				eq.Quantidade AS NOME,
						eq.Quantidade AS ID,
						eq.Quantidade AS qtd',
						// ,count(eq.EmpreendimentoID) as TOTAL',	

		   		'from' => 'emp_empreendimentoquarto AS eq',

		   		'joins' => 'JOIN emp_empreendimento AS e ON eq.EmpreendimentoID = e.EmpreendimentoID',

		   		'conditions' => array('e.EmpreendimentoID = ?', $id)

		   	);

			$temp = self::find('all',$sql);
			$quartos = null;

			foreach ($temp as $quarto) {

				if(empty($quartos)){
					$quartos = $quarto->qtd;
				}else{
					$quartos .= ",".$quarto->qtd;
				}
			}

			// Util::dbg($quartos);

			return $quartos;

		}

		public static function findEmpTipos($id){

		   	$sql = array(
		   		'select' => 'ete.EmpreendimentoID, ete.EmpreendimentoTipoID, et.TipoNome',

		   		'from' => 'emp_empreendimentotipoempreendimento AS ete',

		   		'joins' => 'JOIN emp_empreendimentotipo AS et ON et.EmpreendimentoTipoID = ete.EmpreendimentoTipoID',

		   		'conditions' => array('ete.EmpreendimentoID = ?', $id)

		   	);

			$tipos = self::find('all',$sql);

			$result = "";
			// concatena os tipos (apartamento, cobertura), caso haja mais de um
			foreach ($tipos as $key => $tipo) {
				if($key==0){
					$result = $result . $tipo->tiponome;
				}else{
					$result = $result . ", " . $tipo->tiponome;
				}
			}

         	return $result;

		}

		public static function findEmpConstrutoras($id){

		   	$sql = array(
		   		'select' => 'ece.empreendimento_id, ece.construtora_id, ec.nome',

		   		'from' => 'emp_empreendimentoconstrutoraempreendimento AS ece',

		   		'joins' => 'JOIN emp_empreendimentoconstrutora AS ec ON ece.construtora_id = ec.construtora_id',

		   		'conditions' => array('ece.empreendimento_id = ?', $id),

		   		'order' => 'ec.nome ASC'

		   	);

			$construtoras = self::find('all',$sql);

			$result = "";
			// concatena as construtoras, caso haja mais de uma
			foreach ($construtoras as $key => $construtora) {
				if($key==0){
					$result = $result . $construtora->nome;
				}else{
					$result = $result . ", " . $construtora->nome;
				}
			}

         	return $result;

		}


		public static function findObras(){

			$sql = "SELECT 'empreendimento' AS Produto,
					'lancamentos' AS ProdutoTag,
					p.FlagPublico, 
					p.Nome AS EmpreendimentoNome, 
					p.EmpreendimentoID as ID, 
					p.EmpreendimentoStatusID as StatusID, 
					p.m2menor as m2menor, 
					p.m2maior as m2maior, 
					es.Status as StatusNome, 
					p.EmpreendimentoNaturezaID as NaturezaID, 
					en.NaturezaNome as NaturezaNome, 
					p.Localizacao AS Endereco, 
					sil_c.nome_original AS CidadeNome, 
					sil_b.nome_original AS BairroNome,
					NULL AS ValorVenda,

					CONCAT(\"_custom/empreendimento/fichatecnica/imagem/\",p.EmpreendimentoID,\"/\",p.EmpreendimentoID,\".jpg\") AS imgfullurl,
					CONCAT(\"_custom/empreendimento/fichatecnica/imagem/\",p.EmpreendimentoID,\"/\",p.EmpreendimentoID,\"_vitrine.jpg\") AS imgurl,
					CONCAT(REPLACE(p.Nome, ' ', '-'), \"+\", REPLACE(sil_c.nome_original, ' ', '-'), \"+\", REPLACE(sil_b.nome_original, ' ', '-') ) as objurl

					FROM emp_empreendimento p
					JOIN emp_lancamento AS l ON p.EmpreendimentoID=l.EmpreendimentoID
					LEFT OUTER JOIN emp_empreendimentostatus AS es ON p.EmpreendimentoStatusID=es.EmpreendimentoStatusID
					JOIN emp_empreendimentonatureza AS en ON p.EmpreendimentoNaturezaID=en.EmpreendimentoNaturezaID
					JOIN sil_bairro AS sil_b  ON p.sil_bairro_id  = sil_b.id
					JOIN sil_cidade AS sil_c  ON p.sil_cidade_id  = sil_c.id

					WHERE p.FlagPublico = -1 AND l.FlagPublico = -1 AND sil_b.nome_original is not null

					ORDER BY p.EmpreendimentoID DESC";

			$imoveis = self::find_by_sql($sql);
			return $imoveis;
		}

		public static function findObra($id){
			$sql = array(
		   		'select' => "'lancamentos' AS ProdutoTag, e.Nome,e.empreendimentoID as ID,  e.Localizacao, b.nome_customizado bairro, c.nome_customizado cidade, uf.sigla estado , NULL as img_array, NULL as etapas,
		   						img_conta_id,CONCAT(REPLACE(e.Nome, ' ', '-'), \"+\", REPLACE(c.nome_original, ' ', '-'), \"+\", REPLACE(b.nome_original, ' ', '-') ) as objurl",

		   		'from' => 'emp_empreendimento e',

		   		'joins' => 'JOIN sil_cidade c ON e.sil_cidade_id = c.id
							JOIN sil_bairro b ON e.sil_bairro_id = b.id
							JOIN sil_estado uf ON e.sil_estado_id = uf.id
							INNER JOIN emp_obra eo ON eo.EmpreendimentoID = e.empreendimentoID
							LEFT OUTER JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID',

		   		'conditions' => array('e.FlagPublico = -1 AND l.FlagPublico = -1 AND e.EmpreendimentoID = ?', $id)
		   	);
			
			$obra = self::find('first',$sql);
			$obra->etapas = self::findEtapas($id);
			#Util::dbg(self::table()->last_sql); 
			
         	return $obra;			
		}

		public static function findEtapas($id){
			$sql = array(
				'select' => 'ObraID, Nome, Realizado, img_conta_id',
				'from' => 'emp_obraetapa oe',
				'joins' => 'JOIN emp_obra o ON oe.ObraID = o.EmpreendimentoID',
				'conditions' => array('oe.ObraID = ?', $id),
				'order' => 'oe.Ordem ASC'
			);
			$etapas = self::find('all',$sql);

			return $etapas;

		}


		public static function findStatus(){
			$sql = "SELECT 
					e.EmpreendimentoID, 
					es.EmpreendimentoStatusID AS ID, 
					es.Status AS NOME, 
					count(e.EmpreendimentoStatusID) AS TOTAL

				FROM emp_empreendimento AS e
				JOIN emp_empreendimentostatus AS es ON e.EmpreendimentoStatusID = es.EmpreendimentoStatusID
				JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID

				WHERE e.FlagPublico = -1 AND l.FlagPublico = -1

				GROUP BY e.EmpreendimentoStatusID

				ORDER BY es.Status ASC
			";

			$status = self::find_by_sql($sql);
			foreach ($status as $item) {
				$item->nome = utf8_encode($item->nome);
			}

			return $status;

		}


		public static function findTipos(){

			$sql = "SELECT 
						et.TipoNome AS NOME,
						ete.EmpreendimentoTipoID AS ID,
						count(e.EmpreendimentoID) AS TOTAL

					FROM emp_empreendimento AS e
					JOIN emp_empreendimentotipoempreendimento AS ete ON e.EmpreendimentoID = ete.EmpreendimentoID
					JOIN emp_empreendimentotipo AS et ON ete.EmpreendimentoTipoID = et.EmpreendimentoTipoID
					JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID

					WHERE e.FlagPublico = -1 AND l.FlagPublico = -1

					GROUP BY ete.EmpreendimentoTipoID

					ORDER BY et.TipoNome ASC
			";

			$tipos = self::find_by_sql($sql);
			foreach ($tipos as $tipo) {
				$tipo->nome = utf8_encode($tipo->nome);
			}

			return $tipos;

		}


		public static function findValores(){

			$valores = null;
			// $valores = array(
			// 	'250'  => array('id' => 250 , 'nome' => 'Até 250 mil'),
			// 	'500'  => array('id' => 500 , 'nome' => 'de 250 a 500 mil'),
			// 	'750'  => array('id' => 750 , 'nome' => 'de 500 a 750 mil'),
			// 	'1000' => array('id' => 1000, 'nome' => 'de 750 mil a 1 milhão'),
			// 	'9999' => array('id' => 0   , 'nome' => 'acima de 1 milhão'),
			// );

			return $valores;

		}		



		public static function findQuartos(){

			$sql = "SELECT 
						eq.Quantidade AS NOME,
						eq.Quantidade AS ID,
						count(eq.EmpreendimentoID) as TOTAL
					 
					FROM emp_empreendimentoquarto AS eq
					JOIN emp_empreendimento AS e ON eq.EmpreendimentoID = e.EmpreendimentoID
					JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID

					WHERE e.FlagPublico = -1 AND l.FlagPublico = -1
					AND eq.Quantidade > 0

					GROUP BY eq.Quantidade

					ORDER BY eq.Quantidade ASC

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



		public static function findBairros($tipo=null, $cidadeid = null){
			$conditions = array(
				0 => "e.FlagPublico = ?",
				1 => -1,
			);
				$conditions[0] .= " AND l.FlagPublico = ?";
				$conditions[] = -1;

			if( ($tipo==null) || ($tipo=='null')){ /* do nothing */ }else{
				$conditions[0] .= " AND ete.EmpreendimentoTipoID IN (?)";
				$conditions[] = explode(",", $tipo);					
			}

			if($cidadeid != null ){
				$conditions[0] .= " AND c.id IN (?)";
				$conditions[] = explode(",", $cidadeid);
			}

			$sql = array(
				// "select" => " DISTINCT
 			// 		b.id AS ID,
				// 	b.id AS url,
				// 	count(e.sil_bairro_id) AS TOTAL,
				// 	if(b.cidade_id=1,b.nome_customizado,c.nome_customizado) AS value,
				//     if(b.cidade_id=1,b.nome_customizado,c.nome_customizado) AS NOME 
				//     ", //-- Pega o nome da Cidade ai invés do Bairro se a cidade <> RJ

				"select" => " DISTINCT
 					b.id AS ID,
					b.id AS url,
					count(e.sil_bairro_id) AS TOTAL,					
					if(b.cidade_id=1,b.nome_customizado,CONCAT(b.nome_customizado, ' (', c.nome_customizado ,')')) AS value,
				    if(b.cidade_id=1,b.nome_customizado,CONCAT(b.nome_customizado, ' (', c.nome_customizado ,')')) AS NOME				    
				    /*
					b.nome_customizado AS value,
				    b.nome_customizado AS NOME
				    */
				    ", //-- Pega o nome da Cidade ai invés do Bairro se a cidade <> RJ

				"from" => "emp_empreendimento AS e",

				"joins" => "
					LEFT OUTER JOIN emp_empreendimentotipoempreendimento AS ete ON ete.EmpreendimentoID = e.EmpreendimentoID				
					JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID				
					JOIN sil_bairro AS b ON b.id = e.sil_bairro_id
				  	JOIN sil_cidade AS c ON c.id = b.cidade_id",

				"conditions" => $conditions,

				"group" =>	"b.id",

				"order" => "b.nome_customizado ASC"

				);

			$bairros = self::find('all', $sql);


			foreach ($bairros as $bairro) {
				$bairro->value = Util::removeAcentos(utf8_encode($bairro->value));				
				if($cidadeid != null){
					$bairro->nome = $bairro->nome;	
				}else{
					$bairro->nome = utf8_encode($bairro->nome);	
				}
			}

			return $bairros;

		}	


		/////////
		// metodos utilizados para retornar as listas de itens
		// do filtro lateral das paginas de listagem de empreendimentos
		/////////

		// retorna a lista as construtoras
		public static function listConstrutoras($tipo=null){	// TCK#2885
			$sql = "SELECT 
						ec.construtora_id AS ID, 
						ec.nome AS NOME, 
						COUNT(ece.empreendimento_id) AS TOTAL

					FROM emp_empreendimentoconstrutora AS ec
					JOIN emp_empreendimentoconstrutoraempreendimento AS ece ON ec.construtora_id = ece.construtora_id
					JOIN emp_empreendimento AS e ON ece.empreendimento_id = e.EmpreendimentoID
					JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID

					WHERE e.FlagPublico = -1 AND l.FlagPublico = -1
					GROUP BY ec.construtora_id
					ORDER BY ec.nome
			";

			$list = self::find_by_sql($sql);
			foreach ($list as $item) {
				$item->nome = utf8_encode($item->nome);
			}

			return $list;

		}

		// retorna a lista as cidades
		public static function findCidades($tipo=null){
			$conditions = array(
				0 => "e.FlagPublico = ?",
				1 => -1,
			);
				$conditions[0] .= " AND l.FlagPublico = ?";
				$conditions[] = -1;

			if( ($tipo==null) || ($tipo=='null')){ /* do nothing */ }else{
				$conditions[0] .= " AND ete.EmpreendimentoTipoID IN (?)";
				$conditions[] = explode(",", $tipo);					
			}			

			$sql = array(
				"select" => " DISTINCT
						e.sil_cidade_id, 
						e.sil_cidade_id AS url, 
						e.sil_cidade_id AS ID, 
						c.nome_original AS NOME, 
						c.nome_original AS value, 
						count(e.sil_cidade_id) AS TOTAL",

				"from" => "emp_empreendimento AS e",
					
				"joins" => "
						JOIN sil_cidade AS c ON c.id = e.sil_cidade_id
						JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID				
						LEFT OUTER JOIN emp_empreendimentotipoempreendimento AS ete ON ete.EmpreendimentoID = e.EmpreendimentoID",

				"conditions" => $conditions,

				"group" => "e.sil_cidade_id",

				"order" => "c.nome_original ASC"
			);

			$cidades = self::find('all', $sql);
			foreach ($cidades as $cidade) {
				$cidade->nome = utf8_encode($cidade->nome);
				$cidade->value = Util::removeAcentos(utf8_encode($cidade->value));
			}

			return $cidades;

		}			


		/////////
		// metodo utilizado para efetuar as buscas, seja na barra de busca do topo 
		// quanto no filtro lateral nas paginas de listagem
		/////////
		public static function searchEmpreendimentos($app, $opts){
			
			// constroi as condicoes da consulta
			$conditions = array(
				0 => "p.FlagPublico = ?", 
				1 => -1,
			);
				$conditions[0] .= " AND l.FlagPublico = ?";
				$conditions[] = -1;

				foreach ($opts as $key => $value) {
					if($key=='id'){ //remocao de empreendimentos duplicados
						$conditions[0] .= " AND p.EmpreendimentoID NOT IN (?)";
						$conditions[] = explode(",", $value);					
					}
					if($key=='not_id'){ //remocao de empreendimentos duplicados // verificar onde parametro acima e usado e corrigir
						$conditions[0] .= " AND p.EmpreendimentoID NOT IN (?)";
						$conditions[] = explode(",", $value);					
					}
					if($key=='bairro'){
						$conditions[0] .= " AND p.sil_bairro_id IN (?)";
						$conditions[] = explode(",", $value);
					}
					if($key=='cidade'){
						$conditions[0] .= " AND p.sil_cidade_id IN (?)";
						$conditions[] = explode(",", $value);
					}
					if($key=='tipo'){
						$conditions[0] .= " AND ete.EmpreendimentoTipoID IN (?)";
						$conditions[] = explode(",", $value);					
					}
					if($key=='quartos'){
						$conditions[0] .= " AND eq.Quantidade IN (?)";
						$conditions[] = explode(",", $value);					
					}
					if($key=='status'){
						$conditions[0] .= " AND p.EmpreendimentoStatusID IN (?)";
						$conditions[] = explode(",", $value);					
					}
					if($key=='incorporadoras'){ // TCK#2885
						$conditions[0] .= " AND ece.construtora_id IN (?)";
						$conditions[] = explode(",", $value);					
					}
					if($key=='valor'){
						// switch ($value) {
						// 	case 250:
						// 		$conditions[0] .= " AND i.ValorVenda BETWEEN 0 AND ?";
						// 		break;
						// 	case 500:
						// 		$conditions[0] .= " AND i.ValorVenda BETWEEN 250000 AND ?";
						// 		break;
						// 	case 750:
						// 		$conditions[0] .= " AND i.ValorVenda BETWEEN 500000 AND ?";
						// 		break;
						// 	case 1000:
						// 		$conditions[0] .= " AND i.ValorVenda BETWEEN 750000 AND ?";
						// 		break;
						// 	case 0:
						// 		$conditions[0] .= " AND i.ValorVenda > ?";
						// 		$value = 1000;
						// 		break;							
						// 	default:
						// 		$conditions[0] .= " AND i.ValorVenda < ?";
						// 		break;
						// }
						// $conditions[] = $value*1000;
					}
				}
		

			$sql = array(
				"select" => " DISTINCT
							'empreendimento' AS Produto,
							'lancamentos' AS ProdutoTag,
							p.FlagPublico, 
							p.Nome AS EmpreendimentoNome, 
							p.EmpreendimentoID as ID, 
							p.EmpreendimentoStatusID as StatusID, 
							p.m2menor as m2menor, 
							p.m2maior as m2maior, 
							p.MapaLatitude as MapaLatitude, 
							p.MapaLongitude as MapaLongitude, 
							es.Status as StatusNome, 
							p.EmpreendimentoNaturezaID as NaturezaID,
							en.NaturezaNome as NaturezaNome, 
							p.Localizacao AS Endereco, 
							sil_c.nome_original AS CidadeNome, 
							sil_b.nome_original AS BairroNome,
							p.EmpreendimentoID AS ImagemID,
							NULL AS ValorVenda,

			   				null AS tipologia, 
			   				null AS nquartos, 
			   				null AS construtora, 
			   				es.Status AS estatus,

							p.EmpreendimentoID as imgorder,
							null AS imgfullurl,
							null AS imgurl,
							null as objurl",

				"from" => 	"emp_empreendimento p",

				// joins basicas + joins usadas nos filtros //
				"joins" => 	"LEFT OUTER JOIN emp_empreendimentostatus AS es ON p.EmpreendimentoStatusID=es.EmpreendimentoStatusID
							JOIN emp_empreendimentonatureza AS en ON p.EmpreendimentoNaturezaID=en.EmpreendimentoNaturezaID
							JOIN emp_lancamento AS l ON l.EmpreendimentoID = p.EmpreendimentoID					
							JOIN sil_bairro AS sil_b  ON p.sil_bairro_id  = sil_b.id
							JOIN sil_cidade AS sil_c  ON p.sil_cidade_id  = sil_c.id
							LEFT OUTER JOIN emp_empreendimentoconstrutoraempreendimento AS ece ON p.EmpreendimentoID = ece.empreendimento_id
							LEFT OUTER JOIN emp_empreendimentotipoempreendimento AS ete ON ete.EmpreendimentoID = p.EmpreendimentoID
							LEFT OUTER JOIN emp_empreendimentoquarto AS eq ON eq.EmpreendimentoID = p.EmpreendimentoID",

				"conditions" =>	$conditions,

				"order" =>	"p.EmpreendimentoID DESC",

				// "limit" =>	20
			);

			$empreendimentos = self::find('all',$sql);
			// Util::dbg($conditions);
			// self::showsql();

			$empreendimentos = Empreendimento::EmpUrl($empreendimentos);
			$empreendimentos = Album::UrlImg($empreendimentos);
			foreach ($empreendimentos as $e) {
				$e->nquartos = Empreendimento::findEmpQuartos($e->id);
				$e->tipologia = Empreendimento::findEmpTipos($e->id);
				$e->construtora = Empreendimento::findEmpConstrutoras($e->id);				
			}

			// Util::dbg($empreendimentos);
			// if(empty($opts['method'])){
			// 	if(count($empreendimentos)==1){
			// 		$empUrl = $app['CONFIG']['base'].$empreendimentos[0]->produtotag."/".$empreendimentos[0]->objurl."/".$empreendimentos[0]->id;
			// 		header("Location: ".$empUrl);
			// 		// return $empUrl;
			// 	}
			// }

			// Util::dbg($empreendimentos);

			return $empreendimentos;

		}


		public static function findEmps($tipo=null){
			// constroi as condicoes da consulta
			$conditions = array(
				0 => "p.FlagPublico = ?",
				1 => -1,
			);
				$conditions[0] .= " AND l.FlagPublico = ?";
				$conditions[] = -1;

			if( ($tipo==null) || ($tipo=='null') ){ /* do nothing */ }else{
				$conditions[0] .= " AND ete.EmpreendimentoTipoID IN (?)";
				$conditions[] = explode(",", $tipo);
			}			

			$sql = array(

				"select" => "DISTINCT
					'empreendimento' AS Produto,
					'lancamentos' AS ProdutoTag,
					p.FlagPublico, 
					p.Nome AS EmpreendimentoNome, 
					p.Nome AS Nome, 
					p.Nome AS value, 
					p.EmpreendimentoID as ID, 
					p.EmpreendimentoID as url, 
					p.EmpreendimentoStatusID as StatusID, 
					p.m2menor as m2menor, 
					p.m2maior as m2maior, 
					es.Status as StatusNome, 
					p.EmpreendimentoNaturezaID as NaturezaID, 
					en.NaturezaNome as NaturezaNome, 
					p.Localizacao AS Endereco, 
					sil_c.nome_original AS CidadeNome, 
					sil_b.nome_original AS BairroNome,
					lv.LancamentoID AS ImagemID,
					NULL AS ValorVenda,

					p.EmpreendimentoID as imgorder,
					null AS imgurl,
					null as objurl",

				"from" => "emp_empreendimento p",

				"joins" =>	"
					JOIN emp_lancamento AS l ON l.EmpreendimentoID = p.EmpreendimentoID					
					LEFT OUTER JOIN emp_empreendimentostatus AS es ON p.EmpreendimentoStatusID=es.EmpreendimentoStatusID
					JOIN emp_empreendimentonatureza AS en ON p.EmpreendimentoNaturezaID=en.EmpreendimentoNaturezaID
					LEFT OUTER JOIN emp_lancamentovitrine AS lv ON lv.LancamentoID = p.EmpreendimentoID			
					LEFT OUTER JOIN emp_empreendimentotipoempreendimento AS ete ON ete.EmpreendimentoID = p.EmpreendimentoID
					JOIN sil_bairro AS sil_b  ON p.sil_bairro_id  = sil_b.id
					JOIN sil_cidade AS sil_c  ON p.sil_cidade_id  = sil_c.id
				",	

				"conditions" =>	$conditions,

				"order" => 	"p.EmpreendimentoID DESC"
				);

			$empreendimentos = self::find('all', $sql);
			// echo self::table()->last_sql;
			// Util::dbg($empreendimentos);
			foreach ($empreendimentos as $e) {
				$e->empreendimentonome = utf8_encode($e->empreendimentonome);
				$e->value = Util::removeAcentos(utf8_encode($e->value));
				$e->nome = utf8_encode($e->nome);
				$e->statusnome = utf8_encode($e->statusnome);
				$e->naturezanome = utf8_encode($e->naturezanome);
				$e->endereco = utf8_encode($e->endereco);
				$e->cidadenome = utf8_encode($e->cidadenome);
				$e->bairronome = utf8_encode($e->bairronome);
			}			
			$empreendimentos = Empreendimento::EmpUrl($empreendimentos);

			return $empreendimentos;
		}		

	}