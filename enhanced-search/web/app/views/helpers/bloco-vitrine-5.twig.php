      <div class="container vitrine-1 vitrine-{{cssClass}}">
        <!-- BEGIN VITRINE -->
        <div class="row margin-bottom-40">

          <div class="col-md-12 vitrine">
            <h2>Destaques</h2>
            <div class="owl-carousel owl-carousel5">

            {% for entry in content %}
              {% if entry.produto == 'imovel' %}
              <!-- ITEM DESTAQUES -->
                <div>
                  <div class="product-item">
                    <div class="pi-img-wrapper">
                      <img id="COD{{entry.id}}" src="{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.id}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.id}}">
                      <div>
                        <a href="{{entry.imgurl}}" class="btn btn-default fancybox-button">Zoom</a>
                        <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/" class="btn btn-default fancybox-fast-view">Veja</a>
                      </div>
                    </div>
                    <h3><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/">{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}&nbsp;</a></h3>
                    <div class="pi-quartos">{{entry.cidadenome|convert_encoding('UTF-8','iso-8859-1')}} | {{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                    <div class="pi-price">Código: {{entry.id}}&nbsp;</div>
                    <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.id}}/" class="btn btn-default add2cart">Detalhes</a>
                    <!--div class="sticker sticker-sale"></div-->
                  </div>
                </div>
              <!-- ITEM DESTAQUES -->
              {% endif %}

              {% if entry.produto == 'empreendimento' %}
              <!-- ITEM DESTAQUES -->
                <div>
                  <div class="product-item">
                    <div class="pi-img-wrapper">
                      <img id="COD{{entry.itemid}}" src="{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.itemid}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.itemid}}">
                      <div>
                        <a href="{{entry.imgurl}}" class="btn btn-default fancybox-button">Zoom</a>
                        <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/" class="btn btn-default fancybox-fast-view">Veja</a>
                      </div>
                    </div>
                    <h3><a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/">{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}&nbsp;</a></h3>
                    <div class="pi-codigo">{{entry.construtoranome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                    <div class="pi-quartos">{{entry.cidadenome|convert_encoding('UTF-8','iso-8859-1')}} | {{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                    <div class="pi-price">Código: {{entry.itemid}}&nbsp;</div>
                    <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/" class="btn btn-default add2cart">Detalhes</a>
                    <!--div class="sticker sticker-sale"></div-->
                  </div>
                </div>
              <!-- ITEM DESTAQUES -->
              {% endif %}
            {% endfor %}

            </div>
          </div>

        </div>
        <!-- END VITRINE -->
      </div>