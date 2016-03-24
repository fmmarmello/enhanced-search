{% set content = page.content %}
<!-- BEGIN CONTENT -->
<div class="main">
  <div class="container">

    {% include 'inc/breadcrumb.twig.php' %}

    <div class="col-md-12 col-sm-12">
      <h1 class="page-title">{{page_title}}</h1>

          <!-- BEGIN CONTENT -->
          <div class="container margin-bottom-35">
            <!-- BEGIN PRODUCT LIST -->
            <div class="row product-page" id="obra-lista">
              <h2 class="subtitle">ESCOLHA ABAIXO O EMPREENDIMENTO PARA ACOMPANHAR SUA OBRA:</h2>
              <select name="obras" id="obras" onchange="">
              <option id="0" value="" >Selecione o empreendimento</option>
              {% for item in content %}
              <option id="{{item.id}}" value="/andamento-de-obras/{{item.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{item.id}}/">{{item.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}&nbsp;</option>
              {% endfor %}
              </select>
            </div>            
            <!-- END PRODUCT LIST -->
          </div>
          <!-- END CONTENT -->
          <script>$('#obras').on('change',function(){ document.location = $(this).val();});</script>

    </div>
  </div>
</div>