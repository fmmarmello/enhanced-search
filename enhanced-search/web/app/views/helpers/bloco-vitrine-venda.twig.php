{# "favoritos" recebe array de itens favoritados #}
{% set favoritos = "" %}
{% if CookieFavoritos['favoritos']['imovel'] is defined %}
  {% set favoritos = CookieFavoritos['favoritos']['imovel'] %}
{% endif %}
{% if content is not null %}
  <section class="mid_sec">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="product_item_sec">
            <div class="row">
              <!-- <div class="col-sm-12">         
                <h2>Imóveis <span><a href="/prontos/">Ver Todos</a></span></h2>
              </div> -->
            </div>  
              <div class="row">
                <div class="col-sm-12">
                  <div id="owl-demo2" class="owl-carousel">                    
                    {% for entry in content %}
                    {% if loop.index == 1 or loop.index0 is divisibleby(2) %}
                    <div class="item"> <!-- item duplo -->
                    {% endif %}
                      <div class="product_itemBx"><!-- item unico -->
                        <div class="product_itemBxTop">
                         {# <div class="img_hov_Prtrit">
                            <a href="/#">
                              <img alt="" src="theme/images/sos1.png">
                            </a>
                            <a href="/#">
                              <img alt="" src="theme/images/sos2.png">
                            </a>
                          </div> #}
                          <div class="captn_prt" style="z-index:99999999"></div>
                          <div class="pdct_pic">
                            <!-- <img src="theme/images/product_img.jpg"> -->
                           <div class="vitrine-venda-img" style="background-image: url('{{entry.imgurl}}')"></div>
                           <!--  <img src="{#entry.imgurl#}"> -->
                            <span class="prdct_dtls"><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">Ver detalhes</a></span>
                          </div>                          
                          <span>
                          {% if entry.valorvenda > 0 %}
                            <strong>R$</strong> {{entry.valorvenda|number_format(0,",",".")}}
                          {% else %}
                              {{entry.valorlocacao > 0 ? entry.valorlocacao|number_format(0,",",".") : "Consulte-nos"}}
                          {% endif %}                          
                          </span>
                        </div>            
                        <div class="product_itemBxBot">
                          <h3><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">{{entry.vitrinetitulo|convert_encoding('UTF-8','iso-8859-1')}}</a>  <span></span></h3>
                          <p>{{entry.vitrinechamada|convert_encoding('UTF-8','iso-8859-1')}}</p>
                          <ul>
                            <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/product_icon1.jpg"> <span>{{ entry.quartos > 0 ? entry.quartos : '-'}}</span> </a></li>
                            <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/product_icon2.jpg"> <span>{{ entry.vagas > 0 ? entry.vagas : '-'}}</span> </a></li>
                            <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/product_icon3.jpg"> <span>{{ entry.areaconstruida > 0 ? entry.areaconstruida : '-'}}</span> </a></li>
                          </ul>
                        </div>
                      </div><!-- item unico -->                      
                    
                    {% if loop.index is divisibleby(2) %}
                    </div> <!-- item duplo -->
                    {% endif %}

                    {% endfor %}
                  </div>  
                          
                </div>
              </div>             
          </div>
        </div>
      </div>
    </div>
  </section>
{% endif %}