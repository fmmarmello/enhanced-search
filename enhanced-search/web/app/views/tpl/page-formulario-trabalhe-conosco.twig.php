<!-- BEGIN CONTENT -->
<div class="main form-page">
  <div class="top-contato">
    <div class="container">
      <h1 class="page-title branco">{{page_title}}</h1>   
      {% include 'inc/breadcrumb.twig.php' %} 
    </div>
  </div>
  <div class="container" style="margin-top:80px; margin-bottom:110px;">

    
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="margin-bottom-40">
         
          <div class="col-md-7 col-sm-12 form-box">
            <div class="content-form-page">
              <form role="form" class="form-horizontal form-without-legend" method="post" enctype="multipart/form-data" action="/contato/{{url}}/">
                <input data-value="contato" type="text" value="" name="{{url}}">
                <input data-value="contato" type="text" value="{{token}}" name="token">

                <div class="col-lg-12 col-md-12 form-box">
                  <div class="col-lg-12 col-md-12">
                    <label class="control-label" for="nome">Nome<span class="require">*</span></label>
                    <input type="text" name="nome" id="rh-nome" class="form-control" placeholder="Nome" required>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label class="control-label" for="email">E-Mail<span class="require">*</span></label>
                    <input type="text" name="email" id="rh-email" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label class="control-label" for="telresidencial">Telefone Residencial<span class="require">*</span></label>
                    <input type="text" name="telresidencial" id="rh-telefone1" class="form-control input-telefone"  placeholder="Tel. Residencial">
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label class="control-label" for="telcelular">Telefone Celular</label>
                    <input type="text" name="telcelular" id="rh-telefone2" class="form-control input-telefone"  placeholder="Tel. Celular">
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label class=" control-label">Área de interesse<span class="require">*</span></label>
                    <select class="form-control" name="area_trabalho" required>
                      <option>Área interessada</option>
                      <option value="Administrativo">Administrativo</option>
                      <option value="Comercial">Comercial</option>
                      <option value="Outros">Outros</option>                      
                    </select>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 form-box form-message">
                  <div class="col-md-12 col-lg-12">
                    <label class="control-label" for="message">Mensagem</label>
                    <textarea class="form-control" rows="6" name="mensagem"  placeholder="Mensagem"></textarea>
                  </div>
                  <div class="col-md-7 col-lg-7 form-curriculo">
                    <label class="control-label">Curriculo<span class="require">*</span></label>
                    <input type="file" name="anexo_form" id="anexo_form" required><p class="help-block">Anexe o seu currículo. (doc, docx ou pdf)</p>
                  </div>
                  <div class="mid_frm_Box col-md-5 col-lg-5" style="width:41%;">
                    <input type="submit" class="btn btn-primary button_submit pull-right" value="Enviar" style="margin-top:20px;">
                  </div>
                </div>
               
                 </form>
              </div>
     
            </div>
          </div>

         <div class="col-sm-5">
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