{% set item = page.content %}
<section class="top_body_prt">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
         <!--  <div class="top_body_L">
            <ul> 
                <li><a href="#" class="active2">Comprar</a></li>
                <li><a href="#">Alugar</a></li>
                <li><a href="#">Lancamentos</a></li>  
            </ul>
            <div class="styled-select">
             <select>
                <option>Apartmento</option>
                <option>The second option</option>
             </select>
          </div>
          <input type="text" name="" placeholder="Digite bairro, cidade ou regiao" value="" />
          <input type="submit" name="" value="Buscer" />
          
          <div class="top_body_L_R_menu">
            <ul>
              <li><a href="#">Buscer no mapa</a></li>
              <li><a href="#">Busca Avancada</a></li>
            </ul>
          </div> -->

           </div>
           <div class="top_body_L2">
            <div class="top_body_L2_lft_menu">
              <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/lancamentos/">Resultado de Busca</a></li>
                <li><a  class="active3">{{item.Nome}}</a></li>
              </ul>
            </div>
            {#
            <div class="top_body_L2_rit_menu">
              <ul>
                <li><a href="#">Empreendimento Anterior</a></li>
                <li><a href="#">Próximo Empreendimento</a></li>
              </ul>
            </div>
            #}
           </div>
           <div class="top_body_L3">
            <div class="top_body_L3_lft">
            <p><span>{{item.NaturezaNome}}</span></p>
            <h2>{{item.Nome}}</h2>
            <h6>{{item.BairroNome}}, {{item.CidadeNome}}, {{item.EstadoSigla}}</h6>
            </div>
            
           <!--  <div class="top_body_L3_rit">
              
            </div> -->
            
            <div class="top_body_L3_rit">
                <ul>
                  {% if item.M2Menor is defined and item.M2Menor > 0 %}
                    <li><strong>Empreendimentos {{item.M2Maior|default(false) ? " de " : " a partir de "}} </strong>{{item.M2Menor}}<span style="margin-left: 0px;">m<sup>2</sup></span></li>
                  {% endif %}
                  {% if item.M2Maior is defined and item.M2Maior > 0 %}
                    <li><strong>Até </strong>{{item.M2Maior}}<span style="margin-left:0">m<sup>2</sup></span></li>
                  {% endif %}
                </ul>
                
                {% if item.QtdQuarto is defined and item.QtdQuarto|length > 0 %}
                <span><img src="theme/images/odd1.png"> {{item.QtdQuarto|join(', ')}} Quarto(s)</span>
                {% endif%}
                
                <span><img src="theme/images/odd.png"> {{item.Tipos|join(', ')}}</span>
            </div>
          
           </div>
        </div>
    </div>
  </div>
</section>

<!-- BLOCO INTERNA-EMPREENDIMENTO-TOP -->
<section class="grey_Prt">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-12">
        <div class="grey_image_Prt" id="nivo-lightbox-demo">
          <div onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" style="background: url('{{Config.HOST_ADMIN}}{{item.ImagemCapaPath}}') no-repeat center bottom;width:848px; height:482px; background-size:cover;"/></div>
          <div class="img_hov_Prtlft">
            {# <a href="#"><img src="{{Config.base_url}}theme/images/search.png" alt=""/></a> #}
          </div>

       <!--    <div class="img_hov_Prtrit">
            <a href="#"><img src="{{Config.base_url}}theme/images/sos2.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos2_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos2.png'" /></a>
              <a href="#"><img src="{{Config.base_url}}theme/images/sos1.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos1_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos1.png'" /></a>
          </div> -->
          
        </div>
      </div>
      <div class="col-md-3 col-sm-12">
        <div class="side_frm_Prt">

          <p>Gostou deste Empreendimento? Ligue para:</p>
          <div class="pn_no">
            <h3>{{Customer.telefone1}}</h3>
           <!--  <div class="hov_a">
              <a href="#">Ver telefone</a>
            </div> -->
          </div>
          <div class="mid">
            <p>Ou preencha o formulario abaixo,<br /> que entraremos em contato.</p>
          </div>
       
          <div class="frm_lft_prt">
            <form role="form" class="form-horizontal form-without-legend" method="post" action="/contato/empreendimento-interessado/">

              <input data-value="contato" type="text" value="{{token}}" name="token">
              <input data-value="contato" type="text" value="Interessado no Empreendimento" name="origem">      
              <input type="hidden" name="id" value="{{item.ID}}" />
              <input type="hidden" name="produto" value="empreendimento" />
              <input type="hidden" name="url" value="{{Config.base}}lancamentos/{{item.Url}}" />
            
              <input type="text" name="nome" placeholder="Nome Completo" required/>
              <input type="email" name="email" placeholder="E-mail" required/>
              <div class="half">
                <input type="text" name="telresidencial" placeholder="Telefone Fixo" class="input-telefone"/>
              </div>
              <div class="half2">
                <input type="text" name="telcelular" placeholder="Celular" class="input-telefone"/>
              </div>
              <textarea placeholder="Mensagem" name="mensagem" required></textarea>
              
              <div class="frm_lft_prtBtn">
                <label><input type="checkbox" />Desejo receber novidades por e-mail</label>
                <input type="submit" value="Enviar" />
              </div>

            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- GALERIAS -->
<section class="content_sec">
  <div class="container">
   {% for key, entry in blocks %}
      {% set cssClass = key %}
      {% set content = entry.content %}
      {% include entry.template %}
    {% endfor %}
  </div>
</section>
{# <!-- TIVE QUE FAZER DESSA FORMA --> #}
{# <!-- COLOCANDO UMA UNICA GALERIA PARA TODOS OS TÓPICOS CARREGADOS ACIMA --> #}
<div id="light" class="white_content">  
  <div class="photo_light_sec">
    <div class="photo_light_secLft">    
      
      <div class="light_caro">
        <a class="light_cross" href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img src="{{Config.base_url}}theme/images/light_cross.png"></a>
        <div id="sync1" class="owl-carousel">
          
            {% set topicos = blocks['topicos-lancamento'].content.Topicos %}
            {% for key, topico in topicos if topico.Imagens|length > 0 %}
             
                {% for key, imagem in topico.Imagens %}
                  <div class="item" style="width:911px;height:645px;margin:4% auto;">
                    <div style="background: url('{{Config.HOST_ADMIN}}{{imagem.ImagePath}}') no-repeat center bottom;width:100%;height:100%;background-size:contain;"></div>
                  </div>
                {% endfor %}
             
            {% endfor %}
          
        <!--   <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>      -->       
        </div>

        <div id="sync2" class="owl-carousel">
            {% set topicos = blocks['topicos-lancamento'].content.Topicos %}
            {% for key, topico in topicos if topico.Imagens|length > 0%}
              
                {% for key, imagem in topico.Imagens %}
                  <div class="item" style="width:238px;height:144px;"><img src="{{Config.HOST_ADMIN}}{{imagem.ImagePath}}"></div>
                {% endfor %}
              
            {% endfor %}
          
         <!--  <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div>
          <div class="item"><img src="{{Config.base_url}}theme/images/light_pic1.jpg"></div> -->
        </div>
       </div>
    </div>
    <div class="photo_light_secRight">
      <div class="side_frm_Prt">
        <p>Gostou deste Empreendimento? Ligue para:</p>
        <div class="pn_no">
          <h3>{{Customer.telefone1}}</h3>
         <!--  <div class="hov_a">
            <a href="#">Ver telefone</a>
          </div> -->
        </div>
        <div class="mid">
          <p>Ou preencha o formulário abaixo,<br /> que entraremos em contato.</p>
        </div>
        <div class="frm_lft_prt">
          <form role="form" class="" method="post" action="/contato/empreendimento-interessado/">
            <input data-value="contato" type="text" value="{{token}}" name="token">
            <input data-value="contato" type="text" value="Interessado no Empreendimento" name="origem">      
            <input type="hidden" name="id" value="{{item.ID}}" />
            <input type="hidden" name="produto" value="empreendimento" />
            <input type="hidden" name="url" value="{{Config.base}}lancamentos/{{item.Url}}" />
            
            <input type="text" name="nome" placeholder="Nome Completo" required/>
            <input type="email" name="email" placeholder="E-mail" required/>
            <div class="half">
              <input type="text" name="telresidencial" placeholder="Telefone Fixo" class="input-telefone" required/>
            </div>
            <div class="half2">
              <input type="text" name="telcelular" placeholder="Celular" class="input-telefone"/>
            </div>
            <textarea placeholder="Mensagem" required></textarea>
            
            <div class="frm_lft_prtBtn">          
              <input type="submit" value="Enviar" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="fade" class="black_overlay"></div>