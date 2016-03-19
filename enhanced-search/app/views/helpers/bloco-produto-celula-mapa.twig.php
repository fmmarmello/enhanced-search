              {% if entry.produto == 'imovel' %}
                  <div class="product-item" id="data-fichaid-{{entry.id}}">
                    <div class="pi-hover-opt">
                      <a class="produto-mapa" data-produtoid="{{entry.id}}" data-latitude="{{entry.mapalatitude}}" data-longitude="{{entry.mapalongitude}}">Mapa</a>
                      <a class="produto-link" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">Detalhes</a>
                    </div>

                    <div class="pi-img-wrapper">
                      <a class="produto-link-img" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">
                        <img id="COD{{entry.id}}" src="{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.id}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.id}}">
                      </a>
                    </div>

                    <div class="pi-info-wrapper">
                      <h2>{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</h2>
                    </div>

                    <div class="pi-ambientes-wrapper">
                      <div class="pi-tipologia">
                        <div class="valor">{{entry.nometipo|convert_encoding('UTF-8','iso-8859-1')}}</div>
                      </div>
                      
                      {# {% if entry.areaconstruida is not null %}
                      <div class="pi-area pi-amb-box">
                        <div class="valor">{{entry.areaconstruida}}m²</div>
                        <label>&nbsp;Área</label>
                      </div>
                      {% endif %} #}

                      {% if entry.quartos > 0 %}
                      <div class="pi-quartos pi-amb-box">
                        <div class="valor">{{entry.quartos}}</div>
                        <label>&nbsp;Quartos</label>
                      </div>
                      {% endif %}

                      {% set banheiroTotal = (entry.banheirosocial + entry.banheiroservico) %}
                      {% if banheiroTotal > 0 %}
                      <div class="pi-banheiro pi-amb-box">
                        <div class="valor">{{banheiroTotal}}</div>
                        <label>&nbsp;Banheiros</label>
                      </div>
                      {% endif %}

                      {% if entry.suites > 0 %}
                      <div class="pi-suites pi-amb-box">
                        <div class="valor">{{entry.suites}}</div>
                        <label>&nbsp;Suítes</label>
                      </div>
                      {% endif %}

                      {# {% if entry.vagas > 0 %}
                      <div class="pi-vagas pi-amb-box">
                        <div class="valor">{{entry.vagas}}</div>
                        <label>&nbsp;Vagas</label>
                      </div>
                      {% endif %} #}
                    </div>    

                    <div class="pi-price">
                    {% if entry.produtotag=='prontos' %}
                      {% if entry.valorvenda > 0 %}<div class="pi-attr price"><img src="assets/img/icon-dolar.png"/ alt="preco" title="Valor do imóvel"><span>R$</span> {{entry.valorvenda|number_format(0,",",".")}}&nbsp;</div>{% endif %}
                    {% endif %}
                    {% if entry.produtotag=='locacao' %}
                      {% if entry.valorlocacao > 0 %}<div class="pi-attr price-rent"><img src="assets/img/icon-dolar.png"/ alt="preco" title="Valor do imóvel"><span>R$</span> {{entry.valorlocacao|number_format(0,",",".")}}&nbsp;</div>{% endif %}
                    {% endif %}
                    </div>

                  </div>
              {% endif %}

              {% if entry.produto == 'empreendimento' %}
                  <div class="product-item" id="data-fichaid-{{entry.id}}">
                    <div class="pi-hover-opt">
                      <a class="produto-mapa" data-produtoid="{{entry.id}}" data-latitude="{{entry.mapalatitude}}" data-longitude="{{entry.mapalongitude}}">Mapa</a>
                      <a class="produto-link" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">Detalhes</a>

                    </div>

                    <div class="pi-img-wrapper">
                      <a class="produto-link-img" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">
                        <div class="sticker sticker-id-{{entry.statusid}}"></div>
                        <img id="COD{{entry.id}}" src="{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.id}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.id}}">
                      </a>
                      {% if entry.nquartos is not null %}
                        <div class="pi-quartos">
                        {% if entry.nquartos=="1" %}
                          {{entry.nquartos}} Qt
                        {% else %}
                          {{entry.nquartos}} Qt
                        {% endif %}
                        </div>
                      {% endif %}
                    
                    </div>

                    <div class="pi-info-wrapper">
                      <h2>{{entry.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')|slice(0,24)}}</h2>
                      <h3>{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</h3>
                      
                    </div>
                      
                    <div class="pi-atributos">
                      <span class="hide">{{entry.statusnome|convert_encoding('UTF-8','iso-8859-1')}}</span>
                      <div class="pi-tipologia">{{entry.tipologia|convert_encoding('UTF-8','iso-8859-1')}}&nbsp;</div>

                      {% if entry.m2menor is not null or entry.m2maior is not null %}
                        <div class="pi-area">
                      {% endif %}
                      {% if entry.m2menor is not null %}
                        {{entry.m2menor}}m²
                      {% endif %}
                      {% if entry.m2menor is not null and entry.m2maior is not null %}
                        a
                      {% endif %}
                      {% if entry.m2maior is not null %}
                        {{entry.m2maior}}m²
                      {% endif %}
                      {% if entry.m2menor is not null or entry.m2maior is not null %}
                        </div>
                      {% endif %}
                    </div>
                  </div>
              {% endif %}

              {% if entry.produto == 'noticia' %}
                  <div class="product-item">
                    <div class="pi-img-wrapper">
                      <a class="produto-link-img" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">
                        <img id="COD{{entry.id}}" src="{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.id}}|{{entry.titulo|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.id}}">
                      </a>
                    </div>
                    <div class="pi-info-wrapper">
                      <h2 class="pi-titulo"><a class="produto-link" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">{{entry.titulo|convert_encoding('UTF-8','iso-8859-1')}}</a></h2>
                      <div class="pi-data"><i class="fa fa-calendar"></i>{{entry.data_insercao|date("d/m/Y")}}</div>
                      <h3 class="pi-sumario"><a class="produto-link" href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">{{entry.sumario|convert_encoding('UTF-8','iso-8859-1')}}</a></h3>
                      <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/" class="btn link-detalhes">Leia mais &gt;&gt;</a>
                    </div>
                  </div>
              {% endif %}              