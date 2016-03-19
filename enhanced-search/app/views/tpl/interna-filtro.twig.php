          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5" id="filtro-lateral" data-ws="{% if content.produto == 'imovel' %}buscaImoveis{% else %}buscaEmpreendimentos{% endif %}">
            <ul class="list-group margin-bottom-25 sidebar-menu">

              <div id="tags_container"><h2>Filtros selecionados</h2></div>
              
              {% for tipo, itens in content.filtros %}

                {% if itens != null %}
                <li class="list-group-item clearfix dropdown"><a href="javascript:void(0);"><i class="fa fa-angle-right"></i>{{tipo|capitalize}}</a>
                  <ul class="dropdown-menu">

                  {% set idx = 0 %}
                  {% for item in itens %}
                    <li id="{{tipo}}_{{idx}}" class="{{tipo}}">
                      <a href="javascript:void(0);" class="opt" data-index="{{idx}}" data-tipo="{{tipo}}" data-valor="{{item.nome}}" data-id="{{item.id}}">
                        <i class="fa fa-angle-right"></i>
                        <div class="item-nome">{{item.nome}}</div>
                      </a>
                    </li>
                    {% set idx = idx + 1 %}
                  {% endfor %}

                  </ul>
                </li>
                {% endif %}

              {% endfor %}


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
