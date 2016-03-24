<?php

    namespace Lib;

    use Model;


    class Util {

        // metodo que retorna a rota atual
        public static function getRoute($app){
            echo "<pre>route: ";
            print_r($app['request']->attributes->get('_route'));
            die;
        }


        // metodo que constroi o breadcrumb do site
        public static function buildBreadcrumb($obj=null){
            // breadcrumb fechado em home + dois niveis em caso de um produto instanciado no obj
            // se chamar o metodo sem um obj instanciado, ele faz a leitura padrao do request uri

            // self::dbg($_GET['prontos']);
            if (empty($obj)){               
                $tmp = explode("/", $_SERVER['REQUEST_URI']);

                $breadcrumb = array();
                $url = "";

                $breadcrumb_item['nome'] = 'home';
                $breadcrumb_item['url'] = '';
                $breadcrumb[] = $breadcrumb_item;

                foreach ($tmp as $key => $value) {
                    $breadcrumb_item = array();

                    if ($value){
                        $url .= $value."/";
                        if($value =='locacao'){
                            $value = utf8_decode("Locação");
                        }
                        if($value =='lancamentos'){
                            $value = utf8_decode("Lançamentos");
                        }
                        $breadcrumb_item['nome'] = str_replace("-", " ", $value);
                        
                        $breadcrumb_item['url'] = $url;
                        $breadcrumb[] = $breadcrumb_item;
                    }
                }

            }else{
                
                if($obj->produtotag =='locacao'){
                    $name = utf8_decode("Locação");
                }
                
                if($obj->produtotag =='lancamentos'){
                    $name = utf8_decode("Lançamentos");
                }

                if($obj->produtotag =='prontos'){
                    $name = utf8_decode("Prontos");
                }

                $breadcrumb = array(
                    0 => array(
                        'nome'  => 'Home',
                        'url'   => ''
                    ),
                    1 => array(
                        'nome'  => $name,
                        'url'   => $obj->produtotag.'/'
                    ),
                    2 => array(
                        'nome'  => $obj->prodtitle,
                        'url'   => $obj->produtotag.'/'.$obj->objurl.'/'.$obj->id.'/'
                    )
                );

            }             

            return $breadcrumb;
        }        


        // metodo que verifica se o request foi feito atraves do site
        public static function validRequest($app){

            $temp = explode("?", $_SERVER['HTTP_REFERER']);
            $rota1 = $temp[0];
            $rota2 = substr($app['CONFIG']['base_url'], 0, -1).$app['request']->server->get('REQUEST_URI');
            if ($rota1==$rota2){
                $validation = true;
            }else{
                $validation = false;
            }

            return $validation;
        }

        // metodo que gera o sitemap em xml
        public static function geraXML($app){

            $dom = new \DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $urlset = $dom->createElement("urlset");
            $xmlns = $dom->createAttribute("xmlns");
            $xmlns->value = "http://www.sitemaps.org/schemas/sitemap/0.9";
            $xmlnsi = $dom->createAttribute("xmlns:image");
            $xmlnsi->value = "http://www.google.com/schemas/sitemap-image/1.1";
            $xmlnsm = $dom->createAttribute("xmlns:mobile");
            $xmlnsm->value = "http://www.google.com/schemas/sitemap-mobile/1.0";
            
            // home
            $url = $dom->createElement("url");
            $urlset->appendChild($url);
            $loc = $dom->createElement("loc",$app['CONFIG']['base']);
            $url->appendChild($loc);
            $priority = $dom->createElement("priority","1.000");
            $url->appendChild($priority);
            $changefreq = $dom->createElement("changefreq","daily");
            $url->appendChild($changefreq);

            // fale conosco
            $url = $dom->createElement("url");
            $urlset->appendChild($url);
            $loc = $dom->createElement("loc",$app['CONFIG']['base']."fale-conosco/");
            $url->appendChild($loc);
            $priority = $dom->createElement("priority","1.000");
            $url->appendChild($priority);
            $changefreq = $dom->createElement("changefreq","monthly");
            $url->appendChild($changefreq);


            // trabalhe conosco
            $url = $dom->createElement("url");
            $urlset->appendChild($url);
            $loc = $dom->createElement("loc",$app['CONFIG']['base']."trabalhe-conosco/");
            $url->appendChild($loc);
            $priority = $dom->createElement("priority","1.000");
            $url->appendChild($priority);
            $changefreq = $dom->createElement("changefreq","monthly");
            $url->appendChild($changefreq);

            // venda seu imovel
            $url = $dom->createElement("url");
            $urlset->appendChild($url);
            $loc = $dom->createElement("loc",$app['CONFIG']['base']."contato/venda-seu-imovel/");
            $url->appendChild($loc);
            $priority = $dom->createElement("priority","1.000");
            $url->appendChild($priority);
            $changefreq = $dom->createElement("changefreq","monthly");
            $url->appendChild($changefreq);

            // dynamic content
            $paginas = Model\Pagina::findPaginas();
            foreach ($paginas as $pagina) {
                $url = $dom->createElement("url");
                $urlset->appendChild($url);
                $loc = $dom->createElement("loc",trim($app['CONFIG']['base'].str_replace("&","e",utf8_encode($pagina->objurl))."/"));
                $url->appendChild($loc);
                $priority = $dom->createElement("priority","1.000");
                $url->appendChild($priority);
                $changefreq = $dom->createElement("changefreq","monthly");
                $url->appendChild($changefreq);
            }

            $imoveis = Model\Imovel::findImoveis('',10000000000);
            
                $url = $dom->createElement("url");
                $urlset->appendChild($url);
                $loc = $dom->createElement("loc",trim($app['CONFIG']['base'].utf8_encode($imoveis[0]->produtotag)."/"));
                $url->appendChild($loc);
                $priority = $dom->createElement("priority","1.000");
                $url->appendChild($priority);
                $changefreq = $dom->createElement("changefreq","monthly");
                $url->appendChild($changefreq);
            foreach ($imoveis as $imovel) {
                $url = $dom->createElement("url");
                $urlset->appendChild($url);
                $loc = $dom->createElement("loc",trim($app['CONFIG']['base'].utf8_encode($imovel->produtotag)."/".str_replace("&","e",utf8_encode($imovel->objurl))."/".$imovel->id."/"));
                $url->appendChild($loc);
                $priority = $dom->createElement("priority","1.000");
                $url->appendChild($priority);
                $changefreq = $dom->createElement("changefreq","monthly");
                $url->appendChild($changefreq);
            }
            

            $empreendimentos = Model\Empreendimento::findEmpreendimentos();
            if($empreendimentos){
                $url = $dom->createElement("url");
                $urlset->appendChild($url);
                $loc = $dom->createElement("loc",trim($app['CONFIG']['base'].utf8_encode($empreendimentos[0]->produtotag)."/"));
                $url->appendChild($loc);
                $priority = $dom->createElement("priority","1.000");
                $url->appendChild($priority);
                $changefreq = $dom->createElement("changefreq","monthly");
                $url->appendChild($changefreq);
                foreach ($empreendimentos as $empreendimento) {
                    // & (ampersand) causa erros na geracao do xml
                    $url = $dom->createElement("url");
                    $urlset->appendChild($url);
                    $loc = $dom->createElement("loc",trim($app['CONFIG']['base'].utf8_encode($empreendimento->produtotag)."/".str_replace("&","e",utf8_encode($empreendimento->objurl))."/".$empreendimento->id."/"));
                    $url->appendChild($loc);
                    $priority = $dom->createElement("priority","1.000");
                    $url->appendChild($priority);
                    $changefreq = $dom->createElement("changefreq","monthly");
                    $url->appendChild($changefreq);
                }
            }

            // dynamic content

            $urlset->appendChild($xmlns);
            $urlset->appendChild($xmlnsm);
            $dom->appendChild($urlset);
            ob_clean();
            header("Content-Type: text/xml");
            print $dom->saveXML();            

            die;

        }

     
        // metodo que transforma em um json valido um objeto retornado do model do PHP-AR
        public static function toJSON($data, $options = null){            
                $temp = array();
                // caso precise de uma lista de imoveis em formato json
                foreach ($data as $row) {
                    // corre a lista e converte para array o objeto (o ORM retorna uma array de objetos, sendo cada registro um obj)
                    $aTemp = $row->to_array();
                    foreach ($aTemp as $key => $value) {
                        // para cada item do objeto convertido, verifica se eh uma string e converte para utf8
                        if(is_string($aTemp[$key])){                            
                            $aTemp[$key] = $value;
                        }
                    }
                    // usar json_decode(jso_encode(var)) faz retornar um obj que herda os metodos do stdClass do php
                    // feito isso, tenho uma array de objetos novamente
                    array_push($temp, json_decode(json_encode($aTemp)));
                }

                // transformo em json a array de objetos para retorno 
                $jsonItens = json_encode($temp);

                return $jsonItens;
        }

        public static function toJSON2($data, $options = null){            
                $temp = array();
                // caso precise de uma lista de imoveis em formato json
                foreach ($data as $row) {
                    // corre a lista e converte para array o objeto (o ORM retorna uma array de objetos, sendo cada registro um obj)
                    $aTemp = $row->to_array();
                    foreach ($aTemp as $key => $value) {
                        // para cada item do objeto convertido, verifica se eh uma string e converte para utf8
                        if(is_string($aTemp[$key])){                            
                            $aTemp[$key] = utf8_encode($value);
                        }
                    }
                    // usar json_decode(jso_encode(var)) faz retornar um obj que herda os metodos do stdClass do php
                    // feito isso, tenho uma array de objetos novamente
                    array_push($temp, json_decode(json_encode($aTemp)));
                }

                // transformo em json a array de objetos para retorno 
                $jsonItens = json_encode($temp);

                return $jsonItens;            
        }


        public static function makeCache($content, $filename){
            // implementacao de cache
            // file_put_contents("cache/emps_map.json", $jsonItens);

            // monta o endereco do arquivo de cache
            $filename = "cache/".$filename;

            // gera a data atual e extrai o dia do ano
            $now = getdate();
            $today = date("z", $now[0]);

            // verifica se o arquivo existe
            if (file_exists($filename)) {
                // verifica o dia do ano da criacao do arquivo
                $fileBirth = date ("z", filemtime($filename));
                // se o arquivo de cache tem um dia de vida, atualiza
                if ($today > $fileBirth){
                    file_put_contents("cache/".$filename, $content);                    
                }
            }
        }

        public static function getCache($filename){
            // implementacao de cache
            $cache = false;

            // monta o endereco do arquivo de cache
            $filename = "cache/".$filename;

            // gera a data atual e extrai o dia do ano
            $now = getdate();
            $today = date("z", $now[0]);

            // verifica se o arquivo existe
            if (file_exists($filename)) {
                // verifica o dia do ano da criacao do arquivo
                $fileBirth = date ("z", filemtime($filename));
                // se o arquivo de cache tem um dia de vida, atualiza
                if ($today > $fileBirth){
                    // cache expirou
                    $cache = false;
                }else{
                    // cache valido
                    $cache = file_get_contents($filename);
                }
            }

            // retorno do cache
            return $cache;

        }        

        public static function removeAcentos($string) {
            $tr = strtr(

               $string,

                array (

                      'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
                      'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
                      'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
                      'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
                      'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
                      'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
                      'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
                      'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                      'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                      'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
                      'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r'
                )
            );

            return $tr;
        }

        public static function removeEspacos($string){
            return $str = str_replace(' ','-',$string);
        }

        public static function removeEspacosAcentos($string){
            return $str = self::removeEspacos(self::removeAcentos($string));
        }

        public static function removeCaracteresEspeciais($string){
            $string = preg_replace("/[áàâãä]/", "a", $string);
            $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
            $string = preg_replace("/[éèê]/", "e", $string);
            $string = preg_replace("/[ÉÈÊ]/", "E", $string);
            $string = preg_replace("/[íì]/", "i", $string);
            $string = preg_replace("/[ÍÌ]/", "I", $string);
            $string = preg_replace("/[óòôõö]/", "o", $string);
            $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
            $string = preg_replace("/[úùü]/", "u", $string);
            $string = preg_replace("/[ÚÙÜ]/", "U", $string);
            $string = preg_replace("/ç/", "c", $string);
            $string = preg_replace("/Ç/", "C", $string);
            $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
            $string = preg_replace("/ /", "_", $string);
            return $string;
        }

        // metodo de saida de debug de uma varivel
        public static function dbg($var){
            try{
                echo "dump:";
                echo "<pre>";
                print_r($var);
                echo "</pre>";
                die;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public static function handleFavoritos($app){            
            $tipo   = (!empty($_POST['tipo']) ? $_POST['tipo'] : "");
            $id     = (!empty($_POST['id']) ? $_POST['id'] : ""); 
            $remove = 1;  

            if (isset($_COOKIE['favoritos'])){
                $favoritos = unserialize($_COOKIE['favoritos']);

                if ($tipo) {
                    if ($id) {

                        //verifica a existencia do tipo no cookie, se não existir, cria o tipo
                        if (!isset($favoritos['favoritos'][$tipo])) {
                            $favoritos['favoritos'][$tipo] = array(); 
                        } 

                        $key = array_search($id, $favoritos['favoritos'][$tipo]);                        

                        if ($key === false) {//se item não existe                            
                            array_push($favoritos['favoritos'][$tipo], $id);                            
                        }else{//se item existe remove da lista
                            unset($favoritos['favoritos'][$tipo][$key]);                           
                            $remove = 2;
                            //$favoritos['favoritos'][$tipo] = array_values($favoritos['favoritos'][$tipo]);
                        }
                    }
                }
            
            } else {
                $favoritos = array('favoritos' => array( $tipo => array())); 
                array_push($favoritos['favoritos'][$tipo], $id); 
                //$remove = 1; 
            }

            setcookie('favoritos', serialize($favoritos), time() + (86400 * 365), '/');
            return $remove;            
        }
  
        public static function getFavsList(){
            if(!empty($_COOKIE['favoritos'])){
                
                $favs = unserialize($_COOKIE['favoritos']);
                if(!empty($favs['favoritos'])){
                    if(!empty($favs['favoritos']['imovel'])){
                        $imovel_ids = implode(',',$favs['favoritos']['imovel']);
                        $return = Model\Imovel::findImoveisMinified(null,$imovel_ids);
                    }
                    if(!empty($favs['favoritos']['empreendimento'])){
                        $empreendimento_ids = implode(',',$favs['favoritos']['empreendimento']);
                    }

                    return $return;
                    
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public static function getFavs(){
            return unserialize($_COOKIE['favoritos']);
        }

        public static function closeConnection(){
            return Model\Param::closeConnection();  
        }

        public static function getInfo($app){
            phpinfo();
            Util::dbg('x');
            
        }

        public static function getAPI($path){
            /**
            *   @TO_DO: 
            *   criar a funcionalidade utilizando o comando curl do php 
            *   para enviar consultas para a API. 
            *   
            *   por enquanto estou usando o file_get_contents mesmo. 
            *
            */

            $retorno = file_get_contents($path); 

            return $retorno ? $retorno : false;  
        }

        // public static function linkEspecial($app){
        //     self::dbg("adasddad"); 
        //     return $app->redirect('/prontos/?bairro[]=1&filtroNome=Barra%20da%20Tijuca'); 
        // }

        public static function paginationParams($obj, $itensPorPag){
            //realiza os calculos padrão de paginação para "todas" as listagens 
            /*
            $obj->totalCount;
            $obj->page;
            */
            $obj->pagcount = count($obj->items);
            $obj->totalpages = ceil($obj->totalCount / $itensPorPag);
            if($obj->pagcount > 0 ){
                $obj->maxpag = $obj->pagesize * ( $obj->page - 1 ) + $obj->pagcount;
                $obj->minpag = ($obj->page > 1 ) ? ($obj->maxpag - $obj->pagesize) + 1 : 1;    
            }else{
                $obj->minpag = 0;
                $obj->maxpag = 0;
            }
        }

        public static function getMonthName($monthNumber=false){
            if (!$monthNumber)
                return false; 

            switch ($monthNumber) {
                case '1':
                    return array('nome' => 'Janeiro', 'abreviacao' => 'Jan'); 
                    break;
                 case '2':
                    return array('nome' => 'Fevereiro', 'abreviacao' => 'Fev'); 
                    break;
                 case '3':
                    return array('nome' => 'Março', 'abreviacao' => 'Mar'); 
                    break;
                 case '4':
                    return array('nome' => 'Abril', 'abreviacao' => 'Abr'); 
                    break;
                 case '5':
                    return array('nome' => 'Maio', 'abreviacao' => 'Mai'); 
                    break;
                 case '6':
                    return array('nome' => 'Junho', 'abreviacao' => 'Jun'); 
                    break;
                 case '7':
                    return array('nome' => 'Julho', 'abreviacao' => 'Jul'); 
                    break;
                 case '8':
                    return array('nome' => 'Agosto', 'abreviacao' => 'Ago'); 
                    break;
                 case '9':
                    return array('nome' => 'Setembro', 'abreviacao' => 'Set'); 
                    break;
                 case '10':
                    return array('nome' => 'Outubro', 'abreviacao' => 'Out'); 
                    break;
                 case '11':
                    return array('nome' => 'Novembro', 'abreviacao' => 'Nov'); 
                    break;
                 case '12':
                    return array('nome' => 'Dezembro', 'abreviacao' => 'Dez'); 
                    break;
                
                default:
                    return false; 
                    break;
            }
        }
    }