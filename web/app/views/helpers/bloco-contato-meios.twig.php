          <div class="{{cssClass}}">
            <div class="content-block block-contato-meios">
              <div class="info-wrapper">
              {% if Corretor is null %}
                <h3>Entre em Contato!</h3>
                <p>
                  <i class="fa fa-phone"></i>
                  <span class="telefone_empreendimentos">{{Customer.telefone1}} </span>
                  <span class="telefone_imoveis">{{Customer.telefone2}} </span>
                </p>
                {# <!-- <p><i class="fa fa-envelope"></i><a href="/contato/fale-conosco">Preencha nosso formulário</a></p> --> #}
              {% else %}
                {#<!-- TCK#2603 -->#}
                <h3>Entre em Contato!</h3>
                <p>
                  <i class="fa fa-phone"></i>
                  <span class="telefone_empreendimentos">{{Corretor.telcelular}}</span>
                  <span class="telefone_imoveis">{{Corretor.telcelular}}</span>
                </p>
                {#<!-- TCK#2603 -->#}
              {% endif %}
              </div>
            </div>
          </div>