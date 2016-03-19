<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<html lang="pt-br">

	<head>
		{#<!-- chamada para assets comuns a todas as paginas -->#}
		{% include 'inc/assets.twig.php' %}

		{#<!-- chamada para assets especificos para uma pagina -->#}
		{% for entry in assets %}
			{% set content = entry.content %}
			{% include entry.template %}
		{% endfor %}		
	</head>

	<body class="{{page_class}}">
		
		{% include 'inc/google-tag-manager.twig.php' %}
		
		</script>
		<div class="wrapper">
			{#<!-- cabecalho da pagina -->#}
			{% if 'mapa' in ROTA %}
				{% include 'inc/header-mapa.twig.php' %}
			{% else %}
				{% include 'inc/header.twig.php' %}
			{% endif %}

			{#<!-- corpo da pagina -->#}
			{% include page.template %}

			{#<!-- rodape da pagina -->#}
			{% if 'mapa' not in ROTA %}
				{% include 'inc/footer.twig.php' %}
			{% endif %}
			
			{% include 'inc/footer-last.twig.php' %}		

			{#<!-- modal do site do corretor -->#}
			{% include 'helpers/modal-corretor.twig.php' %}			
		
			
			{#<!-- chamada para assets comuns a todas as paginas -->#}
			{% include 'inc/assets-footer.twig.php' %}


			<script>
			    	function chamaSom(){
			    		var audioElement = document.createElement('audio');
			    		audioElement.setAttribute('src', 'assets/ixco.mp3');
			    		audioElement.setAttribute('autoplay', 'autoplay');
			    		//audioElement.load()

			    		$.get();

			    		audioElement.addEventListener("load", function() {
			    		    audioElement.play();
			    		}, true);

			    		$('.play').click(function() {
			    		    audioElement.play();
			    		});

			    		$('.pause').click(function() {
			    		    audioElement.stop();
			    		});
			    	}

			</script> 
		</div>
	</body>

</html>