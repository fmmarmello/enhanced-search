<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{{Customer.facebookAppID}}',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/pt_BR/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'pt-BR'}
</script>

<section class="top_header hidden-xs">
  <div class="container">
      <div class="row">
        <div class="col-sm-12">        
          <div class="top_header_lft_menu">
            {% set block = MenuAuxiliar %}
            {% include 'inc/menu-auxiliar.twig.php' %}            
          </div>
          <div class="top_header_rit_menu">
            <ul>
              <li>WhatsApp <br /> <span>{{Customer.telefone3}}</span></li>
              <li>Lancamentos <br /> <span>{{Customer.telefone2}}</span></li>
              <li>Prontos <br /> <span>{{Customer.telefone1}}</span></li>
            </ul>
            {# FAVORITOS
            <div class="top_header_rit_menu_last_prt">
              <span>2</span>
              <a  class="toggle-menu menu-right">Favoritos</a>
              <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right right_menu">
                <h3>Favoritos <img src="images/cross.png" alt="" class="cross toggle-menu menu-right" /></h3>
                <div class="right_details_box">
                  <div class="right_details_pic">
                    <a href="#"><img src="images/rt_details_pic1.jpg" alt="" /></a>
                  </div>
                  <div class="right_details_txt">
                    <h4><a href="#">Maravilhoso apartamento com 2 ambientes</a></h4>
                    <h5>Barra da Tijuca, RJ</h5>
                    <p>Apartamento com 3 Quartos, sendo 1 suite</p>
                  </div>
                </div>
                <div class="right_details_box">
                  <div class="right_details_pic">
                    <a href="#"><img src="images/rt_details_pic1.jpg" alt="" /></a>
                  </div>
                  <div class="right_details_txt">
                    <h4><a href="#">Maravilhoso apartamento com 2 ambientes</a></h4>
                    <h5>Barra da Tijuca, RJ</h5>
                    <p>Apartamento com 3 Quartos, sendo 1 suite</p>
                  </div>
                </div>
                <div class="right_search">
                  <input type="text" value="Digite seu e-mail" onblur="if(this.value=='') this.value='Digite seu e-mail'" onfocus="if(this.value=='Digite seu e-mail') this.value=''" />
                  <input type="submit" value="Enviar" />
                </div>
              </div>
            </div>
            #}
          </div>
        </div>
      </div>
    </div>
</section>
<section class="main_header fixed">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div class="logo">
          <a href="/"><img src="theme/images/logo.png" alt="" /></a>
        </div>
      </div>
      <div class="col-sm-5">
        <!-- Static navbar -->
        <nav class="navbar navbar-default main_menu">
                {% set block = MenuPrincipal %}
                {% include 'inc/menu-mapa.twig.php' %}                
        </nav>
      </div>
      <div class="col-sm-4">
        <div class="main_header_R_prt">
          <img src="theme/images/man.png" alt="" class="man" />
          <div class="online">
            <a >
              <img src="theme/images/ln.png" alt="" class="line_brdr" />
              <h3>Corretores <br><span>Online</span></h3>
              <img src="theme/images/q.png" alt="" class="qut" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{% include 'inc/busca-mobile.twig.php' %}            