<?php

    namespace Controller;

    use Model;
    use Lib\Util;

	class Imovel {


        // metodo padrao da arquitetura
        public static function getListImoveis($app){     

            
            // define o titulo da pagina
            $title = 'Imóveis';

            // define as classes css da pagina
            $cssClass = 'ecommerce imovel imovel-venda produto-lista';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            //extensao para imagens a ser mostragem na listagem
            $extensao_img = "_dt";

            $produto = 'imovel';
            $finalidade = 'prontos';

            $params = (!empty($_GET) ? $_GET : null);

            $imoveis = Busca::filtro($app, $produto, $finalidade, $params, "1");

            //Util::dbg($imoveis); 

            $imoveis->produto = (!empty($produto) ? ($produto == 'lancamento' ? 'empreendimento' : $produto) : "imovel"); 
            $imoveis->produtotag = (!empty($finalidade) ? $finalidade : "prontos");

            $imoveis->finalidadelabel = "Prontos"; 

            //itens por pagina //
            $itensPorPag = (!empty($params['take']) ? $params['take'] : 12);
            //itens por pagina //

            Util::paginationParams($imoveis, $itensPorPag);            
                        
            // define os filtros carregados na lateral da pagina
            #//$filtros = Busca::buildFiltroLateral($EntidadeID);

            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            //$breadcrumb = Util::buildBreadcrumb();

            // define o template que carregara
            $page = array(
                'template' => 'tpl/page-interna-lista.twig.php',
                'content' => $imoveis
            );


            // define os blocos que carregarao
            $blocks = NULL;

            // define o side
            $side = array();            
            $side['filtro-lateral'] = array(
                'template' => 'helpers/filtro-lateral.twig.php',
                'content' => $params
            );

            $scripts = array(
                'assets/jvs/jquery.bootpag.min.js',
                'assets/jvs/hogan.js',
                'assets/jvs/typeahead.min.js',
                'theme/js/jquery.flexslider-min.js',
                'assets/jvs/imoveis-init.js', 
                'assets/jvs/typeahead.inforce.js',
                'assets/global/plugins/noUiSlider.8.2.1/nouislider.min.js',
                'assets/global/plugins/wNumb.js',
            ); 


            // monta os dados aque serao enviados ao template
            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,
                'assets'        => $assets,
                //'breadcrumb'    => $breadcrumb,
                'page'          => $page,
                'side'          => $side,
                'scripts'       => $scripts,
                'blocks'        => $blocks,
            );

            #Util::dbg($imoveis);
            // retorna o render do template
            return $app['twig']->render('base.twig.php', $data);
        }

        public static function getImovel($app, $id, $admin = false){            
           
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }           

            $route = ($app['request']->attributes->get('_route'));

            $imvFinalidade = (strpos($route, "locacao") > 0 ? "locacao" : "prontos"); 

            // cria a session com o token para a validacao
            $_SESSION['token'] = $app['TOKEN'];            
            // define a array de objetos da lista


            
            if ($id) {
                $url = $app['API']['paths']['imovel']['detail'].$id;
                
                $imovel = $admin ? json_decode(file_get_contents($url."/?admin=true")) : json_decode(file_get_contents($url));  

           
                if (!$imovel)
                    return Pagina::getPage404($app); 

                $imovel->produto = "imovel"; 
                $imovel->produtotag = $imvFinalidade; 
            } else {
                return Pagina::getPage404($app);
            }

            
            $imovel->Premium = false;

            //IMOVEL PREMIUM 
            if (!empty($imovel->Anuncios)){
                foreach ($imovel->Anuncios as $key => $item) {
                    
                    if ($item->DestaqueID == 7) {
                        $imovel->Premium = true; 
                    }
                }
            }

            //Util::dbg($imovel); 


            $relacionados = array();
            $relacionados = Model\Imovel::findRelacionados($app, $imovel, $imvFinalidade);
            $relacionados->produto = "imovel";             
            // define o token para validacao de forms
            $token = $app['TOKEN'];

            // define o titulo da pagina
            $title = $imovel->TipoNome." | ".$imovel->BairroNome." ";
            $title .= ($imovel->QtdQuarto > 0) ? ($imovel->QtdQuarto > 1 ? "| ".$imovel->QtdQuarto." Quartos": "| ".$imovel->QtdQuarto." Quarto") : "";
            
            //Util::dbg($imovel); 

            // define as classes css da pagina
            $cssClass = 'ecommerce imovel produto-interna';

            // define os assets que carregarao
            $assets = array();

            //Util::dbg($imovel); 

            $assets['facebook'] = array(
                'template' => 'inc/facebook.twig.php',
                'content' => $imovel
            );

            // define o breadcrumb
           // $breadcrumb = Util::buildBreadcrumb($imovel);

            

            // define os templates que carregarao
            $page = array(
                'template' => $imovel->Premium ? 'tpl/page-detalhe-imovel-premium.twig.php' : 'tpl/page-detalhe-imovel.twig.php',
                'content' => $imovel
            );

            // define os helpers que carregarao
            $blocks = array();
 
            // mostra o gmaps
            $blocks['localizacao'] = array( 
                'template' => 'helpers/bloco-localizacao.twig.php', 
                'content' => $imovel
            );
        
            $blocks['relacionados'] = array(
                'template' => 'helpers/bloco-relacionados.twig.php',
                'content' => $relacionados
            );

            $scripts = array(
                'theme/js/nivo-lightbox.js'
            );

            //Util::dbg($relacionados); 


            $data = array(
                'page_title' => $title,
                'page_class' => $cssClass,
                'token'      => $token,
                'assets'     => $assets,
                'page'       => $page,
                'blocks'     => $blocks,
                'scripts'    => $scripts,
                'id'         => $imovel->ID,
                'tag'        => 'pronto'
            );

            return $app['twig']->render('base.twig.php', $data);
        }


        // metodo padrao da arquitetura
        public static function getListImoveisLocacao($app){

            // define o titulo da pagina
            $title = 'Imóveis';

            // define as classes css da pagina
            $cssClass = 'ecommerce imovel imovel-venda produto-lista';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            //extensao para imagens a ser mostragem na listagem
            $extensao_img = "_dt";

            $produto = 'imovel';
            $finalidade = 'locacao';

            $params = (!empty($_GET) ? $_GET : null);

            $imoveis = Busca::filtro($app, $produto, $finalidade, $params, "1");

            //Util::dbg($params); 

            $imoveis->produto = (!empty($produto) ? ($produto == 'lancamento' ? 'empreendimento' : $produto) : "imovel"); 
            $imoveis->produtotag = (!empty($finalidade) ? $finalidade : "prontos");

            $imoveis->finalidadelabel = "Locação"; 

            if ($_SERVER['REMOTE_ADDR'] == '177.129.9.98') {
                //Util::dbg($imoveis); 
            }
            
            //itens por pagina //
            $itensPorPag = (!empty($params['take']) ? $params['take'] : 12);
            //itens por pagina //

            Util::paginationParams($imoveis, $itensPorPag);            
                        
            // define os filtros carregados na lateral da pagina
            #//$filtros = Busca::buildFiltroLateral($EntidadeID);

            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            //$breadcrumb = Util::buildBreadcrumb();

            // define o template que carregara
            $page = array(
                'template' => 'tpl/page-interna-lista.twig.php',
                'content' => $imoveis
            );


            // define os blocos que carregarao
            $blocks = NULL;

            //Util::dbg($imove); 


            // define o side
            $side = array();            
            $side['filtro-lateral'] = array(
                'template' => 'helpers/filtro-lateral.twig.php',
                'content' => $params
            );

            $scripts = array(
                'assets/jvs/jquery.bootpag.min.js',
                'assets/jvs/hogan.js',
                'assets/jvs/typeahead.min.js',
                'theme/js/jquery.flexslider-min.js',
                'assets/jvs/jquery.number.min.js',
                'assets/jvs/imoveis-init.js', 
                'assets/jvs/typeahead.inforce.js'
            ); 


            // monta os dados aque serao enviados ao template
            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,
                'assets'        => $assets,
                //'breadcrumb'    => $breadcrumb,
                'page'          => $page,
                'side'          => $side,
                'scripts'       => $scripts,
                'blocks'        => $blocks,
            );

            #Util::dbg($imoveis);
            // retorna o render do template
            return $app['twig']->render('base.twig.php', $data);
        }        


        public static function getListImvBusca($app){
            //Util::dbg($_POST);
            // define o id da entidade gapo // tabela  gapo_entidade
            $EntidadeID = 1;

            // define o titulo da pagina
            $title = 'Locação de Imóveis';

            // define as classes css da pagina
            $cssClass = 'ecommerce imovel produto-lista retorno-busca';

            //extensao para imagens a ser mostragem na listagem
            $extensao_img = "_tb";

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            // define a array de objetos da lista

            $param = array_filter($_POST);
            $param["extensao_img"] = $extensao_img; 
            $imoveis = Model\Imovel::searchImoveis($app,$param);
            //Util::dbg($imoveis);
            // Util::dbg($param);

            if(empty($imoveis)){
                //return Pagina::getPage404($app);
                //$imoveis = array(0=>array('produto'=>'imovel', 'dummy'=>true));
            }

            // define os filtros carregados na lateral da pagina
            #$filtros = Busca::buildFiltroLateral($EntidadeID);
            // define os assets que carregarao
            $assets = array();
              
            // asset que manipula o filtro lateral
            $assets['set-filter'] = array(
                'template' => 'inc/set-filtros.twig.php',
                'content' => $param
            );
            //Util::dbg($param);

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-interna-lista.twig.php',
                'content' => $imoveis
            );
            
            // define o side
            $side = array();
            $side['filtro-lateral'] = array(
                'template' => 'helpers/filtro-lateral-2.twig.php',
                'content' => $filtros
            );

            // define os templates que carregarao
            $helpers = null;

            // define o conteudo do prerodape
            //$steps = Pagina::getBlocks('pre-rodape');
            $steps = null;

            // define o conteudo do rodape
            //$footer = Pagina::getBlocks('rodape');
            $footer = null;

            // monta os dados aque serao enviados ao template
            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,

                'assets'        => $assets,

                'breadcrumb'    => $breadcrumb,
                'page'          => $page,
                'side'           => $side,
                'helpers'       => $helpers,

                'steps'         => $steps,
                'footer'        => $footer,
            );

            // retorna o render do template
            return $app['twig']->render('base.twig.php', $data);
        }        


        // metodo que retorna a pagina de mapa de imoveis
        public static function getMapa($app, $finalidade){
            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define o titulo da pagina
            $title = 'Busca no Mapa';

            // define as classes css da pagina
            $cssClass = 'ecommerce mapa-geral '.$finalidade;

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            //extensao para imagens a ser mostragem na listagem
            $extensao_img = "_tb";

            // define a array de objetos da lista
            if($finalidade=='prontos'){
                $options['finalidade'] = "prontos"; 
                $options['limit'] = 150;
                $imoveis = Model\Imovel::searchImoveis($app, $options);
                //$imoveis = Model\Imovel::findImoveis($extensao_img, 150);
            }elseif($finalidade=='locacao'){
                $options['finalidade'] = "locacao"; 
                $options['limit'] = 150;
                $imoveis = Model\Imovel::searchImoveis($app, $options);
                //$imoveis = Model\Imovel::findImoveisLocacao($extensao_img, 150);                
            }
            
            //Util::dbg($imoveis);

            // define os assets que carregarao
            $assets = array();
                $assets['mapa-js'] = array(
                    'template' => 'inc/mapa-js.twig.php',
                    'content' => $imoveis
                );

            // define os templates que carregarao
            $page = array();
                $page = array(
                    'template' => 'tpl/interna-mapa-geral.twig.php',
                    'content' => $imoveis
                );
            
            // define os helpers que carregarao
            $helpers = array();

            // define o conteudo de uma barra lateral
            $side = array();
                // $side['lista-imv'] = array(
                //     'template' => 'helpers/bloco-lista-imoveis.twig.php',
                //     'content' => $imoveis
                // );


            // define o conteudo do prerodape
            $steps = array();

            // define o conteudo do rodape
            $footer = array();


            // cria a variavel com todos os elementos dinamicos da pagina
            $data = array(
                'page_title' => $title,
                'page_class' => $cssClass,
                'token'      => $app['TOKEN'],

                'assets' => $assets,

                'breadcrumb' => $breadcrumb,

                'page' => $page,

                'helpers' => $helpers,

                'steps' => $steps,
                'footer' => $footer,
                
            );

            // retorna o render do template para visualizacao
            return $app['twig']->render('base.twig.php', $data);
        }        

	}
