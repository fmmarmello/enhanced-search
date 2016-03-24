          <!-- BEGIN CONTENT -->
          <div class="col-md-3 col-sm-3 form-box">
            <h1>Newsletter</h1>
            <div class="content-form-page form-newsleter">
              <form role="form" class="form-horizontal form-without-legend" method="post" action="/contato/newsletter/">
                <input data-value="contato" type="text" value="" name="{{url}}">
                <input data-value="contato" type="text" value="{{token}}" name="token">

                <div class="form-group">
                  <label class="col-lg-4 control-label" for="nome">Nome<span class="require">*</span></label>
                  <div class="col-lg-12">
                    <input type="text" name="nome" id="nw-nome" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-4 control-label" for="email">E-Mail<span class="require">*</span></label>
                  <div class="col-lg-12">
                    <input type="text" name="email" id="nw-email" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-4 control-label" for="telefone1">Telefone<span class="require">*</span></label>
                  <div class="col-lg-12">
                    <input type="text" name="telresidencial" id="nw-telefone1" class="form-control input-telefone" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-offset-0 padding-left-1 padding-top-20">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- END CONTENT -->
