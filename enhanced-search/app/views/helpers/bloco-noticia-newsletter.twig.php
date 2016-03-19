<style>
	.bloco-newsletter{
		height: 230px;
		background:#f0f0f0;
	}

	.bloco-newsletter .receba-news{
		height: 46px;
		background:#1E3D73;
		color: #FFFFFF; 
	}

	.bloco-newsletter .receba-news h1{
		font-family: "Museo 300", Arial, sans-serif; 
		font-size: 24px;
	}

	.bloco-newsletter .receba-news h1 span{
		font-family: "Museo 700", Arial, sans-serif; 
	}

	.form-news{
		color: #000000; 
	}

	.form-news p{
		padding: 8px 8px 0px 29px;
  		font-size: 12px;
	}

	.form-news input[type="text"], .form-news input[type="email"]{
		height: 30px;
		margin-top: 10px;
	}

	.form-news input[type="button"]{
		background: #1E3D73;
		border: none;
		color: #FFFFFF;
		margin-top: 8px;
		height: 30px;
	}

	.padding-10{
		padding: 10px; 
	}

	.padding-12{
		padding: 12px; 
	}
</style>

<div class="bloco-newsletter">
	<div class="receba-news">
		<h1 class="padding-10">RECEBA <span>NOVIDADES</span></h1>
	</div>

	<div class="form-news">
		<p>
			Receba em primeira mão as novidades da <strong>House Vendas</strong>.
		</p>
		<form role="form" class="HouseCRM_form" method="post" action="/contato/newsletter/">
	        <input data-value="contato" type="hidden" value="{{token}}" name="token">
	      	<input type="text" class="col-md-offset-1 col-md-10" placeholder="Digite seu nome" name="nome" required>
			<input type="email" class="col-md-offset-1 col-md-10" placeholder="Digite seu e-mail" name="email" required>
			<input class="col-md-offset-1 col-md-10 HouseCRM_submit" type="button" value="CADASTRAR">
		</form>
	</div>
</div>
