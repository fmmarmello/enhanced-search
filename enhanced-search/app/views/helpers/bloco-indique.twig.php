  <div class="in_form_inr block-indique" style="display:none;">
    <h5>Indique a um amigo</h5>
  
    {% if (item.produto == 'empreendimento') %}
      <form role="form" class="form-horizontal HouseCRM_form" method="post" action="/contato/empreendimento-indique/">
    {% else %}
      <form role="form" class="form-horizontal HouseCRM_form" method="post" action="/contato/imovel-indique/">
    {% endif %}
      <input type="hidden" value="{{item.produtotag}}/{{(item.objurl|convert_encoding('UTF-8','iso-8859-1'))}}/{{item.id}}" name="tokenAdr">
      <input type="hidden" value="{{token}}" name="token">
      <input type="hidden" value="{{item.id}}" name="id">
      <input type="hidden" value="{{item.produto}}" name="produto">

      <input type="hidden" value="Indique a um amigo" name="origem">

      <div class="form-group">
        <input type="text" class="form-control txt" name="nome" id="interessado-nome" placeholder="Seu nome" required>
      </div>
      <div class="form-group">
        <input type="email" class="form-control txt" name="email" id="interessado-email" placeholder="Seu email" required>
      </div>
       <div class="form-group">
        <input type="text" class="form-control txt" name="nome_amigo" id="interessado-nome" placeholder="Nome do amigo" required>
      </div>
      <div class="form-group">
        <input type="email" class="form-control txt" name="email_amigo" id="interessado-email" placeholder="E-mail do amigo" required>
      </div>
      <div class="row last-row">
        <div class="col-lg-4 col-md-offset-0 pull-right botao-enviar">
          <button class="btn btn-default btn_prt" type="submit">Enviar</button>
        </div>
      </div>
    </form>
  </div>


<!-- END CONTENT -->
