<div class="row">
  <div class="col-sm-12">
    <div class="dit_txt">
      <h3>Mais fotos</h3>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="gal_prt">
      <div class="line">
      {% for entry in content.array_imgs %}
          {% if entry.imgfullurl is defined %}
            {% set URL = entry.imgfullurl %}
          {% else %}
            {% set URL = entry.imgurl %}
          {% endif %}          
          <img  alt="" title="" src="{{entry.imgurl}}" >          
      {% endfor %}        
      </div>      
    </div>
  </div>
</div>