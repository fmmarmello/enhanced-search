{# "favoritos" recebe array de itens favoritados #}

{% set favoritos = "" %}
{% if CookieFavoritos['favoritos']['empreendimento'] is defined %}
  {% set favoritos = CookieFavoritos['favoritos']['empreendimento'] %}
{% endif %}

{% if content is not null %}

<div class="whit_carocel_sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="whit_carocel_sec_inn">
          <div class="product_item_sec">
        <div class="row">
          <div class="col-sm-12">         
            <h6>Oportunidades da semana</h6>
          </div>
        </div>  
          <div class="row">
            <div class="col-sm-12">
              <div id="owl-demo" class="owl-carousel">
                {% set count = 0 %}
                {% for item in content %}
                  
                  {% if count == 0 %}
                    <div class="item">
                  {% endif %}
                    
                    <div class="product_itemBx">
                      <div class="product_itemBxTop">
                       <!--  <div class="img_hov_Prtrit">
                          <a href="#" class="img_hov_Prtrit_star"></a>
                          <a href="#">
                            <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                          </a>
                        </div> -->
                        <div class="pdct_pic">
                          <div style="width:100%; height:171px; background:url('{{Config.ImagePathApi}}{{item.imagemid}}.jpg?mw=263') no-repeat center center; background-size: cover;"></div>
                          <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                        </div>
                        {% if item.valorvenda|default("") %}
                          <span><strong>Valor do Imóvel (R$)</strong>{{item.valorvenda|number_format(0, ',', '.')}}</span>
                        {% endif %}
                      
                      </div>            
                      <div class="product_itemBxBot">
                        <h3>
                          <a href="{{Config.base}}prontos/{{item.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{item.id}}/">
                            {{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}}, {{item.cidadenome|convert_encoding('UTF-8','iso-8859-1')}}, {{item.estadosigla}}
                          </a>  
                          <!-- <span>Botafogo, RJ</span> -->
                        </h3>
                       <!--  <p>Casa de Condomínio</p> -->
                        <p><span>{{item.nometipo|convert_encoding('UTF-8','iso-8859-1')}}<br/>{{item.quartos > 0 ? "com "~item.quartos~" quarto(s)" : "" }} {{item.quartos > 0 ? ", sendo "~item.suites~" suite(s)" : "" }} </span></p>
                        <ul>
                          {% if item.quartos|default(0) > 0 %}
                            <li><img src="{{Config.base_url}}theme/images/product_icon1.jpg" data-toggle="tooltip" data-placement="top" title="Quarto(s)"> <span>{{item.quartos}}</span></li>
                          {% endif %}
                          {% if item.vagas|default(0) > 0 %}
                            <li><img src="{{Config.base_url}}theme/images/product_icon2.jpg" data-toggle="tooltip" data-placement="top" title="Vaga(s) de Garagem"> <span>{{item.vagas}}</span></li>
                          {% endif %}
                          {% if item.areaconstruida|default(0) != "" %}
                            <li><img src="{{Config.base_url}}theme/images/product_icon3.jpg" data-toggle="tooltip" data-placement="top" title="Área Útil"> <span>{{item.areaconstruida}} m<sup>2</sup></span></li>
                          {% endif %}
                        </ul>             
                      </div>
                      <div class="product_itemBxBot_bottm">
                        <a class="btn btn-block btn-laranja" href="{{Config.base}}prontos/{{item.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{item.id}}/" role="button" title="Detalhes">Detalhes</a>
                        <!-- <h4><a href="{{Config.base}}prontos/{{item.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{item.id}}/">Detalhes</a></h4> -->
                      </div>            
                    </div>

                  {% if count == 1 %}
                    </div>
                  {% endif %}
                  
                  {% set count = count + 1 %}
                  {% set count = count == 2 ? 0 : count %}

                {% endfor %}

              </div>  
                      
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{% endif %}