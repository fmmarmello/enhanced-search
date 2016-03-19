<?php

	namespace Model;

	use Controller;
	use Lib\Util;

	class Noticia extends \ActiveRecord\Model {

		static $table_name = 'ntc_noticia';

        public static function showsql(){
            echo self::table()->last_sql;
            die;
        }


		public static function NtcUrl($arrNoticia){
			if (is_array($arrNoticia)){
	        	foreach ($arrNoticia as $oNoticia) {
	        		// filtrar por categoria_id?
					// $finalidade = ($oNoticia->valorvenda) ? "venda" : "locacao";
	        		$oNoticia->objurl = Util::removeCaracteresEspeciais(strtolower(str_replace(" ", "-", $oNoticia->titulo)));
	        	}
			}

			if (is_object($arrNoticia)){
				// $finalidade = ($arrNoticia->valorvenda) ? "venda" : "locacao";
        		$arrNoticia->objurl = Util::removeCaracteresEspeciais(strtolower(str_replace(" ", "-", $oNoticia->titulo)));
			}

        	return $arrNoticia;
		}


		public static function findNoticias($app, $destaque=null, $catId=null, $limit=null){
			$conditions = array(
				0 => "n.FlagPublico = ?",
				1 => -1,
			);

			if( ($destaque==null) || ($destaque=='null')){ /* do nothing */ }else{
				$conditions[0] .= " AND n.FlagDestaque = ?";
				$conditions[] = -1;
			}			

			if( ($catId==null) || ($catId=='null')){ /* do nothing */ }else{
				$conditions[0] .= " AND nc.id = ?";
				$conditions[] = $catId;
			}			

		   	$sql = array(
		   		'select' => ' 
		   			"noticia" 		AS Produto,
		   			"noticias" 		AS ProdutoTag,
		   			n.NoticiaID 	AS ID, 
		   			n.titulo		AS Titulo,
		   			n.DtInclusao 	AS data_insercao,
		   			n.DtAlteracao 	AS data_atualizacao,
		   			n.data 			AS data_programada,
		   			n.FlagPublico	AS FlagPublico, 
		   			n.FlagDestaque  AS FlagDestaque,
		   			n.autor 		AS autor,
		   			n.img_conta_id 	AS conta_id,
		   			img.album_id 	AS AlbumID,
		   			n.arq_conta_id 	AS arq_conta_id,
		   			NULL 			AS objurl,
		   			NULL 			AS imgurl,
		   			NULL 			AS imgfullurl,
		   			NULL 			AS mes,
		   			n.chamada		AS sumario,
		   			n.conteudo		AS corpo,
		   			n.fonte,
		   			n.link,
					img.imagem_id AS ImagemId,
					img.descricao AS ImagemDescricao, 
					year(img.dt_insert) AS ImagemAno,
					month(img.dt_insert) AS ImagemMes
				',


		   		'from' => 'ntc_noticia n',

		   		'joins' => 'LEFT OUTER JOIN img_conta AS imgc ON n.img_conta_id = imgc.conta_id
		   					LEFT OUTER JOIN img_album AS imgb ON imgc.conta_id = imgb.conta_id
							LEFT OUTER JOIN img_imagem AS img ON (imgb.album_id = img.album_id and img.flag_capa = -1)
							INNER JOIN ntc_noticiacategoria AS nc ON n.categoria_id = nc.id',

		   		'conditions' => $conditions,

		   		'order' => 'n.NoticiaID DESC',

		   		"limit" =>	$limit

		   	);

			$noticias = self::find('all',$sql);
			$noticias = self::NtcUrl($noticias);

			// caso não exista capa disponivel setada
			foreach ($noticias as $noticia) {
				$noticia->mes = Util::getMonthName(date("n", $noticia->data_programada))['abreviacao']; 
				if(empty($noticia->imagemid)){
					$noticia->imgurl = Controller\Album::getImgCapa($noticia->produto, $noticia->id);
				}else{
					$noticia = Album::UrlImg($noticia);
				}
			}

			
			return $noticias;

		}

		public static function findNoticia($newsId){

		   	$sql = array(
		   		'select' => '
		   			"noticia" 		AS Produto,
		   			"noticias" 		AS ProdutoTag,
		   			n.NoticiaID 	AS ID, 
		   			n.titulo		AS ProdTitle,
		   			n.titulo		AS Titulo,
		   			n.DtInclusao 	AS data_insercao,
		   			n.DtAlteracao 	AS data_atualizacao,
		   			n.data 			AS data_programada,
		   			n.FlagPublico	AS FlagPublico, 
		   			n.FlagDestaque  AS FlagDestaque,
		   			n.autor 		AS autor,
		   			n.img_conta_id 	AS conta_id,
		   			img.album_id 	AS AlbumID,
		   			n.arq_conta_id 	AS arq_conta_id,
		   			NULL 			AS objurl,
		   			NULL 			AS imgurl,
		   			NULL 			AS imgfullurl,
		   			n.chamada		AS descricao,
		   			n.conteudo		AS corpo,
		   			n.fonte,
		   			n.link,
					img.imagem_id AS ImagemId,
					img.descricao AS ImagemDescricao, 
					year(img.dt_insert) AS ImagemAno,
					month(img.dt_insert) AS ImagemMes,

					NULL 			AS valorvenda,
					NULL 			AS valorlocacao,
					NULL 			AS tipo,
					NULL 			AS cidade,
					NULL 			AS bairronome,
					NULL 			AS estadonome
				',


		   		'from' => 'ntc_noticia n',

		   		'joins' => 'LEFT OUTER JOIN img_conta AS imgc ON n.img_conta_id = imgc.conta_id
		   					LEFT OUTER JOIN img_album AS imgb ON imgc.conta_id = imgb.conta_id
							LEFT OUTER JOIN img_imagem AS img ON (imgb.album_id = img.album_id and img.flag_capa = -1)',

		   		'conditions' => array('n.FlagPublico = -1 AND n.NoticiaID = ?', $newsId),

		   	);

			$noticia = self::find('first',$sql);

			return $noticia;

		}
		

		public static function findCategorias(){

		   	$sql = array(
		   		'select' => '
		   			"noticia" 			AS Produto,
		   			"categorias"		AS ProdutoTag,
		   			nc.id 				AS ID,
		   			nc.nome 			AS Nome,
		   			NULL 				AS objurl,
		   			count(n.NoticiaID) 	AS Total
				',

		   		'from' => 'ntc_noticiacategoria AS nc',

		   		'joins' => 'INNER JOIN ntc_noticia AS n ON n.categoria_id = nc.id',

		   		'conditions' => array('n.FlagPublico = -1'),

		   		'group' => 'nc.id',

		   	);

			$cats = self::find('all',$sql);
			foreach ($cats as $key => $c) {
				$c->objurl = strtolower(str_replace(" ", "-", $c->nome));
			}

			return $cats;

		}


	}