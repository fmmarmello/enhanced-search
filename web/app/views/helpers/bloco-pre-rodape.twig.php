{% if Corretor is null %}
          <!-- BEGIN CONTENT -->
          <div class="col-md-3 col-sm-12">
            <div class="content-block block-atd-online">
              <div class="body-block">                
                  <img src="theme/images/fale-corretor.png" alt="fale com o corrretor"><a href="{{Customer.linkChatOnline}}" class="" title="Atendimento Online">Fale com o corretor</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-12">
            <div class="content-block block-email">
              <div class="body-block">
                <img src="theme/images/email.png"><a href="/contato/fale-conosco/">Envie um Email</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-12">
            <div class="content-block block-email">
              <div class="body-block">
                <img src="theme/images/whatsapp.png"><a href="intent://send/{{'55'~Customer.telefone3|replace({' ': '', '(': '',')': '','-': ''})}}#Intent;scheme=smsto;package=com.whatsapp;action=android.intent.action.SENDTO;end">WhatsApp: {{Customer.telefone3}}</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-12">
            <div class="content-block block-email">
              <div class="body-block">
                <img src="theme/images/calendario.png"><a href="/contato/fale-conosco/">Agende um Atendimento</a>
              </div>
            </div>
          </div>  
          <!-- END CONTENT -->

          <!-- BEGIN CONTENT -->
          <span id="fixed-steps" class="hidden-xs hidden-sm">
            <div class="container">
              <div class="col-md-3 col-sm-12">
                <div class="content-block block-atd-online">
                  <div class="body-block">                
                      <img src="theme/images/fale-corretor.png" alt="fale com o corrretor"><a href="{{Customer.linkChatOnline}}" class="" title="Atendimento Online">Fale com o corretor</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="content-block block-email">
                  <div class="body-block">
                    <img src="theme/images/email.png"><a href="/contato/fale-conosco/">Envie um Email</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="content-block block-email">
                  <div class="body-block">
                    <img src="theme/images/whatsapp.png"><a href="intent://send/{{'55'~Customer.telefone3|replace({' ': '', '(': '',')': '','-': ''})}}#Intent;scheme=smsto;package=com.whatsapp;action=android.intent.action.SENDTO;end">WhatsApp: {{Customer.telefone3}}</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="content-block block-email">
                  <div class="body-block">
                    <img src="theme/images/calendario.png"><a href="/contato/fale-conosco/">Agende um Atendimento</a>
                  </div>
                </div>
              </div>  
            </div>
          </span>
          <!-- END CONTENT -->          

{% else %}

          <!-- BEGIN CONTENT -->
              <div class="col-lg-3 col-md-4 col-sm-3 corretor">
                <div class="info-box call-corretor">
                  <div class="picture" style="background-image: url('http://aqui.inforcecode.com.br/_custom/foto_pessoa/{{Corretor.pessoaid}}/{{Corretor.pessoaid}}.jpg')"></div>
                  <div class="text">
                    <div class="nome">{{Corretor.apelido}}</div>
                    <div class="email">Fale comigo!</div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-3 col-md-4 col-sm-3 corretor">
                <div class="content-block block-telefone call-corretor">
                  
                  <h3>Ligue para o celular</h3>
                  <div class="body-block">
                    <span class="telefone_empreendimentos">{{Corretor.telcelular}} </span>
                    <span class="telefone_imoveis">{{Corretor.telcelular}} </span>
                  </div>
                </div>
              </div>          
              <div class="col-lg-3 col-md-4 col-sm-3 corretor">
                <div class="content-block block-email call-corretor-button">  {#<!-- TCK#2603 // CSS modificado -->#}
                  <div class="body-block">
                    <a href="/contato/fale-conosco/">&nbsp;</a>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3 col-sm-3 corretor detalhes">
                <div class="content-block block-mais-detalhes">
                  <div class="body-block">
                    <a class="bt_detalhes call-corretor" style="color:#FFF;">
                      <div class="bt_plus">+</div>
                      <div class="bt_deta">Detalhes</div>
                    </a>
                  </div>
                </div>
              </div>
          <!-- END CONTENT -->

          <!-- BEGIN CONTENT -->
          <span id="fixed-steps">
            <div class="container">
              <div class="col-lg-3 col-md-4 col-sm-3 corretor">
                <div class="info-box call-corretor">
                  <div class="picture" style="background-image: url('http://aqui.inforcecode.com.br/_custom/foto_pessoa/{{Corretor.pessoaid}}/{{Corretor.pessoaid}}.jpg')"></div>
                  <div class="text">
                    <div class="nome">{{Corretor.apelido}}</div>
                    <div class="email">Fale comigo!</div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-3 col-md-4 col-sm-3 corretor">
                <div class="content-block block-telefone call-corretor">
                  
                  <h3>Ligue para o celular</h3>
                  <div class="body-block">
                    <span class="telefone_empreendimentos">{{Corretor.telcelular}} </span>
                    <span class="telefone_imoveis">{{Corretor.telcelular}} </span>
                  </div>
                </div>
              </div>          
              <div class="col-lg-3 col-md-4 col-sm-3 corretor">
                <div class="content-block block-email call-corretor-button">  {#<!-- TCK#2603 // CSS modificado -->#}
                  <div class="body-block">
                    <a href="/contato/fale-conosco/">&nbsp;</a>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3 col-sm-3 corretor detalhes">
                <div class="content-block block-mais-detalhes">
                  <div class="body-block">
                    <a class="bt_detalhes call-corretor" style="color:#FFF;">
                      <div class="bt_plus">+</div>
                      <div class="bt_deta">Detalhes</div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </span>
          <!-- END CONTENT -->
{% endif %}
<script>
$(document).ready(function(){
    $('.body-block').hover(function() {
      var imgsrc = $(this).find('img').attr('src');
      $(this).find('img').attr('src', imgsrc.replace('.png','_h.png'));
      /* Stuff to do when the mouse enters the element */
    }, function() {
      var imgsrc = $(this).find('img').attr('src');
      $(this).find('img').attr('src', imgsrc.replace('_h.png','.png'));
      /* Stuff to do when the mouse leaves the element */
    });
});
</script>