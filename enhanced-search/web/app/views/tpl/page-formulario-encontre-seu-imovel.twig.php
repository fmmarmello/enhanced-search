<!-- BEGIN CONTENT -->
<div class="main form-page">
  <div class="container">

        {% include 'inc/breadcrumb.twig.php' %}
        
        <h2 class="page-title">Encontre seu <strong style="color:red;text-transform:none;">Imóvel</strong></h2>

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="col-md-12 col-sm-12 margin-bottom-40">          
          <div class="subtitle">Fale conosco através do formulário abaixo ou dos telefones. Será um prazer atendê-lo.</div>
        </div>
        <div class="col-md-8 col-lg-8  col-sm-12 form-box">
          <div class="content-form-page">
            <form role="form" class="form-horizontal form-without-legend" method="post" enctype="multipart/form-data" action="/contato/{{url}}/">
              <input data-value="contato" type="text" value="" name="{{url}}">
              <input data-value="contato" type="text" value="{{token}}" name="token">
              <div class="col-lg-12 col-md-12 form-box">
                <div class="form-group col-md-6 col-lg-6 first">
                  <label class="col-md-12 col-lg-12 control-label" for="nome">Nome</label>
                  <input type="text" name="nome" id="contato-nome" class="form-control"  placeholder="Nome" required>
                </div>
                <div class="form-group col-md-6 col-lg-6">
                  <label class="col-md-12 col-lg-12 control-label" for="email">E-Mail<span class="require">*</span></label>
                  <input type="text" name="email" id="contato-email" class="form-control"  placeholder="Email" required>
                </div>
                <div class="form-group col-md-6 col-lg-6">
                  <label class="col-md-12 col-lg-12 control-label" for="telresidencial">Telefone Residencial</label>
                  <input type="text" name="telresidencial" id="contato-telefone1" class="form-control input-telefone"  placeholder="Tel. Residencial">
                </div>
                <div class="form-group col-md-6 col-lg-6">
                  <label class="col-md-12 col-lg-12 control-label" for="telcelular">Telefone Celular</label>
                  <input type="text" name="telcelular" id="contato-telefone2" class="form-control input-telefone" placeholder="Tel. Celular">
                </div>
                <div class="form-group col-md-12">
                  <label class="col-md-12 col-lg-12 control-label" for="message">Mensagem</label>
                  <textarea class="form-control" rows="6" name="mensagem"  placeholder="Mensagem"></textarea>
                </div>
                <div class="form-group form-curriculo">
                  <label class="col-md-2 col-lg-2 control-label">Curriculo<span class="require">*</span></label>
                  <input type="file" name="anexo_form" id="anexo_form" required><p class="help-block">Anexe o seu currículo. (doc, docx ou pdf)</p>
                </div>                 
              </div>                
              <div class="form-group">
                <label class="col-md-2 col-lg-2 control-label">&nbsp;</label>
                <div class="col-md-8 col-lg-8 checkbox-list">
                  <label>
                    <input type="checkbox" name="newsletter"> Desejo receber novidades por email
                  </label>
                </div>
              </div>
              <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </form>
          </div>
          {% include 'helpers/bloco-formulario-seletor.twig.php'%}         
        </div>

        <div class="col-md-4 col-lg-4">
           {% include 'helpers/bloco-formulario-endereco.twig.php'%}
        </div>
          <!-- END CONTENT -->
        
        <!-- END SIDEBAR & CONTENT -->
  </div>
  </div>
<!-- END CONTENT -->                