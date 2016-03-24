{% set content = page.content %}
{% set items = content.items %}
{% set produtotag = content.produtotag %}
{% set produto = content.produto %}


<div class="prd_list_sec">
  <span class="hide" id="qtdPagina">  {{content.totalpages}}</span>
  <span class="hide" id="itensPagina">{{content.pagcount}}</span>
  <span class="hide"></span>
  <div class="container">
      {% include 'inc/breadcrumb.twig.php' %}
      
      {# Se não retornar nada #}
      {# if content[0] ==  false %} 
        {% include 'inc/search-simple.twig.php' %}
      
       {% include 'helpers/bloco-nenhum-item-encontrado.twig.php' %}
      {% endif #}

      {% if content.produto == 'empreendimento' or content.produto == 'imovel' %}
         
          <!-- BEGIN CONTENT -->
          
          <section class="resulto_top">
            <div class="container">

              <div class="row resulto_top_sec1">
                <div class="col-sm-8">
                  <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">{% if 'locacao' in ROTA %}Aluguel{% else %}Prontos{% endif %}</li>
                  </ol> 
                </div>
                <div class="col-sm-4">
                  <span class="gray"><strong>{{content.totalCount}}</strong> imóveis encontrados para <strong>{% if 'locacao' in ROTA %}alugar{% else %}comprar{% endif %} </strong></span>
                </div>
              </div>

              <div class="row">

                <div class="resulto_top_sec2">
                  
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="resulto_top_sec2_lft">
                      <p><span class="ttmin">{{content.minpag}}</span> - <span class="ttmax">{{content.maxpag}}</span> de {{content.totalCount}} imóveis encontrados</p>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="col-md-6">
                         <div class="resulto_top_sec2_right">
                         
                            <p>Qtde por página:</p>
                            <select class="select-filtro-lateral form-control search-param" data-param="take" id='products-per-page'>
                                <option value="3">3</option>
                                <option value="6">6</option>
                                <option value="9" >9</option>
                                <option value="12" selected>12</option>
                            </select>
                       
                        </div>
                      </div>
                      {% if content.produto == 'imovel' %}
                        <div class="col-md-6">
                          <div class="resulto_top_sec2_right">
                            <p>Ordenar Por:</p>
                           
                              <select class="select-filtro-lateral form-control search-param" data-param="order" id='list-order'>
                                <option value="">Últimos</option>
                                <option value disabled="disabled">-----------</option>
                                <option value="maior-valor">Maior Valor</option>
                                <option value="menor-valor">Menor Valor</option>
                                <option value disabled="disabled">-----------</option>
                                <option value="bairro-az">Bairro A - Z</option>
                                <option value="bairro-za">Bairro Z - A</option>
                                <option value disabled="disabled">-----------</option>
                                <option value="mais-quartos">Mais Quartos</option>
                                <option value="menos-quartos">Menos Quartos</option>
                                <option value disabled="disabled">-----------</option>
                                <option value="maior-area">Maior Área</option>
                                <option value="menor-area">Menor Área</option>
                              </select>
                          </div>
                        </div>
                      {% endif %}

                        
                      
                     
                    
                      
                  
                  <!--  <div class="resulto_top_sec2_right_rit">
                      <ul>
                        <li><a href="#"><img src="images/gal1.png" alt="" /></a></li>
                        <li><a href="#"><img src="images/gal2.png" alt="" /></a></li>
                      </ul>
                    </div> -->
                      
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </section>
          

          <section class="resulto_main">
            <div class="container">
              <div class="row">
                <div class="col-md-3 col-sm-12 barra-lateral">
                  {% for key, entry in side %}
                    {% set cssClass = key %}
                    {% set side = entry.content %}
                    {% include entry.template %}
                  {% endfor %}
                </div>
                <div class="col-md-9 col-sm-12 ">
                  {% if items|length > 0 %} 
                    <div class="resulto_rit content-lista">
                      {% for key, item in items %}
                        {% include 'helpers/bloco-produto-celula.twig.php' %}
                      {% endfor %}
                    </div>
                    <div class="result_bot_lst">
                      <div class="resulto_rt_flt">
                       <p><span class="ttmin">{{content.minpag}}</span> - <span class="ttmax">{{content.maxpag}}</span> de {{content.totalCount}} imóveis encontrados</p>
                      </div>
                      <div class="resulto_rt_rit">
                        <div class="pagination"></div>
                      </div>
                    </div>
                  {% else %}
                    {% include 'helpers/bloco-nenhum-item-encontrado.twig.php' %}
                  {% endif %}
                
                </div>
              </div>
            </div>
          </section>
         </div>      
      {% endif %}
    </div>
    <div class="loading"><div class="loader"></div></div>



