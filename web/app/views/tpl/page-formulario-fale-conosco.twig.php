<style type="text/css">
  label{
    text-align: left;
    color: #214288; 
  }

  .top-contato{
    width: 100%; 
    height: 143px; 
    background: #1c1f24; 
  }

  .branco{
    color: #FFFFFF; 
    font-size: 35px; 
    font-weight: bold;
    margin-top: 35px;
    margin-left: 15px;
  }
</style>

<!-- BEGIN CONTENT -->
<div class="main form-page">
  <div class="top-contato">
    <div class="container">
      <h1 class="page-title branco">{{page_title}}</h1>   
      {% include 'inc/breadcrumb.twig.php' %} 
    </div>
  </div>
  <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div style="margin-top: 60px;">
   
          <div class="col-md-8 col-sm-12 form-box">
            <div class="content-form-page">
              <form role="form" class="form-horizontal form-without-legend formulario_form" method="post" action="/contato/{{url}}/" onsubmit="return validaTelefone();">
                <input data-value="contato" type="text" value="" name="{{url}}">
                <input data-value="contato" type="text" value="{{token}}" name="token">
                <input data-value="contato" type="text" value="{{Customer.name|convert_encoding('UTF-8','iso-8859-1')}} - Fale Conosco" name="origem">
                <input data-value="contato" type="text" {% if Customer.interesse is not null %}value="{{Customer.interesse}}"{%else%}value=""{%endif%} name="codempreendimento">

                <div class="col-md-6">
                  <label class="control-label" for="nome">Nome<span class="require">*</span></label>
                  <input type="text" name="nome" id="contato-nome" class="form-control" placeholder="nome*" required>
                </div>
                <div class="col-md-6">
                  <label class="control-label" for="email">E-Mail<span class="require">*</span></label>
                  <input type="email" name="email" id="contato-email" class="form-control" placeholder="email*" required>
                </div>
                <div class="col-md-6">
                  <label class="control-label" for="telresidencial">Tel. Residencial</span></label>
                  <input type="text" name="telresidencial" id="contato-telefone1" class="form-control input-telefone"  placeholder="Tel. Residencial">
                </div>
                <div class="col-md-6">
                  <label class="control-label" for="telcelular">Tel. Celular</span></label>
                  <input type="text" name="telcelular" id="contato-telefone2" class="form-control input-telefone"  placeholder="Tel. Celular">
                </div>
                <div class="col-md-12">
                  <label class="control-label" for="message">Mensagem<span class="require">*</span></label>
                  <textarea class="form-control" rows="6" name="mensagem"  placeholder="Mensagem" id="contato-mensagem" required></textarea>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary button_submit pull-right" type="submit">Enviar</button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-4">
            {% include 'helpers/bloco-endereco.twig.php' %}
          </div>
          <!-- END CONTENT -->

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
<script>
  function validaTelefone(){
    if ($("#contato-telefone1").val() == "" && $("#contato-telefone2").val() == ""){
      alert("Por Favor, preencha algum campo de telefone."); 
      return false; 
    }
  }

</script>
