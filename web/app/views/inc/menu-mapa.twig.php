    <!-- mobile navbar -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- mobile navbar -->
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        {% for key, item in block %}
        <li class="dropdown menu-id{{item.menuitemid}} {% if key==0 %}item-first{% endif %}{% if (key+1)==(MenuPrincipal|length) %}item-last{% endif %}">
        	<a class="a-menu-id{{item.menuitemid}} {% if item.filhos != '' %} dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" {% else %} " {% endif %}" target="_blank" href="{{item.link}}">{{item.titulo|convert_encoding('UTF-8','iso-8859-1')}}</a>
          
          {% if item.filhos != '' %}
          <ul class="dropdown-menu" data-pai"menu-id{{item.menuitemid}}">
            {% for key, subitem in item.filhos %}
            <li class="dropdown-submenu menu-id{{subitem.menuitemid}} {% if key==0 %}item-first{% endif %}{% if (key+1)==(item.filhos|length) %}item-last{% endif %}">
              <a class="a-menu-id{{subitem.menuitemid}}" href="{{subitem.link}}" target="_blank">{{subitem.titulo|convert_encoding('UTF-8','iso-8859-1')}}<i class="fa fa-angle-right"></i></a>

              {% if subitem.filhos != '' %}
              <ul class="dropdown-menu sub-submenu">
                {% for key, subsubitem in subitem.filhos %}
                <li class="dropdown-submenu menu-id{{subitem.menuitemid}} {% if key==0 %}item-first{% endif %}{% if (key+1)==(subitem.filhos|length) %}item-last{% endif %}">
                  <a class="a-menu-id{{subsubitem.menuitemid}}" href="{{subsubitem.link}}" target="_blank">{{subsubitem.titulo|convert_encoding('UTF-8','iso-8859-1')}}<i class="fa fa-angle-right"></i></a>
                </li>
                {% endfor%}
              </ul>
              {% endif %}
            </li>
            {% endfor%}
          </ul>
          {% endif %}
        </li>
        {% endfor%}
      </ul>
    </div><!--/.nav-collapse -->