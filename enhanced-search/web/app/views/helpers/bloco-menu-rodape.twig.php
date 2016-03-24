    <div class="{{cssClass}}">
      <div class="content-block block-menu">
        <div class="info-wrapper">
          {% if entry.title is defined %}<h3>{{entry.title}}</h3>{% endif %}
          {% for key, item in block %}
          <li class="menuitem menu-id{{item.menuitemid}} {% if key==0 %}item-first{% endif %}{% if (key+1)==(block|length) %}item-last{% endif %}">
            <a class="a-menu-id{{item.menuitemid}}" href="{{item.link}}">{{item.titulo|convert_encoding('UTF-8','iso-8859-1')}}</a>

            {% if item.filhos != '' %}
            <ul class="menuitem-menu">
              {% for key, subitem in item.filhos %}
              <li class="menuitem-submenu menu-id{{subitem.menuitemid}} {% if key==0 %}item-first{% endif %}{% if (key+1)==(item.filhos|length) %}item-last{% endif %}">
                <i class="fa fa-angle-right"></i><a class="a-menu-id{{subitem.menuitemid}}" href="{{subitem.link}}">{{subitem.titulo|convert_encoding('UTF-8','iso-8859-1')}}</a>

                {% if subitem.filhos != '' %}
                <ul class="menuitem-menu">
                  {% for key, subsubitem in subitem.filhos %}
                  <li class="menuitem-submenu menu-id{{subitem.menuitemid}} {% if key==0 %}item-first{% endif %}{% if (key+1)==(subitem.filhos|length) %}item-last{% endif %}"><a class="a-menu-id{{subsubitem.menuitemid}}" href="{{subsubitem.link}}">{{subsubitem.titulo|convert_encoding('UTF-8','iso-8859-1')}}</a></li>
                  {% endfor%}
                </ul>
                {% endif %}

              </li>
              {% endfor%}
            </ul>
            {% endif %}

          </li>
          {% endfor%}
        </div>
      </div>
    </div>