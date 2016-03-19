<!-- BEGIN CONTENT -->
<div class="main form-page">
  <div class="container">

    {% include 'inc/breadcrumb.twig.php' %}
    <h2 class="page-title"><strong style="color:red;text-transform:none;">Ligamos</strong> pra você</h2>

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="margin-bottom-40">
          <div class="subtitle"></div>

          <!-- BEGIN CONTENT -->
          {% if false %}
          {% if Corretor is null %}<div class="col-md-8 col-sm-12 form-box">
            <h1>Fale Conosco</h1>
          {% else %}<div class="col-md-12 col-sm-12 form-box">
            <h1>Fale Comigo</h1>
          {% endif %}
          {% endif %}

          <div class="col-md-8 col-sm-12 form-box">
            <div class="content-form-page">
              <form role="form" class="form-horizontal form-without-legend" method="post" action="/contato/{{url}}/">
                <input data-value="contato" type="text" value="" name="{{url}}">
                <input data-value="contato" type="text" value="{{token}}" name="token">
                <input data-value="contato" type="text" value="Morada - Fale Conosco" name="origem">
                <input data-value="contato" type="text" {% if Customer.interesse is not null %}value="{{Customer.interesse}}"{%else%}value=""{%endif%} name="codempreendimento">

                <div class="form-group col-md-6">
                  <label class="col-md-12 control-label" for="nome">Nome<span class="require">*</span></label>
                  <input type="text" name="nome" id="contato-nome" class="form-control" placeholder="nome" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="col-md-12 control-label" for="email">E-Mail<span class="require">*</span></label>
                  <input type="text" name="email" id="contato-email" class="form-control" placeholder="email" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="col-md-12 control-label" for="telresidencial">Tel. Residencial</label>
                  <input type="text" name="telresidencial" id="contato-telefone1" class="form-control input-telefone"  placeholder="Tel. Residencial">
                </div>
                <div class="form-group col-md-4">
                  <label class="col-md-12 control-label" for="telcelular">Tel. Celular</label>
                  <input type="text" name="telcelular" id="contato-telefone2" class="form-control input-telefone"  placeholder="Tel. Celular">
                </div>
                <div class="form-group col-md-4">
                  <label class="col-md-12 control-label pull-left" for="telcomercial">Tel. Comercial</label>
                  <input type="text" name="telcomercial" id="contato-telefone3" class="form-control input-telefone"  placeholder="Tel. Comercial">
                </div>
                <div class="form-group col-md-12">
                  <label class="col-md-12 control-label" for="message">Mensagem</label>
                  <textarea class="form-control" rows="6" name="mensagem"  placeholder="Mensagem" id="contato-mensagem"></textarea>
                </div>
                {#
                <div class="form-group col-md-12">
                  <label class="col-md-12 control-label">&nbsp;</label>
                  <div class="col-md-12 checkbox-list">
                    <label>
                      <input type="checkbox" name="newsletter"> Desejo receber novidades por email
                    </label>
                  </div>
                </div>
                #}
                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
              </form>
            </div>
            {% include 'helpers/bloco-formulario-seletor.twig.php'%}  
          </div>
          <!-- END CONTENT -->

          {% if Corretor is null %}
          <!-- BEGIN SIDE -->
          <div class="col-md-4 col-sm-12 form-box">
            {% include 'helpers/bloco-formulario-endereco.twig.php'%}
          </div>
          <!-- END SIDE -->
          {% endif %}

        </div>
        <!-- END SIDEBAR & CONTENT -->

  </div>
</div>
<!-- END CONTENT -->        

<!-- BEGIN HELPERS -->
  <div class="col-md-12 col-sm-12 helpers">
    {% for key, entry in blocks %}
      {% set block = key %}
      {% set item = entry.content %}
      {% include entry.template %}
    {% endfor %}
  </div>
<!-- END HELPERS -->

<br clear="all">



{% if Corretor is not null %}        
<script type="text/javascript">
    $(document).ready(function() {
        $(".breadcrumb li.bc-item-3 a").html("Fale Comigo");
    });
</script>
{% endif %}