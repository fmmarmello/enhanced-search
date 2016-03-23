<?php

	
	$_app_config = array(

		/*
		* @config prod
		* dados que serão utilizados quando a aplicação subir para produção 
		*/
	
		"prod" => array(
			"Cliente" 			=> "Nova Época",
			"ClienteShort" 		=> "Nova Época",
			"state" 			=> "production",
			"debug"				=> true,
			"salt" 				=> "@InforceImoveisNE",
			"base"				=> "http://dev.novaepoca.com.br",
			"base_url" 			=> "http://dev.novaepoca.com.br/web/",
			"HOST_EXTRANET" 	=> NULL,
			"ImagePath"			=> "http://novaepoca.inforcedata.com.br/galeriaimagem/imagem/open/",
			"ImageEXT"			=> "tipo=&",
			"ImagePathApi"		=> "http://novaepoca.inforcedata.com.br/image/",
			"HOST_ADMIN" 		=> "http://novaepoca.inforcedata.com.br/",

			"HOST_ROUTE" 		=>  substr($_SERVER['REQUEST_URI'], 1),
			"galeria_imagem" 	=> "_custom/galeria_imagem/",
			
			/*
			* @config mail
			* configuração relacionada a autenticação de e-mail
			*/
			
		
			
			/*
			* @config database
			* configuração relacionada ao banco de dados
			*/

		

			/*
			* @config constantes
			* constantes que devem ser criadas para o site
			*/
			"constantes" => array(
				"itensPorPag" => "12"
			), 


			/*
			* @config api
			* configurações para api de conteudo 
			*/
			"api" 	=> array(
				"key"  => "D6AC8689-6300-479F-A55B-AD2EA4D23CA9", //"2071AB51-DAD9-45BC-A7C9-57FE98E5A71D", 
				"paths" => array(
					"imovel" => array(
						"list" 		=> "http://dev.webapi.inforcedata.com.br/Imovel/Search/D6AC8689-6300-479F-A55B-AD2EA4D23CA9/_", 
						"detail"	=> "http://dev.webapi.inforcedata.com.br/Imovel/Detail/D6AC8689-6300-479F-A55B-AD2EA4D23CA9/"
					),

					"empreendimento" => array(
						"list" => "http://dev.webapi.inforcedata.com.br/Empreendimento/Search/D6AC8689-6300-479F-A55B-AD2EA4D23CA9/",
						"detail" => "http://dev.webapi.inforcedata.com.br/Empreendimento/Detail/D6AC8689-6300-479F-A55B-AD2EA4D23CA9/"
					)
				)
			) 
		),

		/*
		* @config dev
		* dados que serão utilizados enquanto a aplicação estiver em desenvolvimento 
		*/

		"dev" => array(
			"Cliente"			=> "Nova Época",
			"state" 			=> "development",
			"debug" 			=> true,
			"salt"  			=> "@InforceWebApp",
			"base" 				=> "http://novaepoca.temp.w3br.com/",
			"base_url" 			=> "http://novaepoca.temp.w3br.com/web/",
			"HOST_EXTRANET" 	=> NULL,
			"HOST_ADMIN" 		=> "http://novaepoca.inforcecode.com.br/",
			"HOST_ROUTE" 		=> $_SERVER['REQUEST_URI'],
			"galeria_imagem" 	=> "_custom/galeria_imagem/",
			
			/*
			* @config mail
			* configuração relacionada a autenticação de e-mail
			*/

		
			/*
			* @config database
			* configuração relacionada ao banco de dados
			*/

		
		)
	);
