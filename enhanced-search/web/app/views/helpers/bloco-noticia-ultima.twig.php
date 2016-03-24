{% if content != "" and content|length > 1 %}
  <!-- NOTICIAS -->
  <section class="notice_sec">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="notice_left">
              <div class="notice_left_head">
                <h3>Notícias</h3>
              </div>
              <div class="notice_rt_btn">
                <a href="{{Config.base}}noticias/">Ver todas notícias</a>
              </div>
              <div class="notice_box_main">
                <div class="notice_box">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="notice_box_left">
                        <h4>{{content[0].data_programada|date("d")}}<br> <span>{{content[0].mes}}</span></h4>
                      </div>
                    </div>
                    <div class="col-sm-10">
                      <div class="notice_box_right">
                        <h4><a href="/noticia/{{content[0].objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{content[0].id}}">{{content[0].titulo|convert_encoding('UTF-8','iso-8859-1')}}</a></h4>
                        <p><a href="/noticia/{{content[0].objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{content[0].id}}">{{content[0].sumario|convert_encoding('UTF-8','iso-8859-1')}}</a></p>
                      </div>
                    </div>
                  </div>
                </div>
                
                 <div class="notice_box">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="notice_box_left">
                        <h4>{{content[1].data_programada|date("d")}}<br> <span>{{content[1].mes}}</span></h4>
                      </div>
                    </div>
                    <div class="col-sm-10">
                      <div class="notice_box_right">
                        <h4><a href="/noticia/{{content[1].objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{content[1].id}}">{{content[1].titulo|convert_encoding('UTF-8','iso-8859-1')}}</a></h4>
                        <p><a href="/noticia/{{content[1].objurl|convert_encoding('UTF-8','iso-8859-1')}}/{{content[1].id}}">{{content[1].sumario|convert_encoding('UTF-8','iso-8859-1')}}</a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
          </div>
          <div class="col-sm-3 hidden-xs">
            <div class="office_add">
              <div class="office_top">
                <a href="#"><img src="{{Config.base_url}}theme/images/residential_pic1.jpg" alt="" /></a>  
              </div>  
              <div class="office_bottm">
                <h4>People Life</h4>
                <h5>Residencial &amp; Office</h5>
                <p>Seu novo residencial e office no coração de Copacabana</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3 hidden-xs">
            <div class="chat_pic">
              <div id="fb-root"></div>
              <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));</script>
              <div class="fb-page" data-href="https://www.facebook.com/inforceinternet/" data-width="268" data-height="309" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/inforceinternet/"><a href="https://www.facebook.com/inforceinternet/">Inforce Internet Solutions</a></blockquote></div></div>
            </div>  
          </div>
        </div>
      </div>
  </section>
{% else %}
  <!-- QUEM SOMOS -->
  <section class="notice_sec">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="notice_left">
              <div class="notice_left_head">
                <h3>Notícias</h3>
              </div>
              <div class="notice_rt_btn">
                <a href="#">Ver todas notícias</a>
              </div>
              <div class="notice_box_main">
                <div class="notice_box">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="notice_box_left">
                        <h4>06<br> <span>Out</span></h4>
                      </div>
                    </div>
                    <div class="col-sm-10">
                      <div class="notice_box_right">
                        <h4>Os imóveis que R$ 400 mil compram pelo Brasil</h4>
                        <p>Imóveis de 400 mil reais podem ser espaçosos. No entanto, a área de casas e apartamentos à 
                        venda nessa faixa de preço diminui consideravelmente se o imóvel for localizado em bairros nobres 
                        de grandes cidades brasileiras, como São Paulo e Rio de Janeiro.</p>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="notice_box">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="notice_box_left">
                        <h4>01<br> <span>Out</span></h4>
                      </div>
                    </div>
                    <div class="col-sm-10">
                      <div class="notice_box_right">
                        <h4>Enquanto banco dificulta financiamento, construtora facilita</h4>
                        <p>Imóveis de 400 mil reais podem ser espaçosos. No entanto, a área de casas e apartamentos à 
                        venda nessa faixa de preço diminui consideravelmente se o imóvel for localizado em bairros nobres 
                        de grandes cidades brasileiras, como São Paulo e Rio de Janeiro.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
          </div>
          <div class="col-sm-3 hidden-xs">
            <div class="office_add">
              <div class="office_top">
                <a href="#"><img src="{{Config.base_url}}theme/images/residential_pic1.jpg" alt="" /></a>  
              </div>  
              <div class="office_bottm">
                <h4>People Life</h4>
                <h5>Residencial &amp; Office</h5>
                <p>Seu novo residencial e office no coração de Copacabana</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3 hidden-xs">
            <div class="chat_pic">
              <img src="{{Config.base_url}}theme/images/chat_pic.jpg" alt="" />
            </div>  
          </div>
        </div>
      </div>
  </section>

{% endif %}