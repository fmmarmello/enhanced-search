<?php

	namespace Model;

	use Lib\Util;

	class Banner extends \ActiveRecord\Model {

		static $table_name = 'ban_banneritem';
			// coluna entidadeid => { "imovel" : 1, "empreendimento" : 2 }


        public static function findSlides($grupoId){

        	$timerPadrao = 5; // $timerPadrao -> tempo padrao em segundos para o slider trocar

		   	$sql = array(
		   		'select' => ' "slides" AS Produto,
		   				arquivo AS imgurl, 
		   				extensao, 
		   				left(titulo,82) AS titulo, 
		   				subtitulo, 
		   				link, 
		   				target, 
		   				COALESCE(tempo, '.$timerPadrao.') as tempo,
		   				bannerid,
		   				bannerid as ImagemID',

		   		'from' => 'ban_banneritem',

		   		'conditions' => array('bannerid = ? AND flagpublico = ? AND flaglixo = ?', $grupoId, -1, 0),

		   		'order' => 'ordem ASC'
		   	);

			$slides = self::find('all',$sql);
			$slides = Album::UrlImg($slides);

			// Util::dbg($slides);

			return $slides;
		}


		public static function findBannerModal($grupoId){


		   	$sql = array(
		   		'select' => ' "banner-modal" AS Produto,
		   				arquivo AS imgurl, 
		   				extensao, 
		   				left(titulo,82) AS titulo, 
		   				subtitulo, 
		   				link, 
		   				target, 
		   				bannerid,
		   				UNIX_TIMESTAMP(dtpublicacaoinicio) AS data_inicio,
		   				UNIX_TIMESTAMP(dtpublicacaofim) AS data_fim,
		   				UNIX_TIMESTAMP(NOW()) AS data_atual,
		   				tempo',

		   		'from' => 'ban_banneritem',

		   		'conditions' => array('bannerid = ? AND flagpublico = ? AND flaglixo = ? ', $grupoId, -1, 0),

		   		'order' => 'ordem ASC'
		   	);

		   		$banner = self::find('first',$sql);
		   		if($banner){
		   			if ( ($banner->data_inicio==0) && ($banner->data_fim==0) ){
						return $banner;
		   			}
			   		if ( (date("YmdHis",$banner->data_atual) < (date("YmdHis",$banner->data_inicio))) ){
		   				return $banner = null;
					}		   				
			   		if ( (date("YmdHis",$banner->data_atual)) > (date("YmdHis",$banner->data_fim)) ){
		   				return $banner = null;
			   		} 
		   		}

		  
			return $banner;
		}


	}	