<!-- BEGIN SIDEBAR & CONTENT -->
<div class="row margin-bottom-40">

  <!-- BEGIN CONTENT -->
    <div class="col-md-12 col-sm-12">

      <h1>{{content.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h1>
      {% set pagina_corpo = content.corpo|convert_encoding('UTF-8','iso-8859-1') %}
      <div class="content-page">{{pagina_corpo|raw}}</div>

      <div class="col-md-12 col-sm-12">
        {% for entry in helpers %}
          {% for item in entry %}
            {% set content = item.content %}
            {% include item.template %}
          {% endfor %}
        {% endfor %}
      </div>

    </div>
    <!-- END CONTENT -->

</div>
<!-- END SIDEBAR & CONTENT -->