<script type="text/javascript">
  $(document).ready(function(){
    $('.slick-carrossel').slick({
      appendArrows: $(".slick-nav-buttons"),
      speed: 500,
      infinite: true,
      // dots: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      rows: 2,
    });
  });
</script>

      <div class="container vitrine-1 vitrine-{{cssClass}}">
        <!-- BEGIN VITRINE -->
        <div class="row">

          <div class="col-md-12 vitrine">
            <h2>
              <div class="linha-1">Conheça nossos</div>
              <span class="linha-2">empreendimentos</span>
            </h2>
            
            <div class="slick-nav-buttons">{# <!-- span>Navegue:</span --> #}</div>
            <div class="slick-carrossel no-owl-carousel no-owl-carousel4">

            {% for entry in content %}
              <!-- ITEM DESTAQUES -->
                <div>
                  <div class="product-item">
                    <div class="pi-img-wrapper">
                      <img id="COD{{entry.itemid}}" src="{{entry.imgurl}}" class="img-responsive" alt="COD{{entry.itemid}}|{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}" data-id="{{entry.itemid}}">
                      <div>
                        <a href="/empreendimentos/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/" class="btn btn-default fancybox-fast-view"><i class="fa fa-search-plus"></i></a>
                      </div>
                    </div>
                    <h1>{{entry.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}}</h1>
                    <h2>{{entry.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</h2>
                    <h3>{{entry.tipologia|convert_encoding('UTF-8','iso-8859-1')}}</h3>
                    <div class="pi-quartos">
                      {{entry.estatus|convert_encoding('UTF-8','iso-8859-1')}}

                      {% if entry.nquartos is not null %}
                        {% if entry.nquartos=="1" %}
                          - {{entry.nquartos}} Quarto
                        {% else %}
                          - {{entry.nquartos}} Quartos
                        {% endif %}
                      {% endif %}

                      {% if entry.m2menor is not null %}
                        - {{entry.m2menor}}m²
                      {% endif %}
                      {% if entry.m2menor is not null and entry.m2maior is not null %}
                        a
                      {% endif %}
                      {% if entry.m2maior is not null %}
                        {{entry.m2maior}}m²
                      {% endif %}
                    </div>
                    <a href="/{{entry.produtotag}}/{{entry.objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{entry.itemid}}/" class="btn btn-default add2cart">Conheça</a>
                    <div class="sticker sticker-id-{{entry.statusid}}">{{entry.statusnome|convert_encoding('UTF-8','iso-8859-1')}}</div>
                  </div>
                </div>
              <!-- ITEM DESTAQUES -->
            {% endfor %}

            </div>
          </div>

        </div>
        <!-- END VITRINE -->
      </div>