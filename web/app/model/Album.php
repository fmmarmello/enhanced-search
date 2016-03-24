<?php

	namespace Model;

	use Lib\Util;

	class Album extends \ActiveRecord\Model {

		static $table_name = 'img_album';

		// static $after_construct = array('get_publico');

        public static function showsql(){
            echo self::table()->last_sql;
            die;
        }


        public static function UrlImg($data, $ext = ""){
        
            $host_admin = Param::getHostAdmin();
         
        	if(is_array($data)){
	        	foreach ($data as $oImagem) {
	        		if($oImagem->imagemid > 0){
		        		if($oImagem->produto=="empreendimento"){
		        			$oImagem->imgorder = 50000 + $oImagem->imgorder;
		        			$oImagem->imgurl = $host_admin."_custom/empreendimento/fichatecnica/imagem/".$oImagem->imagemid."/".$oImagem->imagemid."_vitrine.jpg";
		        			$oImagem->imgfullurl = $host_admin."_custom/empreendimento/fichatecnica/imagem/".$oImagem->imagemid."/".$oImagem->imagemid.".jpg";
		        		}
		        		if($oImagem->produto=="imovel"){		        			
		        			$oImagem->imgurl = $host_admin."_custom/galeria_imagem/" . $oImagem->imagemano . "/" . $oImagem->imagemmes . "/" . $oImagem->albumid . "/". $oImagem->imagemid;
		        			#$oImagem->imgurl = $host_admin."galeria_imagem/Default.asp?id=".$oImagem->imagemid;
		        			$oImagem->imgfullurl = $oImagem->imgurl.'.jpg';
		        			if(!empty($ext)){
		        				#$oImagem->imgurl .= '&tipo='.$ext;
		        				$oImagem->imgurl .= $ext;		        				
		        			}
		        			$oImagem->imgurl .= '.jpg';
		        		}
		        		if($oImagem->produto=="noticia"){
		        			$oImagem->imgurl = $host_admin."_custom/galeria_imagem/" . $oImagem->imagemano . "/" . $oImagem->imagemmes . "/" . $oImagem->albumid . "/". $oImagem->imagemid . ".jpg";
		        			$oImagem->imgfullurl = $host_admin."_custom/galeria_imagem/" . $oImagem->imagemano . "/" . $oImagem->imagemmes . "/" . $oImagem->albumid . "/". $oImagem->imagemid . ".jpg";
		        		}
		        		if($oImagem->produto=="imagem"){
		        			$oImagem->imgurl = $host_admin."_custom/galeria_imagem/" . $oImagem->imagemano . "/" . $oImagem->imagemmes . "/" . $oImagem->albumid . "/". $oImagem->imagemid .$ext. ".jpg";
		        			$oImagem->imgfullurl = $host_admin."_custom/galeria_imagem/" . $oImagem->imagemano . "/" . $oImagem->imagemmes . "/" . $oImagem->albumid . "/". $oImagem->imagemid . ".jpg";
		        		}
		        		if($oImagem->produto=="slides"){
		        			$oImagem->imgurl = $host_admin.$oImagem->imgurl;
		        		}
		        	}else{
		        		$oImagem->imgorder = 10000 + $oImagem->imgorder;
                        $oImagem->imgurl = "assets/img/logo_cinza.png";
		        	}
	        	}

        	}

        	if(is_object($data)){
        		if($data->imagemid > 0){
	        		if($data->produto=="empreendimento"){
	        			$data->imgorder = 50000 + $oImagem->imgorder;
	        			$data->imgurl = $host_admin."_custom/empreendimento/fichatecnica/imagem/".$data->imagemid."/".$data->imagemid."_vitrine.jpg";
	        			$data->imgfullurl = $host_admin."_custom/empreendimento/fichatecnica/imagem/".$data->imagemid."/".$data->imagemid.".jpg";
	        		}
	        		if($data->produto=="imovel"){
	        			$data->imgurl = $host_admin."_custom/galeria_imagem/" . $data->imagemano . "/" . $data->imagemmes . "/" . $data->albumid . "/". $data->imagemid;
	        			#$data->imgurl = $host_admin."galeria_imagem/Default.asp?id=".$data->imagemid;
	        			$data->imgfullurl = $data->imgurl.'.jpg';
	        			if(!empty($ext)){
	        				#$data->imgurl .= '&tipo='.$ext;
	        				$data->imgurl .= $ext;
	        			}
	        			$data->imgurl .= '.jpg';
	        		}
	        		if($data->produto=="noticia"){
	        			$data->imgurl = $host_admin."_custom/galeria_imagem/" . $data->imagemano . "/" . $data->imagemmes . "/" . $data->albumid . "/". $data->imagemid . ".jpg";
	        			$data->imgfullurl = $host_admin."_custom/galeria_imagem/" . $data->imagemano . "/" . $data->imagemmes . "/" . $data->albumid . "/". $data->imagemid . ".jpg";
	        		}
	        		if($data->produto=="imagem"){
	        			$data->imgurl = $host_admin."_custom/galeria_imagem/" . $data->imagemano . "/" . $data->imagemmes . "/" . $data->albumid . "/". $data->imagemid . $ext.".jpg";
	        			$data->imgfullurl = $host_admin."_custom/galeria_imagem/" . $data->imagemano . "/" . $data->imagemmes . "/" . $data->albumid . "/". $data->imagemid . ".jpg";
	        		}
	        		if($data->produto=="slides"){
	        			$data->imgurl = $host_admin.$data->imgurl;
	        		}
	        	}else{
	        		$data->imgorder = 10000 + $data->imgorder;
					$data->imgurl = "assets/img/logo_cinza.png";

	        	}
	
        	}

        	return $data;

        }


		public static function findGaleria($albumId, $limit, $template){

			$limit = ($limit) ? $limit : 1;
            
		   	$sql = array(
		   		'select' => ' "imagem" AS Produto, 
		   			i.*, 
		   			i.imagem_id as ImagemID, 
		   			i.album_id as AlbumID, 
		   			c.nome as titulo, 
		   			year(i.dt_insert) AS ano, 
		   			year(i.dt_insert) AS imagemano, 
		   			month(i.dt_insert) AS mes, 
		   			month(i.dt_insert) AS imagemmes, 
		   			null AS imgfullurl,
		   			null AS imgurl',

		   		'from' => 'img_imagem i',

		   		'joins' => 'INNER JOIN img_album  AS a  ON i.album_id = a.album_id
	            			INNER JOIN img_conta  AS c  ON a.album_id = c.album_id',

		   		'conditions' => array('c.conta_id = ?', $albumId),

		   		'order' => 'i.flag_capa ASC',

		   		'limit' => $limit
		   	);

		   	$galeria = new \stdClass;
			$galeria->produto = "imagem";
			$galeria->titulo = "Galeria";
			$galeria->descricao = "";
			$galeria->tipo = "carrousel";
			$galeria->template = "galeria-grade-tudo";
			$galeria->array_imgs = self::UrlImg( self::find('all', $sql), "_tb" );
			#Util::dbg(self::table()->last_sql); 

			$galerias = array(
				'template' => $template,
				'content' => $galeria
			);
			$result[] = $galerias;

            return $result;
			
		}


		public static function findGaleriaImovel($ImovelID, $limit, $template, $extensao_img){
			$limit = ($limit) ? $limit : 1;
            
		   	$sql = array(
		   		'select' => ' "imagem" AS Produto, 
		   			i.*,
		   			"Galeria" AS Titulo,
		   			"carrossel" AS Tipo,
		   			null AS Descricao,
		   			year(i.dt_insert) AS imagemano, 
		   			month(i.dt_insert) AS imagemmes, 
		   			i.album_id AS AlbumID,
		   			i.imagem_id As ImagemID,
		   			null AS imgfullurl,
		   			null AS imgurl',

		   		'from' => 'img_imagem i',
		   		'joins' => 'INNER JOIN img_album  AS a  ON i.album_id = a.album_id
	            			INNER JOIN img_conta  AS c  ON a.album_id = c.album_id
	            			INNER JOIN imv_imovel AS im ON c.conta_id = im.img_conta_id',
		   		'conditions' => array('im.ImovelID = ?', $ImovelID),
		   		'order' => 'i.flag_capa ASC',
		   		'limit' => $limit
		   	);

		   	$galeria = new \stdClass;
			$galeria->produto = "imagem";
			$galeria->titulo = "Galeria";
			$galeria->descricao = "";
			$galeria->tipo = "carrousel";
			$galeria->template = "carrousel";
			$galeria->array_imgs = self::UrlImg( self::find('all', $sql),$extensao_img);


			$galerias = array(
				'template' => $template,
				'content' => $galeria
			);
			$result[] = $galerias;

            return $result;
			
		}

		// metodo que busca todos os albuns do produto id 
		// (atualmente apenas empreendimentos tem albuns/conta/galerias)
		// img_conta_id = img_imagem.album_id
		public static function findGalerias($id, $limit){
			$limit = ($limit) ? $limit : 1;

		   	$sql = array(
		   		'select' => ' "imagem" as Produto,
		   			lc.LancamentoTopicoID, 
		   			lc.EmpreendimentoID, 
		   			lc.Nome AS Titulo, 
		   			lc.descricao, 
		   			lc.ordem, 
		   			lc.img_conta_id, 
		   			lce.Nome,
		   			lce.template,
		   			NULL AS array_imgs',
		   		'from' => 'emp_lancamentotopico AS lc',
		   		'joins' => 'INNER JOIN emp_lancamentotopicoexibicao AS lce ON lc.LancamentoTopicoExibicaoID = lce.LancamentoTopicoExibicaoID',
		   		'conditions' => array('lc.empreendimentoid = ? and lc.flagativo = 1' , $id),
		   		'order' => 'lc.ordem ASC',
		   		// 'limit' => $limit
		   	);

			$galerias = self::find('all',$sql);
			// self::showsql();
			$result = array();

			foreach ($galerias as $objeto) {
				
				$objeto = array(
					'template' => 'helpers/bloco-'.$objeto->template.'.twig.php',
					'content' => self::findImagens($objeto, $limit)
				);
				$result[] = $objeto;
			}
			// Util::dbg($result);

            return $result;
			
		}


		public static function findImagens($oAlbum, $limit, $ext=null){
			$limit = ($limit) ? $limit : 1;
            
		   	$sql = array(
		   		'select' => ' "'.$oAlbum->produto.'" as Produto, 
		   			i.*, 
		   			year(i.dt_insert) AS imagemano, 
		   			month(i.dt_insert) AS imagemmes, 
		   			i.album_id AS albumID, 
		   			i.imagem_id AS ImagemID, 
		   			null AS imgfullurl,
		   			null AS imgurl',
		   		'from' => 'img_imagem i',
		   		'conditions' => array('ia.conta_id = ?', $oAlbum->img_conta_id),
		   		'order' => 'i.flag_capa ASC, i.ordem ASC',
		   		'joins' => 'INNER JOIN img_album AS ia ON i.album_id = ia.album_id',
		   		'limit' => $limit
		   	);
			if($ext==null){
				$ext = "_tb";
			}
			$oAlbum->array_imgs = self::UrlImg( self::find('all',$sql), $ext );
			// self::showsql();
			// Util::dbg($oAlbum);

            return $oAlbum;
			
		}


        public static function ImgCapa($ImovelID) {
            
		   	$sql = array(
		   		'select' => 'i.*,year(i.dt_insert) AS ano, month(i.dt_insert) AS mes, null AS imgurl',

		   		'from' => 'img_imagem i',

		   		'joins' => 'INNER JOIN img_album  AS a  ON i.album_id = a.album_id
	            			INNER JOIN img_conta  AS c  ON a.album_id = c.album_id
	            			INNER JOIN imv_imovel AS im ON c.conta_id = im.img_conta_id',

		   		'conditions' => array('im.ImovelID = ?', $ImovelID),

		   		'order' => 'i.flag_capa ASC, i.imagem_id ASC',

		   		'limit' => 1

		   	);

			$result = self::find('first',$sql);

            return $result;
            
        }	




	}

		