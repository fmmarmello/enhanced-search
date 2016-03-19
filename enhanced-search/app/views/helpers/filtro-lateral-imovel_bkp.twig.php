          <!-- BEGIN SIDEBAR -->
          <div class="sidebar lft_box margin-bottom-40" id="filtro-lateral" data-ws="{% if content.produto == 'imovel' %}buscaImoveis{% else %}buscaEmpreendimentos{% endif %}">
            <div class=" lft_box_top">

              <div id="tags_container"><h3>Filtrados por:</h3></div>
              
              {% for tipo, itens in content.filtros %}

                {% if itens != null %} {# bairro é escolhido dinamicamente #}
                <div {% if tipo == 'bairro' %} class="hidden-filter"{% endif %}>
                  <h3>{{tipo|capitalize}}</h3>
                  <div class="in_select">
                    <span class="otr_select">
                      <select class="selectBox-dropdown" name="select_{{tipo}}">
                        <option class="opt {{tipo}}" value="NULL">-Selecione-</option>
                        {% set idx = 0 %}
                          {% for item in itens %}
                            <option class="opt {{tipo}}" id="{{tipo}}_{{idx}}" data-index="{{idx}}" data-tipo="{{tipo}}" data-valor="{{item.nome}}" data-id="{{item.id}}" value="{{idx}}">{{item.nome}}</option>
                          {% set idx = idx + 1 %}
                        {% endfor %}
                      </select>
                    </span>
                  </div>
                </div>
                {% endif %}
              {% endfor %}
            </div>
          </div>
          {#<!-- TCK#2845 -->#}
          <script type="text/javascript">
            $(document).ready(function(){
              // marca a finalidade na barra de busca
              var busca_finalidade = ("{{Config.HOST_ROUTE}}").replace(/\//g, "");
              $("#selFinalidade").val(busca_finalidade);
              setFields();
            });
          </script>
          <!-- END SIDEBAR -->
