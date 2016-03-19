<?php
    namespace Controller;

    use Model;
    use Lib\Util;


	class Pessoa {


        // metodo que procura o corretor pelo nome e registra ele em um cookie e session
        public static function setCorretor($app, $nome){

            if($nome=='limpar'){
                // limpa o cookie do corretor
                setcookie("corretor", "", time()-3600, "/");
                return $app->redirect("/");
            }else{
                // retorna o corretor
                $corretor = Model\Pessoa::findCorretor($nome);
                if(empty($corretor)){
                    // se o  corretor estiver vazio, limpa o cookie
                    setcookie("corretor", "", time()-3600, "/");
                }
            }

            // redireciona para home
            return $app->redirect("/");
        }


        // metodo que retorna o json do corretor como objeto
        public static function getCorretor(){
            if (isset($_COOKIE['corretor'])){
                $corretor = json_decode($_COOKIE['corretor']);
                $corretor = $corretor[0];
            }else{
                $corretor = null;                
            }
            
            return $corretor;
        }

         // metodo que retorna o json do corretor como objeto
        public static function teste(){
            usleep(1); 
            echo "1";
            usleep(1); 
            echo "2";
            return true;
        }

    

	}
