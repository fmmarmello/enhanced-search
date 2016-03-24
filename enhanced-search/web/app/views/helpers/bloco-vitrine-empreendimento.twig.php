{# "favoritos" recebe array de itens favoritados #}

{% set favoritos = "" %}
{% if CookieFavoritos['favoritos']['empreendimento'] is defined %}
  {% set favoritos = CookieFavoritos['favoritos']['empreendimento'] %}
{% endif %}

{% if content is not null %}

<div class="whit_carocel_sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="whit_carocel_sec_inn">
          <div class="product_item_sec">
        <div class="row">
          <div class="col-sm-12">         
            <h2>Imóveis em destaque</h2>
          </div>
        </div>  
          <div class="row">
            <div class="col-sm-12">
              <div id="owl-demo" class="owl-carousel">
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic1.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>320.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Vista para o mar</a>  <span>Botafogo, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic1.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>470.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Vista para o mar</a>  <span>Botafogo, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  
                </div>
                
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic2.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>470.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">500 metros da praia</a>  <span>Copacabana, RJ</span></h3>
                      <p>Apartamento</p> 
                      <p><span>com 2 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic2.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">500 metros da praia</a>  <span>Copacabana, RJ</span></h3>
                      <p>Apartamento</p> 
                      <p><span>com 2 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>              
                  </div>
                  
                </div>
                
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic3.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Tijuca, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>              
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic3.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Tijuca, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>                
                  </div>
                  
                </div>
                
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic4.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Ipanema, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>              
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic4.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Ipanema, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  
                </div>
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic1.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>320.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Vista para o mar</a>  <span>Botafogo, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic1.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>470.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Vista para o mar</a>  <span>Botafogo, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  
                </div>
                
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic2.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>470.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">500 metros da praia</a>  <span>Copacabana, RJ</span></h3>
                      <p>Apartamento</p> 
                      <p><span>com 2 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic2.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">500 metros da praia</a>  <span>Copacabana, RJ</span></h3>
                      <p>Apartamento</p> 
                      <p><span>com 2 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>              
                  </div>
                  
                </div>
                
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic3.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Tijuca, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>              
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic3.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Tijuca, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>                
                  </div>
                  
                </div>
                
                <div class="item">
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic4.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Ipanema, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>              
                  </div>
                  <div class="product_itemBx">            
                    <div class="product_itemBxTop">
                      <div class="img_hov_Prtrit">
                        <a href="#" class="img_hov_Prtrit_star"></a>
                        <a href="#">
                          <img alt="" src="{{Config.base_url}}theme/images/whit_loc.png">
                        </a>
                      </div>
                      <div class="pdct_pic">
                        <img src="{{Config.base_url}}theme/images/caro_pic4.jpg">
                        <!-- <span class="prdct_dtls"><a href="#">Ver detalhes</a></span> -->
                      </div>
                      <span><strong>Valor do Imóvel (R$)</strong>390.000</span>
                    </div>            
                    <div class="product_itemBxBot">
                      <h3><a href="#">Samambaia House</a>  <span>Ipanema, RJ</span></h3>
                      <p>Casa de Condomínio</p>
                      <p><span>com 3 Quartos, sendo 1 suite</span></p>
                      <ul>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon1.jpg"> <span>04</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon2.jpg"> <span>02</span> </a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/product_icon3.jpg"> <span>56 m2</span> </a></li>
                      </ul>             
                    </div>  
                    <div class="product_itemBxBot_bottm">
                      <h4><span>Infraestrutura</span><a href="#url">Detalhes</a></h4>
                    </div>            
                  </div>
                  
                </div>
              </div>  
                      
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{% endif %}