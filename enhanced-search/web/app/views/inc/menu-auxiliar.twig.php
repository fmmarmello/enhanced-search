<ul>
  <li><a href="/" title="Página Inicial"><img src="theme/images/top_lft_home.png" alt="" /></a></li>
{% for key, item in block %}
  <li><a href="{{item.link}}" title="{{item.titulo|convert_encoding('UTF-8','iso-8859-1')}}">{{item.titulo|convert_encoding('UTF-8','iso-8859-1')}}</a></li>  
{% endfor%}
</ul>