{% set item = page.content %}
{% set Galeria = item.Imagens %}


<section class="prd_detal_sec product_premium_top">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="prd_detal_Inn">
					<div class="prd_detl_top_menu gallery_brd">
						<div class="top_body_L2">
					     	<div class="top_body_L2_lft_menu">
					     		<ul>
					     			<li><a href="#" class="active3">Home</a></li>
					     			<li><a href="#">{{item.TipoNome}} {{item.QtdQuarto > 0 ? "com "~(item.QtdQuarto > 1 ? item.QtdQuarto~" quartos" : item.QtdQuarto~" quarto") : ""}} para {{'locacao' in ROTA ? 'alugar' : 'comprar' }}{{item.AreaUtil != "" ? ", "~item.AreaUtil~"m²" : ""}}</a></li>
					     			
					     		</ul>
					     	</div>
					     	<!-- <div class="top_body_L2_rit_menu">
					     		<ul>
					     			<li><a href="#">Imóvel Anteior</a></li>
					     			<li><a href="#">PPróximo Imóvel</a></li>
					     		</ul>
					     	</div> -->
					     </div>
					</div>
					
					<div class="gallery_premium_top">
						<p><span>{{item.Codigo}} </span>- {{item.TipoNome}}</p>
						<h2>{{item.TipoNome}} 
						{{item.QtdQuarto > 0 ? "com "~(item.QtdQuarto > 1 ? item.QtdQuarto~" quartos" : item.QtdQuarto~" quarto") : ""}} para {{'locacao' in ROTA ? 'alugar' : 'comprar' }}{{item.AreaUtil != "" ? ", "~item.AreaUtil~"m²" : ""}}</h2>
						<a href="#"><img src="{{Config.base_url}}theme/images/map_icon.png" alt="" /> {{item.BairroNome}}, {{item.CidadeNome}}, {{item.EstadoSigla}}</a>
					</div>
					
					<div  class="prd_detl_top_menu_L3">
					     <section class="grey_Prt gallery_mid_dec">
							<div class="row">
								 <div class="col-md-9 col-sm-12">
									<div class="grey_image_Prt" id="nivo-lightbox-demo">
										<a title="" href="{{Config.HOST_ADMIN}}{{Galeria[0].ImagePath|default("")}}" data-lightbox-gallery="gallery1"><div style="background: url('{{Config.HOST_ADMIN}}{{Galeria[0].ImagePath|default("")}}') no-repeat center bottom;width:100%; height:571px; background-size:cover;" data-lightbox-gallery="gallery1"/></div></a>
										<div class="img_hov_Prtlft">
											<a href="#"><img src="{{Config.base_url}}theme/images/search.png" alt=""/></a>
										</div>
										<div class="img_hov_Prtrit">
											<a href="#"><img src="{{Config.base_url}}theme/images/whit_star.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/yello_star.png'" onmouseout="this.src='{{Config.base_url}}theme/images/whit_star.png'" /></a>
							    			<a href="#"><img src="{{Config.base_url}}theme/images/sos1.png" alt="" border="0" onmouseover="this.src='{{Config.base_url}}theme/images/sos1_hvr.png'" onmouseout="this.src='{{Config.base_url}}theme/images/sos1.png'" /></a>
										</div>
										<div class="gallery_img_details">
											<div class="gallery_img_details_left">
												<p>Valor de Compra</p>
												<h4><span><sub>R$</sub></span>{{item.ValorVenda|number_format(0,",",".")}}</h4>
												<ul>
												  {% if item.ValorLocacao|default(0) > 0 %}
					                                <li>Aluguel <strong>R$ {{item.ValorLocacao|number_format(0,",",".")}}</strong></li>
					                              {% endif %}
					                              
					                              {% if item.ValorCondominio|default(0) > 0 %}
					                                <li>Condominio <strong>R$ {{item.ValorCondominio|number_format(0,",",".")}}</strong></li>
					                              {% endif %}
					                              
					                              {% if item.ValorIPTU|default(0) > 0 %}
					                                <li>IPTU <strong>R$ {{item.ValorIPTU|number_format(0,",",".")}}</strong></li>
					                              {% endif %}
                             					</ul>
											</div>
											<div class="gallery_img_details_right">
												<ul>
													{% if item.QtdQuarto|default(0) > 0 %}
														<li><a href="#"><img src="{{Config.base_url}}theme/images/icon1.png"><span>{{item.QtdQuarto}}</span></a></li>
													{% endif %}
													
													{% if item.QtdVaga|default(0) > 0 %}
														<li><a href="#"><img src="{{Config.base_url}}theme/images/icon2.png"><span>{{item.QtdVaga}}</span></a></li>
													{% endif %}
													
													{% if item.AreaUtil|default(0) > 0 %}
														<li><a href="#"><img src="{{Config.base_url}}theme/images/icon3.png"><span>{{item.AreaUtil}} m<sup>2</sup></span></a></li>
													{% endif %}
												</ul>
											</div>	
										</div>
									</div>	
								</div> 
								 <div class="col-md-3 col-sm-12">
									<div id="sidebar">
										<div class="side_frm_Prt produto_frm_rt menu">
											<div class="rt_frm_top_main product_premium_menu">
												<div class="top_tag"><p>Gostou desse imóvel?</p></div>
												<div class="mid">
													<p>Preencha seus dados e tenha um<br> atendimento premium.</p>
												</div>
												<div class="frm_lft_prt">
													 <form action="/contato/imovel-interessado/" method="post">
                                                        <input type="hidden" name="id" value="{{item.ID}}" />
							                            <input type="hidden" name="produto" value="imovel" />
							                            <input type="hidden" name="url" value="{{Config.base}}prontos/{{item.Url}}" />
							                            
							                            <input type="text" name="nome" placeholder="Nome Completo" required/>
							                            <input type="email" name="email" placeholder="E-mail" required/>
							                            <input type="text" name="telresidencial" placeholder="Telefone Fixo" class="input-telefone"/>
							                            <input type="text" name="telcelular" placeholder="Celular" class="input-telefone"/>
							                            <textarea placeholder="Mensagem" name="mensagem" required></textarea>
							                            <div class="frm_lft_prtBtn">
							                              <label><input type="checkbox" name="flagnewsletter"/>Desejo receber novidades por e-mail</label>
							                              <input type="submit" value="Enviar" />
							                            </div>
                          							</form>
													<div class="premium_txt">
														<p>*Mensagem de Erro: Prencha nome<br> no formulário</p>
													</div>	
												</div>
											</div>
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
<section class="gallery_premium_area_sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="gallery_premium_area_left">
					<div class="gallery_premium_area_left_box">
						<h4>Sobre este imovel</h4>
						<p>{{item.Descricao|default("")}}</p>
					</div>
					<div class="gallery_premium_area_left_box">
						<h4>Sobre este imovel <span>{{item.CondominioNome != "" ? 'Condomínio '~item.CondominioNome : ''}} {{item.EdificioNome != "" ? ' - Edificio '~item.EdificioNome : ''}}</span></h4>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="gallery_premium_area_right">
					<div class="gallery_premium_area_right_box">
						<div class="row">
							<div class="col-sm-4">
								<h4>Dados do imóvel</h4>
							</div>
							{% if item.QtdPessoa|default(0) > 0 %}
							<div class="col-sm-4">
								<p>Acomoda <strong>{{item.QtdPessoa}}</strong> pessoa(s)</p>
							</div>
							{% endif %}
							<div class="col-sm-4">
								<p>
									{% if item.QtdQuarto > 0 %}
										<strong>{{item.QtdQuarto}} quarto(s)</strong> 
										<strong>{{item.QtdSuite > 0 ? ' sendo '~item.QtdSuite~' suíte(s)' : ''}}</strong>
									{% endif %}
								</p>
							</div>
							<div class="col-sm-4 hidden-xs">
								<h4>&nbsp;</h4>
							</div>
							{% if item.AreaTotal|default(0) > 0 %}
								<div class="col-sm-4">
									<p>Área Total <strong>{{item.AreaTotal}} M<sup>2</sup></strong></p>
								</div>
							{% endif %}
							{% if item.AreaUtil|default(0) > 0 %}
								<div class="col-sm-4">
									<p>Área Útil <strong>{{item.AreaUtil}} M<sup>2</sup></strong></p>
								</div>
							{% endif %}
							<div class="col-sm-4 hidden-xs">
								<h4>&nbsp;</h4>
							</div>
							{% if item.QtdLavabo|default(0) > 0 %}
								<div class="col-sm-4">
									<p>Lavabo(s) <strong>{{item.QtdLavabo}}</strong></p>
								</div>
							{% endif %}
							
							{% if item.QtdSala|default(0) > 0 %}
								<div class="col-sm-4">
									<p>Sala <strong>{{item.QtdSala}} M<sup>2</sup></strong></p>
								</div>
							{% endif %}
							<div class="col-sm-4 hidden-xs">
								<h4>&nbsp;</h4>
							</div>
							
							{% if item.QtdWcTotal|default(0) > 0 %}
								<div class="col-sm-4">
									<p>Banheiro(s) <strong>{{item.QtdWcTotal}}</strong></p>
								</div>
							{% endif %}
							
							{% if item.QtdVaranda|default(0) > 0 %}
								<div class="col-sm-4">
									<p>Varanda <strong>{{item.QtdVaranda}} M<sup>2</sup></strong></p>
								</div>
							{% endif %}
						</div>
					</div>
					<div class="gallery_premium_area_right_box">
						<div class="row">
							<div class="col-sm-4">
								<h4>Comodidades</h4>
							</div>
							{% set count = 0 %}
							{% for key, caracteristica in item.Caracteristicas %}
								{% set count = count + 1 %}
								<div class="col-sm-4">
									<p>{{caracteristica.Nome}}</p>
								</div>

								{% if count == 2 %}
									{% set count = 0%}
									<div class="col-sm-4 hidden-xs">
										<h4>&nbsp;</h4>
									</div>
								{% endif %}

							{% endfor %}
					
						</div>	
					</div>	
					
					<div class="gallery_premium_area_right_box">
						<div class="row">
							
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>

<section class="product_galery_sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="product_galery_top">
					<div class="product_galery_top_left">
						<h3>Galeria de Imagens</h3>
					</div>
					<div class="product_galery_top_right">
						<ul>
							<li>Compartilhar:</li>
							<li><a href="#"><img src="{{Config.base_url}}theme/images/galry_social_icon1.png" alt="" /></a></li>
							<li><a href="#"><img src="{{Config.base_url}}theme/images/galry_social_icon2.png" alt="" /></a></li>
						</ul>
					</div>
				</div>
				<div class="content_secRow">
					<div class="row">
						<div class="col-sm-12">
							<div class="photos_sec">
								{% for key, Imagem in Galeria %}
									<div class="col-xs-6 col-sm-4 photo_col big">
										<div class="photo_colInr">
											<a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block'">
												<!-- <img src="{{Config.base_url}}theme/images/gallery_details_pic1.jpg"> -->
												<div style="width:377px; height:252px; background: url('{{Config.HOST_ADMIN}}{{Imagem.ImagePath|default("")}}') no-repeat center center; background-size: cover;"></div>
												<div class="photo_colPop"></div>
											</a>
										</div>
									</div>
								{% endfor %}
							</div>
						</div>
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
                <div class="item" style="width:911px;height:645px;margin:4% auto;">
                  <div style="background: url('{{Config.HOST_ADMIN}}{{imagem.ImagePath}}') no-repeat center bottom;width:100%;height:100%;background-size:contain;"></div>
                </div>
              {% endfor %}
            </div>
              
            <div id="sync2" class="owl-carousel">
              {% for key, imagem in Galeria%}
                <div class="item" style="width:238px;height:144px;"><img src="{{Config.HOST_ADMIN}}{{imagem.ImagePath}}"></div>
              {% endfor %}
            </div>
         </div>
      </div>
      <div class="photo_light_secRight">
        <div class="side_frm_Prt">
          <p>Gostou deste Imóvel? Ligue para:</p>
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
            <input type="text" name="" placeholder="Nome Completo" />
            <input type="email" name="" placeholder="E-mail" />
            <input type="text" name="" placeholder="Telefone Fixo" />
            <input type="text" name="" placeholder="Celular" />
            <textarea placeholder="Estou interessado no imóvel: {Cód do Imóvel} - {Título do Imóvel}. Aguardo Contato. Obrigado."></textarea>
            
            <div class="frm_lft_prtBtn">
              <input type="submit" value="Enviar" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{% endif %}
<div id="fade" class="black_overlay"></div>
<div id="fade10" class="black_overlay10"></div>
<div id="fade11" class="black_overlay11"></div>
  
