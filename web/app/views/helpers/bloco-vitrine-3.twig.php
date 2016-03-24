    <div class="container vitrine-3">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
          <!-- BEGIN SIDEBAR -->
          {% include 'helpers/bloco-newsletter.twig.php' %}
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-8">
            <h2>Imóveis Prontos</h2>
            <div class="owl-carousel owl-carousel3">
            {% for entry in content %}
            <!-- ITEM -->
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img id="V2-COD{{entry.itemid}}" src="{{Config.HOST_ADMIN}}{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.itemid}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.itemid}}">
                    <div>
                      <a href="{{Config.HOST_ADMIN}}{{entry.imgurl}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="/prontos/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/" class="btn btn-default fancybox-fast-view">Veja</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}&nbsp;</a></h3>
                  <div class="pi-price">R$ {{entry.valorvenda|number_format(2,",",".")}}</div>
                  <a href="/prontos/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/" class="btn btn-default add2cart">Saiba Mais</a>
                  <!--div class="sticker sticker-new"></div>
                  <div class="sticker sticker-sale"></div-->
                </div>
              </div>
            <!-- ITEM -->
            {% endfor %}

            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>