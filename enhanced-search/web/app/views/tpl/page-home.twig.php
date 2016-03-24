
{# include 'inc/breadcrumb.twig.php' #}	
{% for key, entry in blocks %}
	{% if entry.content is defined %}
	{% set cssClass = key %}
	{% set content = entry.content %}
	{% include entry.template %}
{% endif %}   
{% endfor %}

