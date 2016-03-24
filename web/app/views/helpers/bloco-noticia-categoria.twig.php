<div class="{{cssClass}} col-md-12 col-sm-12">
	<h2>Categorias</h2>
	<ul class="cat-list">
	{% for key, entry in content %}
	  <li class="item-{{key}}"><a href="/noticias/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">&gt;&gt; {{entry.nome|convert_encoding('UTF-8','iso-8859-1')}} {# ({{entry.total}}) #}</a></li>
	{% endfor %}
	</ul>
</div>