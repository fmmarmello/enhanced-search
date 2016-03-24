    <div class="search-box">
      <div class="container">
        <div class="form-wrapper">
          <div class="bg-loader"></div>
          <form method="POST" action="" name="form_busca" id="barraBusca">
            {# <!-- INPUTS USADOS PARA TRATAR A BUSCA NO MODEL--> #}
            {# <!-- <input name="finalidade" value="{{Config.HOST_ROUTE}}" type="hidden">  TCK#2845--> #}
            <input name="tipo" value="" type="hidden">
            <input name="condominio_nome" value="" type="hidden">
            <input name="empreendimento_nome" value="" type="hidden">
            <input name="cidade" value="" type="hidden">
            <input name="bairro" value="" type="hidden">
            {# <!-- INPUTS USADOS PARA TRATAR A BUSCA NO MODEL --> #}

            <div class="form-group produto-finalidade" id="boxFinalidade">
              <select id="selFinalidade" name="select_finalidade">
                <option data-value="0" value="null">-Finalidade-</option>
                <option data-value="1" value="lancamentos">Loteamento </option>
                <option data-value="2" value="prontos">Imóveis à Venda</option>
                <option data-value="3" value="locacao">Aluguel </option>
              </select>
            </div>

            {# <!--lista os tipos de acordo com a finalidade selecionada  --> #}
            <div class="form-group produto-tipo assoc-null">
              <select title="Selecione uma Finalidade" name="select_null">
                <option value="null">-Tipo-</option>
              </select>
            </div>
            <div class="form-group produto-tipo assoc-lancamentos">
              <select name="select_lancamentos">
                <option value="null">-Tipo-</option>
                {% for entry in selectLancamentos %}
                <option value="{{entry.id}}">{{entry.nome}}</option>
                {% endfor %}
              </select>
            </div>
            <div class="form-group produto-tipo assoc-prontos">
              <select name="select_prontos">
                <option value="null">-Tipo-</option>
                {% for entry in selectProntos %}
                <option value="{{entry.id}}">{{entry.nome}}</option>
                {% endfor %}
              </select>
            </div>
            <div class="form-group produto-tipo assoc-locacao">
              <select name="select_locacao">
                <option value="null">-Tipo-</option>
                {% for entry in selectLocacao %}
                <option value="{{entry.id}}">{{entry.nome}}</option>
                {% endfor %}
              </select>
            </div>
            {# <!--lista os tipos de acordo com a finalidade selecionada  --> #}


            <div class="form-group produto-regiao" onkeypress="return getKeypress(event)" >
              <input type="text" placeholder="Qual Região?" name="localizacao" class="loc-search busca">
            </div>

            <div class="form-group produto-buscar">
              <button class="bt-buscar" type="button" title="Buscar"/>Buscar</button>
            </div>

            <div class="form-group produto-codigo" onkeypress="return getKeypress(event)">
              <input type="text" placeholder="Código do imóvel" name="codigo" class="loc-codigo">
            </div>

            <div class="form-group produto-buscar-codigo">
              <button class="bt-buscar" type="button" title="Buscar pelo código"/>Buscar</button>
            </div>

            <!-- <div class="form-group produto-buscar-mapa">
              <button class="bt-buscar bt-mapa" type="button" title="Buscar no mapa"/>Buscar</button>
            </div> -->

          </form>
        </div>
      </div>
    </div>

<script type="text/javascript">
  $(document).ready(function(){
    /*
      // busca inteligente // topo das paginas
        rotinas de busca avancada, arquivos adicionais:
        /asset/jvs/custom.js        ->    funcoes js que possuem interpretador de template similar ao twig
        /app.route.php              ->    roda que chama as consultas e o retorno das buscas, atraves de post

        funcao 'getData':
          retorna para o typeahead uma lista json com os dados necessarios. Esta em /asset/jvs/custom.js

        //var rota = "{{ROTA}}";
    */

    // gera a lista do loc_codigo
    $('.loc-codigo').typeahead( getCodigo() );

    // se clicar no campo de regiao sem ter selecionado uma finalidade
    $("input[name='localizacao']").focus(function(){
      var enabled = $("#selFinalidade option:selected").attr('data-value');
      if(enabled==0){
        $("#boxFinalidade").tooltip2("Escolha uma <b>Finalidade</b> primeiro!");
        $(this).blur();
      }
    });



    // se clicar no select de tipo sem ter selecionado uma finalidade
    $(".search-box .produto-tipo select").focus(function(){
      var enabled = $("#selFinalidade option:selected").attr('data-value');
      if(enabled==0){
        $("#boxFinalidade").tooltip2("Escolha uma <b>Finalidade</b> primeiro!");
        $(this).blur();
      }      
    });



    // quando alterar o select de finalidade - locacao, prontos, lancamentos etc - inicia a rotina abaixo
    $(".search-box .produto-finalidade").change(function(){

      // zera o campo de busca avancada
      $('.loc-search').val("");

      // captura a opcao selecionada na finalidade
      var finalidade = $(".search-box .produto-finalidade option:selected").val();
      
      // exibe as opcoes do select de tipo, associado a finalidade - casa, loja, cobertura etc 
      $(".search-box .produto-tipo").css("display","none");
      $(".search-box .assoc-"+finalidade).css("display","block");

      // captura a opcao selecionada no tipo
      var tipo = $(".search-box .assoc-"+finalidade+" select option:selected").val();

      // ao inserir qualquer dado no campo 'qual regiao?' inicia a rotina abaixo
      $('.loc-search').typeahead('destroy');
      $('.loc-search').typeahead( getData(finalidade, tipo) );
    });



    // quando alterar o select de tipo - casa, loja, cobertura etc - inicia a rotina abaixo
    $(".search-box .produto-tipo select").change(function(){
      // zera o campo de busca avancada
      $('.loc-search').val("");

      // captura a opcao selecionada na finalidade
      var finalidade = $(".search-box .produto-finalidade option:selected").val();

      // captura a opcao selecionada no tipo
      var tipo = $(".search-box .assoc-"+finalidade+" select option:selected").val();

      // ao inserir qualquer dado no campo 'qual regiao?' inicia a rotina abaixo
      $('.loc-search').typeahead('destroy');
      $('.loc-search').typeahead( getData(finalidade, tipo) );
    });



    // rotina disparada quando clicar no bt buscar dos itens do formulario de busca anteriores
    // nesse caso, a cidade, o bairro, e empreendimento e o condominio, vindos do typeahead,
    // nao sao contemplados aqui, mas no assets/jvs/custom.js
    $('.produto-buscar .bt-buscar').click(function(){
      // verifica se o campo regiao esta preenchido
      var value_localizacao = $("input[name='localizacao']").val();
      if(value_localizacao==undefined){/*do nothing*/}else{
        if(value_localizacao.length > 0){
          // captura o link gerado para aquele item e dispara o evento de click
          var link = $('.tt-suggestion').first().children('a');
          link.trigger("click");
          return false;        // finaliza o evento
        }
      }

      var value_finalidade = $(".search-box .produto-finalidade option:selected").val();
      var value_tipo = $(".search-box .assoc-"+value_finalidade+" option:selected").val();
      // var value_bairro = "null";
      // var value_cidade = "null";

      if(value_finalidade=='null'){
        // faz nada - exibe mensagem de 'selecione uma opcao'
        $("#boxFinalidade").tooltip("Escolha uma <b>Finalidade</b> primeiro!");
      }else{
        $(".search-box .bg-loader").css("display","block");
        if(value_tipo=='null'){
          // encaminha para a lista correspondente
          // TCK #2845
          window.location = '{{Config.base}}'+value_finalidade+"/";
          // TCK #2845
        }else{
          var action = "/"+value_finalidade+"/";
          (value_finalidade=="null")  ? $(".search-box input[name='finalidade']").remove() : $(".search-box input[name='finalidade']").val(value_finalidade);
          (value_tipo=="null")        ? $(".search-box input[name='tipo']").remove()       : $(".search-box input[name='tipo']").val(value_tipo);

          // (value_bairro=="null")  ? $(".search-box input[name='bairro']").remove() : $(".search-box input[name='bairro']").val(value_bairro);
          // (value_cidade=="null")  ? $(".search-box input[name='cidade']").remove() : $(".search-box input[name='cidade']").val(value_cidade);
          $(".search-box input[name='bairro']").remove();
          $(".search-box input[name='cidade']").remove();

          // TCK#2975
          // $(".search-box form[name='form_busca']").attr("action", action);
          // $(".search-box form[name='form_busca']").submit();
          $("#barraBusca").attr("action", action);
          $("#barraBusca").submit();
        }
      }
    });


    // rotina disparada quando clicar no bt buscar por codigo
    $('.produto-buscar-codigo .bt-buscar').click(function(){
      var value = $(".produto-codigo input[name='codigo']").val();

      if(value==""){
            $(".produto-codigo").tooltip({title: "Por favor, preencha corretamente o campo!", placement: "auto"});
      }else{
        $.get( "/ws/buscaImovel/"+value )
          .done(function( dataResponse ) {        
            if(dataResponse=="0"){
                  $(".produto-codigo").tooltip({title: "Imóvel não encontrado!", placement: "auto"});
            }else{
              window.location = dataResponse;
            }
          });   
      }
    });


    // bt de clicar para o mapa de imoveis
    $(".bt-mapa").click(function(){
      // captura a opcao selecionada na finalidade
      var finalidade = $(".search-box .produto-finalidade option:selected").val();

      if(finalidade=="null"){
          window.location = '{{Config.base}}lancamentos/mapa';
      }else{
          window.location = '{{Config.base}}'+finalidade+'/mapa';
      }
    });

  });

  // funcao que captura o enter quando pressionado com 
  // o cursor do typeahead/hogan
  function getKeypress(e) {
    if (e.keyCode == 13) {
        // var link = $('.tt-suggestion').first().children('a');
        var link = $('.tt-is-under-cursor').children('a');
        // console.log(link);

        // return false;
        link.trigger("click");
    }
  }  
</script>