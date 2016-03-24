<style>
	#input-select,
	#input-number {
		padding: 7px;
		margin: 15px 5px 5px;
		width: 70px;
	}

	.input-range{
		width: 40% !important;
		margin-top: 10px;
	}

	#input-number-min, #input-area-min{
		float: left;
	}

	#input-number-max, #input-area-max{
		float: right;
	}

	.white_content11 select{
		width: 50%;
		height: 20px;
	}

</style>
<section class="mob_buscar mobile">
	<div class="container">
		<div class="row">
			<div class="col-xs-8">
				<input type="text" placeholder="Clique aqui para encontrar imóvel..." />
			</div>
			<div class="col-xs-4">
				<a href = "javascript:void(0)" onclick = "document.getElementById('light11').style.display='block';document.getElementById('fade11').style.display='block'">buscar</a>
			</div>
		</div>
		
<!-- 		<div class="banner_search mt20 mobile">	
			<div class="banner_search_right prd_detl_top_srch">
				<ul>
					<li>
						<span class="banner_search_Box1">
							<p>O que você esta procurando?</p>
							<a href="#" class="actv">Comprar</a>
							<a href="#">Alugar</a>
						</span>
					</li>
					<li>
						<span class="banner_search_Box1">
							<p>Tipo</p>
							<select name="">
	                            <option value="1">Apartamento</option>
	                            <option value="1">Casa</option>
	                            <option value="1">Flat</option>
	                            <option value="1">Galpão</option>
	                            <option value="1">Cobertura</option>
	                        </select>
						</span>
					</li>
					<li>
						<span class="banner_search_Box1">
							<p>Onde?</p>
							<input type="text" placeholder="Copacabana, Rio de Janeiro, rj" />
						</span>
					</li>
				</ul>
			</div>
		</div> -->
	</div>
</section>

<div id="light11" class="white_content11">
	<div class="main_search_popup">
		<div class="main_search_popup_top">
			<h3>Buscar Imóvel</h3>
		</div>
		<div class="main_search_popup_mid">
			<div class="resulto_main_L">
				<div class="roww1_top">
					<h4>O que você esta procurando?</h4>
					<div class="roww1_top_btn">
						<ul>
							<li class="roww1_top_btn_brd"><a href="#" class="roww1_top_actv">Comprar</a></li>
							<li><a href="#">Alugar</a></li>
						</ul>
					</div>
				</div>
				<div class="roww1">
					<h4>Buscar por codigo</h4>
					<input type="text" name="" value="" placeholder="Digite o codigo do imovel" />
					<input type="submit" name="" value=""/>
				</div>
				<div class="roww2">
					<h4>Buscar por codigo <span>Limpar Filtros</span></h4>
					<input type="text" name="" value="" placeholder="Digite aqui a regiao" />
					<input type="submit" name="" value=""/>
					<ul>
						<li> Barra da Tijuca <a href="#"><img src="{{Config.base_url}}theme/images/cross2.png" alt=""></a></li>
						<li> Botafogo <a href="#"><img src="{{Config.base_url}}theme/images/cross2.png" alt=""></a></li>
						<li> Copacabana <a href="#"><img src="{{Config.base_url}}theme/images/cross2.png" alt=""></a></li>
					</ul>
				</div>
				<div class="roww3 mobil_roww3">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingTwo">
					      <h4 class="panel-title">
					        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          <h4>Tipo</h4>
					        </a>
					      </h4>
					    </div>
					    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					      <div class="panel-body">
					         <input id="chk4" type="checkbox" checked="" value="all" name="chk">
							<label for="chk4">Apartamento</label>
							<input id="chk5" type="checkbox" value="false" name="chk">
							<label for="chk5">Casa</label>
							<input id="chk6" type="checkbox" value="true" name="chk">
							<label for="chk6">Cobertura</label>
							<input id="chk7" type="checkbox" checked="" value="all" name="chk">
							<label for="chk7">Galpao</label>
							<input id="chk8" type="checkbox" value="false" name="chk">
							<label for="chk8">Flat</label>
							
					      </div>
					    </div>
					  </div>
					  
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingThree">
					      <h4 class="panel-title">
					        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          <h4>Comodidades</h4>
					        </a>
					      </h4>
					    </div>
					    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
					      <div class="panel-body">
					         <input id="chk9" type="checkbox" checked="" value="all" name="chk">
							<label for="chk9">Piscina</label>
							<input id="chk10" type="checkbox" value="false" name="chk">
							<label for="chk10">Piscina Infantil</label>
							<input id="chk11" type="checkbox" value="true" name="chk">
							<label for="chk11">Elevador</label>
							<input id="chk12" type="checkbox" checked="" value="all" name="chk">
							<label for="chk12">Churrasqueira</label>
							<input id="chk13" type="checkbox" value="false" name="chk">
							<label for="chk13">Sauna a vapor</label>
							
					      </div>
					    </div>
					  </div>
					  
					</div>
				</div>
				<div class="roww3 desk_roww3">
					<h4>Tipo</h4>
					<input id="chk4" type="checkbox" checked="" value="all" name="chk">
					<label for="chk4">Apartamento</label>
					<input id="chk5" type="checkbox" value="false" name="chk">
					<label for="chk5">Casa</label>
					<input id="chk6" type="checkbox" value="true" name="chk">
					<label for="chk6">Cobertura</label>
					<input id="chk7" type="checkbox" checked="" value="all" name="chk">
					<label for="chk7">Galpao</label>
					<input id="chk8" type="checkbox" value="false" name="chk">
					<label for="chk8">Flat</label>
					<a href="#">Ver mais</a>
				</div>
				<div class="roww3">
					<div class="half_1">
					<h4>Quartos</h4>
					<div class="styled-select6">
				   <select>
				      <option>02</option>
				      <option>10</option>
				   </select>
				    </div>
				</div>
				<div class="half_2">
					<h4>Suites</h4>
					<div class="styled-select6">
				   <select>
				      <option>01</option>
				      <option>10</option>
				   </select>
				    </div>
				</div>
				<div class="half_1">
					<h4>Vagas de Garagem</h4>
					<div class="styled-select6">
				   <select>
				      <option>02</option>
				      <option>10</option>
				   </select>
				    </div>
				</div>
				<div class="half_2">
					<h4>Banheiros</h4>
					<div class="styled-select6">
				   <select>
				      <option>1</option>
				      <option>10</option>
				   </select>
				    </div>
				</div>
				</div>
				<div class="roww4">
					<h4>Valor</h4>
					<div id="slider-range-valor"></div>
					<input type="text" name="" id="input-number-min" class="input-range" value=""/>
					<input type="text" name="" id="input-number-max" class="input-range" value=""/>
				</div>
				<div class="roww4">
					<h4>Área Útil</h4>
					<div id="slider-range-area"></div>
					<input type="text" name="" id="input-area-min" class="input-range" value=""/>
					<input type="text" name="" id="input-area-max" class="input-range" value=""/>
				</div>
				<div class="roww10">
					<ul>
						<!-- <li><a href="#">Limpar</a></li> -->
						<li><a href="#" class="actv">Aplicar filtros</a></li>
					</ul>
				</div>	
			</div>
		</div>	
	</div>
	<a href = "javascript:void(0)" class="pop_close" onclick = "document.getElementById('light11').style.display='none';document.getElementById('fade11').style.display='none'">
		<img src="{{Config.base_url}}theme/images/close.png" alt="" />
	</a>	
</div>

