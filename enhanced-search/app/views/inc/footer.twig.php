{# include 'helpers/barra-flutuante.twig.php' #}

  <section class="footer_sec">
    <div class="footer_top">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            {% include 'helpers/bloco-mapa-footer.twig.php' %}
              <!-- <img src="{{Config.base_url}}theme/images/map2.jpg" alt="" /> -->
            
          </div>
          <div class="col-sm-6 hidden-xs">
            <div class="footer_top_rt">
              <div class="row">
                <div class="col-sm-4">
                  <div class="footer_top_rt_Box">
                    <h4>Nova Época Imóveis</h4>
                    <ul>
                      <li><a href="{{Config.base}}a-imobiliaria/">Sobre nós</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="footer_top_rt_Box">
                    <h4>empreendimentos</h4>
                    <ul>
                      <!-- <li><a href="#">Lançamento</a></li> -->
                      <li><a href="{{Config.base}}prontos/">Imóveis Prontos</a></li>
                      <!-- <li><a href="{{Config.base}}locacao/">Locação</a></li> -->
                    </ul>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="footer_top_rt_Box">
                    <h4>contatos</h4>
                    <ul>
                      <li><a href="{{Config.base}}contato/fale-conosco/">Fale Conosco</a></li>
                      <li><a href="{{Config.base}}contato/trabalhe-conosco/">Trabalhe conosco</a></li>
                      <!-- <li><a href="{{Config.base}}contato/fale-conosco/">Cadastre-se</a></li> -->
                    </ul>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="footer_top_rt_btm">
                    <!-- <div class="news_letter">
                      <h5>Newsletter</h5>
                      <div class="news_letter_frm">
                        <form action="/contato/newsletter" method="post">
                          <input type="text" placeholder="Seu e-mail" name="email" required/>
                          <input type="submit" value="Increva-se" required/>
                        </form>
                      </div>
                    </div> -->
                    <div class="footer_top_rt_btm_Inner">
                      <p>Compartilhe</p>
                      <!-- <h5>compartilhe</h5> -->
                      <ul>
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Config.base}}" target="_blank">
                        <i class="fa fa-facebook-official"></i>
                        <!-- <img src="{{Config.base_url}}theme/images/social_icon_new2.png" alt="" /></a> -->
                        </li>
                        <li><a href="https://twitter.com/home?status={{Config.base}}" target="_blank">
                        <i class="fa fa-twitter-square"></i>
                        <!-- <img src="{{Config.base_url}}theme/images/social_icon_new3.png" alt="" /> -->
                        </a></li>
                        <li><a href="https://plus.google.com/share?url={{Config.base}}" target="_blank">
                        <i class="fa fa-google-plus-square"></i>
                        <!-- <img src="{{Config.base_url}}theme/images/social_icon_new4.png" alt="" /> -->
                        </a></li>
                        <!-- <li><a href="#"><img src="{{Config.base_url}}theme/images/social_icon_new1.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/social_icon_new5.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/social_icon_new6.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/social_icon_new7.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{Config.base_url}}theme/images/social_icon_new8.png" alt="" /></a></li> -->
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer_bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="footer_bottom_left">
              <p>Copyright &copy;2016 nova Época imóveis</p>
            </div>
            
            <div class="footer_bottom_rt">
              <p><span>Desenvolvimento:</span> <a href="#"><a href="http://www.inforce.com.br/?NovaEpoca" target="_blank"><img src="{{Config.base_url}}theme/images/logo_ftr.png" alt="" /></a></a></p>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>
