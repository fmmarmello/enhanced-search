{% set item = page.content %}
{% set Galeria = item.Imagens %}


  <section class="prd_detal_sec ">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="prd_detal_Inn">

                  <div class="row resulto_top_sec1">
                      <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="/{{item.produtotag}}/">{{item.produtotag|capitalize}}</a></li>
                        <li class="active">{{item.TipoNome}}
                          {% if item.QtdQuarto|default(0) > 0 %}
                            {{item.QtdQuarto > 0 ? "com "~(item.QtdQuarto > 1 ? item.QtdQuarto~" quartos" : item.QtdQuarto~" quarto") : ""}} {#para Alugar#}{{item.AreaUtil != "" ? ", "~item.AreaUtil~"m²" : ""}}
                          {% endif %}
                        </li>
                      </ol>
                  </div>

            <div class="prd_detl_top_menu_L3">
             
              <section class="grey_Prt">
                <div class="row">
                  <div class="col-md-8 col-sm-12 cont_left">
                      
                      <div class="top_body_L3">
                        <div class="top_body_L3_lft">
                        <p>{{item.Codigo}} -<span> {{item.TipoNome}}</span></p>
                        <h1>{{item.TipoNome}} 
                          {% if item.QtdQuarto|default(0) > 0 %}
                            {{item.QtdQuarto > 0 ? "com "~(item.QtdQuarto > 1 ? item.QtdQuarto~" quartos" : item.QtdQuarto~" quarto") : ""}} {#para Alugar#}{{item.AreaUtil != "" ? ", "~item.AreaUtil~"m²" : ""}} 
                          {% endif %}
                        </h1>
                        <h6>{{item.BairroNome}}, {{item.CidadeNome}}, {{item.EstadoSigla}}</h6>
                        </div>
                        <div class="top_rt_l3_main">
                          {% if item.ValorVenda|default(0) > 0 %}
                            <div class="top_body_L3_rit produto_l3_rt">
                              <ul>
                                <li><strong>Valor de Compra</strong> <span>R$</span> <b>{{item.ValorVenda|number_format(0,",",".")}}</b></li>
                              </ul>
                            </div>
                          {% endif %}
                          <div class="produto_l3_rt2">
                            <ul>
                              {% if item.ValorLocacao|default(0) %}
                                <li>Aluguel <strong>R$ {{item.ValorLocacao|number_format(0,",",".")}}</strong></li>
                              {% endif %}
                              
                              {% if item.ValorIPTU|default(0) %}
                                <li>IPTU <strong>R$ {{item.ValorIPTU|number_format(0,",",".")}}</strong></li>
                              {% endif %}
                              
                              {% if item.ValorCondominio|default(0) %}
                                <li>Condominio <strong>R$ {{item.ValorCondominio|number_format(0,",",".")}}</strong></li>
                              {% endif %}
                            </ul>
                          </div>
                        </div>
                      </div>
                    
                      <div class="grey_image_Prt">
                        <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',0);">
                          <div class="galeria-img-principal" style="background: url('{{Config.ImagePathApi}}{{Galeria[0].ImagemID|default(0)}}.jpg?mh=528') no-repeat center bottom;width:100%; height:528px; background-size:cover;" data-lightbox-gallery="gallery1"  /></div>
                        </a>
                        <!-- <div onclick = "$('#light').css('display','block');$('#fade').css('display','block');" style="background: url('{{Config.HOST_ADMIN}}{{Galeria[0].ImagePath|default("")}}') no-repeat center bottom;width:100%; height:528px; background-size:cover;" data-lightbox-gallery="gallery1"/></div> -->
                        
                        <div class="img_hov_Prtlft">
                          <a href="javascript:$('#light').css('display','block');$('#fade').css('display','block');"><img src="{{Config.base_url}}theme/images/search.png" alt=""/></a>
                        </div>
                   <!--      <div class="img_hov_Prtrit">
                          <a href="#"><img src="{{Config.base_url}}theme/images/whit_star.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/yello_star.png'" onmouseout="this.src='{{Config.base_url}}theme/images/whit_star.png'" /></a>
                          <a href="#"><img src="{{Config.base_url}}theme/images/sos1.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos1_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos1.png'" /></a>
                        </div> -->
                      </div>
                      
                      {% if item.Descricao is defined %}
                      <div class="content_secRow">
                        <h4>Sobre este imovel</h4>
                        <p>{{item.Descricao}}</p>
                      </div>
                      {% endif %}
                      
                      <div class="content_secRow">
                        <div class="row">
                          <div class="col-sm-3"><h4>O local</h4></div>
                          <div class="col-sm-9">
                            <p>{{item.BairroNome}}, {{item.CidadeNome}}, {{item.EstadoSigla}}
                            
                              {% if item.CondominioNome != "" %}
                                - Condominio <strong>{{item.CondominioNome}} </strong> 
                              {% endif %}

                              {% if item.EmpreendimentoNome != "" %}
                                - Empreendimento <strong>{{item.EmpreendimentoNome}} </strong> 
                              {% endif %}

                            </p>
                          </div>
                        </div>
                      </div>
                      

                      <div class="content_secRow">
                        <div class="row">
                          <div class="col-sm-3"><h4>Dados do imovel</h4></div>
                          <div class="col-sm-9">
                            <div class="row">
                              {% if item.QtdPessoa|default('0') > 0 %}
                                <div class="col-sm-4 col-xs-6"><p>Acomoda <strong>{{item.QtdPessoa}} pessoa(s)</strong> </p></div>
                              {% endif %}

                              {% if item.QtdQuarto|default('0') > 0  %}
                                <div class="col-sm-4 col-xs-6">
                                  <p>
                                    {{item.QtdQuarto|default('0') > 1 ? item.QtdQuarto~" Quartos" : item.QtdQuarto~" Quarto"}} 
                                   
                                    {% if item.QtdSuite|default('0') >0 %}
                                      sendo <strong>{{item.QtdSuite > 1 ? item.QtdSuite~" suítes" : item.QtdSuite~" suíte"}}</strong> 
                                    {% endif %}
                                  </p>
                                </div>
                              {% endif %}
                              
                              {% if item.AreaUtil|default(0) > 0 %}
                                <div class="col-sm-4 col-xs-6"><p>Area Útil {{item.AreaUtil}} <strong>M<sup>2</sup></strong> </p></div>
                              {% endif %}

                              {% if item.QtdWcTotal|default(0) > 0 %}
                                <div class="col-sm-4 col-xs-6"><p>{{item.QtdWcTotal}} Banheiro(s) </p></div>
                              {% endif %}
                              
                              {% if item.QtdLavabo|default(0) > 0 %}
                                <div class="col-sm-4 col-xs-6"><p>{{item.QtdLavabo}} Lavabo(s) </p></div>
                              {% endif %}
                              
                              {% if item.QtdSala|default(0) > 0 %}
                                <div class="col-sm-4 col-xs-6"><p> {{item.QtdSala}} Sala(s)</p></div>
                              {% endif %}

                              {% if item.QtdVaranda|default(0) > 0 %}
                                <div class="col-sm-4 col-xs-6"><p>{{item.QtdVaranda}} Varanda(s)</p></div>
                              {% endif %}

                            </div>
                          </div>
                        </div>
                      </div>
                    
                      <!-- COMODIDADES DO IMOVEL -->
                      {% if item.Caracteristicas|length > 0 %}
                        <div class="content_secRow">
                          <div class="row">
                            <div class="col-sm-3"><h4>Comodidades</h4></div>
                            <div class="col-sm-9">
                              <div class="row">
                                {% for key, caracteristica in item.Caracteristicas %}
                                  <div class="col-sm-4 col-xs-6"><p>{{caracteristica.Nome}}</p></div>
                                {% endfor %}
                              </div>
                            </div>
                          </div>
                        </div>
                      {% endif %}
                    
                      {% if Galeria|length > 0 %}
                        <div class="content_secRow galeria">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="photos_sec">
                                {% if Galeria|length >= 2 %}
                                  <div class="col-xs-6 col-sm-6 photo_col big">
                                    <div class="photo_colInr">
                                      <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',0);">
                                        <div style="background-image: url('{{Config.ImagePathApi}}{{Galeria[0].ImagemID}}.jpg?mh=421');" class="galeria-imv-big"></div>
                                        <div class="photo_colPop"></div>
                                      </a>
                                    </div>
                                  </div>
                                  
                                  <div class="col-xs-6 col-sm-6 photo_col big">
                                    <div class="photo_colInr">
                                      <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',1);">
                                        <div style="background-image: url('{{Config.ImagePathApi}}{{Galeria[1].ImagemID}}.jpg?mh=421');" class="galeria-imv-big"></div>
                                        <div class="photo_colPop"></div>
                                      </a>                  
                                    </div>
                                  </div>
                                {% endif %}
                                {% if Galeria|length >= 5 %}
                                  <div class="col-xs-6 col-sm-4 photo_col">
                                    <div class="photo_colInr">
                                      <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',2);">
                                        <div style="background-image: url('{{Config.ImagePathApi}}{{Galeria[2].ImagemID}}.jpg?mh=279');" class="galeria-imv"></div>
                                        <div class="photo_colPop"></div>
                                      </a>
                                   
                                    </div>
                                  </div>
                                 
                                  <div class="col-xs-6 col-sm-4 photo_col">
                                    <div class="photo_colInr">
                                      <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',3);">
                                        <div style="background-image: url('{{Config.ImagePathApi}}{{Galeria[3].ImagemID}}.jpg?mh=279');" class="galeria-imv"></div>
                                        <div class="photo_colPop"></div>
                                      </a>
                                   
                                    </div>
                                  </div>
                                 
                                  <div class="col-xs-12 col-sm-4 photo_col">
                                    <div class="photo_colInr">
                                      <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',4);">
                                        <div style="background-image: url('{{Config.ImagePathApi}}{{Galeria[4].ImagemID}}.jpg?mh=279');" class="galeria-imv"></div>
                                        <div class="photo_colPop"></div>
                                      </a>
                                    </div>
                                  </div>
                                {% endif %}
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="view_img">
                                <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',0);">Ver Galeria Completa</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      {% endif %}
                  </div> 

                  <div class="col-md-4 col-sm-12">
                    <div id="sidebar">
                      <div class="side_frm_Prt produto_frm_rt menu">
                      
                      <div class="rt_frm_top_main">
                        {% if item.FilialTelefone|default("") %}
                          <p>Gostou deste imóvel? Ligue para:</p>
                          <div class="pn_no">
                            <h3>{{item.FilialTelefone|default("")}}</h3>
                            <!-- <div class="hov_a">
                              <a href="#">Ver telefone</a>
                            </div> -->
                          </div>
                          
                          <div class="mid">
                            <p>Ou preencha o formulario abaixo,<br /> que entraremos em contato.</p>
                          </div>
                        {% endif %}
                        
                        <div class="frm_lft_prt">
                          <form action="/contato/imovel-interessado/" method="post">
                            
                            <input type="hidden" name="id" value="{{item.ID}}" />
                            <input type="hidden" name="produto" value="imovel" />
                            <input type="hidden" name="url" value="{{Config.base}}prontos/{{item.Url}}" />
                            
                            <input type="text" name="nome" placeholder="Nome Completo" required class="form-control input-lg"/>
                            <input type="email" name="email" placeholder="E-mail" required class="form-control input-lg"/>
                            <div class="half">
                              <input type="text" name="telresidencial" placeholder="Telefone Fixo" class="input-telefone form-control input-lg"/>
                            </div>
                            <div class="half2">
                              <input type="text" name="telcelular" placeholder="Celular" class="input-telefone form-control input-lg"/>
                            </div>
                            <textarea placeholder="Mensagem" name="mensagem" class="form-control" rows="4" required></textarea>
                            <div class="frm_lft_prtBtn">
                              <label><input type="checkbox" name="flagnewsletter"/>Desejo receber novidades por e-mail</label>
                              <input type="submit" value="Enviar" />
                            </div>
                          </form>
                        </div>
                      </div>  
                      
                      <div class="rt_frm_btm_main">
                        <span class="man_pic"><a href="/contato/venda-seu-imovel/"><img src="{{Config.base_url}}theme/images/man_pic.png" alt="Corretor Online" /></a></span>
                        <div class="man_txt">
                          <h3>Quer vender<br> seu imóvel?</h3>
                          <p>Temos uma equipe especializada, e podemos te ajudar e tornar esse processo mais facil.</p>
                        </div>
                      </div>
                     {#<!--  <div class="man_btn">
                        <a href="#" class="btn_nw">Indicar este Imóvel</a>
                        <div class="man_rt">
                          <ul>
                            <li>Compartilhar:</li>
                            <li><a href="#"><img src="{{Config.base_url}}theme/images/social_icon1.png" alt="" /></a></li>
                            <li><a href="#"><img src="{{Config.base_url}}theme/images/social_icon2.png" alt="" /></a></li>
                          </ul>
                        </div>
                      </div> -->#}
                    </div>
                    </div>
                  </div>
                
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="viw_map_sec">
    <div class="container">
      <div class="row">
        {# <!-- CARREGA OS BLOCOS --> #}
        {% for key, entry in blocks %}
          {% set cssClass = key %}
          {% set content = entry.content %}
          {% include entry.template %}
        {% endfor %}  
      </div>
    </div>
  </section>



<!-- <div id="light" class="white_content">
  <div class="popup_main">
    <h3>Ligamos para você</h3>
    <p>Temos uma equipe especializada e podemos<br>
    te ajudar a encontrar o imóvel dos seus sonhos</p>
    <div class="popup_inner">
      <form action="" method="post">
        <div class="popup_frm">
          <input type="text" placeholder="Nome Completo" />
        </div>
        <div class="popup_frm">
          <input type="text" placeholder="Telefone" />
        </div>
        <div class="popup_frm">
          <p>Qual o melhor horário?</p>
        </div>
        <div class="popup_frm">
          <input type="text" class="left_pop" placeholder="De" />
          <input type="text" class="rt_pop" placeholder="Até" />
        </div>
        <div class="popup_frm">
          <input type="submit" value="Enviar" />
        </div>
      </form>
    </div>
  </div>
  <a href = "javascript:void(0)" class="close" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">
    <img src="{{Config.base_url}}theme/images/close.png" alt="" />
  </a>
</div>
 -->
{% if Galeria != "" %}
 
  <div id="light2" class="white_content2">  
    <div class="photo_light_sec">
      <div class="photo_light_secLft">    
        <div class="light_caro">
            <a class="light_cross" href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade').style.display='none'">
              <img src="{{Config.base_url}}theme/images/light_cross.png">
            </a>
          
            <div id="sync1" class="owl-carousel">
              {% for key, imagem in Galeria%}
                <div class="item carousel-item" style="width:100%;height:645px;margin:4% auto;">
                  <div style="background: url('{{Config.ImagePathApi}}{{imagem.ImagemID}}.jpg?wm=5') no-repeat center bottom;width:100%;height:100%;background-size:contain;"></div>
                </div>
              {% endfor %}
            </div>
              
            <div id="sync2" class="owl-carousel hidden-xs">
              {% for key, imagem in Galeria%}
                <div class="item" style="width:100%;height:144px;">
                  <img src="{{Config.ImagePathApi}}{{imagem.ImagemID}}.jpg?mh=171">
                </div>
              {% endfor %}
            </div>
         </div>
      </div>
      <div class="photo_light_secRight">
        <div class="side_frm_Prt">
          {% if item.FilialTelefone|default("") %}
            <p>Gostou deste Imóvel? Ligue para:</p>
            <div class="pn_no">
              <h3>{{item.FilialTelefone|default("")}}</h3>
             <!--  <div class="hov_a">
                <a href="#">Ver telefone</a>
              </div> -->
            </div>
            <div class="mid">
              <p>Ou preencha o formulario abaixo,<br /> que entraremos em contato.</p>
            </div>
          {% endif %}
          <div class="frm_lft_prt">
            <form role="form" class="form-horizontal form-without-legend formulario_form" method="post" action="/contato/imovel-interessado/">
              
             
              <input type="hidden" name="id" value="{{item.ID}}" />
              <input type="hidden" name="produto" value="imovel" />
              <input type="hidden" name="url" value="{{Config.base}}prontos/{{item.Url}}" />
              
              <input type="text" name="nome" placeholder="Nome Completo" required/>
              <input type="email" name="email" placeholder="E-mail" required/>
              <div class="half">
                <input type="text" name="telresidencial" placeholder="Telefone Fixo" class="input-telefone"/>
              </div>
              <div class="half2">
                <input type="text" name="telcelular" placeholder="Celular" class="input-telefone"/>
              </div>
              <textarea placeholder="Mensagem" name="mensagem" required>Estou interessado no imóvel: {{item.Codigo}} - {{item.TipoNome}}. Aguardo Contato. Obrigado.</textarea>
              <div class="frm_lft_prtBtn">
                <input type="submit" value="Enviar" />
              </div>
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>

 
{% endif %}
<div id="fade" class="black_overlay"></div>
<div id="fade10" class="black_overlay10"></div>
<div id="fade11" class="black_overlay11"></div>
  