<?php

    namespace Controller;

    use Model;
    use Lib\Util;

  	class Album {


        public static function getImgCapa($tipo, $id, $ext=""){
            
            $host_admin = Model\Param::getHostAdminImv();
           
            switch ($tipo) {
                case 'imovel':
                    $i = Model\Album::imgCapa($id);
                    if($i){
      		            $iSrc = $host_admin."_custom/galeria_imagem/".$i->ano."/".$i->mes."/".$i->album_id."/".$i->imagem_id;
                        if(!empty($ext)){
                            $iSrc .= $ext;
                        }
                        $iSrc .= ".jpg";
                    }else{
                        $iSrc = "assets/img/logo_cinza.png";
                    }
                break;
            
                case 'empreendimento':
                    $iSrc = "assets/img/logo_cinza.png";
                break;
                
                default:
                    $iSrc = "assets/img/logo_cinza.png";
  				break;
      		}

            return $iSrc;
        }


	}
