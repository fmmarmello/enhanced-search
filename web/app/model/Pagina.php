<?php

	namespace Model;

	use Controller;
	use Lib\Util;

	class Pagina extends \ActiveRecord\Model {

		static $table_name = 'pag_conteudo';


		public static function findPaginas(){


		   	$sql = array(
		   		'select' => ' "pagina" AS Produto,
		   			"pagina" AS ProdutoTag,
		   			p.conteudoid AS ID, 
		   			p.FlagPublico, 
		   			p.img_conta_id AS album_id,
		   			p.arq_conta_id,
		   			p.nome,
		   			p.urlamigavel AS objurl,
		   			p.titulo,
		   			p.subtitulo,
		   			p.sumario,
		   			p.corpo,
		   			p.palavrachave,
		   			p.data AS data_programada,
		   			p.contador,
		   			p.ordem,
		   			p.flagdestaque,
		   			p.userinsert AS autor,
		   			p.dtinsert AS data_insercao,
		   			p.userupdate AS editor,
		   			p.dtupdate AS data_atualizacao,
		   			ct.nome AS NomeTipo
				',


		   		'from' => 'pag_conteudo p',

		   		'joins' => 'INNER JOIN pag_conteudotipo ct ON p.conteudotipoid = ct.conteudotipoid',
						 //    INNER JOIN sil_cidade c on i.sil_cidade_id = c.id
						 //    INNER JOIN sil_estado e ON i.sil_estado_id = e.id
						 //    INNER JOIN imv_imoveltipo t on i.ImovelTipoID = t.ImovelTipoID
			    //     		LEFT JOIN imv_imovelconstrucao ic on ic.ImovelID = i.ImovelID
							// LEFT OUTER JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
							// LEFT OUTER JOIN imv_imovelambienteqnt iqtd ON i.ImovelID = iqtd.imovelID
							// LEFT OUTER JOIN img_imagem as img ON (img.album_id = imgc.album_id and img.flag_capa = -1)',

		   		'conditions' => array('p.FlagPublico = -1 ')

		   	);

			$paginas = self::find('all',$sql);

			return $paginas;

		}

		public static function findPagina($url){

		   	$sql = array(
		   		'select' => ' "pagina" AS Produto,
		   			"pagina" AS ProdutoTag,
		   			p.conteudoid AS ID, 
		   			p.FlagPublico, 
		   			p.img_conta_id AS conta_id,
		   			p.arq_conta_id,
		   			p.nome,
		   			p.urlamigavel AS objurl,
		   			p.titulo,
		   			p.subtitulo,
		   			p.sumario,
		   			p.corpo,
		   			p.palavrachave,
		   			p.data AS data_programada,
		   			p.contador,
		   			p.ordem,
		   			p.flagdestaque,
		   			p.userinsert AS autor,
		   			p.dtinsert AS data_insercao,
		   			p.userupdate AS editor,
		   			p.dtupdate AS data_atualizacao,
		   			ct.nome AS NomeTipo

				',


		   		'from' => 'pag_conteudo p',

		   		'joins' => 'INNER JOIN pag_conteudotipo ct ON p.conteudotipoid = ct.conteudotipoid',

						 //    INNER JOIN sil_cidade c on i.sil_cidade_id = c.id
						 //    INNER JOIN sil_estado e ON i.sil_estado_id = e.id
						 //    INNER JOIN imv_imoveltipo t on i.ImovelTipoID = t.ImovelTipoID
			    //     		LEFT JOIN imv_imovelconstrucao ic on ic.ImovelID = i.ImovelID
							// LEFT OUTER JOIN img_conta as imgc ON i.img_conta_id = imgc.conta_id
							// LEFT OUTER JOIN imv_imovelambienteqnt iqtd ON i.ImovelID = iqtd.imovelID
							// LEFT OUTER JOIN img_imagem as img ON (img.album_id = imgc.album_id and img.flag_capa = -1)',

		   		'conditions' => array('p.urlamigavel = ? AND p.FlagPublico = -1 AND p.FlagLixo = 0 ', $url)

		   	);

			$content = self::find('first',$sql);
			//Util::dbg(self::table()->last_sql);

			$pagina = array(
				'template' => 'helpers/interna-detalhe-pagina.twig.php',
				'content' => $content
			);

			return $pagina;

		}


		static public function findBlocks($region){


		}

		public static function getFiliais(){
            $sql = "SELECT  
                    f.filialid as id,
                    f.nome,
                    f.endereco,
                    f.flagativo,
                    f.flagsede,
                    f.telefone,
                    f.flagpublico,
                    f.sigla,
                    f.cep,
                    f.sil_bairro_id,
                    sb.nome_customizado as bairro,
                    sc.nome_customizado as cidade,
                    se.sigla as estado
                FROM imo_filial f 
                INNER JOIN sil_bairro sb ON sb.id = f.sil_bairro_id
                INNER JOIN sil_cidade sc ON sc.id = sb.cidade_id
                INNER JOIN sil_estado se ON se.id = sc.estado_id
                WHERE
                    flagpublico = - 1";

            $filiais = Self::find_by_sql($sql);

            return $filiais;
        }

	}