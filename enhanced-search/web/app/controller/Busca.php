<?php

    namespace Controller;

    use Model;
    use Lib\Util;

	class Busca {

   
        public static function buildFiltroLateral($entidade){ 

            /**
            *   parâmetros imovel, empreendimento ou imovel-locacao
            *
            *   o método buildFiltroLateral é responsável por gerar um array final com 
            *   os valores necessários para preencher os campos do filtro lateral. 
            *
            */

            $filtroLateral = array();

            // imovel prontos
            if($entidade=="imovel"){
                
                // seta o primeiro parametro, que define para qual produto vai o filtro
                $filtroLateral["produto"] = "imovel";

                // cria uma array de filtros, que são listas com ID/NOME
                $filtros = Array(
                    'tipo' => Model\Imovel::findTipos(),                    
                    'cidade' => Model\Imovel::findCidades('prontos'),
                    'bairro' => Model\Imovel::findBairros('prontos'),
                    'valor' => Model\Imovel::findValores('prontos'), 
                    'quartos' => Model\Imovel::findQuartos(),
                    'condominio' => Model\Imovel::listCondominios('prontos')
                );   

                $filtroLateral["filtros"] = $filtros;
            }

            // empreendimento
            if($entidade=="empreendimento"){
                // seta o primeiro parametro, que define para qual produto vai o filtro
                $filtroLateral["produto"] = "empreendimento";

                // cria uma array de filtros, que são listas com ID/NOME
                $filtros = Array(
                    'tipo' => Model\Empreendimento::findTipos('prontos'),
                    'cidade' => Model\Empreendimento::findCidades(),
                    'bairro' => Model\Empreendimento::findBairros(),
                    // 'valor' => Model\Empreendimento::findValores(),
                    'quartos' => Model\Empreendimento::findQuartos(),
                    'status' => Model\Empreendimento::findStatus(),
                    //'incorporadoras' => Model\Empreendimento::listConstrutoras(),
                );

                $filtroLateral["filtros"] = $filtros;
            }


            // imovel locacao      
            if($entidade=="imovel-locacao"){
                // seta o primeiro parametro, que define para qual produto vai o filtro
                $filtroLateral["produto"] = "imovel";

                // cria uma array de filtros, que são listas com ID/NOME
                $filtros = Array(
                    'tipo' => Model\Imovel::findTipos('locacao'),
                    'cidade' => Model\Imovel::findCidades('locacao'),
                    'bairro' => Model\Imovel::findBairros('locacao'),
                    'valor' => Model\Imovel::findValores('locacao'),            
                    'quartos' => Model\Imovel::findQuartos(),
                    //'condominio' => Model\Imovel::listCondominios('locacao'),
                );   

                $filtroLateral["filtros"] = $filtros;
            }

            return $filtroLateral; 
        }

        public static function filtrar($app, $produto="", $finalidade="", $pag="1") {

            
            //isso deve vir de uma session
            $param = (!empty($_GET) ? $_GET : null);
            #print_r($param);
            //validação obrigtória de pagina e data

            $jObject = self::filtro($app, $produto, $finalidade, $param, $pag);

            $jObject->produto = (!empty($produto) ? $produto : "imovel"); 
            $jObject->produtotag = (!empty($finalidade) ? $finalidade : "prontos"); 
            
            //itens por pagina //
            $itensPorPag = (!empty($param['take']) ? $param['take'] : 12);
            //itens por pagina //

            Util::paginationParams($jObject, $itensPorPag);

            //Util::dbg($imoveis);
            
            $assets = array();             

            //carrega os blocos para essa página 
            $page = array(); 
                $page = array(
                    'template' => null, 
                    'content'  => $jObject
                );


            $scripts = array(); 
            //$scripts = array( 'assets/jvs/imoveis-init.js'); 


            $data = array(
                'page'      => $page, 
                'scripts'   => $scripts
            ); 

            return $app['twig']->render('base-filtro.twig.php', $data);
       }

        public static function filtro($app, $produto, $finalidade, $param, $pag){            
            //echo date('H:i:s').'<br>';
            /**
            *   @TO_DO: 
            *
            *  método responsável pelo filtro lateral e pelo filtro da home (qualquer filtro feito por ajax)
            *  terminar esse método
            *  string Codigo
            *  string Regioes [ cidade-1; bairro-1 ; ]
            *  string Finalidade  [ enum 0 -  Prontos ]
            *  string Tipos
            *  string QtdQuarto [ ex: 1;2;3;4;100]
            *  string QtdSuite  [ ex: 1;2;3;4;100]
            *  string QtdWcSocial [ ex: 1;2;3;4;100]
            *  string QtdWcServico [ ex: 1;2;3;4;100]
            *  string QtdWcTotal [ ex: 1;2;3;4;100]
            *  string QtdVaga [ ex: 1;2;3;4;100]
            *  double? ValorMin
            *  double? ValorMax
            *  double? AreaMin
            *  double? AreaMax
            *  string Caracteristicas
            */

            #print_r($param);
            //possíveis parametros para 
            $opts = array(
                'take'             => (!empty($param['take'])             ? $param['take']         : 12),
                'nome'             => (!empty($param['nome'])             ? $param['nome']         : NULL),
                'Codigo'           => (!empty($param['Codigo'])           ? $param['Codigo']         : NULL),
                'Tipos'            => (!empty($param['Tipos'])            ? $param['Tipos']         : NULL),
                'Finalidade'       => (!empty($param['Finalidade'])       ? $param['Finalidade']    : "0"),
                'QtdQuarto'        => (!empty($param['QtdQuarto'])        ? $param['QtdQuarto']     : NULL),
                'QtdSuite'         => (!empty($param['QtdSuite'])         ? $param['QtdSuite']      : NULL),
                'QtdWcTotal'       => (!empty($param['QtdWcTotal'])       ? $param['QtdWcTotal']    : NULL),
                'QtdVaga'          => (!empty($param['QtdVaga'])          ? $param['QtdVaga']       : NULL),
                'ValorMin'         => (!empty($param['ValorMin'])         ? str_replace(array(',','.',' '),'', $param['ValorMin'])      : NULL),
                'ValorMax'         => (!empty($param['ValorMax']) && ($param['ValorMax'] != '5.000.000+')         ? str_replace(array(',','.',' '),'', $param['ValorMax'])      : NULL),
                'AreaMin'          => (!empty($param['AreaMin']) && ($param['AreaMin'] != '10')    ? str_replace(array(',','.',' '),'', $param['AreaMin'])       : NULL),
                'AreaMax'          => (!empty($param['AreaMax']) && ($param['AreaMax'] != '6.000+') ? str_replace(array(',','.',' '),'', $param['AreaMax']): NULL),
                'Caracteristicas'  => (!empty($param['Caracteristicas'])  ? $param['Caracteristicas']: NULL),
                'Regioes'          => NULL,
                'order'            => "",
            );  

            $opts['Finalidade'] = $finalidade == "locacao" ? "1" : "0"; 
            
            //echo date('H:i:s').'<br>';
           
            switch (@$param['order']) {
                case 'maior-valor':
                    $opts['order'] = "ValorVenda DESC, ValorLocacao DESC";
                    break;
                case 'menor-valor':
                    $opts['order'] = "ValorVenda ASC, ValorLocacao ASC";
                    break;
                case 'bairro-az':
                    $opts['order'] = "BairroNome ASC";
                    break;
                case 'bairro-za':
                    $opts['order'] = "BairroNome DESC";
                    break;
                case 'mais-quartos':
                    $opts['order'] = "QtdQuarto DESC";
                    break;
                case 'menos-quartos':
                    $opts['order'] = "QtdQuarto ASC";
                    break;
                case 'maior-area':
                    $opts['order'] = "AreaUtil DESC";
                    break;
                case 'menor-area':
                    $opts['order'] = "AreaUtil ASC";
                    break;                
            }
            if(!empty($param['cidade'])){
                $cidades = explode(';',$param['cidade']);
                foreach ($cidades as $value) {
                    if(!empty($value)){
                        $opts['Regioes'] .= 'cidade-'.$value.';';    
                    }
                }
            }
            //echo date('H:i:s').'<br>';
            if(!empty($param['bairro'])){
                $bairros = explode(';',$param['bairro']);
                foreach ($bairros as $value) {
                    if(!empty($value)){
                        $opts['Regioes'] .= 'bairro-'.$value.';';
                    }
                }
            }
            //echo date('H:i:s').'<br>';
            if(is_array($opts['Tipos'])){
                $opts['Tipos'] = implode(';', $opts['Tipos']);
            }
            //echo date('H:i:s').'<br>';
            if(is_array($opts['Caracteristicas'])){
                $opts['Caracteristicas'] = implode(';', $opts['Caracteristicas']);
            }
           

            if ($produto == "imovel") {                
                $url = $app['API']['paths']['imovel']['list']."?page=".$pag."&pagesize=".$opts['take']."&Finalidade=".$opts['Finalidade']."&Tipos=".$opts['Tipos']."&QtdQuarto=".$opts['QtdQuarto']."&QtdSuite=".$opts['QtdSuite']."&QtdWcTotal=".$opts['QtdWcTotal']."&QtdVaga=".$opts['QtdVaga']."&ValorMin=".$opts['ValorMin']."&ValorMax=".$opts['ValorMax']."&AreaMin=".$opts['AreaMin']."&AreaMax=".$opts['AreaMax']."&Regioes=".$opts['Regioes']."&Caracteristicas=".$opts['Caracteristicas']."&Codigo=".$opts['Codigo']."&Order=".rawurlencode($opts['order']);
            } else if ($produto == "empreendimento") {
                $url = $app['API']['paths']['empreendimento']['list']."?page=".$pag."&pagesize=".$opts['take']."&Tipos=".$opts['Tipos']."&QtdQuarto=".$opts['QtdQuarto']."&Nome=".$opts['nome']."&AreaMin=".$opts['AreaMin']."&AreaMax=".$opts['AreaMax']."&Regioes=".$opts['Regioes']."&ValorMin=".$opts['ValorMin']."&ValorMax=".$opts['ValorMax'];
            }

            #if ($_SERVER['REMOTE_ADDR'] == '177.129.9.98')
                #Util::dbg($url); 

            $json = file_get_contents($url);
            //echo date('H:i:s').'<br>';

            $obj = json_decode($json); 
            if ($produto == "imovel")
                $obj->finalidadelabel = $opts['Finalidade'] == "1" ? 'Locação' : 'Pronto'; 
            else
                $obj->finalidadelabel = "Lançamento"; 

            //if ($_SERVER['REMOTE_ADDR'] == '177.129.9.98')
                //Util::dbg($obj); 

            return $obj;
        }
   
        // metodo que busca o imovel pelo codigo
        public static function getFirstImovel($app, $cod){

            $opt = array('conditions' => array('codigo = ?', $cod));
            $imovel = Model\Imovel::find($opt);

            $url = (empty($imovel) ? 0 : $app['CONFIG']['base'].'prontos/_/'.$imovel->imovelid); 
            return $url;
        }


        // metodo que retorna lista de codigos disponiveis
        public static function getCodigos($app){

            $temp = Model\Imovel::searchImoveisPorCodigo($app);

            $codigos = array();
            foreach ($temp as $i) {
                $url = "";
                $codigo = new \stdClass;

                $tipologia = "";
                $finalidade = "";
                $cidade = "";
                $bairro = "";

                if($i->valorvenda > 0){
                    $url = "/prontos/".utf8_encode($i->objurl)."/".$i->id;
                }elseif($i->valorlocacao > 0){
                    $url = "/locacao/".utf8_encode($i->objurl)."/".$i->id;
                }

                $codigo->url = $url;
                $codigo->value = $i->codigo;
                #$codigo->tokens = array($i->codigo, (string)$i->id, (string)preg_replace("/[^0-9]/","",$i->codigo));
                
                $c = 0;
                $test = array();

                while( ($c+1) < strlen($i->codigo) ){
                    array_push($test, substr($i->codigo, $c));
                    $c++;
                }
                
                $codigo->tokens = array($i->codigo, (string)$i->id);
                $codigo->tokens = array_merge($codigo->tokens, $test);

                array_push($codigos, $codigo);
            }

            return json_encode($codigos);
        }


        public static function getListImoveisBusca($app, $format=null){
            //Util::dbg($_POST);
            $options = $_POST;
            $options['limit'] = 150;
            $imoveis = Model\Imovel::searchImoveis($app, $options);

            $data = array(
                'template' => null,
                'content' => $imoveis
            );            

            $temp = array();
            if($format=='json'){
                // caso precise de uma lista de imoveis em formato json
                foreach ($imoveis as $imovel) {
                    // corre a lista e converte para array o objeto (o ORM retorna uma array de objetos, sendo cada registro um obj)
                    $aTemp = $imovel->to_array();
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
                
                return json_encode($temp);
                die;

                // Util::dbg((($temp)));
                // return Util::toJSON($temp);
            }else{
                return $app['twig']->render('tpl/page-interna-lista-busca.twig.php', $data);                
            }

        }


        public static function getListEmpreendimentosBusca($app, $format=null){
                    //Util::dbg($_POST);

            $empreendimentos = Model\Empreendimento::searchEmpreendimentos($app, $_POST);
           // Util::dbg($empreendimentos);

            if(empty($empreendimentos)){
                //Pagina::getPage404($app);
            }

            $data = array(
                'template' => null,
                'content' => $empreendimentos
            );            

            $temp = array();
            if($format=='json'){
                // caso precise de uma lista de imoveis em formato json
                foreach ($empreendimentos as $empreendimento) {
                    // corre a lista e converte para array o objeto (o ORM retorna uma array de objetos, sendo cada registro um obj)
                    $aTemp = $empreendimento->to_array();
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
                die;

                // Util::dbg((($temp)));
                // return Util::toJSON($temp);
            }else{

                //Util::dbg($data);
                return $app['twig']->render('tpl/page-interna-lista-busca.twig.php', $data);
            }

        }

   
        public static function getBairros($app, $finalidade, $tipo, $cidadeid = null){            
            if($finalidade=='lancamentos'){
                $bairros = Model\Empreendimento::findBairros($tipo, $cidadeid);
            }else{
                $bairros = Model\Imovel::findBairros($finalidade, $tipo, $cidadeid);
            }           
            
            //gambers para remover problemas de encoding na busca lateral 
            //para a busca da home a função toJSON é usada
            if($cidadeid != null){
                return Util::toJSON2($bairros);
            }else{
                return Util::toJSON($bairros);
            }          
        }

        public static function getCidades($app, $finalidade, $tipo){

            if($finalidade=='lancamentos'){
                $cidades = Model\Empreendimento::findCidades($tipo);

            }else{
                $cidades = Model\Imovel::findCidades($finalidade, $tipo);
            }

            return Util::toJSON($cidades);

        }

        public static function getEmps($app, $finalidade, $tipo){

            if($finalidade=='lancamentos'){
                $empreendimentos = Model\Empreendimento::findEmps($tipo);
                return Util::toJSON($empreendimentos);

            }else{
                $imoveis = Model\Imovel::findConds($finalidade, $tipo, 'empreendimento');
                return Util::toJSON($imoveis);
            }


        }


        public static function getConds($app, $finalidade, $tipo){

            if($finalidade=='lancamentos'){
                return 0;

            }else{
                // $imoveis = Model\Empreendimento::findEmps($tipo);
                $imoveis = Model\Imovel::findConds($finalidade, $tipo, 'condominio');
                return Util::toJSON($imoveis);
            }

        }

	}
