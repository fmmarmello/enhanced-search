{# "favoritos" recebe array de itens favoritados #}

{% set favoritos = "" %}
{% if CookieFavoritos['favoritos']['empreendimento'] is defined %}
  {% set favoritos = CookieFavoritos['favoritos']['empreendimento'] %}
{% endif %}

{% if content is not null %}
  <section class="emprend_sec desk">
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="emprend_inner">
              <div class="emprend_inner_head">
                <h3>Condomínios e Empreendimentos</h3>
              </div>
              <div class="emprend_inner_head_rt">
                <p>Quer receber os lançamentos com exclusividade?</p>
                <form action="/contato/newsletter/" method="post">
                  <input data-value="contato" type="text" value="{{token}}" name="token">
                  <input data-value="contato" type="text" value="{{Customer.name|convert_encoding('UTF-8','iso-8859-1')}} - Newsletter" name="origem">
              
                  <input type="text" placeholder="Nome" name="nome" required/>
                  <input type="email" placeholder="E-mail" name="email" required/>
                  <input type="submit" value="Cadastrar" />  
                </form>
              </div>
              {% if content|length > 1 %}
                <div class="emprend_main">
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="emprend_Box">
                        <div class="emprend_Pic1">
                          <div style="width:100%; height:358.56px;background:url({{content[0].imgurl}}) no-repeat center center;background-size:cover;"></div>
                          <!-- <img src="{{Config.base_url}}theme/images/empreend_pic1.jpg" alt="" /> -->
                          <div class="emprend_txt1">
                            <div class="tag">{{content[0].bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                            <h4>{{content[0].empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</h4>
                            <h5>{{content[0].tipologia|convert_encoding('UTF-8','iso-8859-1')|default("")}}</h5>
                            <p>{{content[0].vitrinechamada|default("")}}</p>
                            <a href="{{Config.base}}prontos/{{content[0].objurl}}/{{content[0].id}}/">Ver Detalhes</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="emprend_Box">
                        <div class="emprend_Pic2">
                          <div style="width:100%; height:358.56px;background:url({{content[1].imgurl}}) no-repeat center center;background-size:cover;"></div>
                          <div class="tag">{{content[1].bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                          <div class="emprend_txt2">
                            <h4>{{content[1].empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</h4>
                            <h5>{{content[1].tipologia|convert_encoding('UTF-8','iso-8859-1')|default("")}}</h5>
                            <p>{{content[1].vitrinechamada|default("")}}</p>
                            <a href="{{Config.base}}prontos/{{content[1].objurl}}/{{content[1].id}}/">Ver Detalhes</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>  
                </div>  
              {% endif %}
              
              {% if content|length > 4 %}
                <div class="emprend_main">
                    <div class="row"> 
                      <div class="col-sm-4">
                        <div class="emprend_Box">
                          <div class="emprend_Pic2">
                            <div style="width:100%; height:356px;background:url({{content[2].imgurl}}) no-repeat center center;background-size:cover;"></div>
                            <div class="tag">{{content[1].bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                            <div class="emprend_txt2">
                              <h4>{{content[2].empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</h4>
                              <h5>{{content[2].tipologia|convert_encoding('UTF-8','iso-8859-1')|default("")}}</h5>
                              <p>{{content[2].vitrinechamada|default("")}}</p>
                              <a href="{{Config.base}}prontos/{{content[2].objurl}}/{{content[2].id}}/">Ver Detalhes</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="emprend_Box">
                          <div class="emprend_Pic2">
                            <div style="width:100%; height:356px;background:url({{content[3].imgurl}}) no-repeat center center;background-size:cover;"></div>
                            <div class="tag">{{content[1].bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                            <div class="emprend_txt2">
                              <h4>{{content[3].empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</h4>
                              <h5>{{content[3].tipologia|convert_encoding('UTF-8','iso-8859-1')|default("")}}</h5>
                              <p>{{content[3].vitrinechamada|default("")}}</p>
                              <a href="{{Config.base}}prontos/{{content[3].objurl}}/{{content[3].id}}/">Ver Detalhes</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="emprend_Box">
                          <div class="emprend_Pic2">
                            <div style="width:100%; height:356px;background:url({{content[4].imgurl}}) no-repeat center center;background-size:cover;"></div>
                            <div class="tag">{{content[1].bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                            <div class="emprend_txt2">
                              <h4>{{content[4].empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</h4>
                              <h5>{{content[4].tipologia|convert_encoding('UTF-8','iso-8859-1')|default("")}}</h5>
                              <p>{{content[4].vitrinechamada|default("")}}</p>
                              <a href="{{Config.base}}prontos/{{content[4].objurl}}/{{content[4].id}}/">Ver Detalhes</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              {% endif %}
            </div>
          </div>
        </div>
      </div>
  </section>
{% endif %}