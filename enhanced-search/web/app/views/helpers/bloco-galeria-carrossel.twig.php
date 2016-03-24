{% if (content.descricao != "") or (content.array_imgs | length > 1) %}
<div class="container">
    <!-- BEGIN BRANDS X-->        
        <div class="">
          <div class="dit_txt">
              <h2>{{content.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h2>
              {{content.descricao|raw}}
          </div>
          {% if content.array_imgs| length > 1 %}
          <div class="container margin-top-50">
                <!-- div class="owl-carousel owl-carousel6-brands" -->                
                <div id="owl-example-{{content.titulo|replace(' ', '-')}}" class="{{content.template}} {{block}}">
                    {% for entry in content.array_imgs %}
                        {% if entry.imgfullurl is defined %}
                          {% set URL = entry.imgfullurl %}
                        {% else %}
                          {% set URL = entry.imgurl %}
                        {% endif %}
                        <a href="{{URL}}" rel="galeria{{entry.albumid}}" class="fancybox-button">
                          <div class="item" style='background:url("{{entry.imgurl}}") no-repeat center';></div>
                        </a>
                    {% endfor %}
                </div>                
          </div>
          {% endif%}
          </div>
        <script type="text/javascript">
          $(document).ready(function(){
              var owl = $("#owl-example-{{content.titulo|replace(' ', '-')}}");

              owl.owlCarousel({
                itemsCustom : [
                [0, 1],
                [450, 2],
                [600, 3],
                [700, 3],
                [1000, 3],
                [1200, 4],
                [1400, 4],
                [1600, 5]
                ],
                navigation : true,
                /*lazyLoad : true,*/
                slideSpeed : 500
              });
          });
        </script>
        <style>
          #owl-example-{{content.titulo|replace(' ', '-')}} .item{
            margin: 3px;
            height: 137px;
            background-repeat: no-repeat;

          }
          #owl-example-{{content.titulo|replace(' ', '-')}} .item img{
            display: block;
            width: 90%;
            height: auto;
          }
        </style>        
    <!-- END BRANDS -->
</div>
{% endif %}