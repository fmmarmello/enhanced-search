<style type="text/css">
  .news_pannal{
    width: 100%;
    height: 160px;
  }
  .news_pannal:hover{
    box-shadow: 1px 1px 1px 1px rgba(234, 234, 234, 0.9);
  }
  .news_pannal a, .news_pannal a:hover{
    color: black;
    text-decoration: none;
  }
  .news_date{
    width: 95px;
    height: 108px;
    margin: 26px 21px;
    background-color: #1E3D73;
    float: left;
  }
  .news_date h3{
    height: 52px;
    margin-top: -23px;
    padding: 31px;
    font-size: 20px;
    color: white;
  }
  .news_date h1{
    padding-left: 25px;
    margin-top: -5px;
    color: white;
  }
  .news_description{
    float: left;
    height: 100%;
  }
  .news_description h3{
    font-family: Roboto, sans-serif;
    font-size: 14px;
    color: #1E3D73;
  }
  .news_description p{
    font-family: Roboto, sans-serif;
    font-size: 13px;
    margin-left: 10px;
    margin-top: 2px;
    min-height: 50px;
    color: #443e3d;
  }
  .news_description a{
    font-family: Roboto, sans-serif;
    color: #443e3d;
  }
  .bt_leia{
    width: 21px;
    height: 21px;
    padding: 2px 4px;
    background-color: #1E3D73;
  }
  .leia-mais{
    float:left;
  }
  .leia-mais-p{
    float:left;
    margin: 1px 3px !important;
  }
  .glyphicon{
    color: white !important;
  }
</style>
<section class="prd_sectext">
  <div class="container">
    <div class="prd_sectext_Inner">
      <div class="row">
        <div class="col-sm-12">
          {# include 'inc/breadcrumb.twig.php' #}
          <div class="prd_heading"><h3>Notícias<span> house vendas </span></h3></div>
        </div>
      </div>
    </div>
  </div>
</section>

{% set lista_itens = page.content %}
<div class="container">
  <div class="col-md-12">
  <section class="product_sec">
      <div class="product_sec_Inner">
        {% for item in lista_itens %}
        <div class="news_pannal">
          <a href="/noticia/{{item.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{item.id}}/">
            <div class="news_date">
              <h3>{{item.data_insercao|date("M")}}</h3>
              <h1>{{item.data_insercao|date("d")}}</h1>
            </div>
            <div class="news_description">
              <h3>{{(item.titulo|length > 50 ? item.titulo : item.titulo)|convert_encoding('UTF-8','iso-8859-1')}}</h3>
              <p>
                {{(item.sumario|length > 65 ? item.sumario : item.sumario)|convert_encoding('UTF-8','iso-8859-1')}}
              </p>
              <div class="leia-mais">
                <div class="bt_leia">
                  <i class="glyphicon glyphicon-plus"></i>
                </div>
              </div>
              <p class="leia-mais-p">Leia mais</p>
            </div>
          </a>
        </div>
        {% endfor %}
      </div>
    
  </section>
</div>

</div>

