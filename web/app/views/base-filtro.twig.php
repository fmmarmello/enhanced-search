{# <!-- Inclui apenas o miolo do bloco de listagem | usado para filtrar as informações  -->#}
{# <!-- INICIALIZA OS SCRIPTS --> #}
{% for key, script in scripts %}
	<script type="text/javascript" src="{{Config.base_url}}{{script}}"></script>
{% endfor %}
<div class="search-refreshed">
{% set content = page.content %}
{% set items = content.items %}
{% set produtotag = content.produtotag %}
{% set produto = content.produto %}

{% if items|length < 1%}
	{% include 'helpers/bloco-nenhum-item-encontrado.twig.php' %}
	<script>
		$(document).ready(function($) {
			$('.pagination').bootpag({ total: 1, page: 1,  next: 'Próximo',  prev: 'Anterior',});
		});
	</script>
{% else %}
	{% for key, item in items %}
		{% include 'helpers/bloco-produto-celula.twig.php' %}
	{% endfor %}
{% endif %}
</div>

<script>
	$("#qtdPagina").text("{{content.totalpages}}");
	$("#itensPagina").text("{{content.pagcount}}");	

	$('.conteudo-lista').on('change', function() {
	  $('.flexslider').flexslider({
	    animation: "slide",
	    controlsContainer: ".flex-container"
	  });	  
	});
	$(document).ready(function($) {
		updateTotal({{content.totalCount}});		
		$('.pagination').bootpag({
		   total: {{content.totalpages}},
		   page: {{content.page}},
		   maxVisible: 6,
		   next: 'Próximo',
		   prev: 'Anterior',
		});
	});
</script>