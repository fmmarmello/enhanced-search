<?php
   
    namespace Controller;

    use Model;
    Use Lib\Util;
    class Pagina {

        //
        public static function redirectRoute($app, $url=null){
            if(empty($url)){
                return self::getPage404($app);

            }else{
                $data = array(
                    'url' => $url
                );
                return $app->redirect($app['CONFIG']['base']."land/".$url."/index.php");
            }
        }



        public static function buildMenu($idMenu){
            $menu = Model\Menu::findMenu($idMenu);
            return $menu;
        }

        public static function buildMenuPrincipal(){
            // sem config, passe ID manualmente
            $idMenuPrincipal = 1;
            $menuPrincipal = Model\Menu::findMenu($idMenuPrincipal);
            return $menuPrincipal;
        }

        public static function buildMenuRodape(){
            // sem config, passe ID manualmente
            $idMenuRodape = 2;
            $menuRodape = Model\Menu::findMenu($idMenuRodape);
            return $menuRodape;
        }

        // metodo que retorna os blocos de conteudo do rodape
        public static function buildRodapeAux(){

            $blocks = array();
            $blocks['pre-rodape'] = array(
                'template'  => 'helpers/bloco-pre-rodape.twig.php',
                'content'   => null
            );
            return $blocks;
        }

        // metodo que retorna os blocos de conteudo do rodape
        public static function buildRodapePri(){
            $menuRodapePri = self::buildMenu(1);
            $menuRodapeAux = self::buildMenu(2);

            $blocks = array(
                // primeira linha
                'rodape-bloco-a-1' => array(
                    'template' => 'helpers/bloco-menu-rodape.twig.php',
                    'content' => $menuRodapePri,
                    'title' => ""
                ),
                'rodape-bloco-a-2' => array(
                    'template' => 'helpers/bloco-menu-rodape.twig.php',
                    'content' => $menuRodapePri,
                    'title' => ""
                ),
                'rodape-bloco-a-3' => array(
                    'template' => 'helpers/bloco-menu-rodape.twig.php',
                    'content' => $menuRodapeAux,
                    'title' => ""
                ),
                'rodape-bloco-b-2' => array(
                    'template' => 'helpers/bloco-contato-meios.twig.php',
                    'content' => null
                ),
                'rodape-bloco-b-1' => array(
                    'template' => 'helpers/bloco-endereco.twig.php',
                    'content' => null
                ),
                'rodape-bloco-c-1' => array(
                    'template' => 'helpers/bloco-parceiros.twig.php',
                    'content' => null
                ),

            );

            return $blocks;

        }


        public static function getListPage($app, $category){
            // return $app['twig']->render('base.twig.php', $data);
        }


        public static function getPage($app, $url){

            // carrega o conteudo da pagina cadastrada
            $pagina = Model\Pagina::findPagina($url);

                // retorna erro 404 caso nao exista pagina cadastrada
                if(empty($pagina['content'])) return self::getPage404($app);

                // busca e carrega o conteudo da pagina traves de um metodo com registrado como tipo+nome, ex: Nome>>'Noticia', Tipo>>'Lista', Metodo::'ListaNoticia'
                // $methodName = $pagina->nometipo . $pagina->nome;
                // $templateContent = Pagina::$methodName($app);
                // Util::dbg($templateContent);

            // seta classe de css de acordo com a url da pagina
            $pagina_class = trim(str_replace("/", "-", $url));


            // define os assets que carregarao
            $assets = array();
                // $assets['facebook'] = 'inc/facebook.twig.php',                

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-detalhe-pagina.twig.php',
                'content' => $pagina
            );

            // define os helpers que carregarao
            $blocks = array();
                $galerias = Model\Album::findGaleria($pagina['content']->conta_id, 50, 'helpers/bloco-galeria-carrossel.twig.php');
                // $arquivos = Model\Arquivos::findArquivosPagina($pagina->id, 50, 'helpers/interna-arquivos.twig.php');

                $blocks['galerias'] = empty($galerias) ? null : $galerias;
                $blocks['arquivos'] = empty($arquivos) ? null : $arquivos;


            $data = array(
                'page_title' => utf8_encode($pagina['content']->titulo),
                'page_class' => 'ecommerce pagina produto-interna '.$pagina_class,
                'token'      => $app['TOKEN'],

                'assets' => $assets,

                'breadcrumb' => $breadcrumb,

                'page' => $page,

                'blocks' => $blocks,

               
            );

            // Util::dbg($data);

            return $app['twig']->render('base.twig.php', $data);
        }



        public static function getCustomPage($app, $url){

            // carrega o conteudo da pagina cadastrada
            $pagina = Model\Pagina::findPagina($url);

                // retorna erro 404 caso nao exista pagina cadastrada
                if(empty($pagina['content'])) return self::getPage404($app);

                // busca e carrega o conteudo da pagina traves de um metodo com registrado como tipo+nome, ex: Nome>>'Noticia', Tipo>>'Lista', Metodo::'ListaNoticia'
                // $methodName = $pagina->nometipo . $pagina->nome;
                // $templateContent = Pagina::$methodName($app);
                // Util::dbg($templateContent);

            // seta classe de css de acordo com a url da pagina
            $pagina_class = trim(str_replace("/", "-", $url));

            // define os assets que carregarao
            $assets = array();
                // $assets['facebook'] = 'inc/facebook.twig.php',

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-detalhe-pagina.twig.php',
                'content' => $pagina
            );

            // define os helpers que carregarao
            $blocks = array();
                $galerias = Model\Album::findGaleria($pagina['content']->conta_id, 50, 'helpers/bloco-galeria-carrossel.twig.php');
                // $arquivos = Model\Arquivos::findArquivosPagina($pagina->id, 50, 'helpers/interna-arquivos.twig.php');

                $blocks['galerias'] = empty($galerias) ? null : $galerias;
                $blocks['arquivos'] = empty($arquivos) ? null : $arquivos;




            $data = array(
                'page_title' => utf8_encode($pagina['content']->titulo),
                'page_class' => 'ecommerce pagina produto-interna '.$pagina_class,
                'token'      => $app['TOKEN'],

                'assets' => $assets,

                'breadcrumb' => $breadcrumb,

                'page' => $page,

                'blocks' => $blocks,

            );


            return $app['twig']->render('custom/'.$url.'.twig.php', $data);
        }




        public static function ListaNoticia($app){

            $listaNoticia = Noticia::getListNoticia($app);

            return $listaNoticia;

        }


        public static function getPage404($app){

            // define o titulo da pagina
            $title = 'Erro 404';

            // define as classes css da pagina
            $cssClass = 'ecommerce pagina produto-interna';

            // define os assets que carregarao
            $assets = null;

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao
            $page = array(
                'template' => 'error/404.twig.php',
                'content' => NULL
            );

            // define os blocos que carregarao
            $blocks = NULL;


            $data = array(
                    'page_title' => $title,
                    'page_class' => $cssClass,
                    'token' => $app['TOKEN'],

                    'assets' => $assets,

                    'breadcrumb' => $breadcrumb,

                    'page' => $page,

                    'blocks' => $blocks,
                                        
                );
            
            // Util::dbg($data);

            return $app['twig']->render('base.twig.php', $data);

        }

        // metodo que retorna a pagina de mapa de imoveis ///deprecated
        public static function getMapa($app){
            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define o titulo da pagina
            $title = 'Busca no Mapa';

            // define as classes css da pagina
            $cssClass = 'ecommerce mapa-geral';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            //extensao para imagens a ser mostragem na listagem
            $extensao_img = "_tb";

            // define a array de objetos da lista
            $imoveis = Model\Imovel::findImoveis($extensao_img);
            
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
            $blocks = array();
                $blocks['lista-imv'] = array(
                    'template' => 'tpl/bloco-lista-imoveis.twig.php',
                    'content' => $imoveis
                );


            // define o conteudo do prerodape
            //$steps = Pagina::getBlocks('pre-rodape');

            // define o conteudo do rodape
            //$footer = Pagina::getBlocks('rodape');


            // cria a variavel com todos os elementos dinamicos da pagina
            $data = array(
                'page_title' => $title,
                'page_class' => $cssClass,
                'token'      => $app['TOKEN'],

                'assets' => $assets,

                'breadcrumb' => $breadcrumb,

                'page' => $page,
                'blocks' => $blocks,

                'helpers' => $helpers,
                'tag'      => 'mapa'

                /*'steps' => $steps,*/
                /*'footer' => $footer,*/
                
            );

            // retorna o render do template para visualizacao
            return $app['twig']->render('base.twig.php', $data);
        }


        // metodo que retorna o conteudo da janela do prechat
        public static function getPreChat($app){
            // seta os parametros vindo da url
            $param = $_GET;
            // verficando se todos os parametros necessarios existem
            $paramArray = array(
                'produto'           => (isset($param['produto']) ? $param['produto'] : ''),
                'id'                => (isset($param['id']) ? $param['id'] : ''),
                'url'               => (isset($param['url']) ? $param['url'] : ''),
                'empreendimento'    => (isset($param['empreendimento']) ? $param['empreendimento'] : ''),
                'nome'              => (isset($param['nome']) ? $param['nome'] : ''),
                'email'             => (isset($param['email']) ? $param['email'] : ''),
                'ddd'               => (isset($param['ddd']) ? $param['ddd'] : ''),
                'telefone'          => (isset($param['telefone']) ? $param['telefone'] : ''),
                'pro'               => (isset($param['pro']) ? $param['pro'] : ''),
                'filial'            => (isset($param['filial']) ? $param['filial'] : ''),
                'source'            => (isset($param['source']) ? $param['source'] : ''),
                'media'             => (isset($param['media']) ? $param['media'] : ''),
                'campaign'          => (isset($param['campaign']) ? $param['campaign'] : ''),
                'referrer'          => (isset($param['referrer']) ? $param['referrer'] : ''),
                'keyword'           => (isset($param['keyword']) ? $param['keyword'] : ''),
                'host'              => (isset($param['host']) ? $param['host'] : ''),
                'enterlink'         => (isset($param['enterlink']) ? $param['enterlink'] : ''),
                'hotsite'           => (isset($param['hotsite']) ? $param['hotsite'] : ''),
            );

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define o titulo da pagina
            $title = 'Chat';

            // define as classes css da pagina
            $cssClass = 'ecommerce chat';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            // define os assets que carregarao
            $assets = array();

            // define os templates que carregarao
            $tpl = array();

            // define os helpers que carregarao
            $helpers = array();

            // define o conteudo de uma barra lateral
            $side = array();

            // define o conteudo do prerodape
            $steps = null;

            // define o conteudo do rodape
            $footer = null;

            // echo "<pre>dump:";
            // print_r($paramArray);
            // echo "</pre>";

            // cria a variavel com todos os elementos dinamicos da pagina
            $data = array(
                'page_title' => $title,
                'page_class' => $cssClass,
                'token'      => $token,
                'params'      => $paramArray,

                'assets' => $assets,

                'breadcrumb' => $breadcrumb,

                'tpl' => $tpl,

                'helpers' => $helpers,

                'steps' => $steps,
                'footer' => $footer,
                
            );

            // retorna o render do template para visualizacao
            return $app['twig']->render('inc/prechat.twig.php', $data);
        }


        public static function postPreChat($app){
            Util::dbg($_POST);
        }

        public static function getQuemSomos($app){

            // seta classe de css de acordo com a url da pagina
            $pagina_class = "quem-somos";


            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao

            $conteudo = Model\Pagina::findPagina('a-imobiliaria'); 
            
            //Util::dbg($conteudo['content']); 
            $page = array(
                'template' => 'tpl/page-quem-somos.twig.php',
                'content' => $conteudo['content']
            );

            // define os helpers que carregarao
            $blocks = array();


            $data = array(
                'page_title' => "Nova Época - Sobre Nós",
                'page_class' => 'ecommerce pagina '.$pagina_class,
                'token'      => $app['TOKEN'],

                'assets' => $assets,

                'breadcrumb' => $breadcrumb,

                'page' => $page,

                'blocks' => $blocks,

               
            );

            // Util::dbg($data);

            return $app['twig']->render('base.twig.php', $data);

        }

        public static function getServicos($app){

            // seta classe de css de acordo com a url da pagina
            $pagina_class = "servicos";

            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-servicos.twig.php',
                'content' => NULL
            );

            // define os helpers que carregarao
            $blocks = array();
            $blocks = self::buildRodapeAux();


            $data = array(
                'page_title' => "Serviços",
                'page_class' => 'ecommerce pagina '.$pagina_class,
                'token'      => $app['TOKEN'],

                'assets' => $assets,
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'blocks' => $blocks,               
            );
            // Util::dbg($data);
            return $app['twig']->render('base.twig.php', $data);
        }

        public static function getContatoEnglish($app) {

            // seta classe de css de acordo com a url da pagina
            $pagina_class = "contato";

            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-formulario-fale-conosco-english.twig.php',
                'content' => NULL
            );

            $data = array(
                'page_title' => "Fale Conosco - English Version",
                'page_class' => 'ecommerce pagina '.$pagina_class,
                'token'      => $app['TOKEN'],
                'assets' => $assets,
                'breadcrumb' => $breadcrumb,
                'page' => $page,
            );

            return $app['twig']->render('ajax.twig.php', $data);
        }
    
    // metodo que retorna os blocos de conteudo do rodape
    public static function getBlocks($region){

        $blocks = null;        
        return $blocks;
    }
}