<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<base href="http://www.novaepoca.com.br/web/">	
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">    

<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2016 11:12:01 GMT">    

<meta name="generator"	content="http://www.inforce.com.br/">
<meta name="author" 	content="Inforce Internet Solutions">

<meta name="copyright" 	content="Nova Época">
<meta name="url" 		content="http://www.novaepoca.com.br/web/">

<meta name="title"			content="Fale Conosco - Imobiliária Nova Época">
<meta name="description" 	content="A mais moderna imobiliária de prontos do Rio de Janeiro! Casas, apartamentos e imóveis à venda em Botafogo, Flamengo, Copacabana, Tijuca e outros.">
<meta name="keywords" 		content="Imobiliária, Imóveis, Imóveis à venda, Imóveis prontos para morar, Casas, Apartamentos, Rio de Janeiro, Flamengo, Botafogo, Copacabana, Tijuca" >

<title>Contact English Version</title>
<!-- bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!-- PAGE STYLE -->
<link rel="stylesheet" href="{{Config.base_url}}theme/css/english.css">

</head>
<body>
	
	{% include 'inc/google-tag-manager.twig.php' %}

	<div class="bg">
		<div class="container-fluid">
			<section class="header container">
					<div class="col-sm-3 col-md-3 logo">
						<a href="{{Config.base}}"><img src="{{Config.base_url}}theme/images/english/logo.png" alt="Logo Nova Época" class="logo-img img-responsive"></a>
					</div>
					<div class="col-sm-9 col-md-9 hidden-xs telefone">
                        <div class="row">
                            <div class="filial"><p>Afonso Pena <br> {{Customer.telefone1}}</p></div>
                            <div class="filial"><p>Botafogo <br> {{Customer.telefone2}}</p></div>
                            <div class="filial"><p>Copacabana <br> {{Customer.telefone3}}</p></div>
                            <div class="filial"><p>Flamengo <br> {{Customer.telefone4}}</p></div>
                            <div class="filial"><p>Saens Pena <br> {{Customer.telefone5}}</p></div>
                        </div>
					</div>
			</section>
			
			<section class="title-center container">
					<div class="col-md-12 title">
						<h1>Looking to invest in property or buy a home in Rio de Janeiro?</h1>
						<p>Please fill out the form below and submit. A realtor will return your contact.</p>
					</div>
			</section>

			<section class="form">
				<div class="form-box">
					<form action="/contato/fale-conosco-english/" method="post" onsubmit="return validaFormBasic($(this)); ">
						<div class="form-group">
							<label for="name">Name<span>*</span></label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="email">E-mail<span>*</span></label>
							<input type="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label for="phone">Phone<span>*</span></label>
									<input type="text" name="telresidencial" class="form-control input-telefone" required>
								</div>							
								<div class="col-md-6">
									<label for="cellphone">Cell Phone</label>
									<input type="text" name="telcelular" class="form-control input-telefone">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="message">Message<span>*</span></label>
							<input type="text" name="mensagem" class="form-control" required>
						</div>
						<div class="form-group col-md-12">
							<input type="submit" value="send" class="col-md-5 col-md-offset-4">
						</div>
					</form>
				</div>
			</section>
            
            <div class="col-xs-12 visible-xs">
                <div class="filial-content row">
                    <div class="filial"><i class="fa fa-phone"></i><p>Afonso Pena {{Customer.telefone1}}</p></div>
                    <div class="filial"><i class="fa fa-phone"></i><p>Botafogo {{Customer.telefone2}}</p></div>
                    <div class="filial"><i class="fa fa-phone"></i><p>Copacabana {{Customer.telefone3}}</p></div>
                    <div class="filial"><i class="fa fa-phone"></i><p>Flamengo {{Customer.telefone4}}</p></div>
                    <div class="filial"><i class="fa fa-phone"></i><p>Saens Pena {{Customer.telefone5}}</p></div>
                </div>
            </div>

			<section class="footer">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6"><p>Copyright ©2015 Nova Época Imóveis</p></div>
						<div class="col-xs-12 col-sm-6 col-md-6">
                            <a href="http://www.inforce.com.br/?NovaEpoca"><img src="{{Config.base_url}}theme/images/english/logo-inforce.png" class="img-responsive pull-right" alt="Inforce Internet Solution" style="margin-left: 10px;"></a>
                            <p class="pull-right">Developed by:</p>

						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

    
	<script src="{{Config.base_url}}assets/jvs/valida-form-basic.js"></script>
	<script src="{{Config.base_url}}assets/jvs/jquery.mask.js"></script>

	<script>
		$(document).ready(function(){
			$('.input-telefone').mask('(999) 9999-99999');
		}); 
	</script>

	
</body>
</html>