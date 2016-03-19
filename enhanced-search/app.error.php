<?php
    Use Lib\Util;


    // registra o controler de exibicao de erros
    use Symfony\Component\Debug\ErrorHandler;
    ErrorHandler::register();
    use Symfony\Component\Debug\ExceptionHandler;
    ExceptionHandler::register();



$app->error(function (\Exception $e, $code) use($app) {
    $_SESSION['token'] = $app['TOKEN'];
    // tratamento do codigo de erro
    
                 echo $code;
                 echo "<hr>";
                 echo "<pre>";
                 echo $e->getCode();
                 echo "<br>";
                 #print_r($e->getTrace());
                 echo "<br>";
                 echo $e->getLine();
                 echo "<br>";
                 echo $e->getMessage();
                 echo "</pre>";
    
    switch ($code) {
        case 404:
            // define o titulo da pagina
            $title = 'Erro 404';

            $tplError = 'error/404.twig.php';
            break;

        case 500:
            // em caso de erro 500, se estiver em dev, exibe erro, senao, redirect para home
            if($app['CONFIG']['state']=='development'){            
                // echo "<hr>";
                // echo $code;
                // echo "<hr>";
                // echo "<pre>";
                // echo $e->getMessage();
                // echo "</pre>";
            }else{
                 /*echo "<hr>";
                 echo $code;
                 echo "<hr>";
                 echo "<pre>";
                 echo $e->getMessage();
                 echo "</pre>";*/
                //return $app->redirect("/");            
            }

                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug("################  ERRO 500        ###################");
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug($e->getMessage());
                isset($_POST) ? $app['monolog']->addDebug("POST: {{".print_r($_POST)."}}") : NULL;
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug("#####################################################");            


            // define o titulo da pagina
            $title = 'Erro 500';

            $tplError = 'error/500.twig.php';

            break;

        default:
            if($app['CONFIG']['state']=='development'){
                // echo "<hr>";
                // echo $code;
                // echo "<hr>";
                // echo "<pre>";
                // echo $e->getMessage();
                // echo "</pre>";
                
            }else{

                //return $app->redirect("/");            
            }

                $app['monolog']->addDebug(" ");
                $app['monolog']->addDebug(" ");
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug("##############  ERRO   ??????????  ##################");
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug($e->getMessage());
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug("#####################################################");            
                $app['monolog']->addDebug(" ");
                $app['monolog']->addDebug(" ");                    

                // define o titulo da pagina
                $title = 'Erro ???';

                $tplError = 'error/500.twig.php';

    }



            // define as classes css da pagina
            $cssClass = 'ecommerce pagina error-page';

            // define os assets que carregarao
            $assets = null;

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();


            if($app['CONFIG']['state']=='development'){
                $eCode = $code;
                if($app['CONFIG']['state']=='development'){
                    $eMessage = $e->getMessage();
                }else{
                    $eMessage = "";                
                }
            }else{
                $eCode = $code;
                $eMessage = "";                                
            }

            // define os templates que carregarao
            $page = array(
                'template' => $tplError,
                'content' => array(
                    'code' => $eCode,
                    'message' => $eMessage
                )
            );

            // define os blocos que carregarao
            $blocks = NULL;

            $data = array(
                    'page_title' => $title,
                    'page_class' => $cssClass,
                    'token' => $_SESSION['token'],

                    'assets' => $assets,

                    'breadcrumb' => $breadcrumb,

                    'page' => $page,

                    'blocks' => $blocks,

                                        
                );
            
            return $app['twig']->render('base.twig.php', $data);

});