<!-- BEGIN CONTENT -->
<div class="main form-page">
  <div class="container">
    <h2 class="page-title"><strong style="color:red;text-transform:none;">Ligamos</strong> pra você</h2>

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="margin-bottom-40">
        
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
                  <label class="col-md-12 control-label" for="telresidencial">Tel. Residencial</span></label>
                  <input type="text" name="telresidencial" id="contato-telefone1" class="form-control input-telefone"  placeholder="Tel. Residencial">
                </div>
                <div class="form-group col-md-4">
                  <label class="col-md-12 control-label" for="telcelular">Tel. Celular</span></label>
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
                <div class="row">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
              </form>
            </div>
          </div>
          <!-- END CONTENT -->

        </div>
        <!-- END SIDEBAR & CONTENT -->

  </div>
</div>
