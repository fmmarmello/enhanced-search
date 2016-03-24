{# Comentado para reunião do Wagner - 08-01-2015 #}
<section class="nova_gallery_sec desk">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="nova_gallery_inner">
					<div class="emprend_inner_head">
	                <h6>Imóveis por região</h6>
	              </div>
					<!-- <div class="nova_gallery_inner_left">
						<img src="{{Config.base_url}}theme/images/logo2.png" alt="" />
					</div> -->
				<!-- 	<div class="nova_gallery_inner_right">
						<p>Nossa equipe especializada separou os<br>
						melhores imóveis de alto padrão de cada região.</p>
					</div> -->
					<div class="nova_gallery_main">
						<div class="row">
							{# 
								<div class="col-sm-6">
									<div class="nova_gallery_Box">
										<div class="nova_gallery_pic" style="cursor:pointer;" onclick="window.location.href='{{Config.base}}prontos/{{item.objurl}}/{{item.id}}/'">
											<!-- <img src="" alt="" /> -->

											<div style="width:568px;height:285px;background: url('{{item.imgfullurl}}') no-repeat center center;background-size:cover;"></div>
											<div class="nova_gallery_txt1">
												<h4>{{item.nometipo|convert_encoding('UTF-8','iso-8859-1')}} com {{item.quartos}} Quartos<br>
												em {{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}} à Venda</h4>
												<ul>
													<li><a href="#"><img src="{{Config.base_url}}theme/images/icon1.png" alt="" alt="" /> <span>{{item.quartos}}</span></a></li>
													<li><a href="#"><img src="{{Config.base_url}}theme/images/icon2.png" alt="" alt="" /> <span>{{item.vagas}}</span></a></li>
													<li><a href="#"><img src="{{Config.base_url}}theme/images/icon3.png" alt="" alt="" /> <span>{{item.areaconstruida}} m <sup>2</sup></span></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								#}
							
							<div class="col-sm-6">
								<div class="nova_gallery_Box">
									<div class="nova_gallery_pic">
										<img src="{{Config.base_url}}theme/images/copacabana.jpg" alt="Imóveis Em Copacabana" />
										<div class="nova_gallery_txt2">
											<h4>Copacabana</h4>
											<ul>
												<li><a href="{{Config.base}}prontos/?finalidade=prontos&cidade=&bairro=%3B2%3B&filtroNome=Copacabana">Ver imóveis prontos para morar</a></li>
												<!-- <li><a href="{{Config.base}}/locacao/?finalidade=locacao&cidade=&bairro=%3B2%3B&filtroNome=Copacabana&localizacao=copa">Imoveis para Alugar</a></li> -->
											</ul>
											<!-- <div class="nova_gallery_txt2_btm">
												<div class="nova_gallery_btm_left">
													<span class="nmbr">128</span>
													<span class="nmbr2">Imóveis disponíveis<br> nessa região</span>
												</div>
												<div class="nova_gallery_btm_right">
													<a href="#">Informações sobre a região <img src="{{Config.base_url}}theme/images/rt_arw_sml.png" alt="" /></a>
												</div>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="nova_gallery_Box">
									<div class="nova_gallery_pic">
										<img src="{{Config.base_url}}theme/images/nova_gallery_pic2.jpg" alt="Imóveis Em Botafogo" />
										<div class="nova_gallery_txt2">
											<h4>Botafogo</h4>
											<ul>
												<li><a href="{{Config.base}}prontos/?finalidade=prontos&bairro=%3B4%3B&filtroNome=Botafogo">Ver imóveis prontos para morar</a></li>
												<!-- <li><a href="{{Config.base}}/locacao/?finalidade=locacao&bairro=%3B4%3B&filtroNome=Botafogo&tipos_prontos=2%3B5%3B10&tipos_prontos=8&localizacao=Botafogo">Imoveis para Alugar</a></li> -->
											</ul>
											<!-- <div class="nova_gallery_txt2_btm">
												<div class="nova_gallery_btm_left">
													<span class="nmbr">128</span>
													<span class="nmbr2">Imóveis disponíveis<br> nessa região</span>
												</div>
												<div class="nova_gallery_btm_right">
													<a href="#">Informações sobre a região <img src="{{Config.base_url}}theme/images/rt_arw_sml.png" alt="" /></a>
												</div>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="nova_gallery_Box">
									<div class="nova_gallery_pic">
										<img src="{{Config.base_url}}theme/images/nova_gallery_pic3.jpg" alt="Imóveis no Flamengo" />
										<div class="nova_gallery_txt2">
											<h4>Flamengo</h4>
											<ul>
												<li><a href="{{Config.base}}prontos/?finalidade=prontos&bairro=%3B5%3B&filtroNome=Flamengo">Ver imóveis prontos para morar</a></li>
												<!-- <li><a href="{{Config.base}}/locacao/?finalidade=locacao&bairro=%3B6%3B&filtroNome=Ipanema&tipos_prontos=2%3B5%3B10&tipos_prontos=8&localizacao=Ipanema">Imoveis para Alugar</a></li>-->
											</ul>
											<!-- <div class="nova_gallery_txt2_btm">
												<div class="nova_gallery_btm_left">
													<span class="nmbr">128</span>
													<span class="nmbr2">Imóveis disponíveis<br> nessa região</span>
												</div>
												<div class="nova_gallery_btm_right">
													<a href="#">Informações sobre a região <img src="{{Config.base_url}}theme/images/rt_arw_sml.png" alt="" /></a>
												</div>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="nova_gallery_Box">
									<div class="nova_gallery_pic">
										<img src="{{Config.base_url}}theme/images/nova_gallery_pic4.jpg" alt="Imóveis na Tijuca" />
										<div class="nova_gallery_txt2">
											<h4>Tijuca</h4>
											<ul>
												<li><a href="{{Config.base}}prontos/?finalidade=prontos&bairro=%3B3%3B&filtroNome=Tijuca">Ver imóveis prontos para morar</a></li>
												<!-- <li><a href="{{Config.base}}/locacao/?finalidade=locacao&bairro=%3B3%3B&filtroNome=Tijuca&tipos_prontos=2%3B5%3B10&tipos_prontos=8&localizacao=tijuca">Imoveis para Alugar</a></li> -->
											</ul>
											<!-- <div class="nova_gallery_txt2_btm">
												<div class="nova_gallery_btm_left">
													<span class="nmbr">128</span>
													<span class="nmbr2">Imóveis disponíveis<br> nessa região</span>
												</div>
												<div class="nova_gallery_btm_right">
													<a href="#">Informações sobre a região <img src="{{Config.base_url}}theme/images/rt_arw_sml.png" alt="" /></a>
												</div>
											</div> -->
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
</section> 