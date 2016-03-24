{% set galleryid = content.galleryid %}
{% set galleryidInicial = galleryid %}

{# "galleryid" gambs para marcar no "lightbox" a imagem clicada #}

{% set content = content.Topicos %}

  <div class="row">
    <div class="col-sm-9">

    {% for key, topico in content if topico.Nome != 'Localização' %}
      {% if topico.Descricao|default("") and topico.Imagens == "" %}
        <div class="content_secRow">
          <h4>{{topico.Nome}}</h4>
          {% autoescape false %}
          <p>{{topico.Descricao|default('')}}</p>
          {% endautoescape %}
        </div>
      {% elseif topico.Descricao|default("") or topico.Imagens|length > 0 %}
        <div class="content_secRow">
          <div class="col-sm-3"><h4>{{topico.Nome}}</h4></div>
          <div class="col-sm-9">
          {% autoescape false %}
            <p>{{(topico.Descricao|raw)|default('')}}</p>
          {% endautoescape %}
            {% if topico.Imagens|length > 0 %}              
              {% set galleryid = galleryidInicial %}
              <div class="photos_sec">
                {% if topico.Imagens|length > 1 %}
                  <div class="col-sm-6 photo_col big">
                    <div class="photo_colInr">
                    {% set galleryid = galleryid + 1 %}
                      <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';  $('#sync1').trigger('owl.goTo',{{galleryid}});"><div class="galeria-emp-big" style="background-image: url('{{Config.HOST_ADMIN}}{{topico.Imagens[0].ImagePath}}')"></div><div class="photo_colPop">Ver todas as imagens</div></a>
                      </div>
                  </div>
                  <div class="col-sm-6 photo_col big">
                  {% set galleryid = galleryid + 1 %}
                    <div class="photo_colInr">
                      <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',{{galleryid}});"><div class="galeria-emp-big" style="background-image: url('{{Config.HOST_ADMIN}}{{topico.Imagens[1].ImagePath}}')"></div><div class="photo_colPop">Ver todas as imagens</div></a>                 
                    </div>
                  </div>
                {% endif %}
                {% if topico.Imagens|length > 4 %}
                  <div class="col-sm-4 photo_col">
                    <div class="photo_colInr">
                    {% set galleryid = galleryid + 1 %}
                      <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',{{galleryid}});"><div class="galeria-emp" style="background-image: url('{{Config.HOST_ADMIN}}{{topico.Imagens[2].ImagePath}}')"></div><div class="photo_colPop">Ver todas as imagens</div></a>
                    </div>
                  </div>
                  <div class="col-sm-4 photo_col">
                    <div class="photo_colInr">
                    {% set galleryid = galleryid + 1 %}
                      <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',{{galleryid}});"><div class="galeria-emp" style="background-image: url('{{Config.HOST_ADMIN}}{{topico.Imagens[3].ImagePath}}')"></div><div class="photo_colPop">Ver todas as imagens</div></a>
                    </div>
                  </div>
                  <div class="col-sm-4 photo_col">
                    <div class="photo_colInr">
                    {% set galleryid = galleryid + 1 %}
                      <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';$('#sync1').trigger('owl.goTo',{{galleryid}});"><div class="galeria-emp" style="background-image: url('{{Config.HOST_ADMIN}}{{topico.Imagens[4].ImagePath}}')"></div><div class="photo_colPop">Ver todas as imagens</div></a>
                    </div>
                  </div>
                {% endif %}
              </div>
              {% set galleryidInicial = galleryidInicial+  (topico.Imagens|length ) %}
            {% endif %}
          </div>
        </div>
      {% endif %}
    {% endfor %}
    </div>
    <div class="col-sm-3">
      <ul class="side_mnu">
        <li class="online" data-interna="{{id|default('')}}" data-interna-tipo="{{tag|default('')}}" data-ref="{{Config.base}}{{Config.HOST_ROUTE}}"><a >Corretor Online</a></li>
       <!--  <li><a href="#">Indicar Imovel</a></li>
        <li><a href="#">Imprimir</a></li> -->
      </ul>
      <ul class="side_sm">
        <li><a href="#">Compartilhar:</a></li>
        <li><a href="#"><img src="{{Config.base_url}}theme/images/fcbk_icon.png"></a></li>
        <li><a href="#"><img src="{{Config.base_url}}theme/images/fcbk_icon2.png"></a></li>
      </ul>
    </div>
  </div>
  