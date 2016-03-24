      <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SALE PRODUCT -->
          <div class="col-md-12 sale-product destaque-vitrine-1">
            <h2>Destaques</h2>
            <div class="owl-carousel owl-carousel5">

            {% for entry in vitrine_1 %}
            <!-- ITEM DESTAQUES -->
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img id="COD{{entry.itemid}}" src="{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.itemid}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.itemid}}">
                    <div>
                      <a href="{{entry.imgurl}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}&nbsp;</a></h3>
                  <div class="pi-codigo">{{entry.construtoranome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                  <div class="pi-price">Código: {{entry.itemid}}&nbsp;</div>
                  <div class="pi-quartos">{{entry.cidadenome|convert_encoding('UTF-8','iso-8859-1')}} | {{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                  <a href="/lancamentos/{{entry.imvurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/" class="btn btn-default add2cart">Detalhes</a>
                  <div class="sticker sticker-sale"></div>
                </div>
              </div>
            <!-- ITEM DESTAQUES -->
            {% endfor %}

            </div>
          </div>
          <!-- END SALE PRODUCT -->
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->
      </div>