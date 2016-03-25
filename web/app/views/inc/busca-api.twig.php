<div class="banner_search_main">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
      <form name="main-search" class="search-form" id="main-search">
        <!-- OBRIGATORIO --> 
        <input type="hidden" data-product="" data-fin="" name="finalidade" class="input_finalidade">
        <input type="hidden" name="Tipos" class="input_tipo">

        <input name="condominio_nome" value="" type="hidden">
        <input name="empreendimento_nome" value="" type="hidden">
        <input name="cidade" value="" type="hidden">
        <input name="bairro" value="" type="hidden">
        <input name="filtroNome" value="" type="hidden">

        <!-- OBRIGATORIO -->
        <div class="banner_search">
          <div class="banner_search_left">
            <p>Podemos te ajudar!</p>
            <a href="/contato/venda-seu-imovel/" title="Venda seu Imóvel">Venda seu Imóvel</a>
          </div>
          <div class="banner_search_right">
            <ul>
              <li>
                <span class="banner_search_Box1">
                  <p>O que você está procurando?</p>
                    <a data-product="imovel" data-fin="prontos" class="bt_finalidade left-finalidade active2">Comprar</a>
                    <a data-product="imovel" data-fin="locacao" class="bt_finalidade right-finalidade" >Alugar</a>
                </span>
              </li>

              <!-- RECEBE OS TIPOS DE PRONTOS -->
              <li>
                <span class="banner_search_Box1 produto-tipo assoc-prontos">
                  <p>Tipo do Imóvel</p>
                  <select name="tipos_prontos" class="select-filtro-lateral form-control">
                    {% set natureza = "" %}
                    {% for entry in selectProntos %}
                        {% if natureza != entry.naturezanome %}
                            <optgroup label="{{entry.naturezanome}}">
                        {% endif %}
                            <option id="{{entry.id}}" url="{{entry.tipo_natureza}}" {% if loop.index0 == 0 %} selected {% endif %}>{{entry.tiponome}}</option>
                        {% set natureza = entry.naturezanome  %}
                        {% if natureza != entry.naturezanome  %}
                            </optgroup>
                        {% endif %}
                    {% endfor %}
                  </select>
                </span>
              </li>
              
              <!-- RECEBE OS TIPOS DE LOCAÇÃO -->
              <li>
                <span class="banner_search_Box1 produto-tipo assoc-locacao">
                  <p>Tipo do Imóvel</p>
                  <select name="tipos_prontos" class="select-filtro-lateral form-control">
                    {% set natureza = "" %}
                    {% for entry in selectLocacao %}
                    {% if natureza != entry.naturezanome %}
                    <optgroup label="{{entry.naturezanome}}">
                      {% endif %}
                      <option id="{{entry.id}}" url="{{entry.tipo_natureza}}" {% if loop.index0 == 0 %} selected {% endif %}>{{entry.tiponome}}</option>
                      {% set natureza = entry.naturezanome  %}
                      {% if natureza != entry.naturezanome  %}
                    </optgroup>
                    {% endif %}

                    {% endfor %}
                  </select>
                </span>
              </li>
              <li>
                <span class="banner_search_Box1">
                  <p>Onde?</p>
                   <input type="text" placeholder="Digite o bairro, cidade ou região" name="localizacao" value="" class="loc-search busca form-control">
                </span>
              </li>
              <li>
                <span class="banner_search_Box2">
                  <a class="bscr bt-buscar" title="Buscar">buscar</a>
                  <a class="bscr2" id="open" title="Busca Avançada">Busca Avançada <img src="{{Config.base_url}}theme/images/sml_arw1.png" alt="" /></a>
                  
                </span>
              </li>
              <li>
                <span class="banner_search_Box3">
                  <a class="bscr3" onclick="openpopup(this.alt);" title="Buscar por código do imóvel">Buscar por código do imóvel</a>
                </span>
              </li>
            </ul>
            <div id="light10" class="white_content10 produto-buscar-codigo">
              <div class="top_search_opn">
                <ul class="banner_search_Box1">
                  <li><span>Buscar por <strong>código</strong> do imóvel</span></li>
                  <li><input type="text" name="codigo" id="Codigo" value="" class="loc-codigo" placeholder="Digite o código do imóvel" /></li>
                  <li><a  style="cursor:pointer;" class="bscr bt-buscar-codigo">Buscar</a></li>                  
                </ul>
              </div>
              <a href = "javascript:void(0)" class="serch_left_arw" onclick = "document.getElementById('light10').style.display='none';document.getElementById('fade10').style.display='none'">
                <img src="{{Config.base_url}}theme/images/left_arw_new1.png" alt="" />
              </a>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-12">
            
              <div class="expand_sec_main">
                <div class="expand_sec" id="hide">
                        
                  <div class="expand_top">
                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="expand_top_left">
                            <ul>
                              <li>
                                <span class="expnd_slct_bx1"><a ><img src="theme/images/car_icon.jpg" alt="" /></a></span>
                              </li>
                              <li>
                                <span class="expnd_slct_bx2 assoc-prontos assoc-locacao" style="display:block;">
                                  <label>Quartos</label>
                                   <select id="QtdQuarto" name="QtdQuarto" data-filtro="QtdQuarto" class="select-filtro-lateral form-control">
                                      <option value="">Todos</option>
                                      <option value="1">01</option>
                                      <option value="2">02</option>
                                      <option value="3">03</option>
                                      <option value="4;100">04+</option>          
                                   </select>
                                </span>
                              </li>
                              <li>
                                <span class="expnd_slct_bx2 assoc-prontos assoc-locacao" style="display:block;">
                                  <label>Suítes</label>
                                   <select id="QtdSuite" name="QtdSuite" data-filtro = "QtdSuite" class="select-filtro-lateral form-control">
                                      <option value="">Todos</option>
                                      <option value="1">01</option>
                                      <option value="2">02</option>
                                      <option value="3">03</option>
                                      <option value="4;5;100">04+</option>          
                                   </select>
                                </span>
                              </li>
                              <li class="assoc-prontos assoc-locacao" style="display:block;">
                                <span class="expnd_slct_bx1"><a ><img src="theme/images/banh_icon.jpg" alt="" /></a></span>
                              </li>
                              <li>
                                <span class="expnd_slct_bx2 assoc-prontos assoc-locacao" style="display:block;">
                                  <label>Banheiros</label>
                                   <select  id="QtdWcTotal" name="QtdWcTotal" data-filtro = "QtdWcTotal" class="select-filtro-lateral form-control">
                                      <option value="">Todos</option>
                                      <option value="1">01</option>
                                      <option value="2">02</option>
                                      <option value="3">03</option>
                                      <option value="4;100">04+</option>          
                                   </select>
                                </span>
                              </li>
                              <li class="assoc-prontos assoc-locacao" style="display:block;">
                                <span class="expnd_slct_bx1"><a ><img src="theme/images/car_icon.jpg" alt="" /></a></span>
                              </li>
                              <li>
                                <span class="expnd_slct_bx2 assoc-prontos assoc-locacao" style="display:block;">
                                  <label>Vagas Garagem</label>
                                   <select  id="QtdVaga" name="QtdVaga" data-filtro="QtdVaga" class="select-filtro-lateral form-control">
                                      <option value="">Todos</option>
                                      <option value="1">01</option>
                                      <option value="2">02</option>
                                      <option value="3">03</option>
                                      <option value="4;100">04+</option>          
                                   </select>
                                </span>
                              </li>
                            </ul>
                          </div>
                      </div>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                         <div class="row">
                            <div class="col-md-6 assoc-prontos assoc-locacao" style="display:block;">
                              <div class="expand_rang">
                                <label>Valor</label>
                               
                                <div id="slider-range-valor" class="blue"></div>
                               
                                <div class="half_3">
                                <input type="text" name="ValorMin" id="input-number-min" class="input-range-home" value="" onkeypress="return isNumber(event)"/>
                                </div>
                                 <div class="half_4">
                                  <input type="text" name="ValorMax" id="input-number-max" class="input-range-home" value="" onkeypress="return isNumber(event)"/>
                                </div>
                              </div>
                            </div>                            

                            <div class="col-md-5 col-md-offset-1">
                              <div class="expand_rang">
                                <label>Área M<sup>2</sup> </label>
                                 <div id="slider-range-area" class="blue"></div>
                               
                                <div class="half_5">
                                  <input type="text" name="AreaMin" id="input-area-min" class="input-range-home" value="" onkeypress="return isNumber(event)"/>
                                </div>
                                <div class="half_6">
                                  <input type="text" name="AreaMax" id="input-area-max" class="input-range-home" value="" onkeypress="return isNumber(event)"/>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>    
                  
                  <div class="expand_bottom">
                    <div class="row">
                      <div class="col-md-2 col-sm-4 col-xs-4">
                        <div class="expand_bottom_box1">
                          <p><a >Comodidades</a></p>
                        </div>
                      </div>
                      <div class="col-md-10 col-sm-8 col-xs-8 estica-esconde">
                        {% for item in selectProntosCaracteristica %}
                        <div class="expand_bottom_box2 col-md-3">
                          <input id="chk41" type="checkbox" value="false" name="chk">
                          <label for="chk41">{{item.nome|convert_encoding("UTF-8","iso-8859-1")}}</label>
                        </div>
                          {% endfor %}
                      </div>
                      <div class="col-md-2 col-sm-4 col-xs-4">
                        <div class="expand_bottom_box3">
                          <a class="mais">View More <img src="{{Config.base_url}}theme/images/yellow_arw.png" alt="" /></a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div> 
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">
  var porCodigo;
  var porRegiao;
  var finalidade;
  var tipo;
  var mainSearch = $("#main-search");
  var botaoFinalidade = $(".bt_finalidade ");

function getVars(){
    porCodigo = $(".loc-codigo"); //campo de busca por codigo
    porRegiao = $('.loc-search'); //campo de busca por Regiao + TypeAhead
    finalidade = $(".bt_finalidade.active2").attr("data-fin"); //finalidade selecionada   
    tipo =  $(".produto-tipo.assoc-"+finalidade).find(" select option:selected").attr('id'); //tipo selecionado
}


  $(document).ready(function(){

    valorTemp = "";
    $('.input-range-home').on('focus',function(event) {
      valorTemp = $(this).val(); 
      $(this).val("")
    }).blur(function(event) {
      if ($(this).val() == "")
        $(this).val(valorTemp); 
    });

    $(document).ready(function() {
      var SliderValor = document.getElementById('slider-range-valor');

      noUiSlider.create(SliderValor, {
        start: [ 0, 5000000 ],
        step: 1,
        connect: true,
        range: {
          'min': 0,
          'max': 5000000
        },
        format: wNumb({
          decimals: 3,
          thousand: '.',
          //prefix: ' (R$) ',
        })
      });

      var inputNumberMin = document.getElementById('input-number-min');
      var inputNumberMax = document.getElementById('input-number-max');

      SliderValor.noUiSlider.on('update', function( values, handle ) {
        var index = values.indexOf(values[handle]);
        var value = values[handle];

        if ( index == 0 ) {
          inputNumberMin.value = value;
        } else {
          inputNumberMax.value = value;
        }

        if (value == "5.000.000"){
          inputNumberMax.value = "5.000.000+"; 
        }
      });

   
      $(inputNumberMin).on('keyup', function(){
        inputNumberMin.value = format(this.value); 
      });


        $(inputNumberMin).on('blur', function(event) {
        SliderValor.noUiSlider.set([$(this).val(), null]);
      });

        $(inputNumberMin).on('keypress', function(event) {
        if (event.keyCode == 13){
          SliderValor.noUiSlider.set([$(this).val(), null]);
            inputNumberMin.blur();
        }
      });

      $(inputNumberMax).on('keyup', function(){
        inputNumberMax.value = this.value == '5.000.000' ? format(this.value)+'+' : format(this.value); 
      });


        $(inputNumberMax).on('blur',function(event) {
        SliderValor.noUiSlider.set([null, $(this).val()]);
      });

        $(inputNumberMax).on('keypress',function(event) {
        if (event.keyCode == 13){
          SliderValor.noUiSlider.set([null, $(this).val()]);
            inputNumberMax.blur();
        }
      });

      var SliderArea = document.getElementById('slider-range-area');

      noUiSlider.create(SliderArea, {
        start: [ 0, 6000 ],
        step: 1,
        connect: true,
        range: {
          'min': 0,
          'max': 6000
        },
        format: wNumb({
          decimals: 3,
          thousand: '.',
         // postfix: ' (m²) ',
        })
      });

      var inputAreaMin = document.getElementById("input-area-min");
      var inputAreaMax = document.getElementById("input-area-max");

      SliderArea.noUiSlider.on('update', function( values, handle ) {
        var index = values.indexOf(values[handle]);
        var value = values[handle];

        if ( index == 0 ) {
          inputAreaMin.value = value;
        } else {
          inputAreaMax.value = value;
        }

        if (value == "6.000"){
          inputAreaMax.value = "6.000+"; 
        }
      });

      $(inputAreaMin).on('keyup', function(){
        inputAreaMin.value = format(this.value);
      });

        $(inputAreaMin).on('keypress',function(event) {
        if (event.keyCode == 13){
          SliderArea.noUiSlider.set([$(this).val(), null]);
          inputAreaMin.blur();
        }
      });

        $(inputAreaMin).on('blur',function(event) {
        SliderArea.noUiSlider.set([$(this).val(), null]);
      });

      $(inputAreaMax).on('keyup', function(){
        inputAreaMax.value = this.value == '6.000' ? format(this.value)+'+' : format(this.value); 
      });

      $(inputAreaMax).on('blur',function(event) {
        SliderArea.noUiSlider.set([null, $(this).val()]);
      });

        $(inputAreaMax).on('keypress',function(event) {
        if (event.keyCode == 13){
          SliderArea.noUiSlider.set([null, $(this).val()]);
            inputAreaMax.blur();
        }
      });

    });
  

    //ativa função de clique
    $(".bt_finalidade.active2").click(); //força clique para a finalidade especificada
    /*
      // busca inteligente // topo das paginas
        rotinas de busca avancada, arquivos adicionais:
        /asset/jvs/typeahead.inforce.js        ->    funcoes js que possuem interpretador de template similar ao twig
        /app.route.php              ->    roda que chama as consultas e o retorno das buscas, atraves de post

        funcao 'getData':
          retorna para o typeahead uma lista json com os dados necessarios. Esta em /asset/jvs/custom.js
    */

    getVars();
    // gera a lista de códigos de imoveis
    porCodigo.typeahead(getCodigo());

    //gera typeahead    
    //var tipo = mainSearch.find(".assoc-"+finalidade+" select option:selected").val();

    porRegiao.typeahead( getData(finalidade, tipo) ); //typeahead

    // se clicar no select, campo de regiao sem ter selecionado uma finalidade
    // não usado no momento 
    /* 

    $(".selectBox, .produto-regiao").focus(function(){
      var enabled = finalidade;
      if(enabled==0){
        $("#boxFinalidade").tooltip2("Escolha uma <b>Finalidade</b> primeiro!");
        $(this).blur();
      }
    });

    */

    // quando alterar o select de finalidade - locacao, prontos, lancamentos etc - inicia a rotina abaixo
      botaoFinalidade.on('click',function(){

      var product = $(this).attr('data-product');
      var buscaAvancada = $('.bt_busca_avancada');
      if (product == "imovel")
          buscaAvancada.show();
      else
          buscaAvancada.hide();
       

      // zera o campo de busca avancada
      porRegiao.val("");

      // captura a opcao selecionada na finalidade
      //var finalidade = $(this).attr("data-fin");
      getVars();
      console.log(finalidade);

      // exibe as opcoes do select de tipo, associado a finalidade - casa, loja, cobertura etc 
      mainSearch.find(".produto-tipo").hide();
      mainSearch.find(".assoc-lancamentos, #main-search .assoc-locacao, #main-search .assoc-prontos").hide();
      mainSearch.find(".assoc-"+finalidade).show();


      // captura a opcao selecionada no tipo
      //var tipo = mainSearch.find(".assoc-"+finalidade+" select option:selected").val();

      // ao inserir qualquer dado no campo 'qual regiao?' inicia a rotina abaixo
      porRegiao.typeahead('destroy');
      porRegiao.typeahead( getData(finalidade, tipo) );
    }); //checked 2016



    // quando alterar o select de tipo - casa, loja, cobertura etc - inicia a rotina abaixo
      mainSearch.find(".produto-tipo").find("select").change(function(){
      debugger
      // zera o campo de busca avancada
      porRegiao.val("");

      // captura a opcao selecionada na finalidade e tipo
      getVars();

      // ao inserir qualquer dado no campo 'qual regiao?' inicia a rotina abaixo
      porRegiao.typeahead('destroy');
      porRegiao.typeahead( getData(finalidade, tipo) );
    }); //checked 2016


    // rotina disparada quando clicar no botao de busca dos itens do formulario
    // nesse caso, a cidade, o bairro, e empreendimento e o condominio, vindos do typeahead,
    // nao sao contemplados aqui, mas no assets/jvs/typeahead.inforce.js
      mainSearch.on('click','.bt-buscar',function(){
      debugger;
      getVars();
      // verifica se o campo regiao esta preenchido e execute a funcao indicada no typeahead
      var nome_localizacao = porRegiao.val();
      var url = porRegiao.attr('data-full-url');
      var id_localizacao = porRegiao.attr('data-locid');

      //se nao tiver preenchido localidade
      if(nome_localizacao ==undefined || nome_localizacao ==""){
          return false;
      }


      if(finalidade=='null'){
        // faz nada - exibe mensagem de 'selecione uma opcao'
        $("#boxFinalidade").tooltip("Escolha uma <b>Finalidade</b> primeiro!");
          return false;
      }else{
          mainSearch.find(".bg-loader").css("display","block");
        /* se selecionar finalidade mas não selecionar tipo (ex. apartamento etc )*/
        if(tipo=='null'){
          // encaminha para a lista correspondente          
          window.location = '{{Config.base}}'+finalidade+"/";          
        }else{
          /* atribui valor para busca inputs escondidos no form */

          var action = "/"+finalidade+"/";
          (finalidade=="null")  ? mainSearch.find("input[name='finalidade']").remove() : mainSearch.find("input[name='finalidade']").val(finalidade);
          (tipo=="null")        ? mainSearch.find("input[name='Tipos']").remove()       : mainSearch.find("input[name='Tipos']").val(tipo);

          // (value_bairro=="null")  ? mainSearch.find("input[name='bairro']").remove() : mainSearch.find("input[name='bairro']").val(value_bairro);
          // (value_cidade=="null")  ? mainSearch.find("input[name='cidade']").remove() : mainSearch.find("input[name='cidade']").val(value_cidade);
          mainSearch.find("input[name='bairro']").remove();
          mainSearch.find("input[name='cidade']").remove();

          // TCK#2975          
            mainSearch.attr("action", action);
            mainSearch.submit();
        }
      }
    });


    // rotina disparada quando clicar no bt buscar por codigo
    $('.produto-buscar-codigo .bt-buscar, .bt-buscar-codigo').on('click',function(){
      debugger
      var value = $(".produto-buscar-codigo").find("input[name='codigo']").val();

      if(value==""){
            $(".produto-codigo").tooltip({title: "Por favor, preencha corretamente o campo!", placement: "auto"});
      }else{
        window.location = "/prontos/?Codigo="+value;
        /*$.get( "/ws/buscaImovel/"+value )
          .done(function( dataResponse ) {
            debugger
            if(dataResponse=="0"){
                  $(".produto-codigo").tooltip({title: "Imóvel não encontrado!", placement: "auto"});
            }else{}
        });*/
      }
    });


    // bt de clicar para o mapa de imoveis
    $(".bt-mapa").on('click',function(){
      // captura a opcao selecionada na finalidade
      var finalidade = $(".bt_finalidade").attr("data-fin");

      if(finalidade=="null"){
          window.location = '{{Config.base}}lancamentos/mapa';
      }else{
          window.location = '{{Config.base}}'+finalidade+'/mapa';
      }
    });

  });
</script>
<style>  
  .tt-first a, .tt-is-under-cursor a{
    color: #e56600 !important;
    border: none !important;
    text-decoration: none !important;    
    background: #ECECEE !important;
  }
</style>