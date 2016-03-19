<?php

    namespace Model;

    use Lib\Util;

    class Track extends \ActiveRecord\Model {

        static $table_name = 'trk_track';

        public static function LogUser($app, $corretorUrl=false){

            $data = explode($app['CONFIG']['base_url'], $_SERVER['REQUEST_URI']);
            $data = explode("/", $data[0]);
            // segundo a rota estabelecida como padrao do projeto // 1 = nome/url do objeto // 3 = id do objeto, se houver
            $objeto = $data[1];
                if($objeto=="prontos") $objeto = "imovel";
                if($objeto=="lancamentos") $objeto = "empreendimento";
                if(empty($objeto)) $objeto = "pagina";
            $objetoid = (empty($data[3])) ? "0" : $data[3];


            $track = new Track;
            $track->objetoid = $objetoid;
            $track->dtinsert = date("Y-m-d H:i:s");
            $track->referencia = "0";

            
            #print_r($_SERVER['HTTP_USER_AGENT']);
            $track->user_session = isset($_COOKIE['user_session']) ? $_COOKIE['user_session'] : "";
            if(empty($track->user_session)){
                $usr_session = md5($app['CONFIG']['salt'].date('YmdHis'));
                setcookie("user_session", $usr_session, (time()+60*60*24*365) );
                $_SESSION['user_session'] = $usr_session;
                $track->user_session = $usr_session;
            }

            $track->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $track->user_ip = $_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT'];
            
            if ($corretorUrl) {
                 $track->objeto = "corretor";
                $track->site_url = $corretorUrl;    
            } else {
                 $track->objeto = $objeto;
                $track->site_url = $_SERVER['REQUEST_URI'];
            }
            

            $track->save();

        }
    }