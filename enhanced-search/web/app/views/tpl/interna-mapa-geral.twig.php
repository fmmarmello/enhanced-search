<link rel="stylesheet" type="text/css" href="assets/css/base.css">
<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
          {%set content = page.content %}
          <div id="bg-loader"></div>
          <img src="assets/img/spinner.svg" alt="loader" id="loader-spinner-mapa"/>

          <!-- BEGIN CONTENT --> 
          <div class="col-md-8 col-sm-12">

            <!-- BEGIN PRODUCT LIST -->
            <div class="row full-row mapa-geral" id="mapa-geral">
              <div id="map_wrapper">
                  <div id="map_canvas" class="mapping"></div>
              </div>
            </div>
            <!-- END PRODUCT LIST -->

          </div>
          <!-- END CONTENT -->

          <!-- BEGIN SIDE -->
          <div class="col-md-4 col-sm-12 lateral-direita-box">
            <div class="lateral-direita">
              <h2>Imóveis no Mapa</h2>
              <ul class="mapa-geral-menu">
                <li class="menu-item lancamentos item-first"><a href="/lancamentos/mapa/">Lançamentos</a></li>
                <li class="menu-item prontos"><a href="/prontos/mapa/">Prontos</a></li>
                <!-- <li class="menu-item locacao item-last"><a href="/locacao/mapa/">Locação</a></li> -->
              </ul>
              <ul class="mapa-geral-lista" id="mapa-geral-lista">              
              {% for entry in content %}
                {% if entry.mapalatitude is not null and entry.mapalongitude is not null %}
                <li class="produto-item" style="height: 80px" data-latitude="{{entry.mapalatitude}}" data-longitude="{{entry.mapalongitude}}">
                    {% include 'helpers/bloco-produto-celula-mapa.twig.php' %}
                </li>
                {% endif %}
              {% endfor %}
              </ul>
            </div>
          </div>
          <!-- END SIDE -->

          {% if 'mapa' in ROTA %}
            <style>
            #map_canvas{
              width: 300% !important; 
              height: 970px !important;
            }
              
            </style>            
          {% endif %}