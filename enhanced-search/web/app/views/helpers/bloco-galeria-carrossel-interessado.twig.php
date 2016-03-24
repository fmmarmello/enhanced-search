    <!-- BEGIN BRANDS -->
        {% if (content.descricao != "") or (content.array_imgs | length > 0) %}
        <div id="{{block}}" class="slick-carrossel brands {{content.template}} carrossel-interessado margin-bottom-50">
          <h2>{{content.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h2>
          <div class="container">
                <!-- div class="owl-carousel owl-carousel6-brands" -->
                <div class="slick-carrossel-nav-buttons slick-{{content.template}}-buttons {{block}}-nav-buttons"></div>
                <div class="slick-{{content.template}} {{block}}-images">
                    {% for entry in content.array_imgs %}
                        {% if entry.imgfullurl is defined %}
                          {% set URL = entry.imgfullurl %}
                        {% else %}
                          {% set URL = entry.imgurl %}
                        {% endif %}
                        <a href="{{URL}}" rel="galeria{{entry.albumid}}" class="fancybox-button">
                          <span class="pic-container" style="background-image: url('{{entry.imgurl}}'); background-size: cover; background-position: 50% 50%;">
                              <img data-lazy="{{entry.imgurl}}" alt="canon" title="canon" url="{{entry.imgurl}}" style="display:none">
                          </span>
                        </a>
                    {% endfor %}
                </div>
                <div class="descricao">
                    {{content.descricao|raw}}
                </div>
            </div>
        </div>

        <span id="fancy-form-{{block}}" style="display:none">
          <div class='fancybox-form'>
             {% include 'helpers/bloco-interessado.twig.php' %}
          </div>
        </span>

        <script type="text/javascript">
          $(document).ready(function(){
            var slickWidth = $(".slick-carrossel").css("width");
            if(slickWidth == "720px"){
              varSlidesToShow = 4;
            }else{
              varSlidesToShow = 7;
            }

            $('.{{block}}-images').slick({
              appendArrows: $(".{{block}}-nav-buttons"),
              speed: 500,
              infinite: true,
              // dots: true,
              lazyLoad: 'ondemand',
              slidesToShow: varSlidesToShow,
              slidesToScroll: 1,
              rows: 1,
              responsive: [
                {
                  breakpoint: 1030,
                  settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                  }
                }
              ],
            });

            if($(".{{block}}-nav-buttons").html() != ""){
              $(".{{block}}-nav-buttons").prepend("<span>Navegue:</span>");
            }

            var tempLeft = 0;
            var max_width = 9999;
            if($(document).innerWidth() < 1030){
              max_width = 610;
            }
            $(".fancybox-button").fancybox({
                prevEffect    : 'elastic',
                nextEffect    : 'elastic',
                scrolling     : 'no',
                afterLoad: function(current, previous) {
                  // execucoes a serem feitas apos o load
                  $(".fancybox-overlay").addClass("carrossel-interessado");

                  $(".fancybox-overlay").append( $("#fancy-form-{{block}}").html() );

                  {# /*<!-- TCK#2599 -->*/ #}
                  messagemPadrao = "Olá, tenho interesse neste imóvel: "+$("#dfltMss").html();
                  $(".fancybox-form .form-mensagem textarea").val(messagemPadrao);
                  {# /*<!-- TCK#2599 -->*/ #}

                },
                maxWidth: max_width,
                helpers:  {
                    thumbs : {
                        width: 167,
                        height: 125
                    }
                }
            });     


          });


          // quando submeter algum formulario
          $(document).on('click', ".HouseCRM_submit", function(){
            var elePai = $(this).parents('form');

            var codCRM = $(elePai).find("input[name='codempreendimento']").val();
              if(codCRM==undefined){
                codCRM = "";
              }
            var ret = hc_envia_mensagem(
              codCRM,
              $(elePai).find("input[name='nome']").val(),
              $(elePai).find("input[name='email']").val(),
              '', 
              $(elePai).find("input[name='telcelular']").val(),
              'Mensagem enviada pelo cliente');

            obj = $.parseJSON(ret); 

            console.log(ret);

            if(obj.sucesso){ 
              console.log("Mensagem enviada com sucesso!"); 
            }else{ 
              console.log('Falha: '+obj.retorno); 
            }

          });


        </script>

        {% endif %}
    <!-- END BRANDS -->
