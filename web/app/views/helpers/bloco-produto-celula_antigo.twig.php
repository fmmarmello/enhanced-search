{# "favoritos" recebe array de itens favoritados #}
{% set favoritos = "" %}
{% set imoFavoritos = "" %}
{% set empFavoritos = "" %}
{% if CookieFavoritos['favoritos']['imovel'] is defined %}
  {% set imoFavoritos = CookieFavoritos['favoritos']['imovel'] %}
{% endif %}
{% if CookieFavoritos['favoritos']['empreendimento'] is defined %}
  {% set empFavoritos = CookieFavoritos['favoritos']['empreendimento'] %}
{% endif %}

                  <!-- ORDER BLOCK -->
                  <span class="hide">
                    <div class="produto-codigo">{{entry.id}}</div>

                    {% if entry.produto == 'imovel' %}
                      <div class="produto-ordenacao">{% if entry.produtotag == 'locacao' %} {{entry.valorlocacao}}{% else %}{{entry.valorvenda}}{% endif%}</div>
                      <div class="full-list-order">asc</div>
                      <div class="produto-bairro">{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                      <div class="produto-quarto">{{entry.quartos}} quartos</div>
                      {%if entry.empreendimentonome is defined%}<div class="produto-empreendimento">{{entry.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</div>{% endif%}
                      {%if entry.condominionome is defined%}<div class="produto-condominio">{{entry.condominionome|convert_encoding('UTF-8','iso-8859-1')}}</div>{% endif%}
                      {%if entry.nometipo is defined%}<div class="produto-tipo">{{entry.nometipo}}</div>{% endif%}
                      {% if entry.valorvenda is defined %}<div class="produto-preco">{{entry.valorvenda}}</div>{% endif %}
                    {% endif %}

                    {% if entry.produto == 'empreendimento' %}
                      <div class="produto-ordenacao">{{entry.imgorder}}</div>
                      <div class="full-list-order">desc</div>
                      <div class="produto-bairro">{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                      {%if entry.statusnome is defined%}<div class="produto-status">{{entry.statusnome|convert_encoding('UTF-8','iso-8859-1')}}</div>{% endif%}
                      {%if entry.empreendimentonome is defined%}<div class="produto-empreendimento">{{entry.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</div>{% endif%}
                      {%if entry.construtora is defined%}<div class="produto-construtora">{{entry.construtora|convert_encoding('UTF-8','iso-8859-1')}}</div>{% endif%}
                    {% endif %}
                  </span>
                  <!-- /ORDER BLOCK-->
              
              {% if entry.produto == 'imovel' %}
                  <!-- ITEM -->                  
                  <div class="dit_sec">
                    <div class="pic_box" style="background-image: url('{{entry.imgurl}}')">
                      <img src="{{entry.imgurl}}" alt="COD{{entry.id}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}"/>
                      <div class="pb_mid"></div>
                    </div>
                    <div class="rit_box">
                      <div class="rbLft">
                        <p>{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}} </p>
                        <h3>{{entry.nometipo|convert_encoding('UTF-8','iso-8859-1')}} </h3>
                        <ul>
                          <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/listIco1.png" alt=""/>
                            {% if entry.quartos is not null %}
                              {{entry.quartos}}
                            {% else %}
                              ND
                            {% endif %}
                          </a></li>
                          <!-- <li><a href="#"><img src="theme/images/listIco2.png" alt=""/>02</a></li> -->
                          <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/listIco3.png" alt=""/>
                            {% if entry.areaconstruida is not null %}
                              {{entry.areaconstruida}}m²
                            {% endif %}
                          </a></li>
                          <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/garage13.png" alt=""/>
                            {% if entry.vagas is not null %}
                              {{entry.vagas}}
                            {% endif %}
                          </a></li>
                        </ul>
                        {% if entry.produtotag == 'locacao' %}
                          {% if entry.valorlocacao > 0 %}
                              <h4>R$ <strong>{{entry.valorlocacao|number_format(0,",",".")}}</strong></h4>
                          {% endif %}
                          {% if entry.valorvenda > 0 %}
                              <!-- <h4>R$ {{entry.valorvenda|number_format(0,",",".")}}</h4> -->
                          {% endif %}
                        {% else %}
                          {% if entry.valorvenda > 0 %}
                              <h4>R$ <strong>{{entry.valorvenda|number_format(0,",",".")}}</strong></h4>
                          {% endif %}
                          {% if entry.valorlocacao > 0 %}
                              <!-- <h4>R$ {{entry.valorlocacao|number_format(0,",",".")}}</h4> -->
                          {% endif %}
                        {% endif %}

                      </div>
                      <div class="rbRit">                        
                        <div class="rbRit_top">
                          <!-- <a class="share"><img src="theme/images/ritPic1.png" alt=""/></a>
                          <a class="like" data-tipo='imovel' data-id='{{entry.id}}'><img class="like_img" src="theme/images/like{% if entry.id in imoFavoritos %}2{% endif %}.png" alt=""/></a> -->
                          <a  class="share"></a>
                          <a  class="like{% if entry.id in imoFavoritos %}_hover{% endif %}" data-tipo='imovel' data-id='{{entry.id}}'></a>
                        </div>                        
                        <div class="end_btn">
                          <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">Ver mais</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /ITEM -->
              {% endif %}

              {% if entry.produto == 'empreendimento' %}
                  <!-- ITEM -->
                  <div class="dit_sec">
                    <div class="pic_box" style="background-image: url('{{entry.imgurl}}')">
                      <img src="{{entry.imgurl}}" alt="COD{{entry.id}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}"/>
                      <div class="pb_mid"></div>
                    </div>
                    <div class="rit_box">
                      <div class="rbLft">
                        <h1>{{entry.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</h1>
                        <h3><img src="theme/images/icone_local.png" alt=""> {{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}} </h3>
                        <h3>{{entry.tipologia|convert_encoding('UTF-8','iso-8859-1')}} </h3>
                        <ul>
                          <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/listIco1.png" alt=""/>
                            {% if entry.nquartos is not null %}
                              {{entry.nquartos}}
                            {% else %}
                              ND
                            {% endif %}
                          </a></li>
                          <!-- <li><a href="#"><img src="theme/images/listIco2.png" alt=""/>02</a></li> -->
                          <li><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"><img src="theme/images/listIco3.png" alt=""/>
                            {% if entry.m2menor is not null %}
                              {{entry.m2menor}}m²
                            {% endif %}
                            {% if entry.m2menor is not null and entry.m2maior is not null %}
                              a
                            {% endif %}
                            {% if entry.m2maior is not null %}
                              {{entry.m2maior}}m²
                            {% endif %}
                          </a></li>
                        </ul>
                        <!-- <h4>R$ 200.000</h4> -->
                      </div>
                      <div class="rbRit">
                        <div class="rbRit_top">
                          <!-- <a class="share"><img src="theme/images/ritPic1.png" alt=""/></a>
                          <a class="like" data-tipo='empreendimento' data-id='{{entry.id}}'><img class="like_img" src="theme/images/like{% if entry.id in empFavoritos %}2{% endif %}.png" alt=""/></a> -->                          
                          <a  class="share"></a>
                          <a  class="like{% if entry.id in empFavoritos %}_hover{% endif %}" data-tipo='empreendimento' data-id='{{entry.id}}'></a>
                        </div>
                        <div class="end_btn">
                          <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">Ver mais</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /ITEM -->
              {% endif %}

              {% if entry.produto == 'noticia' %}
                <!-- ITEM -->
                <div class="col-md-4 col-sm-6 col-xs-12 produto-item">
                  <div class="product-item">
                      <div class="pi-date-wrapper">
                        <div class="data-dia">{{entry.data_insercao|date("d")}}/{{entry.data_insercao|date("m")}}</div>
                      </div>
                      <div class="pi-info-wrapper">
                        {# <div class="pi-data"><i class="fa fa-calendar"></i>{{entry.data_insercao|date("d/m/Y")}}</div> #}
                        <h2 class="pi-titulo"><a class="produto-link" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">
                        {{(entry.titulo|length > 50 ? entry.titulo|slice(0, 50) ~ '...' : entry.titulo)|convert_encoding('UTF-8','iso-8859-1')}}</a></h2>
                        <h3 class="pi-sumario"><a class="produto-link" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">
                        {{(entry.sumario|length > 65 ? entry.sumario|slice(0, 65) ~ '...' : entry.sumario)|convert_encoding('UTF-8','iso-8859-1')}}</a></h3>
                        <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/" class="btn link-detalhes">Leia mais</a>
                      </div>
                    </div>
                  </div>
                <!-- /ITEM -->
              {% endif %}