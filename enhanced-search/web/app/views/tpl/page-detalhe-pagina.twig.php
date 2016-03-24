{% set content = page.content %}
<!-- BEGIN CONTENT -->
<div class="main">
  <div class="pagina-detalhe">

    {# include 'inc/breadcrumb.twig.php' #}

    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
      <div class="container">
      <!-- BEGIN CONTENT -->
        {% if blocks is defined %}
        <div class="col-md-8 col-sm-12">
        {% else %}
        <div class="col-md-12 col-sm-12">
        {% endif %}
          <h2 class="page-title">{{page_title}}</h2>

          <div class="page-data">{{content.data_insercao|date("d/m/Y")}}</div>
          <h1>{{content.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h1>
          {% set pagina_corpo = content.corpo|convert_encoding('UTF-8','iso-8859-1') %}
          <div class="content-page">{{pagina_corpo|raw}}</div>

        </div>

        {% if blocks is defined %}
        <div class="col-md-4 col-sm-12 barra-lateral">
          {% for key, entry in blocks %}
            {% set cssClass = key %}
            {% set content = entry.content %}
            {% include entry.template %}
          {% endfor %}
        </div>
        {% endif %}
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
    </div>

  </div>
</div>
<!-- END CONTENT -->            