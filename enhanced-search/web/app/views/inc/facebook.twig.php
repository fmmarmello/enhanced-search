{% set item = content %}
		<meta property="fb:app_id" content="{{Customer.facebookAppID}}" /> 

	{% if item.produtotag == 'home' %}

		<meta property="og:site_name" content="{{Config.Cliente}}" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="{{Config.base_url}}theme/images/logo_sharer.jpg"/>

		<meta property="og:title" content="{{Customer.title}}" />
		<meta property="og:description" content="{{Customer.meta_descricao}}" />
		<meta property="og:url" content="{{Config.base}}"/>

	{% else %}		
		<meta property="og:site_name" content="{{Config.Cliente}}" />
		<meta property="og:type" content="website" />
		{% if item.Descricao is defined %}
		<meta property="og:description" content="{{(item.Descricao|striptags[:300])}}" />
		{% else %}
		<meta property="og:description" content="{{Customer.meta_descricao}}" />
		{% endif %}
		
		<meta property="og:url" content="{{Config.base}}/{{item.Url}}"/>
		
		
		{% if item.produtotag == 'lancamentos' %}
		<meta property="og:image" content="{{Config.HOST_ADMIN}}{{item.ImagemCapaPath|default('_custom/galeria_imagem/imagens/img_imovel_sem_foto_2.png')}}"/>
		<meta property="og:title" content="{{page_title}} - {{item.CidadeNome|convert_encoding('UTF-8','iso-8859-1')}} " />
		{% elseif item.produtotag == 'prontos' or item.produtotag == 'locacao' %}		
			<meta property="og:title" content="{{page_title}}{% if item.ValorVenda is defined %} - Venda | {% else %} - Locação | {% endif %} {{item.CidadeNome|convert_encoding('UTF-8','iso-8859-1')}}" />
			{% if item.Imagens|length == 0 or 'sem_foto' in item.Imagens[0].ImagePath%}
				<meta property="og:image" content="{{Config.HOST_ADMIN}}_custom/galeria_imagem/imagens/img_imovel_sem_foto_2.png"/>
			{% else %}
				<meta property="og:image" content="{{Config.HOST_ADMIN}}{{item.Imagens[0].ImagePath}}"/>
			{% endif %}
		{% endif %}
	{% endif %}


{% if item.produtotag is defined and item.produtotag == 'prontos'%}
	<link rel="canonical" href="{{Config.base}}prontos/{{item.Url}}" />
{% elseif item.produtotag is defined and item.produtotag == 'lancamentos' %}
	<link rel="canonical" href="{{Config.base}}lancamentos/{{item.Url}}" />
{% endif %}