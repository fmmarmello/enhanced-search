<?php

	namespace Model;

	use Controller;
	use Lib\Util;

	class Imovel extends \ActiveRecord\Model {


		static $table_name = 'imv_imovel';		


		public static function ImvUrl($arrImovel){
			if (is_array($arrImovel)){
	        	foreach ($arrImovel as $oImovel) {

					$finalidade = ($oImovel->valorvenda) ? "venda" : "locacao";
					$nomeTipo = str_replace("/", "-", $oImovel->nometipo);
					$cidadeNome = str_replace("/", "-", str_replace(" ", "-", $oImovel->cidadenome));
					$bairroNome = str_replace("/", "-", str_replace(" ", "-", $oImovel->bairronome));

	        		// $oImovel->objurl = strtolower(str_replace("/", "-", $oImovel->nometipo)."+".$finalidade."+".str_replace(" ", "-", $oImovel->cidadenome)."+". str_replace(" ", "-", $oImovel->bairronome));
	        		$oImovel->objurl = strtolower($nomeTipo."+".$finalidade."+".$cidadeNome."+". $bairroNome);
	        	}
			}
			if (is_object($arrImovel)){

				$finalidade = ($arrImovel->valorvenda) ? "venda" : "locacao";
				$nomeTipo = str_replace("/", "-", $arrImovel->nometipo);
				$cidadeNome = str_replace("/", "-", str_replace(" ", "-", $arrImovel->cidadenome));
				$bairroNome = str_replace("/", "-", str_replace(" ", "-", $arrImovel->bairronome));

        		// $arrImovel->objurl = strtolower(str_replace("/", "-", $arrImovel->tipo)."+".$finalidade."+".str_replace(" ", "-", $arrImovel->cidade)."+". str_replace(" ", "-", $arrImovel->bairronome));
        		$arrImovel->objurl = strtolower($nomeTipo."+".$finalidade."+".$cidadeNome."+". $bairroNome);
			}

        	return $arrImovel;
		}

		public static function showsql(){
			echo self::table()->last_sql;
			die;
		}			

		public static function findImoveis($img_ext = "", $limit="1000000"){
			
			$limit = empty($limit) ? " LIMIT 100" : " LIMIT ".$limit;
			
			$sql = "SELECT 'imovel' AS Produto,
					'prontos' AS ProdutoTag,
					i.FlagPublico,
					i.EmpreendimentoNome,
					i.ImovelID AS ID,
					img.album_id AS AlbumID,
					i.ValorVenda,
					i.ValorLocacao,
					i.Codigo,
					i.Endereco,
					i.CondominioNome,
					sil_c.nome_original AS cidadeNome,
					sil_b.nome_original AS bairroNome,
					iaq.Quartos,
					iaq.Suites,
					iaq.Vagas,
					iaq.BanheiroSocial,
					iaq.BanheiroServico,
					i.AreaConstruida,
					i.AreaTerreno,
					i.MapaLatitude,
					i.MapaLongitude,					
					it.Icone,
					it.Nome AS NomeTipo,
					img.imagem_id AS ImagemId,
					img.descricao AS ImagemDescricao, 
					year(img.dt_insert) AS ImagemAno,
					month(img.dt_insert) AS ImagemMes

					,i.ImovelID as imgorder
					,NULL as imgurl
					,NULL as imgfullurl
					,CONCAT(it.Nome, \"+\", IF(i.ValorVenda,'Venda','Locacao'), \"+\", REPLACE(sil_c.nome_original, ' ', '-'), \"+\", REPLACE(sil_b.nome_original, ' ', '-') ) as objurl

					FROM imv_imovel i
					JOIN imv_imoveltipo it ON i.imoveltipoID=it.imoveltipoID					
					JOIN sil_bairro sil_b ON i.sil_bairro_id2=sil_b.id					
					JOIN sil_cidade sil_c ON i.sil_cidade_id=sil_c.id					
					LEFT OUTER JOIN imv_imovelambienteqnt iaq ON iaq.imovelID=i.imovelID
					JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
					LEFT OUTER JOIN img_imagem as img ON (img.album_id = imgc.album_id and img.flag_capa = -1)
					WHERE i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0 AND i.ValorVenda > 0 AND i.ImovelStatusID = 1
					ORDER BY i.ValorVenda ASC ".$limit;

			$imoveis = self::find_by_sql($sql);
			$imoveis = self::ImvUrl($imoveis);
						// self::showsql();
			
			// caso não exista capa disponivel setada
			foreach ($imoveis as $imovel) {
				if(empty($imovel->imagemid)){					
					$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, "_tb");					
					$imovel->imgorder = (strpos($imovel->imgurl, "logo_cinza.png") > 0) ? 10000 + $imovel->imgorder : 20000 + $imovel->imgorder;

				}else{
					$imovel->imgorder = 50000 + $imovel->imgorder;
					$imovel = Album::UrlImg($imovel, "_tb");

				}
			}			
						
			return $imoveis;
		}

		public static function findImoveisPremium($img_ext = "", $limit=""){
			
			$limit = empty($limit) ? " LIMIT 100" : " LIMIT ".$limit;
			
			$sql = "SELECT 'imovel' AS Produto,
					'prontos' AS ProdutoTag,
					i.FlagPublico,
					i.EmpreendimentoNome,
					i.ImovelID AS ID,
					img.album_id AS AlbumID,
					i.ValorVenda,
					i.ValorLocacao,
					i.Codigo,
					i.Endereco,
					i.CondominioNome,
					sil_c.nome_original AS cidadeNome,
					sil_b.nome_original AS bairroNome,
					iaq.Quartos,
					iaq.Suites,
					iaq.Vagas,
					iaq.BanheiroSocial,
					iaq.BanheiroServico,
					i.AreaConstruida,
					i.AreaTerreno,
					i.MapaLatitude,
					i.MapaLongitude,					
					it.Icone,
					it.Nome AS NomeTipo,
					img.imagem_id AS ImagemId,
					img.descricao AS ImagemDescricao, 
					year(img.dt_insert) AS ImagemAno,
					month(img.dt_insert) AS ImagemMes

					,i.ImovelID as imgorder
					,NULL as imgurl
					,NULL as imgfullurl
					,CONCAT(it.Nome, \"+\", IF(i.ValorVenda,'Venda','Locacao'), \"+\", REPLACE(sil_c.nome_original, ' ', '-'), \"+\", REPLACE(sil_b.nome_original, ' ', '-') ) as objurl

					FROM imv_imovel i
					JOIN imv_imoveltipo it ON i.imoveltipoID=it.imoveltipoID					
					JOIN sil_bairro sil_b ON i.sil_bairro_id2=sil_b.id					
					JOIN sil_cidade sil_c ON i.sil_cidade_id=sil_c.id					
					LEFT OUTER JOIN imv_imovelambienteqnt iaq ON iaq.imovelID=i.imovelID
					JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
					LEFT OUTER JOIN img_imagem as img ON (img.album_id = imgc.album_id and img.flag_capa = -1)
					LEFT JOIN imv_anunciodestaqueimovel adi ON adi.imovelID = i.imovelID
					LEFT JOIN imv_anunciodestaque ad ON ad.DestaqueID = adi.DestaqueID AND ad.AnuncioID = 1
					WHERE i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0 AND i.ValorVenda > 0 AND i.ImovelStatusID = 1
					ORDER BY i.ValorVenda DESC ".$limit;

			$imoveis = self::find_by_sql($sql);
			$imoveis = self::ImvUrl($imoveis);
						// self::showsql();

			// caso não exista capa disponivel setada
			foreach ($imoveis as $imovel) {
				if(empty($imovel->imagemid)){
					$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, "_tb");
					$imovel->imgorder = (strpos($imovel->imgurl, "logo_cinza.png") > 0) ? 10000 + $imovel->imgorder : 20000 + $imovel->imgorder;
				}else{
					$imovel->imgorder = 50000 + $imovel->imgorder;
					$imovel = Album::UrlImg($imovel, "_tb");
				}
			}

			if($_SERVER['REMOTE_ADDR'] == '192.168.0.2'){
				/*self::showsql();
				Util::dbg($imoveis);	*/
			}
			
			return $imoveis;
		}


		public static function findImovel($app, $imvId, $ext_img=''){

			// montagem basica das condicoes da consulta //TCK#2892
			$conditions = array(
				0 => "i.ImovelID = ?",
				1 => $imvId,
			);
			// filtro por origem
			$origem = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "null");
            if( strpos($origem, $app['CONFIG']['HOST_ADMIN']) === false ){
                // site normal, visitante 
				$conditions[0] .= " AND i.FlagPublico = ?";
				$conditions[] = -1;

				$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
				$conditions[] = 0;

				$conditions[0] .= " AND i.ImovelStatusID = ?";
				$conditions[] = 1;

            }else {
                // link veio do gapo, admin, nao tem filtro de publicado
            }	

		   	$sql = array(
		   		'select' => ' "imovel" AS Produto,
		   			"prontos" AS ProdutoTag,
		   			i.EmpreendimentoNome, 
		   			i.CEP, i.FlagPublico, 
		   			ic.UnidadeAndar,
		   			i.ImovelID AS ID, 
		   			i.Endereco, 
		   			i.EnderecoNumero, 
		   			c.nome_original AS cidade, 
		   			c.nome_original AS cidadenome, 
		   			b.nome_customizado AS BairroNome, 
		   			b.id AS BairroID,  
		   			i.ImovelTipoID,
		   			e.id AS EstdoID, 
		   			e.nome AS EstadoNome,
		   			t.Nome AS Tipo, 
		   			t.Nome AS NomeTipo, 
		   			i.Codigo, 
		   			i.AreaTerreno, 
		   			i.AreaConstruida, 
		   			i.ValorVenda, 
		   			i.ValorLocacao, 
		   			i.ValorTemporada, 
		   			i.Descricao,
		   			i.img_conta_id, 
		   			i.CondominioNome, 
		   			iqtd.Quartos,
		   			iqtd.Suites,
		   			imf.telefone as TelefoneFilial,

		   			NULL AS housecrmcod,
		   			NULL AS vagas,
		   			NULL AS iptu,
		   			NULL AS condominio,
					NULL as ambientes,
					img.album_id AS AlbumID, 
					img.imagem_id AS ImagemId, 
					img.descricao AS ImagemDescricao,
					year(img.dt_insert) AS ImagemAno, 
					month(img.dt_insert) AS ImagemMes,
					adi.AnuncioID, 
					
					null AS imgurl,
					null AS imgfullurl,
					null AS objurl,
					null AS prodtitle',


		   		'from' => 'imv_imovel i',

		   		'joins' => 'INNER JOIN sil_bairro b on i.sil_bairro_id2 = b.id
						    INNER JOIN sil_cidade c on i.sil_cidade_id = c.id
						    INNER JOIN sil_estado e ON i.sil_estado_id = e.id
						    INNER JOIN imv_imoveltipo t on i.ImovelTipoID = t.ImovelTipoID
			        		LEFT JOIN imv_imovelconstrucao ic on ic.ImovelID = i.ImovelID
							LEFT OUTER JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
							LEFT OUTER JOIN imv_imovelambienteqnt iqtd ON i.ImovelID = iqtd.imovelID
							LEFT JOIN imo_setor ise ON ise.setorid = i.setorid
							LEFT JOIN imo_filial imf ON imf.filialid = ise.filialid
							LEFT JOIN imv_anunciodestaqueimovel adi ON adi.imovelID = i.imovelID
							LEFT JOIN imv_anunciodestaque ad ON ad.DestaqueID = adi.DestaqueID
							LEFT OUTER JOIN img_imagem as img ON (img.album_id = imgc.album_id and img.flag_capa = -1)',

		   		'conditions' => $conditions

		   	);

			$imovel = self::find('first',$sql);

			if(empty($imovel))
				return $imovel;


			$imovel = self::ImvUrl($imovel);

				if(empty($imovel->imagemid)){
					$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, $ext_img);
				}else{
					$imovel = Album::UrlImg($imovel,$ext_img);
				}
			 
            
            // titulo
            $imovel->prodtitle = "";
            $imovel->prodtitle .= ($imovel->tipo) ? $imovel->tipo." | " : "";
            switch ($imovel->quartos) {
                case null:
                    $imovel->prodtitle .= "";
                    break;
                case 0:
                    $imovel->prodtitle .= "";
                    break;
                case 1:
                    $imovel->prodtitle .= "1 Quarto | ";
                    break;
                
                default:

                    $imovel->prodtitle .= $imovel->quartos." Quartos | ";

                    break;
            }
            $imovel->prodtitle .= ($imovel->bairronome) ? $imovel->bairronome : "";

            Util::dbg($imovel); 

			return $imovel;
	
		}


		public static function findImoveisLocacao($img_ext = ""){

			$sql = "SELECT 'imovel' AS Produto,
					'locacao' AS ProdutoTag,
					i.FlagPublico,
					i.EmpreendimentoNome,
					i.ImovelID AS ID,
					img.album_id AS AlbumID,
					i.ValorVenda,
					i.ValorLocacao,
					i.Codigo,
					i.Endereco,
					i.CondominioNome,
					sil_c.nome_original AS cidadeNome,
					sil_b.nome_original AS bairroNome,
					iqtd.Quartos,
					iqtd.Suites,
					iaq.Vagas,
					i.AreaConstruida,
					i.AreaTerreno,
					i.MapaLatitude,
					i.MapaLongitude,										
					iaq.BanheiroSocial,
					iaq.BanheiroServico,
					it.Icone,
					it.Nome AS NomeTipo,
					img.imagem_id AS ImagemId,
					img.descricao AS ImagemDescricao, 
					year(img.dt_insert) AS ImagemAno,
					month(img.dt_insert) AS ImagemMes

					,i.ImovelID as imgorder
					,NULL as imgurl
					,NULL as imgfullurl
					,CONCAT(it.Nome, \"+\", IF(i.ValorVenda,'Venda','Locacao'), \"+\", REPLACE(sil_c.nome_original, ' ', '-'), \"+\", REPLACE(sil_b.nome_original, ' ', '-') ) as objurl

					FROM imv_imovel i
					LEFT OUTER JOIN imv_imoveltipo it ON i.imoveltipoID=it.imoveltipoID
					LEFT OUTER JOIN imv_imovelnatureza inm ON i.imovelnaturezaID=inm.imovelnaturezaID
					LEFT OUTER JOIN sil_bairro sil_b ON i.sil_bairro_id=sil_b.id
					LEFT OUTER JOIN sil_bairro sil_b2 ON i.sil_bairro_id2=sil_b2.id
					LEFT OUTER JOIN sil_cidade sil_c ON i.sil_cidade_id=sil_c.id
					LEFT OUTER JOIN sil_estado sil_e ON i.sil_estado_id=sil_e.id
					LEFT OUTER JOIN imv_imovelambienteqnt iaq ON iaq.imovelID=i.imovelID
					LEFT OUTER JOIN imv_imovelconstrucao ic ON ic.imovelID=i.imovelID
					LEFT OUTER JOIN imv_imovelstatus ism ON i.imovelstatusID=ism.StatusID
					LEFT OUTER JOIN imv_imovelambienteqnt iqtd ON i.imovelID=iqtd.imovelID
					LEFT OUTER JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
					LEFT OUTER JOIN img_imagem as img ON (img.album_id = imgc.album_id and img.flag_capa = -1)

					WHERE i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0 AND i.ValorLocacao > 0 AND i.ImovelStatusID = 1

					ORDER BY  i.ValorLocacao ASC";

			$imoveis = self::find_by_sql($sql);
			$imoveis = self::ImvUrl($imoveis);

			// caso não exista capa disponivel setada
			foreach ($imoveis as $imovel) {
				if(empty($imovel->imagemid)){
					$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, "_tb");
					$imovel->imgorder = (strpos($imovel->imgurl, "logo_cinza.png") > 0) ? 10000 + $imovel->imgorder : 20000 + $imovel->imgorder;
				}else{
					$imovel->imgorder = 50000 + $imovel->imgorder;
					$imovel = Album::UrlImg($imovel, "_tb");
				}

			}
			// Util::dbg($imoveis);
			return $imoveis;
		}		



		public static function findRelacionados($app, $imovel, $finalidade=""){
			
			$finalidades = array(
				"prontos" 	=> 0, 
				"locacao"	=> 1
			); 

			$data = array();

			($imovel->BairroID) 				? $data['bairro'] 		= "bairro-".$imovel->BairroID 	: $data['bairro'] = "";
			($imovel->TipoID) 					? $data['tipo'] 		= $imovel->TipoID 				: $data['tipo'] = "";
			($imovel->QtdQuarto) 				? $data['quartos'] 		= $imovel->QtdQuarto 			: $data['quartos'] = "";
			(isset($finalidades[$finalidade]))	? $data['finalidade'] 	= $finalidades[$finalidade]		: $data['finalidade'] = "0";
						
			$url = $app['API']['paths']['imovel']['list']."?Finalidade=".$data['finalidade']."&Tipo=".$data['tipo']."&Regioes=".$data['bairro']."&QtdQuarto=".$data['quartos'];
			$imoveis = json_decode(file_get_contents($url)); 

			
			return $imoveis;
		}


		public static function findTipos(){

			$sql = "SELECT
						it.Nome as TipoNome,
                        CONCAT(it.Nome,'_',na.NaturezaNome) as tipo_natureza,
                        CONCAT(it.imoveltipoid,'_',na.imovelnaturezaid ) AS id,
						na.NaturezaNome AS NaturezaNome,
						count(i.imovelid) AS total

						FROM imv_imovel AS i
						INNER JOIN imv_imovelnatureza AS na ON na.ImovelNaturezaID = i.ImovelNaturezaID
						INNER JOIN imv_imoveltipo AS it ON i.ImovelTipoID = it.ImovelTipoID

						WHERE i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0
						group by tipo_natureza
						ORDER BY na.NaturezaNome DESC";

			$tipos = self::find_by_sql($sql);
			foreach ($tipos as $tipo) {
				$tipo->tiponome = utf8_encode($tipo->tiponome);
				$tipo->tipo_natureza = strtolower(util::removeEspacosAcentos(utf8_encode($tipo->tipo_natureza)));
			}
			return $tipos;
		}



		public static function findTiposLocacao(){


			/*$sql = "SELECT 
						it.ImovelTipoID AS ID, 
						it.Nome AS NOME,
						count(i.ImovelTipoID) AS TOTAL,
						it.Icone,
						it.Sigla,
						it.Tipo,
						it.SubTipo,
						it.Categoria

					FROM imv_imovel AS i 
					INNER JOIN imv_imoveltipo AS it ON i.ImovelTipoID = it.ImovelTipoID
					WHERE i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0 AND i.ValorLocacao > 0
					GROUP BY i.ImovelTipoID
					ORDER BY it.Nome ASC";*/

			/*$sql = "SELECT DISTINCT
			    (it.Tipo) AS NOME,
			    GROUP_CONCAT(DISTINCT (it.ImovelTipoID) separator ';') AS ID,
			    COUNT(i.ImovelTipoID) AS TOTAL,
			    it.Icone,
			    it.Sigla,
			    it.Tipo,
			    it.SubTipo,
			    it.Categoria
			FROM
			    imv_imovel AS i
			        INNER JOIN
			    imv_imoveltipo AS it ON i.ImovelTipoID = it.ImovelTipoID
			WHERE
			    i.FlagPublico = - 1
			        AND i.FlagRequerAprovacao = 0 AND i.ValorLocacao > 0
			GROUP BY it.Tipo
			ORDER BY it.Nome ASC";*/

			$sql = "SELECT DISTINCT
			       (it.Nome) AS NOME,
			       GROUP_CONCAT(DISTINCT (it.ImovelTipoID) separator ';') AS ID,
			       COUNT(i.ImovelTipoID) AS TOTAL,
			       it.Icone,
			       it.Sigla,
			       it.Tipo,
			       it.SubTipo,
			       it.Categoria
			  FROM imv_imovel AS i
			  INNER JOIN imv_imoveltipo AS it ON i.ImovelTipoID = it.ImovelTipoID
			 WHERE i.FlagPublico = - 1
			   AND i.FlagRequerAprovacao = 0
			   AND i.ValorLocacao > 0
			   AND i.ImovelStatusId = 1
			GROUP BY it.Nome
			ORDER BY it.Nome ASC";


			$tipos = self::find_by_sql($sql);
			foreach ($tipos as $tipo) {
				$tipo->nome = utf8_encode($tipo->nome);
			}

			return $tipos;
		}



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

					FROM imv_imovel AS i 
					INNER JOIN imv_imovelambienteqnt AS it ON i.ImovelID = it.ImovelID
					WHERE i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0 AND it.Quartos > 0
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



		public static function findStatus(){

			$status = null;

			// $status = array(
			// 	'250'  => array('id' => 250 , 'nome' => 'Até 250 mil'),
			// 	'500'  => array('id' => 500 , 'nome' => 'de 250 a 500 mil'),
			// 	'750'  => array('id' => 750 , 'nome' => 'de 500 a 750 mil'),
			// 	'1000' => array('id' => 1000, 'nome' => 'de 750 mil a 1 milhão'),
			// 	'9999' => array('id' => 0   , 'nome' => 'acima de 1 milhão'),
			// );

			return $status;
		}



		public static function findValores($finalidade=null){


			if($finalidade=='locacao'){			
				$valores =  array(
					'3'  => array('id' => 3  , 'nome' => 'Até 3 mil'),
					'5'  => array('id' => 5  , 'nome' => 'de 3 a 5 mil'),
					'10' => array('id' => 10 , 'nome' => 'de 5 a 10 mil'),
					'15' => array('id' => 15 , 'nome' => 'de 10 mil a 15 mil'),
					'99' => array('id' => 0  , 'nome' => 'acima de 15 mil'),
				);
			}else{
				$valores =  array(
					'250'  => array('id' => 250 , 'nome' => 'Até 250 mil'),
					'500'  => array('id' => 500 , 'nome' => 'de 250 a 500 mil'),
					'750'  => array('id' => 750 , 'nome' => 'de 500 a 750 mil'),
					'1000' => array('id' => 1000, 'nome' => 'de 750 mil a 1 milhão'),
					'9999' => array('id' => 0   , 'nome' => 'acima de 1 milhão'),
				);
			}

			return $valores;
		}



		public static function findInfra($imvId){
		   	$sql = array(
		   		'select' => 'i.imovelID, i.Codigo, ic.nome',
		   		'from' => 'imv_imovel i',
		   		'joins' => 'INNER JOIN imv_caracteristicaimovel ici on i.imovelID = ici.imovelID
						    INNER JOIN imv_caracteristica ic on ic.caracteristicaID = ici.caracteristicaID',
		   		'conditions' => array('i.ImovelID = ?', $imvId)
		   	);
			$result = self::find('all',$sql);
         	return $result;
		}


		public static function findQtdAmbientes($imvId){
			$sql = array(
				'select' 		=>	'
						it.ImovelAmbienteQntID, 
						it.ImovelID,
						it.Quartos,
						it.Suites,
						it.BanheiroSocial,
						it.BanheiroServico,
						it.Lavabo,
						it.Dependencia,
						it.DependenciaRevertida,
						it.DependenciaReversivel,
						it.Sala,
						it.Varanda,
						it.Vagas',
	
				'from'			=>	'imv_imovel AS i',
	
				'joins'			=>	'INNER JOIN imv_imovelambienteqnt AS it ON i.ImovelID = it.ImovelID',
	
				'conditions'	=>	array('i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0 AND i.ImovelID = ?', $imvId)

			);

			$ambientes = self::find('first',$sql);

			return $ambientes;
		}


		/**
		 * @param null $finalidade
		 * @param null $tipo
		 * @return mixed
		 * @throws \ActiveRecord\RecordNotFound
         */
		public static function findCidades($finalidade=null, $tipo=null){
			// constroi as condicoes da consulta

			$conditions = array(
				0 => "i.FlagPublico = ?",
				1 => -1,
			);
			$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
			$conditions[] = 0;

			if( ($tipo==null) || ($tipo=='null')){ /* do nothing */ }else{
				$tipoArr = explode('_',$tipo);
				#tipo
				$conditions[0] .= " AND i.ImovelTipoID IN (?)";
				$conditions[] = explode(",", $tipoArr[0]);
				#natureza
				$conditions[0] .= " AND i.ImovelNaturezaID IN (?)";
				$conditions[] = explode(",", $tipoArr[1]);
			}			

			if( ($finalidade==null) || ($finalidade=='null')){ /* do nothing */ }else{
				if($finalidade=='locacao'){
					$conditions[0] .= " AND i.ValorLocacao > ?";
					$conditions[] = "0";
				}
				if($finalidade=='prontos'){
					$conditions[0] .= " AND i.ValorVenda > ?";
					$conditions[] = "0";
				}
			}
						
			$sql = array(
					"select" => "
						c.id,
						CONCAT(c.nome_customizado,' (',e.sigla,')') as nome,
						CONCAT(c.nome_customizado,' (',e.sigla,')') as value,
						CONCAT(e.sigla,'/',c.nome_customizado,'/') as fullUrl,
						CONCAT('BR','>',e.sigla,'>',c.nome_customizado) as locID,
						count(i.sil_cidade_id) AS TOTAL",

					"from" => "imv_imovel AS i",

					"joins" => "JOIN sil_bairro AS b ON b.id = i.sil_bairro_id2
				  		JOIN sil_cidade AS c ON c.id = b.cidade_id
                        JOIN sil_estado AS e ON e.id = c.estado_id",

					"conditions" => $conditions,

					"group" => "c.id",

					"order" => "c.nome_original ASC"
				);

			$cidades = self::find('all', $sql);
			//Util::dbg($conditions);

			foreach ($cidades as $cidade) {
				$cidade->nome = utf8_encode($cidade->nome);
				$cidade->fullurl = strtolower(Util::removeEspacosAcentos(utf8_encode(($cidade->fullurl))));
				$cidade->value = Util::removeAcentos(utf8_encode($cidade->value));
			}

			return $cidades;
		}


		/**
		 * @param null $finalidade
		 * @param null $tipo
		 * @param null $cidadeid
		 * @return mixed
		 * @throws \ActiveRecord\RecordNotFound
         */
		public static function findBairros($finalidade=null, $tipo=null, $cidadeid=null){
			// constroi as condicoes da consulta
			$conditions = array(
				0 => "i.FlagPublico = ?",
				1 => -1,
			);
			$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
			$conditions[] = 0;

			$conditions[0] .= " AND i.ImovelStatusID = ?";
			$conditions[] = 1;

			if($finalidade==null){ /* do nothing */ }else{
				if($finalidade=='locacao'){
					$conditions[0] .= " AND i.ValorLocacao > ?";
					$conditions[] = "0";
				}
				if($finalidade=='prontos'){
					$conditions[0] .= " AND i.ValorVenda > ?";
					$conditions[] = "0";
				}
			}

			if( ($tipo==null) || $tipo=="null"){ /* do nothing */ }else{
				$tipoArr = explode('_',$tipo);
				#tipo
				$conditions[0] .= " AND i.ImovelTipoID IN (?)";
				$conditions[] = explode(",", $tipoArr[0]);
				#natureza
				$conditions[0] .= " AND i.ImovelNaturezaID IN (?)";
				$conditions[] = explode(",", $tipoArr[1]);
			}

			if($cidadeid == null ){ /* do nothing */ }else{
				$conditions[0] .= " AND c.id IN (?)";
				$conditions[] = explode(",", $cidadeid);
			}

			$sql = array(

				"select" =>
					"	b.id as ID,
                        CONCAT('BR','>',e.sigla,'>',c.nome_customizado,'>',b.nome_customizado) as locID,
                        b.nome_customizado as nome,
                        b.nome_customizado as value,
                        CONCAT(e.sigla,'/',c.nome_customizado,'/',b.nome_customizado,'/') as fullurl,
                        count(i.sil_bairro_id2) AS total",
				"from" => "imv_imovel AS i",
				"joins" =>"
				  		JOIN sil_bairro AS b ON b.id = i.sil_bairro_id2
				  		JOIN sil_cidade AS c ON c.id = b.cidade_id
                        JOIN sil_estado AS e ON e.id = c.estado_id",

				"conditions" =>	$conditions,
				"group" => 	"b.id"
		);

			$bairros = self::find('all', $sql);



			foreach ($bairros as $bairro) {
				$bairro->locid = Util::removeAcentos(utf8_encode((($bairro->locid))));
				$bairro->nome = utf8_encode($bairro->nome);
				$bairro->value = utf8_encode($bairro->value);
				$bairro->fullurl = strtolower(Util::removeEspacosAcentos(utf8_encode(($bairro->fullurl))));

			}
			#Util::dbg($bairros);
			return $bairros;
		}

		/**
		 * @param $finalidade
         */
		public static function findCaracteristicas($finalidade = null){

			$conditions = array(
				0 => "i.FlagPublico = ?",
				1 => -1,
			);
			$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
			$conditions[] = 0;

			$conditions[0] .= " AND i.ImovelStatusID = ?";
			$conditions[] = 1;

			$conditions[0] .= " AND ic.FlagSite = ?";
			$conditions[] = 1;

			if($finalidade == null){ /* do nothing */ }else{
				if($finalidade=='locacao'){
					$conditions[0] .= " AND i.ValorLocacao > ?";
					$conditions[] = "0";
				}
				if($finalidade=='prontos'){
					$conditions[0] .= " AND i.ValorVenda > ?";
					$conditions[] = "0";
				}
			}
			$sql = array(
				"select" => " ic.CaracteristicaID, ic.Nome, ic.CategoriaID, ic.FlagAtivo ",

				"from" => "imv_imovel AS i",

				"joins" => "join imv_caracteristicaimovel ici on ici.ImovelID = i.imovelid
							left join imv_caracteristica ic on ic.caracteristicaid = ici.caracteristicaid",

				"conditions" => $conditions,

				"group" => "ic.caracteristicaid",

				"order" => "ic.nome"
			);

			$caracteristicas = self::find('all', $sql);
			return $caracteristicas;
		}

		public static function findNaturezas(){

			$sql = "SELECT na.ImovelNaturezaID AS id,
						na.NaturezaNome AS nome,
						count(i.ImovelNaturezaID) AS total

						FROM imv_imovel AS i
						INNER JOIN imv_imovelnatureza AS na ON na.ImovelNaturezaID = i.ImovelNaturezaID

						WHERE i.FlagPublico = -1 AND i.FlagRequerAprovacao = 0

						GROUP BY na.ImovelNaturezaID
						ORDER BY na.NaturezaNome ASC
				";

			$naturezas = self::find_by_sql($sql);
			foreach ($naturezas as $natureza) {
				$natureza->nome = utf8_encode($natureza->nome);
			}

			return $naturezas;

		}		



		public static function findConds($finalidade=null, $tipo=null, $empConds){
			// constroi as condicoes da consulta
			$conditions = array(
				0 => "i.FlagPublico = ?",
				1 => -1,
			);
			$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
			$conditions[] = 0;


			if( ($tipo==null) || ($tipo=='null')){ /* do nothing */ }else{
				$conditions[0] .= " AND i.ImovelTipoID IN (?)";
				$conditions[] = explode(",", $tipo);
			}			

			if( ($finalidade==null) || ($finalidade=='null')){ /* do nothing */ }else{
				if($finalidade=='locacao'){
					$conditions[0] .= " AND i.ValorLocacao > ?";
					$conditions[] = "0";
				}
				if($finalidade=='prontos'){
					$conditions[0] .= " AND i.ValorVenda > ?";
					$conditions[] = "0";
				}
			}

			switch ($empConds) {
				case 'condominio':
					$select = "DISTINCT
							'imovel' AS Produto,
							'".$finalidade."' AS ProdutoTag,
							i.CondominioNome AS value,
							i.CondominioNome AS nome,
							'1' AS url,
							NULL AS objurl
						";

					break;
				
				case 'empreendimento':
					$select = "DISTINCT
							'imovel' AS Produto,
							'".$finalidade."' AS ProdutoTag,
							i.EmpreendimentoNome AS value,
							i.EmpreendimentoNome AS nome,
							'1' AS url,
							NULL AS objurl
						";
					break;
			}

			$sql = array(

				"select" => $select,

				"from" => "imv_imovel i",

				"joins" =>	"LEFT OUTER JOIN imv_imoveltipo it ON i.imoveltipoID=it.imoveltipoID
					 		 LEFT OUTER JOIN imv_imovelnatureza inm ON i.imovelnaturezaID=inm.imovelnaturezaID
					 		 LEFT OUTER JOIN sil_bairro sil_b ON i.sil_bairro_id=sil_b.id
					 		 LEFT OUTER JOIN sil_bairro sil_b2 ON i.sil_bairro_id2=sil_b2.id
					 		 LEFT OUTER JOIN sil_cidade sil_c ON i.sil_cidade_id=sil_c.id
					 		 LEFT OUTER JOIN sil_estado sil_e ON i.sil_estado_id=sil_e.id
					 		 LEFT OUTER JOIN imv_imovelambienteqnt iaq ON iaq.imovelID=i.imovelID
					 		 LEFT OUTER JOIN imv_imovelconstrucao ic ON ic.imovelID=i.imovelID
					 		 LEFT OUTER JOIN imv_imovelstatus ism ON i.imovelstatusID=ism.StatusID
					 		 LEFT OUTER JOIN imv_imovelambienteqnt iqtd ON i.imovelID=iqtd.imovelID
				",	

				"conditions" =>	$conditions,

				"order" => 	"i.ImovelID DESC"
				);

			$imoveis = self::find('all', $sql);
			// echo self::table()->last_sql;
			// Util::dbg($imoveis);
			foreach ($imoveis as $i) {
				$i->value = Util::removeAcentos(utf8_encode($i->value));
				$i->nome = utf8_encode($i->nome);
				// $i->nometipo = utf8_encode($i->nometipo);
				// $i->cidadenome = utf8_encode($i->cidadenome);
				// $i->bairronome = utf8_encode($i->bairronome);
			}			
			// $imoveis = self::ImvUrl($imoveis);

			return $imoveis;
		}		


		/////////
		// metodos utilizados para retornar as listas de itens
		// do filtro lateral das paginas de listagem de empreendimentos
		/////////

		// retorna a lista as condominios
		public static function listCondominios($finalidade=null){	// TCK#2885
			// constroi as condicoes da consulta
			$conditions = array(
				0 => "i.FlagPublico = ?",
				1 => -1,
			);
			$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
			$conditions[] = 0;

			$conditions[0] .= " AND i.CondominioNome != ?";
			$conditions[] = "";

			if( ($finalidade==null) || ($finalidade=='null')){ /* do nothing */ }else{
				if($finalidade=='locacao'){
					$conditions[0] .= " AND i.ValorLocacao > ?";
					$conditions[] = "0";
				}
				if($finalidade=='prontos'){
					$conditions[0] .= " AND i.ValorVenda > ?";
					$conditions[] = "0";
				}
			}
			//

			$sql = array(

				"select" => "DISTINCT
							i.CondominioNome AS ID,
							i.CondominioNome AS NOME,

							COUNT(i.ImovelID) AS TOTAL ",

				"from" => "imv_imovel i",

				"conditions" =>	$conditions,

				"group" =>	"CondominioNome",

				"order" => 	"i.CondominioNome ASC"
				);

			$list = self::find('all', $sql);
			foreach ($list as $i) {
				$i->id = utf8_encode($i->id);
				$i->nome = utf8_encode($i->nome);
			}			

			return $list;
		}		



		/////////
		// metodo utilizado para efetuar as buscas, seja na barra de busca do topo 
		// quanto no filtro lateral nas paginas de listagem
		/////////
		public static function searchImoveis($app, $opts= array()){
			// Util::dbg($opts);
			
			//$limit = 99999;
			$limit = (isset($opts['limit']) && !empty($opts['limit']) ? $opts['limit'] : 100);
			$order = "i.imovelID DESC";
			$img_ext = "_tb";
			$imvFinalidade = "prontos";

			// constroi as condicoes da consulta
			$conditions = array(
				0 => "i.FlagPublico = ? ",
				1 => -1,
			);
			$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
			$conditions[] = 0;

				foreach (array_filter($opts) as $key => $value) { // remove Keys vazias
					if($key == "extensao_img"){
						$img_ext = $value;
					}
					if($key=='limite'){
						$limit = $value;
					}
					if($key=='ordem'){
						if($value=='random'){
							$order = "RAND()";
						}
					}
					if($key=='bairro'){
						$conditions[0] .= " AND i.sil_bairro_id2 IN (?)";
						$conditions[] = explode(",", $value);
					}
					if($key=='cidade'){
						$conditions[0] .= " AND i.sil_cidade_id IN (?)";
						$conditions[] = explode(",", $value);
					}					
					if($key=='id'){
						$conditions[0] .= " AND i.ImovelID NOT IN (?)";
						$conditions[] = explode(",", $value);
					}					
					if($key=='not_id'){
						$conditions[0] .= " AND i.ImovelID NOT IN (?)";
						$conditions[] = explode(",", $value);
					}					
					if($key=='tipo'){
						$conditions[0] .= " AND i.ImovelTipoID IN (?)";
						$conditions[] = explode(",", $value);					
					}
					if($key=='finalidade' || $key=='select_finalidade'){
						$imvFinalidade = $value; //TCK#2968
						if($value=='locacao'){
							$conditions[0] .= " AND i.ValorLocacao > ?";
							$conditions[] = "0";
						}
						if($value=='prontos'){
							$conditions[0] .= " AND i.ValorVenda > ?";
							$conditions[] = "0";
						}
					}

					if($key=='quartos'){
						$conditions[0] .= " AND iqtd.Quartos IN (?)";
						$conditions[] = explode(",", $value);					
					}

					if($key=='valor'){
						if($imvFinalidade=='locacao'){ 			//TCK#2968
							switch ($value) {
								case 3:
									$conditions[0] .= " AND i.ValorLocacao BETWEEN 0 AND ?";
									break;
								case 5:
									$conditions[0] .= " AND i.ValorLocacao BETWEEN 3000 AND ?";
									break;
								case 10:
									$conditions[0] .= " AND i.ValorLocacao BETWEEN 5000 AND ?";
									break;
								case 15:
									$conditions[0] .= " AND i.ValorLocacao BETWEEN 10000 AND ?";
									break;
								case 0:
									$conditions[0] .= " AND i.ValorLocacao > ?";
									$value = 15;
									break;							
								default:
									$conditions[0] .= " AND i.ValorLocacao < ?";
									break;
							}							
						}
						if($imvFinalidade=='prontos'){			//TCK#2968
							switch ($value) {
								case 250:
									$conditions[0] .= " AND i.ValorVenda BETWEEN 0 AND ?";
									break;
								case 500:
									$conditions[0] .= " AND i.ValorVenda BETWEEN 250000 AND ?";
									break;
								case 750:
									$conditions[0] .= " AND i.ValorVenda BETWEEN 500000 AND ?";
									break;
								case 1000:
									$conditions[0] .= " AND i.ValorVenda BETWEEN 750000 AND ?";
									break;
								case 0:
									$conditions[0] .= " AND i.ValorVenda > ?";
									$value = 1000;
									break;							
								default:
									$conditions[0] .= " AND i.ValorVenda < ?";
									break;
							}
						}
						$conditions[] = $value*1000;
					}
					if($key=='condominio_nome') {
						$conditions[0] .= " AND i.CondominioNome LIKE CONCAT('%', ? ,'%')";
						$conditions[] = $value;
					}					
					if($key=='condominio'){	// TCK#2885
						$conditions[0] .= " AND i.CondominioNome IN (?)";
						$conditions[] = explode(",", $value);
					}					
					if($key=='empreendimento_nome'){
						$conditions[0] .= " AND i.EmpreendimentoNome LIKE CONCAT('%', ? ,'%')";
						$conditions[] = $value;
					}	

					if($key=='empreendimento_nome'){
						$conditions[0] .= " AND i.EmpreendimentoNome LIKE CONCAT('%', ? ,'%')";
						$conditions[] = $value;
					}					
				}
				//Util::dbg($conditions);
			//


			$sql = array(
				"select" => " 
							'imovel' AS Produto,
							'".$imvFinalidade."' AS ProdutoTag,
							i.FlagPublico,
							i.EmpreendimentoNome,
							i.ImovelID as ID,
							i.img_conta_id,
							imgc.album_id AS album_id,
							imgc.album_id AS albumid,
							i.ValorVenda,
							i.ValorLocacao,
							i.Codigo,
							i.Endereco,
							i.CondominioNome,
							i.MapaLatitude,
							i.MapaLongitude,
							sil_c.nome_original AS cidadeNome,
							sil_b.nome_original AS bairroNome,
							iqtd.Quartos,
							iqtd.Suites,
							iqtd.Vagas,
							iqtd.BanheiroServico,
							iqtd.BanheiroSocial,
							i.AreaConstruida,
							i.AreaTerreno,
							it.Icone,
							it.Nome AS NomeTipo,
							img.imagem_id AS ImagemId,
							img.imagem_id AS Imagem_Id,
							img.descricao AS ImagemDescricao, 
							year(img.dt_insert) AS Ano,
							month(img.dt_insert) AS Mes,
							year(img.dt_insert) AS ImagemAno,
							month(img.dt_insert) AS ImagemMes

							,i.ImovelID as imgorder
							,NULL as imgurl
							,NULL as imgfullurl
							,NULL as objurl",

				"from" => 	"imv_imovel i",


				"joins" => 	"LEFT OUTER JOIN imv_imoveltipo it ON i.imoveltipoID = it.imoveltipoID
					        LEFT OUTER JOIN sil_bairro sil_b ON i.sil_bairro_id2 = sil_b.id
					        LEFT OUTER JOIN sil_cidade sil_c ON sil_b.cidade_id = sil_c.id
					        LEFT OUTER JOIN imv_imovelambienteqnt iqtd ON iqtd.imovelID = i.imovelID
					        LEFT OUTER JOIN img_conta AS imgc ON i.img_conta_id = imgc.conta_id
					        LEFT OUTER JOIN img_imagem AS img ON (img.album_id = imgc.album_id AND img.flag_capa = - 1)",

				"conditions" =>	$conditions,
				"order" =>	$order,
				"limit" =>	$limit
			);

			$imoveis = self::find('all',$sql);			
			$imoveis = self::ImvUrl($imoveis);			
			
			
			// caso não exista capa disponivel setada
			foreach ($imoveis as $imovel) {
				if(empty($imovel->imagemid)){
					$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, $img_ext);
					$imovel->imgorder = (strpos($imovel->imgurl, "logo_cinza.png") > 0) ? 10000 + $imovel->imgorder : 20000 + $imovel->imgorder;
				}else{
					$imovel->imgorder = 50000 + $imovel->imgorder;
					$imovel = Album::UrlImg($imovel, $img_ext);
				}

			}
			

			// if(count($imoveis)==1){
			// 	$imovelUrl = $app['CONFIG']['base'].$imoveis[0]->produtotag."/".$imoveis[0]->objurl."/".$imoveis[0]->id;
			// 	header("Location: ".$imovelUrl);
			// }

			// Util::dbg($conditions);

			return $imoveis;

		}	

		public static function searchImoveisPorCodigo($app){

			$conditions = array(
				0 => "i.FlagPublico = ? ",
				1 => -1,
			);

			$conditions[0] .= " AND i.FlagRequerAprovacao = ?";
			$conditions[] = 0;

			$limit = 9999; 
			
			$order = "i.imovelID DESC";
			
			$sql = array(
				"select" => " 
					
					'imovel' AS Produto,
					i.FlagPublico,
					i.EmpreendimentoNome,
					i.ImovelID as ID,
					i.Codigo, 
					i.ValorVenda,
					i.ValorLocacao,
					it.Nome AS NomeTipo,
					sil_c.nome_original AS cidadeNome,
					sil_b.nome_original AS bairroNome,
					
					NULL as objurl",
				
				"from" => 	"imv_imovel i",

				"joins" => 	"LEFT OUTER JOIN imv_imoveltipo it ON i.imoveltipoID = it.imoveltipoID
					         JOIN sil_bairro sil_b ON i.sil_bairro_id2 = sil_b.id
					         JOIN sil_cidade sil_c ON sil_b.cidade_id = sil_c.id", 
				
				"conditions" =>	$conditions,
				
				"order" =>	$order,
				
				"limit" =>	$limit
			);

			$imoveis = self::find('all',$sql);	
			$imoveis = self::ImvUrl($imoveis);	
			
			return $imoveis;

		}	
	}



	/*
public static function findImoveisMinified($img_ext = "_tb",$ids = null){
			$limit = " LIMIT 100";

			$conditions = array(
				0 => " i.FlagPublico = ? ",
				1 => -1,
			);
			$conditions[0] .= " AND i.FlagRequerAprovacao = ? ";
			$conditions[] = 0;

			if($ids != null) {
				$conditions[0] .= " AND i.ImovelID in (?) ";
				$conditions[] = $ids;
			}

			//,CONCAT(it.Nome, \"+\", IF(i.ValorVenda,"Venda","Locacao"), \"+\", REPLACE(sil_c.nome_original, " ", "-"), \"+\", REPLACE(sil_b.nome_original, " ", "-") ) as objurl ',
			$sql = array(
			"select" => '*
					/*"imovel" AS Produto,
					/*IF(i.ValorVenda,"prontos","locacao") AS ProdutoTag,
					i.EmpreendimentoNome,
					i.ImovelID AS ID,
					img.album_id AS AlbumID,
					i.ValorVenda,
					i.ValorLocacao,
					i.Codigo,
					i.CondominioNome,
					sil_c.nome_original AS cidadeNome,
					sil_b.nome_original AS bairroNome,
					it.Nome AS NomeTipo,
					img.imagem_id AS ImagemId
					,i.ImovelID as imgorder
					,NULL as imgurl
					,NULL as imgfullurl ',
					
			"from" =>" imv_imovel  ",
			"join" =>" /*LEFT OUTER JOIN imv_imoveltipo it ON i.imoveltipoID=it.imoveltipoID
					LEFT OUTER JOIN sil_bairro sil_b ON i.sil_bairro_id=sil_b.id
					LEFT OUTER JOIN sil_bairro sil_b2 ON i.sil_bairro_id2=sil_b2.id
					LEFT OUTER JOIN sil_cidade sil_c ON i.sil_cidade_id=sil_c.id
					LEFT OUTER JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
					LEFT OUTER JOIN img_imagem as img ON (img.album_id = imgc.album_id and img.flag_capa = -1) ",
			/*"conditions"=> $conditions,
			/*"order" => " i.imovelID DESC ",
			/*"limit" => $limit
			);
						
			$imoveis = self::find('first',$sql);
			self::showsql();
			$imoveis = self::ImvUrl($imoveis);
			
			

			// caso não exista capa disponivel setada
			foreach ($imoveis as $imovel) {
				if(empty($imovel->imagemid)){
					$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, "_tb");
					$imovel->imgorder = (strpos($imovel->imgurl, "logo_cinza.png") > 0) ? 10000 + $imovel->imgorder : 20000 + $imovel->imgorder;
				}else{
					$imovel->imgorder = 50000 + $imovel->imgorder;
					$imovel = Album::UrlImg($imovel, "_tb");
				}
			}

			// Util::dbg($imoveis);
			return $imoveis;
		}
	*/