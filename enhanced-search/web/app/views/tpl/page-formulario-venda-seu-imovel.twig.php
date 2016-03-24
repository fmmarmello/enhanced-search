{% set content = page.content %}

<style type="text/css">
  .subtitulo h4{
    color: #214288;
    font-weight: bold;
    font-size: 23px;
    margin: 0; 
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

    <section class="content" style=" margin-top: 100px; margin-bottom: 70px;">
      <div class="container">
          <div class="col-sm-7">
          <!--   <div class="col-md-12 subtitulo"><h4>Lorem ipsum blabla bla bla lblablala</h4></div> -->
            <div class="col-md-12"><h4>Preencha o formulário abaixo, que responderemos em breve!</h4></div>
            <div class="content-form-page">
              <form role="form" class="form-horizontal form-without-legend" method="post" action="/contato/{{url}}/?envio=ok">
                  <input data-value="contato" type="text" value="" name="{{url}}">
                  <input data-value="contato" type="text" value="{{token}}" name="token">
                  <input data-value="contato" type="text" value="Venda seu imóvel" name="origem">                
                  
                  <div class="col-md-6 col-lg-6 first">
                    <label class="control-label" for="nome">Nome*</label>
                    <input type="text" name="nome" id="contato-nome" class="form-control"  placeholder="Nome" required>
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="email">E-Mail<span class="require">*</span></label>
                    <input type="email" name="email" id="contato-email" class="form-control"  placeholder="Email" required>
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="telresidencial">Telefone Residencial*</label>
                    <input type="text" name="telresidencial" id="contato-telefone1" class="form-control input-telefone"  placeholder="Tel. Residencial" required>
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="telcelular">Telefone Celular</label>
                    <input type="text" name="telcelular" id="contato-telefone2" class="form-control input-telefone" placeholder="Tel. Celular">
                  </div>
                  
                  <div class="col-md-12">
                    <h4 style="font-size: 13px;font-weight: bold;margin-top: 30px;color: #777777;">Dados do Imóvel</h4>
                    <hr>  
                  </div>
                  

                   {% if content is not null %}

                  <div class="col-md-6 col-lg-6 first">
                    <label class="control-label" for="natureza">Natureza*</label>
                   
                      <select class="form-control natureza" name="venda_imovel[natureza]" required>
                          <option value="">- Selecione -</option>
                        {% for natureza in content['form_natureza'] %}
                          <option value="{{natureza.nome}}">{{natureza.nome}}</option>
                        {% endfor %}
                      </select>                     
                   
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="finalidade">Finalidade*</label>
                    
                      <select class="form-control" name="venda_imovel[finalidade]">
                          <option value="0">- Selecione -</option>
                          <option value="1">Venda</option>
                          <option value="2">Aluguel</option>
                      </select>                     
                    
                  </div>
                 
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="quartos">Quartos</label>
                    
                      <select class="form-control quartos" name="venda_imovel[quartos]">
                          <option value="0">- Selecione -</option>
                        {% for quarto in content['form_quartos'] %}
                          <option value="{{quarto.nome}}">{{quarto.nome}}</option>
                        {% endfor %}
                      </select>                     
                    
                  </div>
                   <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="tipo">Tipo*</label>
                    
                      <select class="form-control" name="venda_imovel[tipo]" required>
                          <option value="">- Selecione -</option>
                        {% for tipo in content['form_tipo'] %}
                          <option value="{{tipo.nome}}">{{tipo.nome}}</option>
                        {% endfor %}
                      </select>                     
                    
                  </div>

                
                  {% endif %}
              
                  <div class="col-md-12 col-lg-12">
                    <label class="control-label" for="endereco">Endereço</label>
                    <input type="text" name="venda_imovel[endereco]" class="form-control" placeholder="Endereço">
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="bairro">Bairro*</label>
                    <input type="text" name="venda_imovel[bairro]" class="form-control" placeholder="Bairro" required>
                  </div>

                  <div class="col-md-4 col-lg-4">
                    <label class="control-label" for="cidade">Cidade</label>
                    <input type="text" name="venda_imovel[cidade]" class="form-control"  placeholder="Cidade">
                  </div>
                  <div class="col-lg-2 col-md-2">
                    <label class="control-label" for="uf">UF</label>
                    <select class="form-control" name="venda_imovel[uf]">
                        <option value="0">UF</option>
                      {% for uf in content['form_uf'] %}
                        <option value="{{uf.nome}}">{{uf.nome}}</option>
                      {% endfor %}
                    </select>                     
                  </div>

                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="areautil">Área Útil</label>
                    <input type="text" name="venda_imovel[areautil]" class="form-control input-area"  placeholder="Área Útil">
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="valorvenda">Valor Venda</label>
                    <input type="text" name="venda_imovel[valorvenda]" class="form-control input-moeda"  placeholder="Valor">
                  </div>

                  {% if false %}                  
                  <div class="col-md-6 col-lg-6">
                    <label class="control-label" for="areatotal">Área Total</label>
                    <div class="col-md-12 col-lg-12">
                      <input type="text" name="venda_imovel[areatotal]" class="form-control input-area">
                    </div>
                  </div>
                  {% endif %}
                  <div class="col-md-12 col-lg-12">
                    <label class="control-label" for="mensagem">Comentário</label>
                    <textarea class="form-control" rows="6" name="mensagem"  placeholder="Mensagem"></textarea>
                  </div>
                 <div class="col-md-12">
                    <input type="submit" value="Enviar" class="btn btn-primary button_submit pull-right">
                  </div>
              </form>
            </div>    
            </div>
            <div class="col-sm-5">
               {% include 'helpers/bloco-endereco.twig.php' %}
            </div>        
        </div>
      </section>
    

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
  
  $(window).on('load',function() {    
    
    $(".natureza").change(function(){
        if($(this).val() == 'Residencial'){
          $("label[for='quartos']").text('Quartos*');
          $(".quartos").attr('required','required');
        }else{
          $("label[for='quartos']").text('Quartos');
          $(".quartos").attr('required',false);
        }
    });
    $('select').selectBox('destroy');
  });  
</script>