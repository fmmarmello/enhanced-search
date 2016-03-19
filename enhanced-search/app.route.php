<?php

use Symfony\Component\HttpFoundation\Response;

/* ROTAS ESPECIAIS */

$app->get ('/teste/',             		function() 			use($app) { return Controller\Pessoa::teste($app); });
$app->get('/prontos/barra-da-tijuca/', function() use($app) { 
	return $app->redirect('/prontos/?finalidade=prontos&Tipos=5%3B2&bairro=%3B1%3B&filtroNome=Barra+da+Tijuca');
});

// TEASER
// $app->get  ('/',                         	function() 					use($app) { return Controller\Home::getTeaser($app); });
// $app->post ('/',                         	function() 					use($app) { return Controller\Home::postTeaser($app); });
// $app->get ('/_app/', 		                function() 					use($app) { return Controller\Home::redirectRoute($app, "_app"); });
// $app->get ('/land/', 		                function() 					use($app) { return Controller\Pagina::redirectRoute($app); });
 $app->get ('/land/{url}/', 	                function($url) 				use($app) { return Controller\Pagina::redirectRoute($app, $url); });

$app->get ('/corretor/{nome}/',             	function($nome) 			use($app) { return Controller\Pessoa::setCorretor($app, $nome); });

// PADRAO
$app->get ('/',		                       		function() 					use($app) { return Controller\Home::getHome($app); });
//$app->get ('/home/',                       		function() 					use($app) { return Controller\Home::getHome($app); });


$app->get('/home/', function () use ($app) {
	$body = Controller\Home::getHome($app);
 	return new Response($body, 200, array('Cache-Control' => 's-maxage=3600, public'));
});

$app->get('/home2/', function () use ($app) {
	$body = Controller\Home::getHome($app,'static');
 	return new Response($body, 200, array('Cache-Control' => 's-maxage=3600, public'));
});

$app->get('/prontos/rio-de-janeiro/', function () use ($app) {
 	return $app->redirect('http://novaepoca.temp.w3br.com/prontos/?finalidade=prontos&Tipos=&condominio_nome=&empreendimento_nome=&cidade=%3B1%3B&bairro=&filtroNome=Rio+de+Janeiro&tipos_prontos=&tipos_prontos=localizacao=Rio+de+Janeiro&Codigo=&QtdQuarto=&QtdSuite=&QtdWcTotal=&QtdVaga=');
});

$app->get('/prontos/zona-sul/', function () use ($app) {
 	return $app->redirect('http://novaepoca.temp.w3br.com/prontos/?finalidade=prontos&filtroNome=Zona+Sul&bairro=;2;4;6');
});


// ESTATICAS
$app->get ('/a-imobiliaria/',                 	function() 					use($app) { return Controller\Pagina::getQuemSomos($app); });
$app->get ('/servicos/',                 		function() 					use($app) { return Controller\Pagina::getServicos($app); });

// $app->get ('/extranet/',                    	function() 					use($app) { return Controller\Home::getExtranet($app); });
$app->get ('/admin/',                      		function() 					use($app) { return Controller\Home::getAdmin($app); });

$app->get ('/getAPI/',       	  				function() 					use($app) { return Controller\Imovel::getAPI($app); });
$app->get ('/prontos/mapa/',       	  			function() 					use($app) { return Controller\Imovel::getMapa($app,'prontos'); });

$app->get ('/prontos/',                	 		function() 					use($app) { return Controller\Imovel::getListImoveis($app); });

$app->get('/prontos/', function () use ($app) {
	$body = Controller\Imovel::getListImoveis($app);
 	return new Response($body, 200, array('Cache-Control' => 's-maxage=3600, public'));
});


$app->post('/prontos/',                	 		function() 					use($app) { return Controller\Imovel::getListImvBusca($app); });

$app->get ('/prontos/preview/{id}/',			function($id)	 		use($app) { return Controller\Imovel::getImovel($app, $id, "admin"); });

$app->get ('/prontos/{url}/{id}/',				function($id,$url)	 		use($app) { return Controller\Imovel::getImovel($app, $id); });


$app->get ('/locacao/mapa/',       	  			function() 					use($app) { return Controller\Imovel::getMapa($app,'locacao'); });
$app->get ('/locacao/',                	 		function() 					use($app) { return Controller\Imovel::getListImoveisLocacao($app); });
$app->post('/locacao/',                	 		function() 					use($app) { return Controller\Imovel::getListImvBusca($app); });
$app->get ('/locacao/{url}/{id}/',				function($id,$url)	 		use($app) { return Controller\Imovel::getImovel($app, $id); });

$app->get ('/imovel/{url}/{id}/',				function($id,$url)	 		use($app) { return Controller\Imovel::getImovel($app, $id); });

#$app->get ('/lancamentos/mapa/',       			function() 					use($app) { return Controller\Empreendimento::getMapa($app); });
$app->get ('/lancamentos/mapa/',       			function() 					use($app) { return $app->redirect('/'); });

//$app->get ('/lancamentos/',           	  		function() 					use($app) { return Controller\Empreendimento::getListEmpreendimentos($app); });

$app->get('/lancamentos/', function () use ($app) {
	$body = Controller\Empreendimento::getListEmpreendimentos($app);
 	return new Response($body, 200, array('Cache-Control' => 's-maxage=3600, public'));
});

$app->post('/lancamentos/',			   	  		function() 					use($app) { return Controller\Empreendimento::getListEmpBusca($app); });
$app->get ('/lancamentos/{url}/{id}/',			function($id,$url)	 		use($app) { return Controller\Empreendimento::getEmpreendimento($app, $id); });
$app->get ('/lancamentos/ficha/{url}/{id}/',	function($id,$url)	 		use($app) { return Controller\Empreendimento::getEmpreendimentoFicha($app, $id); });
$app->get ('/lancamentos-entregues/',  	  		function() 					use($app) { return Controller\Empreendimento::getListEmpreendimentosEntregues($app); });

$app->get ('/noticias/',           	  			function() 					use($app) { return Controller\Noticia::getListNoticias($app); });
$app->get ('/noticias/categorias/{url}/{id}/',	function($id,$url)			use($app) { return Controller\Noticia::getListNoticias($app, $id); });
$app->get ('/noticia/{url}/{id}/',				function($id,$url)	 		use($app) { return Controller\Noticia::getNoticia($app, $id); });

$app->get ('/andamento-de-obras/',           	function() 					use($app) { return Controller\Empreendimento::getListObras($app); });
$app->get ('/andamento-de-obras/{url}/{id}/',	function($id,$url)	 		use($app) { return Controller\Empreendimento::getObra($app, $id); });

$app->get ('/mapa/', 	          	  			function() 					use($app) { return Controller\Empreendimento::getMapa($app); });


// CONTATO 
$app->get ('/contact/',             	function() 					use($app) { return Controller\Pagina::getContatoEnglish($app); });
$app->get ('/contato/',             		function() 					use($app) { return Controller\Contato::getContatoPage($app, 'fale-conosco'); });
$app->get ('/fale-conosco/', 				function() 					use($app) { return Controller\Contato::getContatoPage($app, 'fale-conosco'); });
$app->get ('/trabalhe-conosco/', 			function() 					use($app) { return Controller\Contato::getContatoPage($app, 'trabalhe-conosco'); });
$app->get ('/contato/{url}/',             	function($url) 				use($app) { return Controller\Contato::getContatoPage($app, $url); });
$app->post('/contato/{url}/',          	  	function($url) 				use($app) { return Controller\Contato::postContatoPage($app, $url); });


$app->post('/enviaEmail/{url}/',          	  	function($url) 				use($app) { return Controller\Contato::postEnviaEmail($app, $url); });


// WS
$app->get ('/ws/getImgCapa/{tipo}/{id}',	function($tipo, $id)		use($app) { return Controller\Album::getImgCapa($app, $tipo, $id); });
$app->get ('/ws/trocaCidade/{id}',			function($id)				use($app) { return Lib\ImovelCidade::trocaCidade($app,$id); });

$app->get ('/ws/sitemap/',					function()					use($app) { return Lib\Util::geraXML($app); });
$app->get ('/sitemap.xml',					function()					use($app) { return Lib\Util::geraXML($app); });

$app->get ('/ws/chat/',						function()					use($app) { return Controller\Pagina::getPreChat($app); });
$app->post('/ws/chat/',						function()					use($app) { return Controller\Contato::postContatoPage($app, 'chat'); });

$app->get ('/ws/buscaImovel/{cod}',				function($cod)				use($app) { return Controller\Busca::getFirstImovel($app, $cod); }); //verificar se essa rota atende
$app->post('/ws/buscaImoveis/',					function()					use($app) { return Controller\Busca::getListImoveisBusca($app); });
$app->post('/ws/buscaImoveis/{format}',			function($format)			use($app) { return Controller\Busca::getListImoveisBusca($app, $format); });
$app->post('/ws/buscaEmpreendimentos/',			function()					use($app) { return Controller\Busca::getListEmpreendimentosBusca($app); });
$app->post('/ws/buscaEmpreendimentos/{format}', function($format)		use($app) { return Controller\Busca::getListEmpreendimentosBusca($app, $format); });

$app->get ('/ws/buscaIndicesFinanceiros/', 		function()					use($app) { return Controller\Busca::getIndicesFinanceiros($app); });


// BARRA DE BUSCA
$app->get ('/ws/buscaBairros/{fin}/{tipo}/{nome}',		function($fin,$tipo)			use($app) { return Controller\Busca::getBairros($app, $fin, $tipo); });
$app->post ('/ws/buscaBairros/{fin}/{tipo}/{cidadeid}',	function($fin,$tipo,$cidadeid)	use($app) { return Controller\Busca::getBairros($app, $fin, $tipo, $cidadeid); });

$app->get ('/ws/buscaCidades/{fin}/{tipo}/{nome}',		function($fin,$tipo)			use($app) { return Controller\Busca::getCidades($app, $fin, $tipo); });
$app->get ('/ws/buscaEmps/{fin}/{tipo}/{nome}',			function($fin,$tipo)			use($app) { return Controller\Busca::getEmps($app, $fin, $tipo); });
$app->get ('/ws/buscaConds/{fin}/{tipo}/{nome}',		function($fin,$tipo)			use($app) { return Controller\Busca::getConds($app, $fin, $tipo); });
$app->get ('/ws/buscaCodigos/',							function()						use($app) { return Controller\Busca::getCodigos($app); });

//FILTRO
$app->get ('/filtros/',						function()						use($app) { return Controller\Busca::filtrar($app); });
$app->get ('/filtros/{tipo}/',				function($tipo)					use($app) { return Controller\Busca::filtrar($app, $tipo); });	
$app->get ('/filtros/{tipo}/{fin}/',		function($tipo,$fin)			use($app) { return Controller\Busca::filtrar($app, $tipo, $fin); });
$app->get ('/filtros/{tipo}/{fin}/{page}',	function($tipo,$fin, $page)		use($app) { return Controller\Busca::filtrar($app, $tipo, $fin, $page); });

// CUSTOM
$app->get('/info/',							function()					use($app) { return Lib\Util::getInfo($app); });
$app->get ('/{url1}/',                     	function($url1)				use($app) { return Controller\Pagina::getPage($app,$url1); });
$app->get ('/{url1}/{url2}/',              	function($url1,$url2)		use($app) { return Controller\Pagina::getPage($app,$url1."/".$url2); });

/* DEBUG */
// $app->get ('/dbtest/',                  	function() 					use($app) { return Controller\Imovel::dbtest($app); });

//FAVORITOS
$app->get('/ws/listaFavoritos/',			function()					use($app) { return Lib\Util::getFavoritos($app); });
$app->post('/ws/adicionaFavoritos/',		function()					use($app) { return Lib\Util::handleFavoritos($app); }); //set or remove


#venda/rj/rio-de-janeiro/zona-norte/tijuca/apartamento_residencial/1/
#$app->get('/venda/{uf}/{cidade}/{regiao}/{bairro}/{tipo_finalidade}/{pagina}/')

#venda/rj/rio-de-janeiro/zona-norte/tijuca/1
#$app->get('/venda/{uf}/{cidade}/{regiao}/{bairro}/{pagina}/')

#venda/rj/rio-de-janeiro/apartamento_residencial/1/
#$app->get('/venda/{uf}/{cidade}/{tipo_finalidade}/{pagina}/')

#venda/rj/rio-bonito/1/
#$app->get('/venda/{uf}/{cidade}/{pagina}/')