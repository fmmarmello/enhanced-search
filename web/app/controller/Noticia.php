<?php

    namespace Controller;

    use Model;
    use Lib\Util;

	class Noticia {


        // metodo padrao da arquitetura
        public static function getListNoticias($app, $catId=null){

            // define o id da entidade gapo // tabela  gapo_entidade
            // $EntidadeID = 1;

            // define o titulo da pagina
            $title = 'Notícias';

            // define as classes css da pagina
            $cssClass = 'ecommerce noticia produto-lista';

            // define o token para validacao de forms
            $token = $app['TOKEN'];

            // define a array de objetos da lista
            $noticias = Model\Noticia::findNoticias($app, null, $catId);

            // define o bloco lateral das noticias em destaque
            $destaques = true;
            $destaques = Model\Noticia::findNoticias($app, $destaques, null, 5);

            // define o bloco lateral das categorias
            $categorias = Model\Noticia::findCategorias();
            // Util::dbg($categorias);

            // define os filtros carregados na lateral da pagina
            // $filtros = Busca::buildFiltroLateral($EntidadeID);

            // define os assets que carregarao
            $assets = array();

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-interna-lista-noticias.twig.php',
                'content' => $noticias
            );


            // define os blocos de conteudo que carregarao
            $blocks = array();
                $blocks['categorias'] = array(
                    'template' => 'helpers/bloco-noticia-categoria.twig.php',
                    'content' => $categorias
                );
                /* Não usado para Morada*/
                /*$blocks['destaques'] = array(
                    'template' => 'helpers/bloco-noticia-destaque.twig.php',
                    'content' => $destaques
                );*/
            

            // monta os dados aque serao enviados ao template
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

            // retorna o render do template
            return $app['twig']->render('base.twig.php', $data);

        }



        public static function getNoticia($app, $id){

            // cria a session com o token para a validacao
            $_SESSION['token'] = $app['TOKEN'];
            
            // define a array de objetos da lista
            $noticia = Model\Noticia::findNoticia($id);

            // define o bloco lateral das noticias em destaque
            $destaques = true;
            $destaques = Model\Noticia::findNoticias($app, $destaques, null, 5);

            // define o bloco lateral das categorias
            $categorias = Model\Noticia::findCategorias();

            // Util::dbg($noticia);

            // define o token para validacao de forms
            $token = $app['TOKEN'];            

                // caso nao tenha nenhuma noticia com o id informado, retorna 404
                if(empty($noticia->id)) return Pagina::getPage404($app);

            // define o titulo da pagina
            // $title = utf8_encode($noticia->prodtitle);
            $title = "Notícias e Artigos";

            // define as classes css da pagina
            $cssClass = 'ecommerce noticia produto-interna';

            // gera as galerias do produto
            $galeria = Model\Album::findGaleria($noticia->albumid, 150,'helpers/bloco-galeria-carrossel.twig.php');

            // define os assets que carregarao
            $assets = array();
                // $assets['facebook'] = array(
                //     'template' => 'inc/facebook.twig.php',
                //     'content' => $noticia
                // );


            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb($noticia);

            // define os templates que carregarao
            $page = array(
                'template' => 'tpl/page-detalhe-pagina.twig.php',
                'content' => $noticia
            );

            // define os helpers que carregarao
            $blocks = array();
                // $blocks['categorias'] = array(
                //     'template' => 'helpers/bloco-noticia-categoria.twig.php',
                //     'content' => $categorias
                // );
                $blocks['destaques'] = array(
                    'template' => 'helpers/bloco-noticia-destaque.twig.php',
                    'content' => $destaques
                );


            $data = array(
                'page_title' => $title,
                'page_class' => $cssClass,
                'token'      => $token,

                'assets'     => $assets,

                'breadcrumb' => $breadcrumb,

                'page'        => $page,

                'blocks'    => $blocks,

            );

            // Util::dbg($helpers);
            return $app['twig']->render('base.twig.php', $data);
        }

	}
