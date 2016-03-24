             {% if content|length > 0 %} 
               <ul class="list" style="list-style:none">
                  {% for item in content %}
                  <li>
                    <!-- ORDER -->
                    <span class="hide">
                      <div class="produto-codigo">{{item.id}}</div>
                      <div class="produto-ordenacao">{{item.imgorder}}</div>
                      <div class="produto-bairro">{{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                      {% if item.valorvenda is defined %}
                      <div class="produto-preco">{{item.valorvenda}}</div>
                      {% endif %}
                      {% if item.produto == 'imovel' %}
                      <div class="produto-quarto">{{item.quartos}} quartos</div>
                      {% endif %}
                    </span>
                    <!-- ORDER -->

                    {# <!-- ajuste para manter padrao de formato entre templates --> #}
                    {% set entry = item %}
                    <!-- ITEM -->
                    <div class="col-md-4 col-sm-6 col-xs-12 produto-item">
                      {% include 'helpers/bloco-produto-celula.twig.php' %}
                    </div>
                    <!-- /ITEM -->
                  </li>
                  {% endfor %}            
                </ul>
                <ul class="pagination pull-right"></ul>
             
              {% else %}
                <style>
                  .rotate{
                    -ms-transform: rotate(-90deg);
                    -webkit-transform: rotate(-90deg);
                    transform: rotate(-90deg);
                  }
                </style>
                
                {% include 'helpers/bloco-nenhum-item-encontrado.twig.php' %}
                <ul class="list" style="list-style:none">
                </ul>
                <ul class="pagination pull-right"></ul>
              {% endif%}
