          <style>
            .produto-link{
              font-size: 15px;
              font-weight: bold;
            }
          </style>
          <div class="{{cssClass}} col-md-12 col-sm-12">
            <h2>Matérias em Destaque</h2>

            {% for entry in content %}

              {% if entry.produto == 'noticia' %}
                  <div class="product-item">
                    <div class="pi-info-wrapper">
                      <div class="pi-data">{{entry.data_insercao|date("d/m/Y")}}</div>
                      <h3 class="pi-titulo"><a class="produto-link" href="/noticia/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/"> {{entry.titulo|convert_encoding('UTF-8','iso-8859-1')}}</a></h3>
                      <a href="/noticia/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/" class="btn link-detalhes">Leia mais</a>
                    </div>
                  </div>
              {% endif %}          

            {% endfor %}
            </div>    