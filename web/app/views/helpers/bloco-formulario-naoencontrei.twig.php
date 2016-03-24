<section class="mid_frm_sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="mid_frm_inner">
					<h3>Ainda não encontrou seu imóvel? <br>
						<span>Nós podemos te ajudar!</span>
						<p>Sabemos que encontrar o imóvel dos seus sonhos não é uma tarefa fácil, e nós 
						podemos te auxiliar nessa jornada pois temos uma equipe super preparada.</p>
						<p><span>Nos diga seus dados e como deve ser o imóvel dos seus sonhos:</span></p>
						<form action="/contato/encontre-seu-empreendimento/" method="post" name="lancamento-nao-encontrei" id="formHome">
							

							<div class="mid_frm_Box">
								<ul>
									<li><a data-finalidade="lancamento" class="slct opt-form-home">Lançamento</a></li>
									<li><a data-finalidade="prontos" class=" opt-form-home">Pronto</a></li>
									<!-- <li><a data-finalidade="Locação" class="opt-form-home">Alugar</a></li> -->									
								</ul>
								<input type="hidden" name="finalidade" value="lancamento">
							</div>
							<div class="mid_frm_Box">
								<input type="text" placeholder="Nome*" name="nome" class="name " onblur="if(this.value=='') this.value='Nome'" onfocus="if(this.value=='Nome') this.value=''" required/>
								<input type="email" placeholder="E-mail*" name="email" class="mail" onblur="if(this.value=='') this.value='E-mail'" onfocus="if(this.value=='E-mail') this.value=''" required/>
							</div>
							<div class="mid_frm_Box">
								<input type="text" placeholder="Telefone Fixo*" name ="telresidencial" class="tel1 input-telefone" onblur="if(this.value=='') this.value='Telefone Fixo'" onfocus="if(this.value=='Telefone Fixo') this.value=''" required/>
								<input type="text" placeholder="Telefone Celular" name="telcelular" class="tel2 input-telefone" onblur="if(this.value=='') this.value='Telefone Celular'" onfocus="if(this.value=='Telefone Celular') this.value=''" />
							</div>	
							<div class="mid_frm_Box">
								<div class="top_select">
									<select name="tipo" required>
			                            <option value="Todos">Tipo do Imóvel</option>
			                            <option value="Apartamento">Apartamento</option>
			                            <option value="Casa">Casa</option>
			                            <option value="Flat">Flat</option>
			                            <option value="Galpão">Galpão</option>
			                            <option value="Cobertura">Cobertura</option>
			                        </select>
		                        </div>
		                        <div class="top_select2">
									<select name="quartos">
										<option value="">Qtde de Quartos</option>
			                            <option value="1">1</option>
			                            <option value="2">2</option>
			                            <option value="3">3</option>
			                            <option value="4">4</option>
			                            <option value="5+">5+</option>
			                        </select>
		                        </div>
		                        <div class="top_select2">
									<select name="vagas">
										<option value="">Qtde de Vagas</option>
			                            <option value="1">1</option>
			                            <option value="2">2</option>
			                            <option value="3">3</option>
			                            <option value="4+">4+</option>
			                        </select>
		                        </div>
							</div>
							<div class="mid_frm_Box">
								<input type="text" name="regiao" placeholder="Em qual região você gostaria? " onblur="if(this.value=='') this.value='Em qual região você gostaria? Pode ser mais de uma.'" onfocus="if(this.value=='Em qual região você gostaria? Pode ser mais de uma.') this.value=''" />
							</div>
							<div class="mid_frm_Box">
								<input type="submit" value="Pronto! Enviar." />
							</div>
						</form>
					</h3>
				</div>
			</div>
			<div class="col-sm-6 hidden-sm hidden-xs">
				<div class="mid_frm_rt">
					<img src="theme/images/girl_pic.jpg" alt="" />
				</div>
			</div>
			
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('.opt-form-home').click(function(event) {
			var finalidade = $(this).attr('data-finalidade'); 
			if (finalidade == 'lancamento')
				$("#formHome").attr('action', '/contato/encontre-seu-empreendimento/');
			else
				$("#formHome").attr('action', '/contato/encontre-seu-imovel/');
			
			$('input[name=finalidade]').val($(this).attr('data-finalidade')); 
		});
	});
</script>