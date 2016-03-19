{% set select = page.select %}
{% set content = page.content %}
<!-- BEGIN CONTENT -->
<div class="main">
  <div class="container">

    {% include 'inc/breadcrumb.twig.php' %}

    <div class="col-md-12 col-sm-12">
      <h1 class="page-title">{{page_title}}</h1>

      <!-- BEGIN CONTENT -->
      <div class="container margin-bottom-15">
        <!-- BEGIN PRODUCT LIST -->
        <div class="row product-page" id="obra-lista" >
          <h2 class="subtitle">ESCOLHA ABAIXO O EMPREENDIMENTO PARA ACOMPANHAR SUA OBRA:</h2>
          <select name="obras" id="obras" onchange="">
          <option id="0" value="" >Selecione o empreendimento</option>
          {% for item in select %}
          <option id="{{item.id}}"  value = "/andamento-de-obras/{{item.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{item.id}}/">{{item.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}&nbsp;</option>
          {% endfor %}
          </select>
        </div>            
        <!-- END PRODUCT LIST -->
      </div>
      <!-- END CONTENT -->

      <script>$('#obras').on('change',function(){ document.location = $(this).val();});</script>

      <div class="col-md-12 col-sm-12 obra-contents">
        <div class="product-page">
          <div class="row">        

            <div class="col-md-12 col-sm-12 basic-info">
              <h3>{{item.nome|convert_encoding('UTF-8','iso-8859-1')}}</h4>
              <p>{{item.localizacao|convert_encoding('UTF-8','iso-8859-1')}}, {{item.bairro|convert_encoding('UTF-8','iso-8859-1')}}, {{item.cidade|convert_encoding('UTF-8','iso-8859-1')}}</p>
              <p><a href="empreendimentos/{{item.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{item.id}}/">+ Detalhes do Empreendimento</a></p>
            </div>
            <div class="col-md-12 col-sm-12">
              <h4>ETAPAS DA OBRA</h4>
            </div>
            <div class="col-md-12 col-sm-12">
              {% for entry in item.etapas %}
              <p class="label">{{entry.nome|convert_encoding('UTF-8','iso-8859-1')}}</p>
              <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{entry.realizado}}" aria-valuemin="0" aria-valuemax="100" style="width: {{entry.realizado}}%;min-width:2em">
                  <span>{{entry.realizado}}%</span>
                </div>
              </div>            
              {% endfor %}
            </div>          
            <div class="col-md-12 col-sm-12">
              {% for key, entry in blocks %}
                {% set cssClass = key %}
                {% set content = entry.content %}
                {% include entry.template %}
              {% endfor %}
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
