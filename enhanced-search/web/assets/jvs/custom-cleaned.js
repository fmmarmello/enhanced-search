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

function isScrolledIntoView(elem)
{
    if(elem.leng > 0){
      var $elem = $(elem);
      var $window = $(window);

      var docViewTop = $window.scrollTop();
      var docViewBottom = docViewTop + $window.height();

      var elemTop = $elem.offset().top;
      var elemBottom = elemTop + $elem.height();

      return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));      
    }    
}

/* Formulário de Imovel Não Encontrado  - Home
* Altera classe dos botões e tipo do formulário
*/
$(".mid_frm_Box li a").click(function(){
  $(".mid_frm_Box li a").removeClass('slct'); //remove classe de seleção
  var finalidade = $(this).attr('data-finalidade'); //pega a finalidade selecionada no formulário
  $(this).addClass('slct'); //adiciona classe ao item selecionado
  $(".mid_frm_inner form").attr('name',finalidade+'-nao-encontrado'); //muda name do formulario
});
/* Fim Home não Encontrado */

/*  Seletor de Finalidade - HOME  */
$(".bt_finalidade").click(function(){
  $(".bt_finalidade").removeClass('active2'); //remove classe de seleção
  var finalidade = $(this).attr('data-fin'); //pega a finalidade selecionada no formulário
  $("#main-search input[name=finalidade]").val(finalidade);
  var product = $(this).attr('data-product'); //pega a finalidade selecionada no formulário
  $(this).addClass('active2'); //adiciona classe ao item selecionado
  $(".input_finalidade").attr('data-fin',finalidade).attr('data-product',product).val(finalidade); //muda name do formulario
});


// bugfix // hide forms from bots
  $("input[data-value='contato']").each(function(){
    $(this).css("display","none");
  });

  $('.online, .chat').click(function(event){
    var interna = typeof $(this).attr('data-interna') == 'undefined' || $(this).attr('data-interna') == "" ? false : $(this).attr('data-interna'); 

    if (interna) {
      var tipo = typeof $(this).attr('data-interna-tipo') == 'undefined' || $(this).attr('data-interna-tipo') == "" ? false : $(this).attr('data-interna-tipo'); 
      var ref = $(this).attr('data-ref'); 
      if (tipo == 'pronto')
        abreChat(2, interna, "_blank", ref);   
      else if (tipo == 'empreendimento')
        abreChat(3, interna, "_blank", ref);
      else
        abreChat(1, interna, "_blank", ref);
    } else {
      MultiChat();  
    }
    
  });

function abreChat(tipo, produto, target, ref, largura, altura){
  FechaDHTML(3);
  
  /*
    TIPOS: 

    1 - Chat normal 
    2 - Chat especial para imóveis prontos
    3 - Chat especial para lançamentos
  */

  // var urlAtual = window.location.href
  // var urlArray = urlAtual.split('/');
  // if(urlAtual.indexOf('pronto') > 0){
  //   tipo = 2;
  //   if(urlArray.length > 6){
  //     produto =  urlArray[urlArray.length-2];
  //   }
  // }else if(urlAtual.indexOf('lancamento') > 0){
  //   tipo = 3;
  //   if(urlArray.length > 6){
  //     produto =  urlArray[urlArray.length-2];
  //   }
  // }

  tipo    = typeof tipo     !== 'undefined' ? tipo    : 1; 
  produto = typeof produto  !== 'undefined' ? produto : ""; //id do produto
  target  = typeof target   !== 'undefined' ? target  : "_blank";
  altura  = typeof altura   !== 'undefined' ? altura  : "586";
  largura = typeof largura  !== 'undefined' ? largura : "502";
  ref     = typeof ref      !== 'undefined' ? ref     : "";

  switch(tipo) {
      case 1:
          window.open('/ws/chat/?id='+produto+'&produto=&linkform='+ref, target, 'width='+largura+', height='+altura); 
          break;
      case 2:
          window.open('/ws/chat/?id='+produto+'&produto=imovel&linkform='+ref, target, 'width='+largura+', height='+altura); 
          break;
      case 3:
          window.open('/ws/chat/?id='+produto+'&produto=empreendimento&linkform='+ref, target, 'width='+largura+', height='+altura); 
          break;    
  }
}