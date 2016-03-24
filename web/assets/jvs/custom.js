// Declare js vars
var flagBusca;
var productList;
var productList2;
var filter = {};


// js para acertar o pre header fixo
window.onload = scroll;
window.onscroll = scroll;
function scroll () {
	var eleTop = 0;
	$('.pre-footer').show(function(){
		eleTop = $('.pre-footer').offset().top;
	});

	var elePos = (eleTop - window.innerHeight);
	if(window.pageYOffset > elePos){
		$("#fixed-steps").css("display","none");
	}else{
		$("#fixed-steps").css("display","block");
	}
}

var menuHover = 0;

function mostraBairros(tipo, cidade){

	if(typeof tipo == undefined){
		tipo = null;
	}

	var finalidade = $('.sidebar').attr('data-ws'); //empreendimento ou imovel
	
	if (finalidade == 'buscaImoveis'){
		finalidade = 'prontos';
	}else if(finalidade =='buscaEmpreendimentos'){
		finalidade = 'lancamentos';
	}


	$.ajax({
		url: '/ws/buscaBairros/'+finalidade+'/'+tipo +'/'+cidade,
		type: 'POST',
		dataType: 'json',
	})
	.done(function(data) {
		console.log(data);
		$('select[name=select_bairro]').empty(); //limpa opcoes
		$('select[name=select_bairro]').append('<option class="opt {{tipo}}" value="NULL">-Selecione-</option>');
		$(data).each(function(index, el) {
			$('select[name=select_bairro]').append('<option class="opt bairro" id="bairro_'+index+'" data-tipo="bairro" data-id="'+el.id+'" data-valor="'+el.nome+'" data-index="'+index+'" value="'+index+'">'+el.nome+'</option>');
		});
		$(".hidden-filter").show('slow');
	});
}

$(window).load(function(){
	/* FAVORITOS */
	/*
	*	@favs
	*	Adiciona ao cookie 'favoritos' o elemente clicado, dentro de seu tipo correspondente	
	*
	*/
	$('.like, .like_hover').click(function(){
		
		var id = $(this).attr('data-id');
		var tipo = $(this).attr('data-tipo');
		var el = $(this);

		$.post('/ws/adicionaFavoritos/', {tipo: tipo, id: id}, function(data, textStatus, xhr) {			
		}).done(function(data){
			if(data == 1){
				toastr.success('Item adicionado com sucesso');				
				$(el).removeClass('like').addClass('like_hover'); 	
			}else if(data == 2){
				toastr.error('Item removido com sucesso'); //apenas usa o estilo de erro para reportar uma remoção
				$(el).removeClass('like_hover').addClass('like');
			}
		});
	});
	/* FAVORITOS */

	/* BAIRROS POR CIDADE */
	$('.barra-lateral').on('change','.selectBox-dropdown[name=select_cidade]',function(){		
		var cidade = $(this ).find('option:selected').attr('data-id');

		console.log(cidade);		
		var tipo = null;		

		if(typeof cidade != undefined){ //se uma cidade válida for marcada
			mostraBairros(tipo, cidade);
		}
	});

	/* BAIRROS POR CIDADE */

	/* CLIQUE NA BOX DO PRODUTO  */

	/* HOME */
	$(".immoval_Box :not(.like), .immoval_Box :not(.like_hover)").click(function(){
		var link = $(this).find('.immoval_btn').attr('href');
		console.log(link);
		if(typeof link != "undefined"){
			//console.log('contem');
			window.location = link;
		}
	});
	/* HOME */

	/* LISTAGEM */
	$(".dit_sec").click(function(e){

		//item "favoritar"
		var img = $(this).find('a.like, a.like_hover');		
		/*	
		* 	e.target indica exato elemento que foi clicado
		*	key 0 indica o elemento HTML, necessário para essa comparação
		*/		
		if(e.target !== img[0]){ 
			var link = $(this).find('.end_btn a').attr('href');
			if(typeof link != "undefined"){				
				window.location = link;
			}
		}
	});
	/* LISTAGEM */
	/* CLIQUE NA BOX DO PRODUTO */
});

// Custom js functions and inits
$(document).ready(function(){
	// bugfix // hide forms from bots
	$("input[data-value='contato']").each(function(){
		$(this).css("display","none");
	});

	//habilita fancybox e tooltip
	$("a.fancybox-button, .fancybox-button").fancybox();
	$(".chat_box_Right img").tooltip({title: "Em breve!", placement: "top"});

	//"ouve" a eventos que ain
	$('body').on('DOMNodeInserted', 'div', function () {
      	$('.share, .print').tooltip({title: "Em breve!", placement: "auto"});
      	$("a.fancybox-close").click(function(){
			$.fancybox.close();
		});
	});
	$("li.servicos").tooltip({title: "Em breve!", placement: "bottom"});

		
	//INDIQUE / INTERESSADO BUTTON

	$('.indique').click(function() {
		$('.block-interessado').hide(); 
		$('.block-indique').show(); 
		$('html,body').animate({ scrollTop: $('#map').offset().top - 80}, 800);
	}); 

	$('.interessado').click(function() {
		$('.block-indique').hide(); 
		$('.block-interessado').show(); 
		$('html,body').animate({ scrollTop: $('#map').offset().top - 80}, 800);
	}); 

	/*$(".like, .share").on('click', function(){
		$(this).parent().tooltip('Em breve!');
		console.log('entrei');
	});*/
	$('.chat_box_Right').hover(function(){
		$(this).find('img').attr('src','theme/images/chat_icon2.png');
	},function(){
		$(this).find('img').attr('src','theme/images/chat_icon.png');
	});

	
	// bugfix metronic // menu dropdown
	$(".menu-principal li.dropdown").hover(function() {
		$(".dropdown-menu").css("visibility","hidden");							
		$(this).find(".dropdown-menu").css("visibility","visible");
	},function(){
		$(".dropdown-menu").css("visibility","hidden");									
	});

	
	// na pagina de listagem de imoveis ou empreendimentos

		// rotina para detectar imagens não carregadas
		$('.imovel.produto-lista .pi-img-wrapper .img-responsive, .imovel.produto-interna .product-main-image .img-responsive').error(function(){

			var id = $(this).attr("data-id");
			var route = "/ws/getImgCapa/imovel/" + id;
			// getImageCapa(id, route);

		});

		$('.empreendimento.produto-lista .pi-img-wrapper .img-responsive, .empreendimento.produto-interna .product-main-image .img-responsive').error(function(){

			var id = $(this).attr("data-id");
			var route = "/ws/getImgCapa/empreendimento/" + id;
			getImageCapa(id, route);

		});
		// ------------------------------------------------


		// gera paginador onload
		productList = geraPaginacao($("#products-per-page").val());
		// gera paginador onchange do select
		$("#products-per-page").change(function(){
			productList = geraPaginacao($(this).val());
		});



		// seta a ordem da lista
		$(".select-order").change(function(){ 
			var value = $(this).val();
			var aValue = value.split("_");
			productList.sort(aValue[0], { order: aValue[1] });
		});

		// exibir em lista ou em grade
		$("#produto-lista-filled a.grade").click(function(){
			$("#partial-list").removeClass("lista");
			$("#partial-list").addClass("grid");
		});
		$("#produto-lista-filled a.lista").click(function(){
			$("#partial-list").removeClass("grid");
			$("#partial-list").addClass("lista");
		});


		// rotina do filtro lateral
		// $("#filtro-lateral .opt").click(function(){			//metodo tradicional
		$("#filtro-lateral select").change(function(){				//metodo moradamg #TCK3225
			var ele = $(this);
				ele = $(this).children("option:selected");			// metodo moradamg #TCK3225

			var service = $("#filtro-lateral").attr("data-ws");

			var tipo = $(ele).attr("data-tipo");
			var valor = $(ele).attr("data-valor");
			var id = $(ele).attr("data-id");
			var idx = $(ele).attr("data-index");

			if(valor==undefined){
				return null;
			}

			$("#produto-lista-filled").css("opacity","0.3");
			$("#loader-spinner").css("display","block");

			// em caso de imovel, setar finalidade
			var finalidade = $("#imovel_finalidade").attr("data-venda-locacao");
			if (finalidade==undefined){/*do nothing*/}else{
				filter['finalidade'] = finalidade;
			}

			// tratamento da var global filter para enviar um json no formato tipo : id para a busca # ex: { bairro : 2 }
			if (filter[tipo]==undefined){
				filter[tipo] = "0,"+id;				
			}else{
				filter[tipo] = filter[tipo]+","+id;
			}

			// certas tags tem tratamento diferente
			// tags do tipo valor por exemplo
			if(tipo=='valor'){
				filter[tipo] = id;

				// remove as outras tags do tipo valor
				$("#tags_container .tag").each(function(){
					var tipo = $(this).attr("data-tipo");
					var id = $(this).attr("data-id");
					var idx = $(this).attr("data-index");
					if(tipo=='valor'){
						$(this).remove();
						$("#"+tipo+"_"+idx).css("display","block");
					}
				});
			}

			$("#tags_container").append('<span class="tag" data-index="'+idx+'" data-tipo="'+tipo+'" data-valor="'+valor+'" data-id="'+id+'">'+valor+'</span>');
			$("#"+tipo+"_"+idx).css("display","none");

			dataPost = filter;

			// verifica se a variavel sinalizadora do filtro esta ativa
			// ou seja, aguardando uma resposta ajax
	        if(flagBusca && flagBusca.readyState !== 4){
	            // se estiver aguardando, cancela os filtros anteriores e carrega o atualizado
	            flagBusca.abort();

				flagBusca = $.post( "/ws/"+service+"/", dataPost )
					.done(function( dataResponse ) {

						$("#full-list").html( dataResponse );
						productList = geraPaginacao($("#products-per-page").val());
						setFields(); //TCK#2845
						
					})


	        }else{
				flagBusca = $.post( "/ws/"+service+"/", dataPost )
					.done(function( dataResponse ) {

						$("#full-list").html( dataResponse );
						productList = geraPaginacao($("#products-per-page").val());
						setFields(); //TCK#2845
						
					});
			}

		});
		$(document).on('click', "#tags_container .tag", function(){

			$("#produto-lista-filled").css("opacity","0.3");
			$("#loader-spinner").css("display","block");

			var service = $("#filtro-lateral").attr("data-ws");

			var tipo = $(this).attr("data-tipo");
			var valor = $(this).attr("data-valor");
			var id = $(this).attr("data-id");
			var idx = $(this).attr("data-index");

			// certas tags tem tratamento diferente
			if(tipo=='valor'){
			// tags do tipo valor por exemplo
				filter[tipo] = undefined;				
			}else{

				if ((filter[tipo]==("0,"+id)) || (filter[tipo]==undefined)){
					filter[tipo] = undefined;				
				}else{
					if(filter[tipo].indexOf(",0") > 0){
						filter[tipo] = filter[tipo].replace(","+id+",", ",");
						filter[tipo] = filter[tipo].replace(",0", "");
					}else{
						filter[tipo] = filter[tipo]+",0";
						filter[tipo] = filter[tipo].replace(","+id+",", ",");
						filter[tipo] = filter[tipo].replace(",0", "");
					}
				}
			}			


			$(this).remove();			
			$("#"+tipo+"_"+idx).css("display","block");

			dataPost = filter;

	        if(flagBusca && flagBusca.readyState !== 4){
	            // se estiver aguardando, cancela os filtros anteriores e carrega o atualizado
	            flagBusca.abort();
				flagBusca = $.post( "/ws/"+service+"/", dataPost )
					.done(function( dataResponse ) {

						$("#full-list").html( dataResponse );
						productList = geraPaginacao($("#products-per-page").val());
						setFields(); //TCK#2845
						
					});

	        }else{
				flagBusca = $.post( "/ws/"+service+"/", dataPost )
					.done(function( dataResponse ) {

						$("#full-list").html( dataResponse );
						productList = geraPaginacao($("#products-per-page").val());
						setFields(); //TCK#2845
						
					});
			}
			

		});		


	// masks
	$(".input-telefone").mask('(99) Z9999-9999', {
	    translation: {
    	  'Z': { pattern: /[0-9]/, optional: true }
    	}
  	});

	$(".input-moeda").mask('#.##0', {
		reverse: true,
	    translation: {
    	  'Z': { pattern: /[0-9]/, optional: true }
    	}
  	}).blur(function(){
			var value = $(this).val();
			if(value==""){}else{
				$(this).val('R$ ' + value);
			}
		})
		.focus(function(){
			$(this).val("");
		});

	$(".input-area").mask('#.##0', { reverse: true })
		.blur(function(){
			var value = $(this).val();
			if(value==""){}else{
				$(this).val( value + ' m²' );
			}
		})
		.focus(function(){
			$(this).val("");
		});
	//masks

	// ajuste de altura do bg de uma das vitrines
	// $(".ecommerce .main").css("background-position", "center "+$(".vitrine-imoveis-prontos-3").height()+"px");


	// busca inteligente // topo das paginas
	// quando trocar a finalidade, trocar para a lista de tipos(apt,casa,loja etc) pre carregados
	$(".search-box .produto-finalidade").change(function(){
		var value = $(".search-box .produto-finalidade option:selected").val();
		$(".search-box .produto-tipo").css("display","none");
		$(".search-box .assoc-"+value).css("display","block");
	});


	// adiciona o texto 'navegue' nos botoes de galeria
	// $(".vitrine .owl-controls .owl-buttons").prepend("<span>Navegue:</span>");


	// forms interessado / indique
	$("#interessado-box button.bt-indique").click(function(){
		$("#indique-box").css("display","block");
		$("#interessado-box").css("display","none");		
	});
	$("#indique-box button.bt-interessado").click(function(){
		$("#indique-box").css("display","none");
		$("#interessado-box").css("display","block");		
	});
});


function geraPaginacao(prodPerPage){
	if(prodPerPage){

		var prodLista = $("#full-list").html();
		$("#partial-list").html(prodLista);
		
		var productList = new List('produto-lista-filled', {
			valueNames: [
				'produto-titulo',
				'produto-ordenacao',
				'produto-codigo',
				'produto-bairro',
				'produto-preco',
				'produto-empreendimento',
				'produto-condominio',
				'produto-construtora',
				'produto-tipo',
				'produto-quarto',
				'produto-status',
			],
			page: prodPerPage,
			plugins: [ 
				ListPagination({
					left: 1,
					right: 1, 
				})
			] 
		});

		var ordem = $(".full-list-order").first().text();
		ordem = (typeof ordem == undefined || ordem.trim() == '' ) ? 'desc' : ordem ;		

		productList.sort('produto-ordenacao', { order: ordem });

		$("#produto-lista-filled").css("opacity","1");
		$("#loader-spinner").css("display","none");


		return productList;
	}
}

function getImageCapa(id, route){
		$.get(route)
		.done(function( data ) {
			$("#COD"+id).attr("src", data);
			$("#COD"+id).attr("data-BigImgsrc", data);

			// pode encadear diversos locais ou aternativas de imagens, lembrando sempre de deixar o unbind no ultimo
			// exemplo:
			// $("#COD"+id).error(function(){
			// 	$("#COD"+id).attr("src", "http://www.dominio.com.br/img/sem_imagem.pn"); // exemplo de erro
			// });

			$("#COD"+id).error(function(){
				$("#COD"+id).attr("src", "assets/img/sem_imagem.png");
				$("#COD"+id).unbind('error');
			});
		});	
}


function getData(finalidade, tipo){
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
          '<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'" data-tipo="'+tipo+'" data-cidade="{{url}}">{{nome}}</a>'
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
          '<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'" data-tipo="'+tipo+'" data-bairro="{{url}}">{{nome}}</a>'
        ].join(''),
        engine: Hogan
      },
      
      {
        header: '<h3 class="header_typeahead">Por Condomínios</h3>',
        prefetch: {
          url: '/ws/buscaConds/'+finalidade+'/'+tipo+'/buscaConds_tipo='+tipo,
          ttl: 0
        },
        template: [
          '<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'" data-tipo="'+tipo+'" data-cond="{{url}}" data-cond-nome="{{value}}">{{nome}}</a>'
        ].join(''),
        engine: Hogan
      },
      {
        header: '<h3 class="header_typeahead">Por Empreendimento</h3>',
        prefetch: {
          url: '/ws/buscaEmps/'+finalidade+'/'+tipo+'/buscaEmps_tipo='+tipo,
          ttl: 0
        },
        template: [
          '<a onclick="callSearch(this)" class="typeahead-custom-filter" data-finalidade="'+finalidade+'" data-tipo="'+tipo+'" data-emp="{{url}}" data-emp-nome="{{value}}">{{nome}}</a>'
        ].join(''),
        engine: Hogan
      }
    ]; 

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

function redirect(url){
	window.location = url;
}


function callSearch(ele){
	/*
		rotina disparada quando se clica em algum item retornado pelo typeahead,
		e monta um form para postar para a rota os paramentros da busca. A rota POST
		então recebe os paramentros, chama o controller adequado e retorna o conteudo
		da busca em uma listagem.
	*/ 

    var dataFin = $(ele).attr("data-finalidade");
    var dataTipo = $(ele).attr("data-tipo");
    var dataBairro = $(ele).attr("data-bairro");
    var dataCidade = $(ele).attr("data-cidade"); 

    var dataEmp = $(ele).attr("data-emp");
    var dataCond = $(ele).attr("data-cond");

    var action = "/"+dataFin+"/";
    (dataTipo=="null")    ? $(".search-box input[name='tipo']").remove()   : $(".search-box input[name='tipo']").val(dataTipo);

    (dataBairro>0)  ? $(".search-box input[name='bairro']").val(dataBairro) : $(".search-box input[name='bairro']").remove();
    (dataCidade>0)  ? $(".search-box input[name='cidade']").val(dataCidade) : $(".search-box input[name='cidade']").remove();

    // empreendimento
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
	    	$(".search-box input[name='empreendimento_nome']").val(dataEmpNome);
	    	
    	}

    }

    // condominio
    if(dataCond>0){
    	dataCondNome = $(ele).attr("data-cond-nome");
    	dataCondNome = dataCondNome.toLowerCase();
    	$(".search-box input[name='condominio_nome']").val(dataCondNome);

    }

	// TCK#2975
    // $(".search-box form[name='form_busca']").attr("action", action);
    // $(".search-box form[name='form_busca']").submit();
    $("#barraBusca").attr("action", action);
    $("#barraBusca").submit();


}    

// rotina de verificação e configuracao 
// da barra de busca em caso existirem dados
// verifica a rota
// TCK#2845
function setFields(){
	// return false;

  	var busca_finalidade = $("#selFinalidade").val();

  	var busca_tipo = $("#tags_container .tag[data-tipo='tipo']").attr("data-id");

    // exibe a lista de tipos referente a finalidade
    $(".search-box .produto-tipo").css("display","none");
    $(".search-box .assoc-"+busca_finalidade).css("display","block");

    if(busca_tipo==undefined) busca_tipo = "null";
    $(".produto-tipo.assoc-"+busca_finalidade+" select").val(busca_tipo);

    // dispara o evento 'change' para atualizar o hogan/typeahead da regiao
    // $(".search-box .produto-finalidade").trigger("change");
    // $(".search-box .produto-tipo select").trigger("change");
    $(".search-box .produto-tipo.assoc-"+busca_finalidade+" select").trigger("change");

	// return false;
}
// TCK#2845



// simples funcao para verificar se a variavel eh vazia
function vazio(variavel){
if(variavel==undefined){
  return true;
}
if(variavel==null){
  return true;
}
if(variavel==0){
  return true;
}
if(variavel==""){
  return true;
}
return false;
}


// funcoes prototipo que extendem o jquery
jQuery.fn.extend({

	// funcao que cria um tooltip generico em cima do 
	// elemento container (div, span, p) que ele foi designado
	// exemplo: $("#id div.classe").tooltip("texto a ser exibido e aceita <b>html</b>");
    tooltip2: function(texto) {

        html = '';
        html += '   <div class="tooltip_popup">';
       	html += '     <div class="triangle-down"></div>';
        html +=     texto;
        html += '   </div>';

        this.append(html);
        setTimeout(function(){
            $( ".tooltip_popup" ).animate({
              opacity: 0
            }, 1500, function() {
              $( ".tooltip_popup" ).remove();
            });              
        },2000);

        return true;
    },

    rollTo: function(ele) {
		var eleTop = 0;

		eleTop = $(ele).offset().top;

		window.scrollTo(0, eleTop);

        return true;
    }

});