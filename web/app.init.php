<?php

	// inicializações php básicas 
	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	//
	use Symfony\Component\HttpFoundation\Request;	
	use Symfony\Component\HttpFoundation\Response;

	
	$_CFG = ($_SERVER['SERVER_NAME'] == "local.site.morada") ? $_app_config['dev'] : $_app_config['prod'];

	// criação do cookie de sessão de usuario
	if(empty($_COOKIE['user_session'])){
		date_default_timezone_set("America/Sao_Paulo");
		setcookie("user_session", md5($_CFG['salt'].date('YmdHis')), (time()+60*60*24*365) );
	}


	// instancia uma nova aplicação silex
	$app = new Silex\Application();


	// registra o serviço de log
	$app->register(new Silex\Provider\MonologServiceProvider(), array(
	    'monolog.logfile' => __DIR__.'/mono/dev-'.date("Ymd").'.log',
	));

	//regista um http cacher
	$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
	    'http_cache.cache_dir' => __DIR__.'/cache/',
	));


	// registra um gerador de url // nao usando por enquanto
	// $app->register(new Silex\Provider\UrlGeneratorServiceProvider());


	// registra serviço de email
	$app->register(new Silex\Provider\SwiftmailerServiceProvider());
		$app['swiftmailer.options'] = $_CFG['mail'];
		$app['mailer'] = $app->share(function ($app) {
		    return new \Swift_Mailer($app['swiftmailer.transport']);
		});


	// registra o serviço de banco de dados - ORM PHPActiveRecord
	$app->register(new Ruckuus\Silex\ActiveRecordServiceProvider(), array(
    	'ar.model_dir' => __DIR__ . '/app/model',
    	'ar.connections' =>  array ('conn' => 'mysql://'.$_CFG["db"]["user"].':'.$_CFG["db"]["pass"].'@'.$_CFG["db"]["host"].'/'.ltrim($_CFG["db"]["path"],'/').''),
    	'ar.default_connection' => 'conn'
	));

	// registra o engine de template twig
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
	    'twig.path' => __DIR__.'/app/views',
	    'debug' =>true, 
	));



	/************************/
	/* GLOBAIS DA APLICACAO */
	/************************/

	// configurações
	$app['CONFIG'] = $_CFG; // inicializada na linha 80 deste mesmo arquivo

	$app['API'] = $_CFG['api']; 

	// declara o estado do debug
	$app['debug'] = $_CFG['debug'];

	// token usado para validação dos formularios
	$app['TOKEN'] = md5(date("YmdHis").$_CFG['salt']);


	// registrando globais no sistema de template twig
	$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {

	$filter = new Twig_SimpleFilter('unserialize', 'unserialize'); // OQ QUE É ISSO?

	$twig->addFilter($filter);

			// adiciona a rota como global		
			$twig->addGlobal('ROTA', $app['request']->attributes->get('_route') );

			// adiciona como global o cliente
			$Customer = Model\Cliente::findCliente();
			$twig->addGlobal('Customer', $Customer );		// no twig
			$app['Customer'] = $Customer;					// na aplicação silex

			// adiciona como global as configs da aplicacao
		    $twig->addGlobal('Config', $app['CONFIG'] );

		    
		    // adiciona o corretor como global do twig
		    $twig->addGlobal('Corretor', Controller\Pessoa::getCorretor() );

		    $twig->addExtension(new Twig_Extension_Debug());

		    // menu principal como global do twig
		    $twig->addGlobal('MenuPrincipal', Controller\Pagina::buildMenuPrincipal() );
		    $twig->addGlobal('MenuAuxiliar', Controller\Pagina::buildMenu(2));

		    // forms da busca 
		    $twig->addGlobal('selectProntos', Model\Imovel::findTipos() );		    
		    $twig->addGlobal('selectImovelQuartos', Model\Imovel::findQuartos() );
		    $twig->addGlobal('selectProntosValores', Model\Imovel::findValores() );
		    $twig->addGlobal('selectProntosCidades', Model\Imovel::findCidades('prontos') );
		    $twig->addGlobal('selectProntosBairros', Model\Imovel::findBairros('prontos') );

		    $twig->addGlobal('selectLocacao', Model\Imovel::findTiposLocacao() );
		    $twig->addGlobal('selectLocacaoValores', Model\Imovel::findValores('locacao') );
		    $twig->addGlobal('selectLocacaoCidades', Model\Imovel::findCidades('locacao') );
		    $twig->addGlobal('selectLocacaoBairros', Model\Imovel::findBairros('locacao') );

		    // forms da busca geral do cabecalho 
		    $twig->addGlobal('selectLocalizacao', Model\Empreendimento::findBairros() );
		    $twig->addGlobal('selectTipos', Model\Empreendimento::findTipos() ); //antigo selectLancamentos
		    $twig->addGlobal('selectLancamentos', Model\Empreendimento::findTipos() );
		    $twig->addGlobal('selectQuartos', Model\Empreendimento::findQuartos() );
		    $twig->addGlobal('selectStatus', Model\Empreendimento::findStatus() );
		    $twig->addGlobal('selectPorNome', Model\Empreendimento::findEmpreendimentos() );
		    $twig->addGlobal('selectCidades', Model\Empreendimento::findCidades() );

			$twig->addGlobal('selectProntosCaracteristica', Model\Imovel::findCaracteristicas('prontos') );

		    // rodape como global do twig // falta implementar
		    $twig->addGlobal('RodapeAuxiliar', Controller\Pagina::buildRodapeAux() );
		    $twig->addGlobal('RodapePrincipal', Controller\Pagina::buildRodapePri() );
		    $twig->addGlobal('RodapeEstatico', TRUE );
 
			$twig->addGlobal('MeuIP', $_SERVER['REMOTE_ADDR']);	
			$twig->addGlobal("CurrentUrl", $_SERVER["REQUEST_URI"]);

			//variáveis para pegar o endereço
			//Lib\Util::dbg(Model\Pagina::getFiliais()); 
		   	$twig->addGlobal('Enderecos', Model\Pagina::getFiliais() );
		
			
		    /*
		    *	@favoritos
		    *	esta variavel global traz todos os itens favoritados e armazenados no cookie[favoritos]
		    */

		    // if (isset($_COOKIE['favoritos'])) {
		    // 	$twig->addGlobal('CookieFavoritos', Lib\Util::getFavs());
		    // }
		    

			// tracking
			Model\Track::LogUser($app);
			#if($_SERVER['REMOTE_ADDR'] == '177.129.9.98'){			
			#}
			

	    return $twig;

	}));