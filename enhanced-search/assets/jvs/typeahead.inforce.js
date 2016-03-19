
function getData(finalidade, tipo){  	
  if(typeof tipo == "undefined" || tipo == ""){tipo = 'null';}
    /*
  		rotina utilizando o sistema de template hogan para retornar a lista 
  		para o typeahead. Gera uma lista de links atrelados a uma funcao 
  		(callSearch) que fará um post para a rota determinada.

  		Dentro da var retorno temos blocos, e cada um eh objeto JSON e uma 
  		listagem diferente. O campo prefetch e o que diz: ele popula 
  		previamente com os dados capturados pela url, uma rota que serve
  		apenas para retornar os dados.
  	*/    
      var retorno = [
      {
        header: '<h3 class="header_typeahead">Por Cidade</h3>',
        prefetch: {
          url: '/ws/buscaCidades/'+finalidade+'/'+tipo+'/buscaCidades_tipo='+tipo,
          ttl: 0
        },
        template: [
          //'<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'"  data-nome="{{nome}}" data-tipo="'+tipo+'" data-cidade="{{url}}">{{nome}}</a>'
          '<a  class="typeahead-custom-filter" data-finalidade="'+finalidade+'"  data-nome="{{nome}}" data-tipo="'+tipo+'" data-cidade="{{url}}">{{nome}}</a>'
        ].join(''),
        engine: Hogan
      },
      {
        header: '<h3 class="header_typeahead">Por Bairro</h3>',
        prefetch: {
          url: '/ws/buscaBairros/'+finalidade+'/'+tipo+'/buscaBairros_tipo='+tipo,
          ttl: 0
        },
        template: [
          //'<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'"  data-nome="{{nome}}" data-tipo="'+tipo+'" data-bairro="{{url}}">{{nome}} ({{total}})</a>'
          '<a class="typeahead-custom-filter" data-full-url ="{{fullurl}}" data-locid="{{locid}}" data-finalidade="'+finalidade+'"  data-nome="{{nome}}" data-tipo="'+tipo+'" data-bairro="{{url}}">{{nome}} ({{total}})</a>'
        ].join(''),
        engine: Hogan
      },
      
      // {
      //   header: '<h3 class="header_typeahead">Por Condomínios</h3>',
      //   prefetch: {
      //     url: '/ws/buscaConds/'+finalidade+'/'+tipo+'/buscaConds_tipo='+tipo,
      //     ttl: 0
      //   },
      //   template: [
      //     '<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'"  data-nome="{{nome}}" data-tipo="'+tipo+'" data-cond="{{url}}" data-cond-nome="{{value}}">{{nome}}</a>'
      //   ].join(''),
      //   engine: Hogan
      // },
      // {
      //   header: '<h3 class="header_typeahead">Por Empreendimento</h3>',
      //   prefetch: {
      //     url: '/ws/buscaEmps/'+finalidade+'/'+tipo+'/buscaEmps_tipo='+tipo,
      //     ttl: 0
      //   },
      //   template: [
      //     '<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'" data-nome="{{nome}}" data-tipo="'+tipo+'" data-emp="{{url}}" data-emp-nome="{{value}}">{{nome}}</a>'
      //   ].join(''),
      //   engine: Hogan
      // }
    ];
    console.log(retorno);
    return retorno; 
}

function getCodigo(){
      var retorno = [
      {
        header: '<h3 class="header_typeahead">Por Código</h3>',
        prefetch: {
          url: '/ws/buscaCodigos/',
          ttl: 0
        },
        template: [
          '<a href="{{url}}" onclick="redirect(\'{{url}}\')" class="typeahead-custom-filter">{{value}}</a>'
        ].join(''),
        engine: Hogan
      }
    ]; 

    return retorno; 
}

function getEmpreendimento(finalidade, tipo){
      var retorno = [
      {
        header: '<h3 class="header_typeahead">Empreendimentos</h3>',
        prefetch: {          
          url: '/ws/buscaEmps/'+finalidade+'/'+tipo+'/buscaEmps_tipo='+tipo,
          ttl: 0
        },
        template: [
          '<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'" data-nome="{{nome}}" data-tipo="'+tipo+'" data-emp="{{url}}" data-emp-nome="{{value}}">{{nome}}</a>'
        ].join(''),
        engine: Hogan
      }
    ];
    return retorno; 
}

function redirect(url){
	window.location = url;
}


function callSearch(ele){
  debugger
  $(".bt-buscar").prop({
    disabled: 'disabled'    
  });
	/*
		rotina disparada quando se clica em algum item retornado pelo typeahead ou tag de remoção de filtros,
		e monta um form para postar para a rota os paramentros da busca. A rota POST
		então recebe os paramentros, chama o controller adequado e retorna o conteudo
		da busca em uma listagem.
	*/

  /* .search-form -  classe presente na busca da home e no filtro lateral */
  
  //debugger

    var dataFin = $(ele).attr("data-finalidade"); //lancamento, pronto etc..
    var dataTipo = $(ele).attr("data-tipo"); //id(s) do(s) tipo(s) -- casa, apartamento etc
    var dataBairro = $(ele).attr("data-bairro"); //id do item atual de tipo bairro
    var dataCidade = $(ele).attr("data-cidade");
    var dataNome = $(ele).attr("data-nome");
    var dataRemocao = $(ele).attr("data-remover"); //tag que indica se item vai ser removido


    var dataEmp = $(ele).attr("data-emp");
    var dataCond = $(ele).attr("data-cond");

    var action = "/"+dataFin+"/";
    (dataTipo !="null")? $(".search-form input[name='Tipos']").val(dataTipo) :$(".search-form input[name='Tipos']").remove();
    (dataFin !="null") ? $(".search-form input[name='finalidade']").val(dataFin) : $(".search-form input[name='finalidade']").remove();
    (dataNome !="null") ? $(".search-form input[name='filtroNome']").val(dataNome) : $(".search-form input[name='filtroNome']").remove();

    //bairro // new 2016
    if(dataBairro>0){ //igual ao de cidade --> UNIFICAR
      handleTags('bairro',dataBairro,dataRemocao, dataNome);
    }else{
      //se nao selecionar um bairro, removo requisicao?
      //$(".search-form input[name='bairro']").remove();
    }
    
    //cidade // new 2016
    if (dataCidade>0){
      //filtroTipo, id, dataRemocao, nome
      handleTags('cidade',dataCidade,dataRemocao, dataNome);
    }else{
      //se nao selecionar uma cidade, removo requisicao?
      //$(".search-form input[name='cidade']").remove();
    }

    // empreendimento // old 2015
    if(dataEmp>0){
    	if(dataFin=='lancamentos'){
	    	dataEmpNome = $(ele).attr("data-emp-nome");
	    	dataEmpNome = dataEmpNome.replace(/ /g, "+").toLowerCase();
	    	dataEmpNome = dataEmpNome.replace(/\//g, "-").toLowerCase();
	    	window.location = "/"+dataFin+"/"+dataEmpNome+"/"+dataEmp;
	    	return false;

    	}else{
	    	dataEmpNome = $(ele).attr("data-emp-nome");
	    	dataEmpNome = dataEmpNome.toLowerCase();
	    	$(".search-form input[name='empreendimento_nome']").val(dataEmpNome);
    	}
    }

    // condominio  // old 2015
    if(dataCond>0){
    	dataCondNome = $(ele).attr("data-cond-nome");
    	dataCondNome = dataCondNome.toLowerCase();
    	$(".search-form input[name='condominio_nome']").val(dataCondNome);
    }

    
    if($("#main-search").size() > 0){ //se estiver na home
      $("#main-search").attr("action", action);
      $("#main-search").submit();
    }else{ // filtro lateral
      doSearch($("form#filtro-lateral"));  
    }   
    
   
    
}

// rotina de verificação e configuracao 
// da barra de busca em caso existirem dados
// verifica a rota
// TCK#2845
function setFields(){ // not checked 2016
	// return false;

  	var busca_finalidade = $("#selFinalidade").val();

  	var busca_tipo = $("#tags_container .tag[data-tipo='tipo']").attr("data-id");

    // exibe a lista de tipos referente a finalidade
    $("#main-search .produto-tipo").css("display","none");
    $("#main-search .assoc-"+busca_finalidade).css("display","block");

    if(busca_tipo==undefined) busca_tipo = "null";
    $(".produto-tipo.assoc-"+busca_finalidade+" select").val(busca_tipo);

    // dispara o evento 'change' para atualizar o hogan/typeahead da regiao
    // $("#main-search .produto-finalidade").trigger("change");
    // $("#main-search .produto-tipo select").trigger("change");
    $("#main-search .produto-tipo.assoc-"+busca_finalidade+" select").trigger("change");

	// return false;
}
// TCK#2845

function handleTags(filtroTipo, id, dataRemocao, filtroNome){ //trata remoção e inserção de tags de filtro
  /*** exemplos de entrada ****   /
      filtroTipo : cidade
      id : 34
      dataRemocao : true
      filtroNome : Rio de Janeiro
  /*****/
  $(".search-form input[name='"+filtroTipo+"']").val(function(i,val){
    //verifica se objeto está sendo removido ou adicionado
    var marcada = val.indexOf(";"+id+";");
    if(marcada >=0){//se já existe
      if(typeof dataRemocao !== undefined){  //e está marcada para exclusão
        val = val.replace(";"+id+";",";"); //remove cidade marcada
        $(".selected-filters").find("[data-"+filtroTipo+"='"+id+"']").remove(); //remove tag de item
      }
      //se nao nao faz nada..
      return val;
    }else{
      
      if($("#main-search").size() == 0){ //se NÃO estiver na home
        //adiciona filtro a itens marcados
        $(".selected-filters").append('<li data-type="'+filtroTipo+'" data-remover="true" onclick="callSearch(this)" data-'+filtroTipo+'="'+id+'" data-id="'+id+'"> '+filtroNome+' <a ><img src="theme/images/cross2.png" alt=""></a></li>');
      }
      return val +';'+ id+';';
    }
  });
}