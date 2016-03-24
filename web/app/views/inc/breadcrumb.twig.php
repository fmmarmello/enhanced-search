{% if breadcrumb is defined %}    
    	<div class="container">
	      <div class="row">
	        <div class="col-sm-12">
	          <div class="top_body_L2">
	            <div class="top_body_L2_lft_menu">	            
	              <ul>
		            {% for item in breadcrumb %}
		        		<li><a href="{{Config.base~item.url|convert_encoding('UTF-8','iso-8859-1')}}">{{item.nome|convert_encoding('UTF-8','iso-8859-1')|title }}</a></li>
		            {% endfor %}
			        </ul>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
{% endif %}