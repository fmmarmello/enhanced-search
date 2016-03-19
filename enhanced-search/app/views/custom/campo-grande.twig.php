<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<html lang="pt-br">

	<head>
		<!-- {# chamada para assets comuns a todas as paginas #} -->
		{% include 'inc/assets.twig.php' %}

		<!-- {# chamada para assets especificos para uma pagina #} -->
		{% for entry in assets %}
			{% set content = entry.content %}
			{% include entry.template %}
		{% endfor %}

		<title>{{page_title}}</title>
	</head>

	<body class="{{page_class}} ficha-empreendimento">

	    <div class="main">
	      <div class="container">
	      	
			<!-- {# chamada para os templates de conteudo da pagina #} -->
			{% for key, entry in tpl %}
				{% set cssClass = key %}
				{% set content = entry.content %}
				{% include entry.template %}
			{% endfor %}

	      </div>
	    </div>

		<!-- Código do Google para tag de remarketing -->
		<!-- 
			As tags de remarketing não podem ser associadas a informações pessoais 
			de identificação nem inseridas em páginas relacionadas a categorias de 
			confidencialidade. Veja mais informações e instruções sobre como 
			configurar a tag em: http://google.com/ads/remarketingsetup 
		-->
		<script type="text/javascript">
		/* <![CDATA[ */
			var google_conversion_id = 966724407;
			var google_custom_params = window.google_tag_params;
			var google_remarketing_only = true;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
		<noscript><div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/966724407/?value=0&amp;guid=ON&amp;script=0"/></div></noscript>		
	</body>

</html>