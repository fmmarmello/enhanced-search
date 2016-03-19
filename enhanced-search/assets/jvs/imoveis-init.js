function initSlider() {
    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: false,
        controlsContainer: ".flex-container"
    });
}

function filtroRegiao(){
    console.log('filtro regiao');

    $(".regiao-lateral, .empnome-lateral, .codigo-lateral").typeahead('destroy'); //typeahead

    var finalidade = ( typeof $('#filtro-lateral').attr('data-fin') != "undefined" ? $('#filtro-lateral').attr('data-fin') : String("null"));
    var tipo = [];
    $("input[name='Tipos[]']:checked").each(function ()
    {
        tipo.push($(this).val().replace(';',','));
    });
    if (tipo.length === 0) { tipo = String("null");}else{tipo = tipo.join(',');}

    //filtro de regioes
    if($(".regiao-lateral").size() > 0 ){
        $(".regiao-lateral").typeahead(getData(finalidade, tipo));
    }

    if($(".empnome-lateral").size() > 0 ){
        //filtro por nome do empreendimento
        $(".empnome-lateral").typeahead(getEmpreendimento(finalidade, tipo));
    }

    if($(".codigo-lateral").size() > 0 ){
        //filtro por código
        $(".codigo-lateral").typeahead(getCodigo());
    }

    // apaga o typeahead de regiao
    $('.regiao-lateral').val("");
}

function doSearch(form, page, top){
    
    if(window.doSearchAjax){window.doSearchAjax.abort();}        

        //ativa o loading
        $(".loading").show();  
        
        var formData = $(form).serialize();
        
        //grava no localstorage
        
        
        var finalidade = $(form).attr('data-fin');
        var produto = $(form).attr('data-product');
        localStorage.setItem('filters-'+produto, formData);

        //verifica se recebeu parametro de paginação 
        //se não aponta pra pagina 1
        page  = (typeof page == "undefined" || page == "") ? "1" : page;

        window.doSearchAjax = $.ajax({
            url: '/filtros/'+produto+'/'+finalidade+'/'+page,
            type: 'GET',            
            data: formData,
        }).done(function(data) {
            debugger
            $(".content-lista").empty().html(data);       

            //slide top
            if (top != "" && top !== undefined){
                $('html, body').animate({scrollTop:0}, 2000);
                //chamaSom();
            }

            //altera contador de paginação
            pagCount(page);           

            // inicia o slider
            initSlider(); 

            //desativa o loading
            $('.loading').hide();            
        });
}
//*   alterar total count de registros ( classe ttcount)
function updateTotal(value){
    $(".ttcount").html(value);
}

function pagCount(page){
    page  = (typeof page == "undefined" || page == "") ? "1" : page;
    //altera contador de paginação

    /*
        Update de páginas é realizado em 
        app/base-filtro.twig.php
    */
    var itensPorPagina = $("#products-per-page :selected").val();
    
    if ($(".resulto_col1").size() > 0) {
        $('.ttmin').text((page-1)*itensPorPagina + 1);
    }else{
        $('.ttmin').text((page-1)*itensPorPagina);
        //$('.ttmin').text(0);
    }

    /**
    *   @TO_DO:
    *   ttmax -> valor deve vir do framework, mas por enquanto estou fazendo da forma abaixo
    *
    */

    if($(".resulto_col1").size() < itensPorPagina){
        $('.ttmax').text(((page-1) * itensPorPagina + $(".resulto_col1").size() ));
    }else{
        $('.ttmax').text((page * itensPorPagina));    
    }
}

function formReset(){    
    $(".selected-filters li ").each(function(){
        var filtroTipo = $(this).attr('data-type');
        var id = $(this).attr('data-id');
        handleTags(filtroTipo, id, 'true', '');
    });
    
    $(".barra-lateral form")[0].reset();
    //remove filtros do typeahead

    doSearch($("form#filtro-lateral"));
}

$(document).ready(function() {
    //inicia typeaheads
    filtroRegiao();

    // inicia o slider
    initSlider(); 
 

    //ao alterar item do form chama busca
    $(document).on('change','form#filtro-lateral',function (e) {
        console.log('form change');
        
        //gambs para funcao OnClick do TypeAhead sobrescrever onchange do Form
        //setTimeout(function() {
            if(!($(e.target).hasClass('regiao-lateral'))) {// se nao for seletor lateral de regiao ex(typeahead)
                console.log('vou buscar');
                doSearch($("form#filtro-lateral"));
            }
       // }, 300);
    });

    $("form#filtro-lateral").on('submit',function (e) {
        //console.log('vou buscar por submit');
        e.preventDefault();
        //doSearch($("form#filtro-lateral"));
    });
    
    //tratamento especial para itens de range (ex: valor, area etc)
    $(document).on('mouseup', ".fscaret",function(){
       doSearch($("form#filtro-lateral"));
    });

    //filtros fora da listagem lateral [Ordenação, ItensPorPag]
    $('.search-param').on('change',function(){
        var paramType = $(this).attr('data-param');        
        var paramVal = $(this).val();

        sessionStorage.setItem(paramType,paramVal);
        $('[name="'+paramType+'"]').val(paramVal);
        
        doSearch($("form#filtro-lateral")); 
    });
});

$(window).load(function(){
    //plugin para paginação
    debugger    
    var itensPagina = $("#qtdPagina").html().trim();
    $('.pagination').bootpag({
       total: itensPagina,
       page: 1,
       maxVisible: 6,
       next: 'Próximo',
       prev: 'Anterior',
    }).on('page', function(event, pag){
        console.log('Pagina: '+pag);
        doSearch($('#filtro-lateral'), pag, true);
    });
});