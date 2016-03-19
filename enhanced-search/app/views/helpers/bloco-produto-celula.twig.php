<div class="resulto_col1">
  <div class="resulto_col1_lft">
    <div class="flexslider">
      <ul class="slides">
        {% if produto == "imovel" %}
          {% if item.Imagens|length > 0 %}
            {% for key, image in item.Imagens %}             
                <li><div style="background: url({{Config.ImagePathApi}}{{image.ImagemID}}.jpg?w=338) no-repeat center center;width: 100%;height: 226px;background-size: cover;"   /></li>              
            {% endfor %}
          {% else %}
            {#<!-- COLOCAR IMAGEM PADRÃO CINZA -->#}
            <li><img src="{{Config.ImagePath}}0" alt="" style="width:100%"/></li>            
          {% endif %}
        {% else %}
          <!-- IMAGEM DE CAPA DA FICHA TÉCNICA DO EMPREENDIMENTO -->
          <li><div style="background: url('{{Config.HOST_ADMIN}}{{item.ImagemCapaPath|default('_custom/galeria_imagem/imagens/img_imovel_sem_foto_2.png')}}') no-repeat center center;width: 100%;height: 226px;background-size: cover;" /></li>
        {% endif %}       

      </ul>
      <div class="captn_prt">
          <div class="cap_lft">
            {% if item.ValorLocacao is defined and item.ValorLocacao != "" and 'locacao' in ROTA %}
              {% if produto == "empreendimento" %}
                <h5>A partir de</h5>
              {% endif %}
              
              <h4><span>R$</span> {{item.ValorLocacao|number_format(0,",",".")}}</h4>
            {% elseif item.ValorVenda is defined and item.ValorVenda != "" %}
              <h4><strong>R$</strong> {{item.ValorVenda|number_format(0,",",".")}}</h4>
            {% else %}
              <h4>Valor sob consulta</h4>
            {% endif %}
          </div>
          
        </div>
        <div class="cap_hov_Prtrit">
          <div class="cap_lft cap_lftyelo">
            <a class="{{produto=='empreendimento' ? 'odd' : ''}}">{{(produtotag == 'lancamentos'? 'Lançamento' : content.finalidadelabel)}}</a>
          </div>
          <div class="cap_rit">
            <a href="#"><img src="{{Config.base_url}}theme/images/whit_star.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/yello_star.png'" onmouseout="this.src='{{Config.base_url}}theme/images/whit_star.png'" /></a>
            <a href="#"><img src="{{Config.base_url}}theme/images/sos1.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos1_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos1.png'" /></a>
          </div>
        </div>  
      </div>
  </div>
  {% if produto == "imovel" %}
    <div class="resulto_col1_rit">
      <a href="{{Config.base}}prontos/{{item.Url}}"><h2>
        {{item.TipoNome}} | {{item.BairroNome}} 
        
        {% if item.QtdQuarto|default(0) > 0 %}
          {{item.QtdQuarto > 1 ? "| "~item.QtdQuarto~" Quartos" : "| "~item.QtdQuarto~" Quarto" }}
        {% endif %}
      </h2></a>
      <h4>{{item.BairroNome}}, {{item.CidadeNome}}, {{item.EstadoSigla}}</h4>
      <p>
        {% if item.TipoNome != "" %}
          {{item.TipoNome}}
        {% endif %}
        
        {% if item.QtdQuarto|default(0) > 0 %}
          com {{item.QtdQuarto > 1 ? item.QtdQuarto~" Quartos" : item.QtdQuarto~" Quarto" }} 
        {% endif %}

        {% if item.QtdSuite|default(0) > 0 %}
          sendo {{item.QtdSuite > 1 ? item.QtdSuite~" Suites" : item.QtdSuite~" Suite" }}
        {% endif %}
   
      </p>
        
      <div class="product_itemBxBot resulto_item">
        <ul>
          {% if item.QtdQuarto|default(0) > 0 %}
            <li><a href="/prontos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/product_icon1.jpg" data-toggle="tooltip" data-placement="top" title="" data-original-title="Quarto(s)"> <span>{{item.QtdQuarto}}</span> </a></li>
          {% endif %}
          
          {% if item.QtdVaga|default(0) > 0 %}
            <li><a href="/prontos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/product_icon2.jpg" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vaga(s) de Garagem"> <span>{{item.QtdVaga}}</span> </a></li>
          {% endif %}

          {% if item.AreaUtil|length != "" %}
            <li><a href="/prontos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/product_icon3.jpg" data-toggle="tooltip" data-placement="top" title="" data-original-title="Área Útil"> <span>{{item.AreaUtil}} m<sup>2</sup></span></a></li>
          {% endif %}
        </ul>             
      </div>
      <div class="resulto_item_btn">
        {%if 'locacao' in ROTA %}
          <a href="{{Config.base}}locacao/{{item.Url}}">Ver Detalhes</a>
        {% else %}
          <a href="{{Config.base}}prontos/{{item.Url}}">Ver Detalhes</a>
        {% endif %}
        
      </div>
    </div>
  
  {% elseif produto == "empreendimento" %}
  
    <div class="resulto_col1_rit">
      <a href="{{Config.base}}lancamentos/{{item.Url}}"><h2>{{item.Nome}}</h2></a>
      <h4>{{item.BairroNome}}, {{item.CidadeNome}}, {{item.EstadoSigla}}</h4>
      <!-- <p>Avanco Aliados</p> -->
      <div class="product_itemBxBot resulto_item odd2">
      <ul>
        {% if item.QtdQuarto|length > 0 %}
          <li><a href="/lancamentos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/odd1.png"> <span>{{item.QtdQuarto|join(', ')}} Quarto(s)</span> </a></li>
        {% endif %}

        {% if item.Tipos %}
          <li><a href="/lancamentos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/odd.png"> <span>{{item.Tipos|join(', ')}}</span> </a></li>
        {% endif %}
        
        {% if item.M2Menor is defined or item.M2Maior is defined %}
          <li>
            <a href="/lancamentos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/odd3.png">
              <span>
                {% if item.M2Menor is defined %}
                  {{item.M2Menor}} M<sup>2</sup> 
                {% endif %}

                {% if item.M2Maior is defined %}
                  a {{item.M2Maior}} M<sup>2</sup>
                {% endif %}
              </span> 
            </a>
          </li>
        {% endif %}
      </ul>
        </div>
      <div class="resulto_item_btn">
        <a href="{{Config.base}}lancamentos/{{item.Url}}">Ver Detalhes</a>
      </div>
    </div>
  {% endif %}
</div>
