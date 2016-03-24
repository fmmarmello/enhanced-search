  <section class="banner_sec">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      
      <!-- Indicators -->
      <!-- <ol class="carousel-indicators">
        {% for key, banner in content %}
          <li data-target="#carousel-example-generic" data-slide-to="{{key}}" class="{{key == 0 ? 'active' : ''}}"></li>
        {% endfor %}
       </ol> -->
      <!-- Wrapper for slides -->
      
      <div class="carousel-inner" role="listbox">
        {% for key, banner in content %}
          <div class="item {{key == 0 ? 'active' : ''}}">
            <div class="banner_Box" style="background: url({{banner.imgurl}}) no-repeat center center;">
              <div class="banner_txt_main">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="banner_txt">
                        <h2>{{banner.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h2>
                        <h1>{{banner.subtitulo|convert_encoding('UTF-8','iso-8859-1')}}</h1>
                        <!-- <a href="{{banner.link}}" target="{{banner.target}}">Ver imóveis</a> -->
                        <!--<h2 class="mobile">{{banner.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h2>-->
                        
                        <!-- <div class="desk">
                          <a href="{{banner.link}}" target="{{banner.target}}">Ver imóveis</a>
                        </div> -->
                        
                        <!-- <div class="banner_txt2_main mobile">
                          <div class="banner_txt2">
                            <a href="{{Config.base}}prontos/">Imóveis para comprar</a>
                          </div>
                          <div class="banner_txt2">
                            <a href="{{Config.base}}aluguel/">Imóveis para alugar</a>
                          </div>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        {% endfor %}
 
      </div>
    
      <!-- Controls -->
        <!-- <a class="left left_arw" href="#carousel-example-generic" role="button" data-slide="prev">
          <img src="{{Config.base_url}}theme/images/left_arw.png" alt="" />
        </a>
        <a class="right rt_arw" href="#carousel-example-generic" role="button" data-slide="next">
          <img src="{{Config.base_url}}theme/images/rt_arw.png" alt="" />
        </a> -->
    </div>
    
    {% include 'inc/busca-api.twig.php' %}
  </section>


  <!-- BUSCA MOBILE -->
<!--   <section class="mob_buscar mobile">
    <div class="container">
      <div class="row">
        <div class="col-xs-8">
          <input type="text" placeholder="Clique aqui para encontrar imóvel..." />
        </div>
        <div class="col-xs-4">
          <a href = "javascript:void(0)" onclick = "document.getElementById('light11').style.display='block';document.getElementById('fade11').style.display='block'">buscar</a>
        </div>
      </div>
      
      
          <div class="banner_search mt20 mobile"> 
            <div class="banner_search_right prd_detl_top_srch">
              <ul>
                <li>
                  <span class="banner_search_Box1">
                    <p>O que você esta procurando?</p>
                    <a href="#" class="actv">Comprar</a>
                    <a href="#">Alugar</a>
                  </span>
                </li>
                <li>
                  <span class="banner_search_Box1">
                    <p>Tipo</p>
                    <select name="">
                                    <option value="1">Apartamento</option>
                                    <option value="1">Casa</option>
                                    <option value="1">Flat</option>
                                    <option value="1">Galpão</option>
                                    <option value="1">Cobertura</option>
                                </select>
                  </span>
                </li>
                <li>
                  <span class="banner_search_Box1">
                    <p>Onde?</p>
                    <input type="text" placeholder="Copacabana, Rio de Janeiro, rj" />
                  </span>
                </li>
              </ul>
            </div>
          </div>
        
    </div>
  </section> -->
  
  {% if app.request.server.get("REMOTE_ADDR") == '177.129.9.98' %}
    {% include 'inc/busca-mobile.twig.php' %}
  {% endif %}