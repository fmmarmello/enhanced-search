<!-- RELACIONADOS -->
{% if content.produto == "imovel" %}
<div class="product_item_sec product_item_sec_2">
  <div class="row">
    <div class="col-sm-12">         
      <h2 class=>Veja também esses imóveis</h2>
    </div>
    
    {% set count = 0 %}
    {% for key, item in content.items if count < 4 %}
      {% if item.Imagens|length > 0 %}
        {% set count = count + 1%}
        <div class="col-sm-3">
          <div class="product_itemBx">            
            <div class="product_itemBxTop">
            <!--   <div class="img_hov_Prtrit">
                <a href="#"><img src="{{Config.base_url}}theme/images/sos2.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos2_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos2.png'" /></a>
                <a href="#"><img src="{{Config.base_url}}theme/images/sos1.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos1_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos1.png'" /></a>
              </div> -->
              <div class="pdct_pic">
                <div class="galeria-relacionados" style="background: url('{{Config.ImagePathApi}}{{item.Imagens[0].ImagemID|default(0)}}.jpg?mw=263') no-repeat center center;background-size:cover;"></div>
                <!-- <img src="{{Config.HOST_ADMIN}}{{item.Imagens[0].ImagePath}}"> -->
                <!-- <span class="prdct_dtls"><a href="{{Config.base}}prontos/{{item.Url}}">Ver detalhes</a></span> -->
              </div>
              {% if item.ValorVenda|default(0) > 0 %}
                <span><strong>Valor do Imóvel (R$)</strong>{{item.ValorVenda|number_format(0,",",".")}}</span>
              {% endif %}
            </div>            
            <div class="product_itemBxBot">
              <h3>
                <a href="/prontos/{{item.Url}}">{{item.BairroNome}}, {{item.CidadeNome}} - {{item.EstadoSigla}}</a>  
              <!--   <span>subtitulo??</span> -->
              </h3>
                <p>
                  {% if item.TipoNome != "" %}
                    {{item.TipoNome}}
                  {% endif %}
                  
                  {% if item.BairroNome != "" %}
                    | {{item.BairroNome}}
                  {% endif %}

                  {% if item.QtdQuarto|default(0) > 0 %}
                    | {{item.QtdQuarto > 1 ? item.QtdQuarto~" Quartos" : item.QtdQuarto~" Quarto"}}
                  {% endif %}

                </p>
              <ul>
                {% if item.QtdQuarto|default(0) != "" %}
                  <li><a href="/prontos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/product_icon1.jpg" data-toggle="tooltip" data-placement="top" title="" data-original-title="Quarto(s)"> <span>{{item.QtdQuarto}}</span> </a></li>
                {% endif %}

                {% if item.QtdVaga|default(0) != "" %}
                  <li><a href="/prontos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/product_icon2.jpg" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vaga(s) de Garagem"> <span>{{item.QtdVaga}}</span> </a></li>
                {% endif %}

                {% if item.AreaUtil|default("") != "" %}
                  <li><a href="/prontos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/product_icon3.jpg" data-toggle="tooltip" data-placement="top" title="" data-original-title="Área Útil"> <span>{{item.AreaUtil}} m2</span> </a></li>
                {% endif %}

              </ul> 
            </div>            
            <div class="product_itemBxBot_bottm" style="
            margin-bottom: 10px;">
              <h4><a href="{{Config.base}}prontos/{{item.Url}}">Detalhes</a></h4>
            </div> 
          </div>          
        </div>
       {% endif %}
    
    {% endfor %}
  </div> 
</div> 

{% else %}
  <div class="product_item_sec vitrine-relacionados-lancamento">
  <div class="row">
    <div class="col-sm-12">         
      <h2>Veja também esses empreendimentos</h2>
    </div>
    
    {% set count = 0 %}
    {% for key, item in content.items if count < 4 %}
        {% set count = count + 1%}
        <div class="col-sm-3">
          <div class="product_itemBx">            
            <div class="product_itemBxTop">
            <!--   <div class="img_hov_Prtrit">
                <a href="#"><img src="{{Config.base_url}}theme/images/sos2.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos2_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos2.png'" /></a>
                <a href="#"><img src="{{Config.base_url}}theme/images/sos1.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos1_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos1.png'" /></a>
              </div> -->
              <div class="pdct_pic">
                <div class="galeria-relacionados" style="background-image: url('{{Config.HOST_ADMIN}}{{item.ImagemCapaPath|default('_custom/galeria_imagem/imagens/img_imovel_sem_foto_2.png')}}');"></div>
               <!--  <span class="prdct_dtls"><a href="{{Config.base}}lancamentos/{{item.Url}}">Ver detalhes</a></span> -->
              </div>

              <div class="captn_prt">
                <span>
                  {% if item.M2Menor is defined %}
                    <strong>de </strong>{{item.M2Menor}} m<sup>2</sup>
                  {% endif %}

                  {% if item.M2Maior is defined %}
                    <strong>até </strong>{{item.M2Maior}} m<sup>2</sup>
                  {% endif %}
                </span>
              </div>

            </div>            
            <div class="product_itemBxBot">
              <h3>
                <a href="/lancamentos/{{item.Url}}" title="{{item.BairroNome}}, {{item.CidadeNome}} {#item.EstadoSigla#}">{{item.BairroNome}},<br> {{item.CidadeNome}} {#item.EstadoSigla#}</a>  
                <!--   -->
              </h3>
                <p>
                  {% if item.StatusNome != "" %}
                    {{item.StatusNome}}
                  {% endif %}
                  
                  {% if item.NaturezaNome != "" %}
                    | {{item.NaturezaNome}}
                  {% endif %}
                  <br>
                  {% if item.BairroNome != "" %}
                    {{item.BairroNome}}
                  {% endif %}

                </p>
              <ul>
                
                {% if item.QtdQuarto|length > 0 %}
                  <li><span><img src="{{Config.base_url}}theme/images/odd1.png"> {{item.QtdQuarto|join(', ')}} Quarto(s)</span> </li>
                  <!--<li><a href="/lancamentos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/odd1.png"> <span>{{item.QtdQuarto|join(', ')}} Quarto(s)</span> </a></li>-->
                {% endif %}

                {% if item.Tipos|length > 0 %}
                <li><span><img src="{{Config.base_url}}theme/images/odd.png"> {{item.Tipos|join(', ')}}</span></li>
                <!--<li><a href="/lancamentos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/odd.png"> <span>{{item.Tipos|join(', ')}}</span> </a></li>-->
                {% endif %}                

                {% if item.M2Menor is defined or item.M2Maior is defined %}
                <!--<li><span><img src="{{Config.base_url}}theme/images/odd3.png"> {{item.M2Maior|default(false) ? "de "~item.M2Maior~"M²" : ""}} {{item.M2Maior|default(false) ? "a "~item.M2Maior~"M²" : ""}}</span> </li>
                <li><a href="/lancamentos/{{item.Url}}"><img src="{{Config.base_url}}theme/images/odd3.png"> <span>{{item.M2Maior|default(false) ? "de "~item.M2Maior~"M²" : ""}} {{item.M2Maior|default(false) ? "a "~item.M2Maior~"M²" : ""}}</span> </a></li>-->
                {% endif %}
              </ul> 
            </div>            
            <div class="product_itemBxBot_bottm">
              <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
            </div>  
          </div>          
        </div>
    {% endfor %}
  </div> 
</div> 
{% endif %}



