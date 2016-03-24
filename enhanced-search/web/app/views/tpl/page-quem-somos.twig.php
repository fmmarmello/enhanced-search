{% set content = page.content %}
 <style>
 .title-blue{
    color: #1D3D72; 
    font-weight: bold;
    font-size: 21px; 
    font-family:'Open Sans', sans-serif;
    margin-top: 0px;
  }

  .interna p{
    color: #7d7e82 !important;
    font-family:'Open Sans', sans-serif;
    font-size: 13px;
  }
 </style>
 <div class="top-contato">
    <div class="container">
      <h1 class="page-title branco">{{content.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h1>   
      {% include 'inc/breadcrumb.twig.php' %} 
    </div>
  </div>
<div class="interna">  
  <section class="content">
    <div class="container" style="margin-top: 80px;">

      <div class="col-sm-6">
        {{content.corpo|raw}}
      </div>
      <div class="col-sm-3">
        <h2 class="title-blue">Missão</h2><br /> 
        <p>
          Transformar o sonho da casa própria, para milhares de cariocas, em realidade. Com qualidade de informação, transparência e segurança em nossos serviços prestados.
        </p>    
      </div>
      <div class="col-sm-3">
        <h2 class="title-blue">Visão</h2><br />
         <p>
          Ser a maior, a melhor, a mais capacitada e mais admirada imobiliária do estado do Rio de Janeiro.
        </p>  
      </div>
    </div>
  </div>
</section>
</div>