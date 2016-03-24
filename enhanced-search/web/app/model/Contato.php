<?php

	namespace Model;

	class Contato extends \ActiveRecord\Model {

		static $table_name = 'crm_formulario';

        public static function findFormulario($url){

		   	$sql = array(
		   		'select' => '
		   				formularioid AS ID, 
		   				pagina AS url, 
		   				defaultfocus AS foco,
		   				mailto, 
		   				mailcc, 
		   				mailcco, 
		   				mailsubject AS assunto, 
		   				mailstyle as estilo, 
		   				mailtextosuperior,
		   				mailtextoinferior,
		   				flagnewsletter,
		   				flagnewslettertext,
		   				msgsucessotitulo,
		   				msgsucessomensagem,
		   				msgalertatitulo,
		   				msgalertamensagem,
		   				msgerrotitulo,
		   				msgerromensagem,
		   				flagativo,
		   				nome,
		   				origemid,
		   				dtinsert,
		   				userinsert,
		   				dtupdate,
		   				userupdate
		   		',
		   		'from' => 'crm_formulario',
		   		'conditions' => array('flagativo = -1 AND pagina = ?', $url),
		   		// 'order' => 'ordem ASC'
		   	);

			$result = array(
				'template' => 'helpers/formulario-'.$url.'.twig.php',
				'content' => self::find('first',$sql)
			);

			return $result;
		}
	}	