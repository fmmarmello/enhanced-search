{# "favoritos" recebe array de itens favoritados #}
{% set favoritos = "" %}
{% if CookieFavoritos['favoritos']['imovel'] is defined %}
  {% set favoritos = CookieFavoritos['favoritos']['imovel'] %}
{% endif %}
          {% if content is not null %}
          <section class="immoval_sec" id="{{cssClass}}">
            <div class="container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="immoval_Inner">

                    <div class="immoval_Inner_top">
                      <span><!-- <img src="theme/images/star.png" alt="" />  --><strong>Imóveis </strong>em destaque</span>
                      <ul>
                        <li class="tab1"><a >Vendas</a></li>
                        <li class="tab2"><a  class="selected">Locação</a></li>
                      </ul>
                      {% if MeuIP == '177.129.9.98' %}                            
                      <ul class="ver-todos"><a href="/locacao/"><li>Ver Todos</li></a></ul>
                      {% endif %}
                    </div>

                    <div class="immoval_Inner_Midmain">
                      <div class="immoval_Inner_Mid" id="div2">
                        <div id="owl-imv-locacao" class="owl-carousel">

                          {% for entry in content %}                
                          <div class="item">
                            <div class="immoval_Box">
                              <div class="immoval_pic" style="background-image: url('{{entry.imgurl}}')">
                                <img src="{{entry.imgurl}}" alt="COD{{entry.id}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" />
                                
                                <div class="immoval_share">
                                  <ul>
                                    <li><a  class="share"></a></li>
                                    <li><a  class="like{% if entry.id in favoritos %}_hover{% endif %}" data-tipo='imovel' data-id='{{entry.id}}'></a></li>
                                  </ul>
                                </div>
                               
                                <div class="hovr_bg">
                                  <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/" class="serch2"><img src="theme/images/search2.png" alt="" /></a>
                                </div>
                              </div>
                              <div class="immoval_mid_main">
                                <div class="immoval_mid">                                  
                                  <h4>{{entry.nometipo|convert_encoding('UTF-8','iso-8859-1')}}</h4>
                                  <ul>
                                    <li><img src="theme/images/icone_local.png" alt=""> <a >{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</a></li>
                                  </ul>
                                </div>
                                <div class="immoval_bottm">
                                  <ul>
                                    {% if entry.quartos > 0 %}
                                    <li><a ><span><img src="theme/images/imovl_btm_icon1.png" alt="" /></span>{{entry.quartos}}</a></li>
                                    {% else %}
                                    <li><a ><span><img src="theme/images/imovl_btm_icon1.png" alt="" /></span>ND</a></li>
                                    {% endif %}

                                    {% set banheiroTotal = (entry.banheirosocial + entry.banheiroservico) %}
                                    {% if banheiroTotal > 0 %}
                                    <li><a ><span><img src="theme/images/imovl_btm_icon2.png" alt="" /></span>{{banheiroTotal}}</a></li>
                                    {% else %}
                                    <li><a ><span><img src="theme/images/imovl_btm_icon2.png" alt="" /></span>ND</a></li>
                                    {% endif %}                        

                                    {% if entry.areaconstruida is not null %}
                                    <li><a ><span><img src="theme/images/imovl_btm_icon3.png" alt="" /></span>{{entry.areaconstruida}}m²</a></li>
                                    {% else %}
                                    <li><a ><span><img src="theme/images/imovl_btm_icon3.png" alt="" /></span>ND</a></li>
                                    {% endif %}
                                  </ul>
                                  <span class="price">{% if entry.valorvenda > 0 %}R$ <strong>{{entry.valorvenda|number_format(0,",",".")}}{% else %}Consulte!{% endif %}</strong></span>

                                  <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/" class="immoval_btn">Ver mais</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          {% endfor %}  

                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </section>

          <script>
            $(document).ready(function() {
                $("#imoveis-destaque-locacao .tab1").click(function(){
                  $("#imoveis-destaque-locacao").fadeOut('fast', function() {
                    $("#imoveis-destaque-venda").fadeIn('fast', function() {});
                  });                  
                });
             
                var owl = $("#owl-imv-locacao");
                owl.owlCarousel({
                    itemsCustom : [
                        [0, 1],
                        [450, 2],
                        [600, 3],
                        [700, 3],
                        [1000, 3],
                        [1200, 4],
                        [1400, 4],
                        [1600, 4]
                    ],
                    navigation : true
                });
               
            });
          </script>

          {% endif %}