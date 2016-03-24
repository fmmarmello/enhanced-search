

<div class=" in_form ">
  <div class="in_form_inr block-interessado">
    <h5>Estou interessado</h5>
    {% if (item.produto == 'empreendimento') %}
      <form role="form" class=" " method="post" action="/contato/empreendimento-interessado/">
    {% else %}
      <form role="form" class=" " method="post" action="/contato/imovel-interessado/">
    {% endif %}
      <input type="hidden" value="{{item.produtotag}}/{{(item.objurl|convert_encoding('UTF-8','iso-8859-1'))}}/{{item.id}}" name="tokenAdr">
     
      <input type="hidden" value="{{token}}" name="token">
      <input type="hidden" value="{{item.id}}" name="id">
      <input type="hidden" value="{{item.produto}}" name="produto">
      <input type="hidden" value="Estou interessado" name="origem">                                      
      <div class="form-group">
        <input type="text" class="form-control txt" name="nome" id="interessado-nome" placeholder="Seu nome" required>
      </div>
      <div class="form-group">
        <input type="email" class="form-control txt" name="email" id="interessado--email" placeholder="Seu email" required>
      </div>
      <div class="form-group">
        <input type="text" class="form-control txt input-telefone" name="telresidencial" id="interessado-telefone1" placeholder="Seu telefone" required>
      </div>
      <div class="form-group form-mensagem">
        <textarea class="form-control txt" name="mensagem" rows="3" placeholder="Mensagem" required></textarea>
      </div>
      <div class="form-group">
        <div class="row">
        <div class="col-sm-8 check-newsletter">
          <label class="checkbox-inline">
            <input type="checkbox" name="newsletter" checked="checked"> 
            <p class="txt2">Receber novidades por E-mail</p>
          </label>
        </div>
        <div class="col-sm-4 botao-enviar">
          <button type="submit" class="btn btn-default btn_prt">Enviar</button>
        </div>
      </div>
      </div>
    </form>
  </div>
  {% include 'helpers/bloco-indique.twig.php' %}    
</div>




<!-- END CONTENT -->