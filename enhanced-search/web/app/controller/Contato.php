<?php

    namespace Controller;

    use Lib\Util;
    use Model;

    class Contato {

        // cria parametro estatico para testes de contato
        public static $devTest = false;

        // metodo generico para processar forms
        public static function getContatoPage($app,$rota){
            
            $_SESSION['token'] = $app['TOKEN'];

            $url = explode("-", $rota);

            $contatoPage = Model\Contato::findFormulario("contato/".$rota);
            $content = $contatoPage['content'];

            // define o breadcrumb
            $breadcrumb = Util::buildBreadcrumb();            

            $assets = array();

            // define o formData para cada rota
            $formData = array();
            if($rota=='venda-seu-imovel'){
                // sem imovel, sem fromData
                $formData['produtotag'] = "";
                $formData['form_natureza'] = "";
                $formData['form_tipo'] = "";
                $formData['form_quartos'] = "";
                $formData['form_natureza'] = Model\Param::findNaturezas();
                $formData['form_tipo'] = Model\Param::findTipos();
                $formData['form_quartos'] = Model\Param::findQuartos();
                $formData['form_uf'] = Model\LocalEstado::findUFs();
            }

            // define os templates que carregarao
            $page = array(
                'template'  => 'tpl/page-formulario-'.$rota.'.twig.php', 
                'content' => $formData
            );

            // captura as variaveis globais do sistema de template - twig - e popula as variaveis para retornar o endereco
            $Globals = $app['twig']->getGlobals();
            $Customer = $Globals['Customer'];
                // alteracoes necessarias para retornar o gmaps corretamente
                $Customer->produtotag = "contato";
                $Customer->estadonome = $Customer->estado;
                $Customer->bairronome = $Customer->bairro;
                $Customer->endereco = $Customer->logradouro;
                $Customer->condominionome = null;
                $Customer->interesse = null;

                // hack para filtrar o contato por finalidades e imv/emp
                foreach ($_GET as $key => $value) {
                    $Customer->interesse = $key;
                }

            // define os templates que carregarao
            $blocks = array();
                
                /*$blocks['localização'] = array( 
                    'template' => 'helpers/interna-localizacao.twig.php', 
                    'content' => $Customer
                );*/
            $scripts = array();

            if($content){
                $contato = array(
                    'page_title'    => utf8_encode($content->assunto),
                    'page_class'    => 'ecommerce '.$rota,
                    'token'         => $app['TOKEN'],
                    'breadcrumb'    => $breadcrumb,
                    'url'           => $rota,
                    'assets'        => $assets,
                    'page'          => $page,
                    'scripts'       => $scripts,
                    'blocks'        => $blocks,
                );

                return $app['twig']->render('base.twig.php', $contato);

            }else{
                return Pagina::getPage404($app);
            }
        }        


        public static function postContatoPage($app,$rota){

            // verificacao do campo antirobo, que deve vir vazio do POST
            if(empty($_POST[$rota])){

                $url = explode("-", $rota);
                $contatoPage = Model\Contato::findFormulario(trim("contato/".$rota));
                $contato = $contatoPage['content'];

                // if ($_SERVER['REMOTE_ADDR'] == '177.129.9.98') {
                //     Util::dbg($contato); 
                // }

                // captura as variaveis globais do sistema de template - twig - e popula as variaveis para retornar o endereco
                $Globals = $app['twig']->getGlobals();
                $Customer = $Globals['Customer'];
                $contato->assunto = $Customer->name . " - " . $contato->assunto;
                // Util::dbg($Customer->name);

                if( (empty($contato->origemid)) || (empty($_POST['email']))) {
                    return $app['twig']->render('base.twig.php', array(
                        'page_class' => 'ecommerce',
                        'page_title' => 'Erro',
                        'token'      => $app['TOKEN'],
                        'assets'     => null,
                        'tpl'        => array( 'main' => array( 'template' => 'error/404.twig.php', 
                                                                'content' => "email postado: ".$_POST['email']." / origem: ".$contato->origemid )
                                        ), 
                        'steps'      => Pagina::getBlocks('pre-rodape'),
                        'footer'     => Pagina::getBlocks('rodape'),
                    ));
                }
               
                // valida o token gerado pela aplicacao e verifica se o request foi feito pelo site
             
                //if( ( ($_SESSION['token'] == $_POST['token']) || (Util::validRequest($app)) ) || ($rota=='chat') ){

                    // devido ao banco estar em ISO-8859-1(latin1) e o code em UTF-8, precisamos usar 
                    //      'utf8_decode' quando for gravar no banco
                    //      'utf8_encode' quando puxarmos do banco para saida
                    $data = array(
                        'id'            => empty($_POST['id']            )? NULL : $_POST['id'],
                        'produto'       => empty($_POST['produto']       )? NULL : $_POST['produto'],
                        'tokenAdr'      => empty($_POST['tokenAdr']      )? NULL : $_POST['tokenAdr'],
                        'email'         => empty($_POST['email']         )? NULL : $_POST['email'],
                        'nome'          => empty($_POST['nome']          )? $_POST['email'] : utf8_decode($_POST['nome']),        // caso o nome esteja vazio, grava o email
                        'nome_amigo'    => empty($_POST['nome_amigo']    )? NULL : utf8_decode($_POST['nome_amigo']),
                        'email_amigo'   => empty($_POST['email_amigo']   )? NULL : $_POST['email_amigo'],
                        'telresidencial'=> empty($_POST['telresidencial'])? NULL : $_POST['telresidencial'],
                        'telcelular'    => empty($_POST['telcelular']    )? NULL : $_POST['telcelular'],
                        'telcomercial'  => empty($_POST['telcomercial']  )? NULL : $_POST['telcomercial'],
                        'vagas'         => empty($_POST['vagas']  )?        NULL : $_POST['vagas'],
                        'quartos'       => empty($_POST['quartos']  )?      NULL : $_POST['quartos'],
                        'finalidade'    => empty($_POST['finalidade']  )?   NULL : $_POST['finalidade'],
                        'regiao'        => empty($_POST['regiao'])?         NULL : $_POST['regiao'],
                        'tipo'          => empty($_POST['tipo'])?           NULL : $_POST['tipo'],
                        'flagnewsletter'=> empty($_POST['newsletter']    )? NULL : $_POST['newsletter'],
                        'area_trabalho' => empty($_POST['area_trabalho'] )? NULL : utf8_decode($_POST['area_trabalho']),
                        'mensagem'      => empty($_POST['mensagem']      )? NULL : utf8_decode($_POST['mensagem']),
                        'venda_imovel'  => empty($_POST['venda_imovel']  )? NULL : $_POST['venda_imovel'],
                        'user_session'  => empty($_COOKIE['user_session'])? NULL : $_COOKIE['user_session'],
                        'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
                        'user_ip'       => $_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT'],
                        'sent_date'     => date("Y-m-d H:i:s"),
                        'origemid'      => $contato->origemid, 
                        'referer'       => empty($_POST['linkform']  )? NULL : $_POST['linkform'],
                        'url'           => empty($_POST['url']  )? NULL : $_POST['url'],
                        'rota'          => $rota ? $rota : ""

                    );   
                   
                    if($rota=='chat'){
                        $data['codempreendimento'] = empty($_POST['codempreendimento']) ? '0' : $_POST['codempreendimento'];
                        if($data['codempreendimento']=='0'){
                            $data['mensagem'] = "Prechat: ".$_POST['linkfrom'];
                            //Felipe tirou
                            //if($_POST['hotsite']=="" || !isset($_POST['hotsite'])){/* do nothing */}else{
                              //  $data['mensagem'] = "Prechat: ".$data['hotsite'];
                            //}
                        }else{
                            $data['mensagem'] = "Prechat - COD: ".$data['codempreendimento'];
                        }
                    }
                    
                    //Felipe tirou
                    #if(empty($data['telresidencial'])){                        
                        #$data['telresidencial'] = (empty($_POST['telefone'])) ? NULL : "(".$_POST['ddd'].") ".$_POST['telefone'];                        
                    #}


                    // define destinatrio de acordo com o form cadastrado
                    $setMailTo = explode(",", $contato->mailto);

                    // verifica se existe um amigo para receber o email
                    if (empty($data['email_amigo'])){ /* nao faz nada */ }else{
                        // se houver, adiciona mais um item na array de emails destinatarios
                        $setMailTo[] = $data['email_amigo'];
                    }

                    // verifica se existe algum corretor associado, se houver, altera os forms postados, EXCETO:
                    // enviar para um amigo; newsletter; trabalhe conosco
                    if (empty($data['email_amigo'])){ 

                        if( ($contato->origemid==2) || ($contato->origemid==7) ){ /* nao faz nada */ }else{ /* nao sendo newsletter nem indique imovel */

                            if (isset($_COOKIE['corretor'])){

                                // popula a var corretor com o json armazenado no cookie
                                $corretor = json_decode($_COOKIE['corretor']);
                                $corretor = $corretor[0];

                                // zera a var setMailTo e add o email do corretor
                                unset($setMailTo);
                                $contato->assunto = $Customer->name . " - " . "Corretor ".$corretor->apelido." - " . $contato->assunto;
                                $setMailTo[] = $corretor->email;
                                // $setMailTo[] = "raul@inforce.com.br"; // teste

                                // Util::dbg($contato);
                            }
                        }
                    }



                    // quem envia o email
                    $setMailFrom = $app['CONFIG']['mail']['username'];
                    $setMailFromName = $app['CONFIG']['Cliente'];

                    // instancia a classe de email e prepara para o envio
                        // debug
                        if(self::$devTest){                            
                            unset($setMailTo);                                      // teste
                            $contato->assunto = "Teste - " . $contato->assunto;     // teste
                            $setMailTo[] = $contato->mailto;                   // teste
                        }
                        // debug


                
                        $message = \Swift_Message::newInstance()
                            ->setSubject( utf8_encode($contato->assunto) )
                            ->setFrom( array($setMailFrom => $setMailFromName) )
                            ->setTo( $setMailTo )
                            ->setBcc( "registro@inforce.com.br" )
                            ->setBody( 
                                $app['twig']->render('email/email-'.$rota.'.twig', $data), 
                                'text/html'
                            );

                    
                   
                    // anexa arquivos enviados pelo usuario
                    if($_FILES){
                        $message->attach(\Swift_Attachment::fromPath($_FILES['anexo_form']['tmp_name'])->setFilename($_FILES['anexo_form']['name']) );
                    }

                    // atualiza a pessoa do modulo crm e retorna o pessoaid // tabela crm_pessoa
                    //$crmPessoa = Model\CrmPessoa::setPessoa($data);
                    //$data['pessoaid'] = $crmPessoa->pessoaid;

                    // seta outros parametros para o setPessoaForm
                    $data['mailto'] = implode("; ", $setMailTo);
                    $data['mailfrom'] = $setMailFrom;
                    $data['mailcc'] = "";
                    $data['mailcco'] = "";
                    $data['mailreply'] = "";
                    $data['mailsubject'] = ($contato->assunto);
                    $data['mailbody'] = utf8_decode($app['twig']->render('email/email-'.$rota.'.twig', $data));
                    $data['urlorigem'] = $_SERVER['REQUEST_URI'];
                    $data['iporigem'] = $_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT'];
                    $data['navegadororigem'] = $_SERVER['HTTP_USER_AGENT'];

                    //Util::dbg($data);

                    switch ($data['produto']) {
                        case 'empreendimento':
                            $emp_id = $data['id'];
                            $imv_id = '0';
                            $ast_id = '0';
                            break;

                        case 'imovel':
                            $emp_id = '0';
                            $imv_id = $data['id'];
                            $ast_id = '0';
                            break;
                        
                        case 'prontos': //imovel
                            $emp_id = '0';
                            $imv_id = $data['id'];
                            $ast_id = '0';
                            break;
                        
                        case 'locacao': //imovel
                            $emp_id = '0';
                            $imv_id = $data['id'];
                            $ast_id = '0';
                            break;
                        
                        default:
                            $emp_id = '0';
                            $imv_id = '0';
                            $ast_id = '0';
                            break;
                    }

                    // trata encoding do venda_imovel e insere dentro da mensagem antes de gravar no banco
                    if(empty($data['venda_imovel'])){}else{
                        $data['mensagem'] .= "<br><br>";
                        foreach ($data['venda_imovel'] as $key => $value) {
                            $data['mensagem'] .= "<b>".utf8_decode($key).":</b>".utf8_decode($value)."<br>";
                        }
                        $data['mensagem'] .= "<br>";
                    }
           

                    // grava no banco o contato referente - modulo CRM
                    // Model\CrmPessoaForm::setPessoaForm($data);

                    
                    // execuda a procedure do banco
                    $procedure = "CALL crm_sp_contato_upd(".$data['origemid'].",
                        1,
                        '".$data['nome']."',
                        '', 
                        '".$data['email']."',
                        '', 
                        '".$data['telresidencial']."', 
                        '".$data['telcelular']."', 
                        '".$data['telcomercial']."', 
                        '', 
                        '', 
                        '', 
                        '', 
                        '".$data['flagnewsletter']."', 
                        '".$ast_id."', 
                        '".$imv_id."', 
                        '".$emp_id."', 
                        '".$data['mensagem']."', 
                        '".$data['mailfrom']."', 
                        '".$data['mailto']."', 
                        '".$data['mailcc']."', 
                        '', 
                        '', 
                        '".$data['mailsubject']."', 
                        '".$data['mailbody']."', 
                        '".$data['origemid']."', 
                        '".$data['iporigem']."', 
                        '".$data['navegadororigem']."',
                        'NULL') "; 

                        try {
                            // Retrieve the PDO object
                            // $pdo = Model\Contato::connection()->connection;
                            
                            // do stuff with your pdo connection object here ...
                            // $stmt = $pdo->prepare($procedure);
                            // $stmt->bindParam(1, $return_value, PDO::PARAM_STR, 4000); 
                            
                            // call the stored procedure
                            // $stmt->execute();
                            $sql = Model\Contato::query($procedure);

                            // Util::dbg($procedure);                                                    
                        } catch (Exception $e) {
                          
                        }                        

                    // dispara o email
                    $app['mailer']->send($message, $failures);      #comentei

                    //Util::dbg("envio ok");
                    //Util::dbg($message);

                    // pagina de retorno para o usuario
                    $retorno = $app['twig']->render('base.twig.php', array(
                        'page_title' => 'Obrigado pelo Contato',
                        'page_class' => 'ecommerce obrigado-contato',
                        'token'      => $app['TOKEN'],
                        'assets'     => NULL,
                        'page'       => array( 'template' => 'email/contato-obrigado.twig', 'content' => $data ),
                        'blocks'     => NULL,
                    ));  

                
                    // desvio em caso do prechat
                    if($rota=='chat'){
                            // if($_SERVER['REMOTE_ADDR'] == '177.129.9.98'){
                            //     Util::dbg("http://extranet.sawa.la/chat/?rd=57&o=Site Sawala&pd=".$data['id']."&nome=".$data['nome']."&email=".$data['email']."&tel=".$data['telresidencial']."&direto=1"."&ref=".$data['referer']); 
                            // }      
                        if (!empty($data['produto'])){
                            switch ($data['produto']) {
                                case 'imovel':
                                    return $app->redirect("http://extranet.sawa.la/chat/?rd=-99&o=site&avl=".$data['id']."&nome=".$data['nome']."&email=".$data['email']."&tel=".$data['telresidencial']."&direto=1"); 
                                    break;

                                case 'empreendimento':
                                    if($_SERVER['REMOTE_ADDR'] == '177.129.9.98'){
                                        //Util::dbg("http://extranet.sawa.la/chat/?rd=57&o=Site Sawala&pd=".$data['id']."&nome=".$data['nome']."&email=".$data['email']."&tel=".$data['telresidencial']."&direto=1"); 
                                    }   
                                    
                                    //header('location:'."http://extranet.sawa.la/chat/?rd=57&o=Site Sawala&pd=".$data['id']."&nome=".$data['nome']."&email=".$data['email']."&tel=".$data['telresidencial']."&direto=1");
                                    return $app->redirect("http://extranet.sawa.la/chat/?rd=57&o=Site Sawala&pd=".$data['id']."&nome=".$data['nome']."&email=".$data['email']."&tel=".$data['telresidencial']."&direto=1"); 
                                    break;
                                
                                default:
                                    return $app->redirect("http://extranet.sawa.la/chat/?rd=57&o=Google&pd=5&nome=".$data['nome']."&email=".$data['email']."&tel=".$data['telresidencial']); 
                                    break;
                            }
                        }
                    }

                // }else{ //caso contrario, alerta de tentativa de CSFR
                //     // return die("CSFR"); 
                //     $retorno = $app->redirect("/");
                // }

                //Util::dbg($retorno); 
                return $retorno;

            }else{
                $user = "COOKIE: user_session ".$_COOKIE['user_session'];
                $ip1 = "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR'];
                $ip2 = "REMOTE_PORT: ".$_SERVER['REMOTE_PORT'];
                @$ip3 = "HTTP_X_FORWARDED_FOR: ".$_SERVER['HTTP_X_FORWARDED_FOR']; // verificar porque da erro
                $data1 = "QUERY_STRING: ".$_SERVER['REQUEST_URI'];
                $data2 = "HTTP_USER_AGENT: ".$_SERVER['HTTP_USER_AGENT'];
                $date = "TIMESTAMP: ".date("Y-m-d H:i:s");

                $app['monolog']->addDebug(" ");
                $app['monolog']->addDebug(" ");
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug("################  SPAM DE EMAIL  ####################");
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug("TRACK:");
                $app['monolog']->addDebug("[$user]");
                $app['monolog']->addDebug("[$ip1]");
                $app['monolog']->addDebug("[$ip2]");
                $app['monolog']->addDebug("[$ip3]");
                $app['monolog']->addDebug("[$data1]");
                $app['monolog']->addDebug("[$data2]");
                $app['monolog']->addDebug("[$date]");
                $app['monolog']->addDebug("#####################################################");
                $app['monolog']->addDebug("######################################################");            
                $app['monolog']->addDebug(" ");
                $app['monolog']->addDebug(" ");

                    // pagina de retorno para o usuario
                    return $app['twig']->render('base.twig.php', array(
                        'page_title' => 'Obrigado pelo Contato',
                        'page_class' => 'ecommerce obrigado-contato',
                        'token'      => $app['TOKEN'],
                        'assets'     => null,
                        'tpl'        => array('main' => array( 'template' => 'email/contato-obrigado.twig', 'content' => null )),
                        'steps'      => Pagina::getBlocks('pre-rodape'),
                        'footer'     => Pagina::getBlocks('rodape'),
                    )); 
            }


        }


        public static function postEnviaEmail($app, $rota){

            $_SESSION['token'] = $app['TOKEN'];

            $url = explode("-", $rota);

            $contatoPage = Model\Contato::findFormulario("contato/".$rota);
            $content = $contatoPage['content'];

            Util::dbg($content); 

            return "Gabriel"; 
        }

    }
