<?php
    namespace Controller;

    use Model;
    use Lib\Util;


    class Home {

        public static function getExtranet($app){
            return $app->redirect($app['CONFIG']['HOST_EXTRANET']);
        }

        public static function getAdmin($app){
            return $app->redirect($app['CONFIG']['HOST_ADMIN']);
        }

        // metodo que gera os dados para exibicao da HOME
        public static function getHome($app){             
                        
            $time_start = microtime(true)*1000;
            
            $datas = array();
   
            // IDs de banners
                // o grupoId(bannerid) é definido pelo banco, ja que nao 
                // temos uma forma de definir qual e o id do grupo do banner modal
                // pode ser usado para banner de cidades diferentes 
            $bannerSliderTopo = 4;
            //$bannerSliderMeio = 4;
            $bannerModal = 5;

            // variaveis de init da HOME // IDs de vitrines
            $vitrineID_lancamentos = 1;
            $vitrineID_prontos = 4;
            $vitrineID_superdestaque = 5;
            //$vitrineID_locacao = 8;

            // cria a session com o token para a validacao
            $_SESSION['token'] = $app['TOKEN'];

            // define o token para validacao de forms
            $token = $app['TOKEN'];            

            // define o titulo da pagina
            $title = 'Casas, apartamentos e imóveis à venda no Rio de Janeiro';
            
            // instancia um objeto php padrao para identificar a pagina no template do facebook
            $homeFacebook = new \stdClass;
            $homeFacebook->produtotag = "home";

            // define as classes css da pagina
            $cssClass = 'ecommerce home-page';

            // define os assets extras que carregarao
            
            $assets = array();
            $assets['facebook'] = array(
                'template' => 'inc/facebook.twig.php',
                'content' => $homeFacebook
            ); 


            // define o template que carregara
                
            $page = array(
                'template' => 'tpl/page-home.twig.php',
                'content' => NULL
            );

            // gera o conteudo dos blocos da pagina
            $blocks = array();
                /* banner e busca superior */                
                $blocks['slider-1'] = array(
                    'template' => 'helpers/bloco-slides.twig.php',
                     'content' => Model\Banner::findSlides(1)
                );

                // if ($_SERVER['REMOTE_ADDR'] == '177.129.9.98')
                //     Util::dbg(Model\Vitrine::findVitrine(1));
                
                /**
                *
                *   vitrine de imóveis em destaque
                */
                

                //Util::dbg(Model\Vitrine::findVitrine(1)); 

                $blocks['empreendimento-destaque'] = array(
                    'template' => 'helpers/bloco-vitrine-principal.twig.php',
                    'content' => Model\Vitrine::findVitrine(1) 
                );

                //Util::dbg(Model\Vitrine::findVitrine(2)); 
                // $blocks['empreendimento-superdestaque'] = array(
                //     'template' => 'helpers/bloco-vitrine-superdestaque.twig.php',
                //     'content' => Model\Vitrine::findVitrine(2) //destaques de empreendimentos
                // );
              
                // $blocks['imoveis-destaque-venda'] = array(
                //     'template' => 'helpers/bloco-vitrine-venda.twig.php',
                //     'title' => 'Imóveis <b>em Destaque</b>',
                //     'content' => Model\Vitrine::findVitrine($vitrineID_prontos)
                // );
                
                // $blocks['nao-encontrei'] = array(
                //     'template' => 'helpers/bloco-formulario-naoencontrei.twig.php',
                //     'title' => 'Não encontrei',
                //     'content' => null
                // );

                $imoveisPremium = Model\Imovel::findImoveisPremium("", 4); 
                //Util::dbg($imoveisPremium); 
                
                //Regiões
                $blocks['bloco-regioes'] = array( 
                    'template' => 'helpers/bloco-home-regioes.twig.php',
                    'content' => $imoveisPremium
                );
                

                // $blocks['bloco-localizacao'] = array( 
                //     'template' => 'helpers/bloco-home-mapa.twig.php', 
                //     'content' => Model\Imovel::findImoveis("", 50)
                //  );            

                // $blocks['bloco-noticias'] = array(
                //     'template' => 'helpers/bloco-noticia-ultima.twig.php',
                //     'content' => Model\Noticia::findNoticias($app, null, null, 2)
                // );

                if($_SERVER['REMOTE_ADDR'] == '177.129.9.98'){
                       #print_r($blocks['bloco-noticias']);
                }

                // $blocks['barra-flutuante'] = array(
                //   'template' => 'helpers/barra-flutuante.twig.php',
                //   'content' => null
                // );
      
              /*  $blocks['banner-modal'] = array(
                    'template' => 'helpers/banner-modal.twig.php',
                    'content' => Model\Banner::findBannerModal($bannerModal)
                );*/


                $scripts = array(
                    'assets/jvs/hogan.js',
                    'assets/jvs/typeahead.min.js',
                    'theme/js/jquery.flexslider-min.js',
                    'assets/jvs/typeahead.inforce.js',
                    'theme/js/nivo-lightbox.js',
                    'assets/jvs/custom-cleaned.js',
                    'assets/global/plugins/noUiSlider.8.2.1/nouislider.min.js',
                    'assets/global/plugins/wNumb.js'
                ); 

            // parametros que irao popular o template
            $data = array(                
                'page_title'    => $title,
                'page_class'    => $cssClass,
                'token'         => $token,
                'assets'        => $assets,                
                'page'          => $page,
                'scripts'       => $scripts,
                'blocks'        => $blocks,
            );
            
            // exemplos de remocao do rodape, caso necessario
                // $app['twig']->addGlobal('MenuPrincipal', NULL);
                // $app['twig']->addGlobal('MenuAuxiliar', NULL);
                // $app['twig']->addGlobal('RodapePrincipal', NULL);
                // $app['twig']->addGlobal('RodapeAuxiliar', NULL);
                // $app['twig']->addGlobal('RodapeEstatico', NULL);

            // retorno para renderizar a pagina
            
            //Util::dbg($datas);
            return $app['twig']->render('base.twig.php', $data);
        
        }

    }
