<?php

    namespace Controller;

    use Model;
    Use Lib\Util;

    class Empreendimento {


        // gera lista basica de empreendimentos
        public static function getListEmpreendimentos($app){

            // define o id da entidade gapo // tabela  gapo_entidade
            $EntidadeID = 2;

            // define o titulo da pagina
            $title = 'Empreendimentos';

            // define as classes css da pagina
            $cssClass = 'ecommerce empreendimento produto-lista';

            // define o token para validacao de forms
            $token = $app['TOKEN'];
            
            // define a array de objetos da lista
            
            //Model\Empreendimento::findEmpreendimentos();

            //$url = "http://webapi.inforcedata.com.br/Empreendimento/Search?page=1&pagesize=10"; 
            //$empreendimentos = json_decode(file_get_contents($url));

            

            $produto = "empreendimento"; 
            $finalidade = "lancamentos";            
            
            $params = (!empty($_GET) ? $_GET : null);
            #Util::dbg($params);

            $empreendimentos = Busca::filtro($app, $produto, $finalidade, $params, "1");

            $empreendimentos->produto = $produto; 
            $empreendimentos->produtotag = $finalidade;

            //itens por pagina //
            $itensPorPag = (!empty($params['take']) ? $params['take'] : 12);
            //itens por pagina //

            Util::paginationParams($empreendimentos, $itensPorPag);
            
            //Util::dbg($empreendimentos);

            // define os filtros carregados na lateral da pagina
            #//$filtros = Busca::buildFiltroLateral($EntidadeID);
            
            // define os assets que carregarao
            $assets = array(); 

            // define o breadcrumb
            //$breadcrumb = Util::buildBreadcrumb();            

            // define o template que carregara
            $page = array(
                'template' => 'tpl/page-interna-lista.twig.php',
                'content' => $empreendimentos
            );

            //Util::dbg($empreendimentos); 

            // define os blocos que carregarao
            $blocks = array();

            // define o side
            $side = array();
                $side['filtro-lateral'] = array(
                    'template' => 'helpers/filtro-lateral.twig.php',
                    'content' => $params
                );

            $scripts = array('assets/jvs/imoveis-init.js', 'assets/jvs/jquery.bootpag.min.js'); 


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

            //Util::dbg($empreendimentos); 
            return $app['twig']->render('base.twig.php', $data);
        }


        // gera interna basica de empreendimentos
        public static function getEmpreendimento($app, $id){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
            
            // cria a session com o token para a validacao
            $_SESSION['token'] = $app['TOKEN'];

            // define o token para validacao de forms
            $token = $app['TOKEN'];
            if ($id){
                $url = $app['API']['paths']['empreendimento']['detail'].$id;
                $empreendimento = json_decode(file_get_contents($url)); 
                
                if (!$empreendimento)
                    return Pagina::getPage404($app); 

                $empreendimento->produtotag = "lancamentos";
                $empreendimento->galleryid = -1;
            } else {
                return Pagina::getPage404($app);
            }

            //Util::dbg($empreendimento); 

            if (!$empreendimento)
                return Pagina::getPage404($app);   
            

            // define a array de objetos relacionados
            $relacionados = array(); 
            $relacionados = Model\Empreendimento::findRelacionados($app, $empreendimento);
            $relacionados->produto = "empreendimento"; 

            // define o titulo da pagina
            $title = $empreendimento->Nome." | ".$empreendimento->BairroNome;

            // define as classes css da pagina
            $cssClass = 'ecommerce empreendimento produto-interna';

            // gera as galerias do produto
            //$galerias = Model\Album::findGalerias($id, 150);
            
            // define os assets que carregarao
            $assets = array();            
             $assets['facebook'] = array(
                'template' => 'inc/facebook.twig.php',
                'content' => $empreendimento
             );

            //Util::dbg($empreendimento); 

            $page = array(
                'template' => 'tpl/page-interna-empreendimento.twig.php',
                'content' =>   $empreendimento
            );
           
            // define o breadcrumb
            //$breadcrumb = Util::buildBreadcrumb($empreendimento);

            // define os helpers que carregarao
            $blocks = array();
            
         
            $blocks['bloco-cinza'] = array(
                'template' => 'helpers/bloco-empreendimento-top.twig.php', 
                'content' => $empreendimento,                    
            );

            $blocks['topicos-lancamento'] = array(
                'template' => 'helpers/bloco-topicos-empreendimento.twig.php', 
                'content' => $empreendimento,
            );
            
            // mostra o gmaps
            $blocks['localizacao'] = array(
                'template' => 'helpers/bloco-localizacao.twig.php', 
                'content' => $empreendimento,                    
            );

            $blocks['relacionados'] = array(
                'template' => 'helpers/bloco-relacionados.twig.php',
                'content' => $relacionados
            );

            //Util::dbg($empreendimento); 
     
            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,
                'assets'        => $assets,
                //'breadcrumb'    => $breadcrumb,
                'page'          => $page,
                'blocks'        => $blocks,
                'id'            => $empreendimento->ID, 
                'tag'           => 'empreendimento'
            );
          
            return $app['twig']->render('base.twig.php', $data);
        }



        public static function getListEmpreendimentosEntregues($app){

            // define o id da entidade gapo // tabela  gapo_entidade
            $EntidadeID = 2;

            // define o titulo da pagina
            $title = 'Empreendimentos Entregues';

            // define as classes css da pagina
            $cssClass = 'ecommerce empreendimento produto-lista';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            // define a array de objetos da lista
            $empreendimentos = Model\Empreendimento::findEmpreendimentosEntregues();

            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();            

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-interna-lista.twig.php',
                'content' => $empreendimentos
            );

            $blocks = array();
                // $blocks['side'] = array(
                //     'template' => 'helpers/interna-filtro.twig.php',
                //     'content' => $filtros
                // );


            // monta os dados aque serao enviados ao template
            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,

                'assets'        => $assets,

                'breadcrumb'    => $breadcrumb,

                'page'          => $page,

                'blocks'        => $blocks,
            );

            // Util::dbg($empreendimentos); 
            return $app['twig']->render('base.twig.php', $data);
        }




        // 
        public static function getEmpreendimentoFicha($app, $id){

            // cria a session com o token para a validacao
            $_SESSION['token'] = $app['TOKEN'];

            // define a array de objetos da lista
            $empreendimento = Model\Empreendimento::findEmpreendimento($app, $id);

            // define o token para validacao de forms
            $token = $app['TOKEN'];            

            // define o id da entidade gapo // tabela  gapo_entidade
            $EntidadeID = 2;

            // caso o model nao retorne imovel algum, dispara erro de produto nao encontrado
            if($empreendimento->id){
                // define o titulo da pagina
                $title = utf8_encode($empreendimento->prodtitle);

                // define as classes css da pagina
                $cssClass = 'ecommerce empreendimento produto-interna';

                // gera as galerias do produto
                $galerias = Model\Album::findGalerias($id, 150);
            }


            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            $breadcrumb = null;

            // define os templates que carregarao
            $tpl = array();
                $tpl['main'] = array(
                    'template' => 'helpers/interna-detalhe-empreendimento.twig.php',
                    'content' => $empreendimento
                );

            // define os helpers que carregarao
            $helpers = array();
            if($galerias){
                foreach ($galerias as $key => $galeria) { 
                    $helpers['galeria-'.$key] = $galeria;
                }
            }
                // mostra o gmaps
                $helpers['localização'] = array( 
                    'template' => 'helpers/interna-localizacao.twig.php', 
                    'content' => $empreendimento
                );

            // define o conteudo do prerodape
            $steps = null;

            // define o conteudo do rodape
            $footer = null;

            // Util::dbg($helpers);
            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,

                'assets'        => $assets,

                'breadcrumb'    => $breadcrumb,

                'tpl'           => $tpl,

                'helpers'       => $helpers,

                'steps'         => $steps,
                'footer'        => $footer,
            );

            // Util::dbg($data);
            return $app['twig']->render('base-ficha.twig.php', $data);
        }




        public static function getListObras($app){

            $obras = Model\Empreendimento::findObras();

            $title = "Andamento de Obras";

            $cssClass = 'ecommerce emprendimento obras';

            // cria a session com o token para a validacao
            $_SESSION['token'] = $app['TOKEN'];

            // define o token para validacao de forms
            $token = $app['TOKEN'];     

            // define os assets que carregarao
            $assets = array();


            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();            


            $page = array(                
                'template' => 'tpl/page-lista-empreendimento-obras.twig.php',
                'content' => $obras
            );
            // Util::dbg($page);

            // define os blocos  que carregarao
            $blocks = array();


            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,

                'assets'        => $assets,

                'breadcrumb'    => $breadcrumb,

                'page'           => $page,

                'blocks'       => $blocks,
            );

            // Util::dbg($data);

            return $app['twig']->render('base.twig.php', $data);
        }

        public static function getObra($app, $id){
            $title = "Andamento de Obras";

            $cssClass = 'ecommerce emprendimento obras detalhe-obra';

            // cria a session com o token para a validacao
            $_SESSION['token'] = $app['TOKEN'];

            // define o token para validacao de forms
            $token = $app['TOKEN'];     

            // define os assets que carregarao
            $assets = array();


            $obra = Model\Empreendimento::findObra($id);

            // para popular o select
            $obras = Model\Empreendimento::findObras();

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();            


            $blocks = null;

            $galerias = Model\Album::findGaleria($obra->img_conta_id, 50, "helpers/bloco-galeria-grade-obra.twig.php");
            // Util::dbg($galerias);

            if($galerias){
                foreach ($galerias as $key => $galeria) {
                    $blocks['galeria-'.$key] = $galeria;
                }
            }


            
            $page = array(                
                'template' => 'tpl/page-interna-empreendimento-obra.twig.php',
                'content' => $obra,
                'select' => $obras
            );

            $data = array(
                'page_title' => $title,
                'page_class' => $cssClass,
                'item'   => $obra,

                'assets' => null,                

                'page' => $page,
                
                'blocks' => $blocks,

                'token'      => $app['TOKEN'],
                
            );

            return $app['twig']->render('base.twig.php', $data);
        }




        public static function getListEmpBusca($app){
            // Util::dbg($_POST);

            // define o id da entidade gapo // tabela  gapo_entidade
            $EntidadeID = 2;

            // define o titulo da pagina
            $title = 'Empreendimentos';

            // define as classes css da pagina
            $cssClass = 'ecommerce empreendimento produto-lista retorno-busca';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            $param = array_filter($_POST);

            // define a array de objetos da lista
            $empreendimentos = Model\Empreendimento::searchEmpreendimentos($app, $param);
            // Util::dbg($empreendimentos);

            // define os filtros carregados na lateral da pagina
#            $filtros = Busca::buildFiltroLateral($EntidadeID);
            //Util::dbg($filtros);

            
            
            if(empty($empreendimentos)){
                //return Pagina::getPage404($app);
                $empreendimentos = array(0=>array('produto'=>'empreendimento', 'dummy'=>true));
            }


            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define o template que carregara
            $page = array(
                'template' => 'tpl/page-interna-lista.twig.php',
                'content' => $empreendimentos
            );
            // asset que manipula o filtro lateral
            $assets['set-filter'] = array(
                'template' => 'inc/set-filtros.twig.php',
                'content' => $param
            );
            
            // define o side
            $side = array();
            $side['filtro-lateral'] = array(
                'template' => 'helpers/filtro-lateral-2.twig.php',
                'content' => $filtros
            );
            
            // define os blocos que carregarao
            $blocks = null;

            // monta os dados que serao enviados ao template
            $data = array(
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,

                'assets'        => $assets,

                'breadcrumb'    => $breadcrumb,
                'side'          => $side,
                'page'          => $page,

                'blocks'        => $blocks,

            );

            // retorna o render do template
            return $app['twig']->render('base.twig.php', $data);
        }        



        // metodo que retorna a pagina de mapa de imoveis
        public static function getMapa($app){
            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define o titulo da pagina
            $title = 'Busca no Mapa';

            // define as classes css da pagina
            $cssClass = 'ecommerce mapa-geral empreendimentos';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            //extensao para imagens a ser mostragem na listagem
            $extensao_img = "_tb";

            // define a array de objetos da lista
            $emps = Model\Empreendimento::findEmpreendimentos();
            // Util::dbg($emps);

            // define os assets que carregarao
            $assets = array();
                $assets['mapa-js'] = array(
                    'template' => 'inc/mapa-js.twig.php',
                    'content' => $emps
                );

            // define os templates que carregarao
            $page = array();
                $page = array(
                    'template' => 'tpl/interna-mapa-geral.twig.php',
                    'content' => $emps
                );

            // define os helpers que carregarao
            $helpers = array();

            // define o conteudo de uma barra lateral
            $side = array();
                // $side['lista-imv'] = array(
                //     'template' => 'helpers/bloco-lista-imoveis.twig.php',
                //     'content' => $emps
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

