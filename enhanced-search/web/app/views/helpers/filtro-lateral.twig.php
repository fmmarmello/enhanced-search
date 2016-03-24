<form id='filtro-lateral' class="search-form {{produtotag}}" data-fin= '{{produtotag}}' data-product = '{{produto}}'>

<input type="hidden" data-product="{{produto}}" data-fin="{{produtotag}}" name="finalidade" class="input_finalidade">
<!-- <input type="hidden" name="Tipos" class="input_tipo"> -->

<input name="condominio_nome" value="" type="hidden">
<input name="empreendimento_nome" value="" type="hidden">
{# Side contem parametros recebido por GET, geralmente da busca da home #}
<input name="cidade" value="{{side.cidade|default('')}}" type="hidden">
<input name="bairro" value="{{side.bairro|default('')}}" type="hidden">
<input name="filtroNome" value="{{side.filtroNome|default('')}}" type="hidden">
<input name="take" value="" type="hidden">
<input name="order" value="" type="hidden">

<!-- RANGES -->
<input name="AreaMin" id="AreaMin"   data-filtro="AreaMin" value="" type="hidden">
<input name="AreaMax" id="AreaMax"   data-filtro="AreaMax" value="" type="hidden">

<!-- RANGES -->

<div class="resulto_main_L">    

    <div class="roww1_top">
      <h4>O que você esta procurando?</h4>
      <div class="roww1_top_btn">
        <ul>
          <li class="roww1_top_btn_brd"><a href="{{Config.base}}prontos/" class="{{'locacao' in ROTA ? '' : 'roww1_top_actv'}}">Comprar</a></li>
          <li><a class="{{'locacao' in ROTA ? 'roww1_top_actv' : ''}}" href="{{Config.base}}locacao/">Alugar</a></li>
        </ul>
      </div>
    </div>

    {% if produto is defined and produto != 'empreendimento' %}
    <div class="roww1">
      <h4>Buscar por Código</h4>
      <input type="text" name="Codigo" id="Codigo" value="" class="codigo-lateral" placeholder="Digite o código do imóvel" />
    <!--   <input type="submit" name="" value=""/> -->
    </div>
    {% endif %}

    {% if produto == 'empreendimento' %}
    <div class="roww1">
      <h4>Buscar por nome do Empreendimento</h4>
      <div class="produto-nome" onkeypress="return getKeypress(event)" >
        <input type="text" placeholder="Nome do Empreendimento" name="nome" value="" class="empnome-lateral busca">
      </div>
    </div>
    {% endif %}
    <div class="roww2">
      <h4>Buscar por Região <span class="filter-clean" onclick="formReset()">Limpar Filtros</span></h4>
      <input type="text" class="regiao-lateral" onkeypress="return getKeypress(event)" name="" value="" placeholder="Digite aqui a região" />
      <!-- <input type="submit" name="" value="" disabled="disabled" /> -->
      <ul class="selected-filters">
        {# Filtros recebidos dinamicamente #}
        {# se existe e tem tamanho maior que 0 sem ; #}        
        
        {% set bairro = (side.bairro is defined ) ? side.bairro|replace({";":""}) : "" %}
        
        {% if  bairro|length > 0 %}
          <li data-type="bairro" data-remover="true" onclick="callSearch(this)" data-bairro="{{bairro}}" data-id="{{bairro}}"> {{side.filtroNome}} <a href="/#"><img src="theme/images/cross2.png" alt="X"></a></li>
        {% endif %}
        {% set cidade = (side.cidade is defined) ? side.cidade|replace({";":""}) : "" %}
        
        {% if  cidade|length > 0 %}        
          <li data-type="cidade" data-remover="true" onclick="callSearch(this)" data-cidade="{{cidade}}" data-id="{{cidade}}"> {{side.filtroNome}} <a href="/#"><img src="theme/images/cross2.png" alt="X"></a></li>
        {% endif %}
        
      </ul>    
    </div>
    {#    

    <div class="roww3">
      <h4>Finalidade</h4>
      <input id="chk1" type="checkbox" checked="" value="all" name="chk">
      <label for="chk1">Comprar</label>
      <input id="chk2" type="checkbox" value="false" name="chk">
      <label for="chk2">Alugar</label>
      <input id="chk3" type="checkbox" value="true" name="chk">
      <label for="chk3">Lançamento</label>
    </div>
    #}
    


    {% if produto is defined and produto != 'empreendimento' %}
    <div class="roww3 tipos-prontos estica-esconde">
      {% if selectProntos is defined %}
        <h4>Tipo</h4>
        {# Marca Itens que estão vindo na busca #}
        {% for item in selectProntos %}                
          {% if side.Tipos is defined %}                        
            {% if item.id == side.Tipos %}
              <input id="Tipos-{{loop.index}}" type="checkbox" name="Tipos[]" data-filtro = "Tipos" value="{{item.id}}" checked>
            {% else %}
              <input id="Tipos-{{loop.index}}" type="checkbox" name="Tipos[]" data-filtro = "Tipos" value="{{item.id}}" >
            {% endif %}
          {% else %}
            <input id="Tipos-{{loop.index}}" type="checkbox" name="Tipos[]" data-filtro = "Tipos" value="{{item.id}}" >
          {% endif %}
          
          <label for="Tipos-{{loop.index}}">{{item.tiponome}}</label>
        {% endfor %}
        {# <a href="/#">Ver mais</a> #}
      {% endif %}
    </div>

    <p class="mais">Veja Mais +</p>

    {# na sawala empreendimento nao tem valor #}
    <input name="ValorMin" id="ValorMin" data-filtro="ValorMin" value="" type="hidden">
    <input name="ValorMax" id="ValorMax" data-filtro="ValorMax" value="" type="hidden"> 
    
    <div class="roww3">
      <div class="half_1">
        <h4>Quartos</h4>
         <select id="QtdQuarto" name="QtdQuarto" data-filtro="QtdQuarto" class="select-filtro-lateral form-control" >
            <option value="">Todos</option>
            <option value="1"     {{ (side.QtdQuarto|default('') == '1') ? 'selected' : '' }}>01</option>
            <option value="2"     {{ (side.QtdQuarto|default('') == '2') ? 'selected' : '' }}>02</option>
            <option value="3"     {{ (side.QtdQuarto|default('') == '3') ? 'selected' : '' }}>03</option>
            <option value="4;100" {{ (side.QtdQuarto|default('') == '4;100') ? 'selected' : ''}}>04+</option>          
         </select>
       
      </div>
      <div class="half_2">
        <h4>Suites</h4>
         <select id="QtdSuite" name="QtdSuite" data-filtro = "QtdSuite" class="select-filtro-lateral form-control">
            <option value="">Todos</option>
            <option value="1"       {{ (side.QtdSuite|default('') == '1') ? 'selected' : '' }} >01</option>
            <option value="2"       {{ (side.QtdSuite|default('') == '2') ? 'selected' : '' }} >02</option>
            <option value="3"       {{ (side.QtdSuite|default('') == '3') ? 'selected' : '' }} >03</option>
            <option value="4;5;100" {{ (side.QtdSuite|default('') == '4;5;100') ? 'selected' : '' }} >04+</option>          
         </select>
          
      </div>
      <div class="half_1">
        <h4>Vagas de Garagem</h4>
         <select  id="QtdVaga" name="QtdVaga" data-filtro="QtdVaga" class="select-filtro-lateral form-control" >
            <option value="">Todos</option>
            <option value="1"     {{ (side.QtdVaga|default('') == '1') ? 'selected' : '' }} >01</option>
            <option value="2"     {{ (side.QtdVaga|default('') == '2') ? 'selected' : '' }} >02</option>
            <option value="3"     {{ (side.QtdVaga|default('') == '3') ? 'selected' : '' }} >03</option>
            <option value="4;100" {{ (side.QtdVaga|default('') == '4;100') ? 'selected' : '' }} >04+</option>          
         </select>
          
      </div>
      <div class="half_2">
        <h4>Banheiros</h4>
       
         <select  id="QtdWcTotal" name="QtdWcTotal" data-filtro = "QtdWcTotal" class="select-filtro-lateral form-control">
            <option value="">Todos</option>
            <option value="1"     {{ (side.QtdWcTotal|default('') == '1') ? 'selected' : '' }} >01</option>
            <option value="2"     {{ (side.QtdWcTotal|default('') == '2') ? 'selected' : '' }} >02</option>
            <option value="3"     {{ (side.QtdWcTotal|default('') == '3') ? 'selected' : '' }} >03</option>
            <option value="4;100" {{ (side.QtdWcTotal|default('') == '4;100') ? 'selected' : '' }} >04+</option>          
         </select>
       
      </div>
    </div>
   
      <div class="roww4">
          <h4>Valor</h4>
          <div id="slider-range-valor" class="blue"></div>
          <input type="text" name="ValorMin" id="input-number-min" class="input-range" value="" onkeypress="return isNumber(event)"/>
          <input type="text" name="ValorMax" id="input-number-max" class="input-range" value="" onkeypress="return isNumber(event)"/>
        </div>
   
  
    {% else %}
    <div class="roww3 tipos-lancamento">
      {% if selectTipos is defined %}
        <h4>Tipo</h4>
        {# Marca Itens que estão vindo na busca #}
        {% for item in selectTipos %}                
          {% if side.Tipos is defined %}                        
            {% if item.id == side.Tipos %}
              <input id="Tipos-{{loop.index}}" type="checkbox" name="Tipos[]" data-filtro = "Tipos" value="{{item.id}}" checked>
            {% else %}
              <input id="Tipos-{{loop.index}}" type="checkbox" name="Tipos[]" data-filtro = "Tipos" value="{{item.id}}" >
            {% endif %}
          {% else %}
            <input id="Tipos-{{loop.index}}" type="checkbox" name="Tipos[]" data-filtro = "Tipos" value="{{item.id}}" >
          {% endif %}
          
          <label for="Tipos-{{loop.index}}">{{item.nome}}</label>      
        {% endfor %}
        {# <a href="/#">Ver mais</a> #}
      {% endif %}
    </div>
    <div class="roww3">
      <div class="half_1">
        <h4>Quartos</h4>
        <div class="styled-select6">
         <select id="QtdQuartoLan" name="QtdQuarto" data-filtro="QtdQuarto" >
            <option value="">Todos</option>            
            <option value="1" {{ (side.QtdQuarto|default('') == '1') ? 'selected' : '' }} >01</option>
            <option value="2" {{ (side.QtdQuarto|default('') == '2') ? 'selected' : '' }} >02</option>
            <option value="3" {{ (side.QtdQuarto|default('') == '3') ? 'selected' : '' }} >03</option>
            <option value="4" {{ (side.QtdQuarto|default('') == '4') ? 'selected' : '' }} >04</option>          
            <option value="5" {{ (side.QtdQuarto|default('') == '5') ? 'selected' : '' }} >05 ou mais</option>          
         </select>
        </div>
      </div>
    </div>
    {% endif %}
    
   
      <div class="roww4">
        <h4>Área Útil</h4>
        <div id="slider-range-area" class="blue"></div>
        <input type="text" name="AreaMin" id="input-area-min" class="input-range" value="" onkeypress="return isNumber(event)"/>
        <input type="text" name="AreaMax" id="input-area-max" class="input-range" value="" onkeypress="return isNumber(event)"/>
      </div>
   
    {#
    <div class="roww3">
      <h4>Comodidades -- FALTA</h4>
      <input  type="checkbox" name="Caracteristicas[]" data-filtro="Caracteristicas" id="Caracteristicas-" checked="" value="all" name="chk">
      <label >Piscina</label>
      <input  type="checkbox" name="Caracteristicas[]" data-filtro="Caracteristicas" id="Caracteristicas-" value="false" name="chk">
      <label >Piscina Infantil</label>
      <input  type="checkbox" name="Caracteristicas[]" data-filtro="Caracteristicas" id="Caracteristicas-" value="true" name="chk">
      <label >Elevador</label>
      <input  type="checkbox" name="Caracteristicas[]" data-filtro="Caracteristicas" id="Caracteristicas-" checked="" value="all" name="chk">
      <label >Churrasqueira</label>
      <input  type="checkbox" name="Caracteristicas[]" data-filtro="Caracteristicas" id="Caracteristicas-" value="false" name="chk">
      <label >Sauna a vapor</label>
      <a href="/#">Ver mais</a>
    </div>
    
    <div class="roww5">
      <h4>Veja Tambem</h4>
      <ul>
        <li>Apartamento, 4 Quartos, Barra da Tijuca para Alugar.</li>
        <li>Casa, 2 Quartos, Barra da Tijuca para Comprar..</li>
        <li>Flat, 3 Quartos, Sao Conrado para Comprar.</li>
        <li>Casa, 2 Quartos, Barra da Tijuca para Comprar..</li>
        <li>Apartamento, 4 Quartos, Barra da Tijuca para Alugar.</li>
      </ul>
    </div>
    #}
</div>
</form>

<script>
  $(document).ready(function() {


    valorTemp = "";
  
    $('.input-range').focus(function(event) {
      valorTemp = $(this).val(); 
      $(this).val("")
    }).blur(function(event) {
      if ($(this).val() == "")
        $(this).val(valorTemp); 
    });


      var SliderValor = document.getElementById('slider-range-valor');

      ValorMin = '{{side.ValorMin|default("0")}}'; 
      ValorMax = '{{side.ValorMax|default("5000000")}}'; 

      ValorMin = ValorMin.replace( /^\D+/g, ''); 
      ValorMax = ValorMax.replace( /^\D+/g, ''); 

      noUiSlider.create(SliderValor, {
        start: [ ValorMin, ValorMax ],
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

      SliderValor.noUiSlider.on('change', function( values, handle ) {
         doSearch('#filtro-lateral', 1); 
      });

   
      inputNumberMin.addEventListener('keyup', function(){
        inputNumberMin.value = format(this.value); 
      });

      $("#input-number-min").blur(function(event) {
        SliderValor.noUiSlider.set([$(this).val(), null]);
        doSearch('#filtro-lateral', 1); 
      });

      $("#input-number-min").keypress(function(event) {
        if (event.keyCode == 13){
          SliderValor.noUiSlider.set([$(this).val(), null]); 
          $("#input-number-min").blur(); 
        }
      });

      inputNumberMax.addEventListener('keyup', function(){
        inputNumberMax.value = this.value == '5.000.000' ? format(this.value)+'+' : format(this.value); 
      });

      $("#input-number-max").blur(function(event) {
        SliderValor.noUiSlider.set([null, $(this).val()]);
        doSearch('#filtro-lateral', 1); 
      });

      $("#input-number-max").keypress(function(event) {
        if (event.keyCode == 13){
          SliderValor.noUiSlider.set([null, $(this).val()]); 
          $("#input-number-max").blur(); 
        }
      });

      var SliderArea = document.getElementById('slider-range-area');

      AreaMin = '{{side.AreaMin|default("0")}}'; 
      AreaMax = '{{side.AreaMax|default("6000")}}'; 

      AreaMin = AreaMin.replace( /^\D+/g, ''); 
      AreaMax = AreaMax.replace( /^\D+/g, ''); 

      noUiSlider.create(SliderArea, {
        start: [ AreaMin, AreaMax ],
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

      var inputAreaMin = document.getElementById('input-area-min');
      var inputAreaMax = document.getElementById('input-area-max');


      var status_slider_range_load_dosearch = false; 

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

      SliderArea.noUiSlider.on('change', function( values, handle ) {
         doSearch('#filtro-lateral', 1); 
      });


      inputAreaMin.addEventListener('keyup', function(){
        inputAreaMin.value = format(this.value); 
      });

      $("#input-area-min").keypress(function(event) {
        if (event.keyCode == 13){
          SliderArea.noUiSlider.set([$(this).val(), null]); 
          $("#input-area-min").blur(); 
        }
      });

      $("#input-area-min").blur(function(event) {
        SliderArea.noUiSlider.set([$(this).val(), null]);
        doSearch('#filtro-lateral', 1); 
      });

      inputAreaMax.addEventListener('keyup', function(){
        inputAreaMax.value = this.value == '6.000' ? format(this.value)+'+' : format(this.value); 
      });

      $("#input-area-max").blur(function(event) {
        SliderArea.noUiSlider.set([null, $(this).val()]);
        doSearch('#filtro-lateral', 1); 
      });

      $("#input-area-max").keypress(function(event) {
        if (event.keyCode == 13){
          SliderArea.noUiSlider.set([null, $(this).val()]); 
          $("#input-area-max").blur(); 
        }
      });
  });
</script>


