{% if content is not null %}
    <!-- BEGIN BRANDS -->
    <div class="container"> 
        <div class="row">
          <div class="col-sm-12">
            <div class="dit_txt">
              <h3>Infraestrutura</h3>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-12">
            <div class="list_prt">
              <ul>
                {% for entry in content %}
                    <li class="col-md-3 col-lg-3"><a>{{entry.nome|convert_encoding('UTF-8','iso-8859-1')}}</a></li>
                {% endfor %}
              </ul>
            </div>
          </div>          
        </div>
    </div>
    
    <!-- END BRANDS -->
{% endif %}