<?php
	
	namespace Model;

	use Controller;
	use Lib\Util;

	class Vitrine extends \ActiveRecord\Model {

		static $table_name = 'vit_vitrineitem';
			// coluna entidadeid => { "imovel" : 1, "empreendimento" : 2 }


		public static function findVitrine($id){
			$sql = array(
		   		'select' => 'vitrineid, 
		   					vitrineid as ID, 
							vitrinepaiid,
							entidadeid,
							nome,
							titulo,
							subtitulo,
							ordem,
							quantidademax,
							flagrandom',

		   		'from' => 'vit_vitrine vit',		   		

		   		// 'conditions' => array('i.FlagPublico = -1 AND sil_c.id = ? HAVING mes IS NOT NULL', 2),
		   		'conditions' => array('vit.vitrineid = ?', $id)
		   	);
		   	$result = self::find('first',$sql);
	   		
		   	if($result->entidadeid == '1'){ //imovel

		   		$vitrine = self::findImovelVitrine($result->id,$result->flagrandom,$result->quantidademax,'_original');

		   	}else if($result->entidadeid == '2'){ //empreendimento

		   		$vitrine = self::findEmpreendimentoVitrine($result->id,$result->flagrandom,$result->quantidademax);
		   	}

		   	return $vitrine;
		}

		public static function findImovelVitrine($id, $order, $limit, $img_ext=""){

			$order = ($order) ? "RAND()" : "v.ordem ASC";
			$limit = ($limit) ? $limit : 1;

		   	$sql = array(
		   		'select' => '"imovel" AS Produto,
						     "prontos" AS ProdutoTag,

						       vit.titulo,
						       vit.quantidademax,
						       vit.flagrandom,
						       v.titulo as VitrineTitulo,
		   					   v.chamada as VitrineChamada,
						       i.ImovelID as ID,
						       i.ImovelID as ItemID,
						       i.ValorVenda,
							   i.ValorLocacao,
							   i.AreaConstruida,
							   i.img_conta_id,
							   i.CondominioNome,
							   i.EmpreendimentoNome,

							   sil_c.nome_original AS cidadeNome,
						       sb.nome_customizado as bairroNome,
						       sil_e.sigla as estadosigla,
						       it.Nome as NomeTipo,
						       iaq.Quartos,
						       iaq.Suites,
						       iaq.Vagas,
						       iaq.BanheiroSocial,
						       iaq.BanheiroServico,

						       "_global/img/ico_apto.gif" as icone,

							   img.album_id,
							   img.album_id AS AlbumID,
							   img.imagem_id AS ImagemId,
							   img.imagem_id AS Imagem_Id,
							   img.descricao AS ImagemDescricao,
							   year(img.dt_insert) AS ano,
							   month(img.dt_insert) AS mes,
							   year(img.dt_insert) AS imagemano,
							   month(img.dt_insert) AS imagemmes,

						   NULL as imgorder,
						   NULL as imgurl,
						   NULL as imgfullurl,
						   NULL as objurl',

		   		'from' => 'imv_imovel i',

		   		'joins' => 'INNER JOIN vit_vitrineitem v on i.ImovelID = v.objetoid
							INNER JOIN vit_vitrine vit on vit.vitrineid = v.vitrineid
							INNER JOIN imv_imoveltipo it on it.ImovelTipoID = i.ImovelTipoID
							INNER JOIN sil_bairro sb ON i.sil_bairro_id2 = sb.id
							INNER JOIN sil_cidade sil_c ON i.sil_cidade_id = sil_c.id
							INNER JOIN sil_estado sil_e ON sil_c.estado_id = sil_e.id
							INNER JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
							INNER JOIN img_album as imga ON imga.conta_id = i.img_conta_id
							INNER JOIN img_imagem as img ON (img.album_id = imga.album_id AND img.flag_capa = -1)
							INNER JOIN imv_imovelambienteqnt iaq ON iaq.imovelID=i.imovelID',

		   		// 'conditions' => array('i.FlagPublico = -1 AND sil_c.id = ? HAVING mes IS NOT NULL', 2),
		   		'conditions' => array('i.FlagPublico = -1 and i.FlagRequerAprovacao <> -1 and v.vitrineid = ?', $id),

		   		'order' => $order,
		   		'limit' => $limit
		   	);
            
			$result = self::find('all',$sql);

			/*$result = Album::UrlImg($result);*/

			if ($result) {

				$new = array(); 

				foreach ($result as $imovel) {
					if(empty($imovel->imagemid)){
						$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, $img_ext);
					}else{
						$imovel = Album::UrlImg($imovel, $img_ext);
					}

					$new[] = $imovel; 
				}

				
				if (count($result) < 10) {
					$min =  10 - count($result);

					$complet = self::findImovelVitrineComplementar($min, "", $img_ext); 

					

					foreach ($complet as $key => $value) {
						$new[] = $value; 
					}


				}				

				$new = Imovel::ImvUrl($new);


			} else {
				$result = self::findImovelVitrineComplementar(10, "", $img_ext); 

				// if ($_SERVER['REMOTE_ADDR'] == '177.129.9.98') 
				// 	Util::dbg($result); 
			
				
				foreach ($result as $key => $value) {
					$new[] = $value; 
				}
			}
			
			// if ($_SERVER['REMOTE_ADDR'] == '177.129.9.98')
			// 	Util::dbg($new); 

            return $new;

		}

		public static function findImovelVitrineComplementar($limit, $order="", $img_ext=""){

			$order = ($order) ? "RAND()" : "i.ImovelID DESC";
			$limit = ($limit) ? $limit : 1;

		   	$sql = array(
		   		'select' => '"imovel" AS Produto,
						     "prontos" AS ProdutoTag,

						       i.ImovelID as ID,
						       i.ImovelID as ItemID,
						       i.ValorVenda,
							   i.ValorLocacao,
							   i.AreaConstruida,
							   i.img_conta_id,
							   i.CondominioNome,
							   i.EmpreendimentoNome,

							   sil_c.nome_original AS cidadeNome,
						       sb.nome_customizado as bairroNome,
						       sil_e.sigla as estadosigla,
						       it.Nome as NomeTipo,
						       iaq.Quartos,
						       iaq.Suites,
						       iaq.Vagas,
						       iaq.BanheiroSocial,
						       iaq.BanheiroServico,

						       "_global/img/ico_apto.gif" as icone,

							   img.album_id,
							   img.album_id AS AlbumID,
							   img.imagem_id AS ImagemId,
							   img.imagem_id AS Imagem_Id,
							   img.descricao AS ImagemDescricao,
							   year(img.dt_insert) AS ano,
							   month(img.dt_insert) AS mes,
							   year(img.dt_insert) AS imagemano,
							   month(img.dt_insert) AS imagemmes,

						   NULL as imgorder,
						   NULL as imgurl,
						   NULL as imgfullurl,
						   NULL as objurl',

		   		'from' => 'imv_imovel i',

		   		'joins' => 'INNER JOIN imv_imoveltipo it on it.ImovelTipoID = i.ImovelTipoID
							INNER JOIN sil_bairro sb ON i.sil_bairro_id2 = sb.id
							INNER JOIN sil_cidade sil_c ON i.sil_cidade_id = sil_c.id
							INNER JOIN sil_estado sil_e ON sil_c.estado_id = sil_e.id
							INNER JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
							INNER JOIN img_album as imga ON imga.conta_id = i.img_conta_id
							INNER JOIN img_imagem as img ON (img.album_id = imga.album_id AND img.flag_capa = -1)
							INNER JOIN imv_imovelambienteqnt iaq ON iaq.imovelID=i.imovelID',

		   		// 'conditions' => array('i.FlagPublico = -1 AND sil_c.id = ? HAVING mes IS NOT NULL', 2),
		   		'conditions' => array('i.FlagPublico = -1 and i.FlagRequerAprovacao <> -1'),

		   		'order' => $order,
		   		'limit' => $limit
		   	);
            
			$result = self::find('all',$sql);

			/*$result = Album::UrlImg($result);*/
			
			foreach ($result as $imovel) {
				if(empty($imovel->imagemid)){
					$imovel->imgurl = Controller\Album::getImgCapa($imovel->produto, $imovel->id, $img_ext);
				}else{
					$imovel = Album::UrlImg($imovel, $img_ext);
				}
			}				

			// Util::dbg($result);
			$result = Imovel::ImvUrl($result);
			//Util::dbg($result);
            return $result;

		}
		
		
		public static function findEmpreendimentoVitrine($vitrineID, $order, $limit){

			$order = ($order) ? "RAND()" : "v.ordem ASC";
			$limit = ($limit) ? $limit : 1;
            
		   	$sql = array(
		   		'select' => ' "empreendimento" AS produto,
		   				"lancamentos" AS ProdutoTag,
		   				e.EmpreendimentoID AS itemid, 
		   				e.EmpreendimentoID AS ID, 
		   				e.Nome AS EmpreendimentoNome, 
		   				v.vitrineitemid,
		   				v.titulo as VitrineTitulo,
		   				v.chamada as VitrineChamada,
		   				lv.LancamentoID AS ImagemID,
		   				ecs.Nome as ConstrutoraNome, 
		   				sc.nome_customizado cidadenome, 
		   				sb.nome_customizado bairronome,
						e.m2menor as m2menor, 
						e.m2maior as m2maior, 
						e.m2maior as AreaConstruida,
						e.valormenor as ValorMenor,

		   				null AS tipologia,
		   				null AS nometipo,
		   				null AS nquartos, 
		   				null AS quartos, 
		   				null AS BanheiroSocial, 
		   				null AS BanheiroServico, 
		   				null AS ValorVenda, 

		   				es.Status AS estatus,
		   				es.Status AS statusnome,
		   				e.EmpreendimentoStatusID AS statusID,
						NULL as imgorder,
		   				null AS imgurl, 
		   				null AS imgfullurl, 
		   				null AS objurl',

		   		'from' => 'vit_vitrineitem v',

		   		'joins' => 'INNER JOIN emp_empreendimento e on e.EmpreendimentoID = v.objetoid 
		   					INNER JOIN emp_empreendimentostatus AS es ON e.EmpreendimentoStatusID = es.EmpreendimentoStatusID
	            			LEFT JOIN emp_empreendimentoquarto eq on eq.EmpreendimentoID = e.EmpreendimentoID 
	            			LEFT JOIN emp_lancamentovitrine AS lv ON lv.LancamentoID = e.EmpreendimentoID	
	            			LEFT JOIN emp_lancamento AS l ON l.EmpreendimentoID = e.EmpreendimentoID	
			                LEFT JOIN sil_bairro sb ON e.sil_bairro_id = sb.id 
			                LEFT JOIN sil_cidade sc ON e.sil_cidade_id = sc.id 
			                LEFT JOIN emp_empreendimentoconstrutoraempreendimento ec ON ec.empreendimento_id = e.EmpreendimentoID 
			                LEFT JOIN emp_empreendimentoconstrutora ecs ON ecs.construtora_id = ec.construtora_id',

		   		'conditions' => array('e.FlagPublico = -1 AND l.FlagPublico = -1 AND vitrineid = ?', $vitrineID),

				'group' => 'e.EmpreendimentoID',

		   		'order' => $order,
		   		
		   		'limit' => $limit
		   	);

			$result = self::find('all',$sql);
			$result = Album::UrlImg($result);
			foreach ($result as $e) {
				$e->nquartos = Empreendimento::findEmpQuartos($e->id);
				$e->tipologia = Empreendimento::findEmpTipos($e->id);
				// $e->objurl = strtolower(str_replace(" ","-", $e->empreendimentonome)."+".str_replace(" ","-", $e->empreendimentonome)."+".str_replace(" ", "-", $e->cidadenome)."+". str_replace(" ", "-", $e->bairronome));
				$e = Empreendimento::EmpUrl($e);

			}
			// Util::dbg($result);

            return $result;
		}

	}	