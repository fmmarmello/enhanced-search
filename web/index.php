<?php
	/*
	* Arquivo de index do App Site Inforce
	* Versão geral do sistema: v1.1.0
	* 2015
	*
	*/


	/*
	*	se o site precisar entrar em 'modo de manutenção'
	*	descomente esse require e comente todos os outros
	*
	*	require ('manutencao.php');
	*/
	 
	require('../vendor/autoload.php');      // autoload do silex

	require('app.config.php');              // array de configuração da aplicação
	
	require('app.init.php');                // inicializacao do webapp

	require('app.route.php');               // mapa de rotas 
	
	require('app.error.php');               // gerenciador de erros
	
	require('app.log.php');               // sistema de log

	//===========================================================================

	/*
	*	
	*	fix de redirect para www 
	*	apenas para producao
	*/	
	// if($_CFG['state']=="production"){
	// 		if(strpos($_SERVER['SERVER_NAME'], "www")===false){;
	// 			header("location: ".$_CFG['base'].substr($_CFG['HOST_ROUTE'],1));
	// 		}
	// 	}
	

	//===========================================================================
	
	// RUN!
	$app->run();
	//$app['http_cache']->run();

	//Fecha a conexão com o banco
	Lib\Util::closeConnection();