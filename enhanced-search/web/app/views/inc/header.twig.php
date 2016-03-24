</div><div id="fb-root"></div>
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

{# include 'inc/mobile-header.twig.php' #}

<header class="header_sec">
  <div class="header_top">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="header_top_left">
            <ul>
              <li><a href="{{Config.base}}a-imobiliaria/" title="Sobre Nós">Sobre Nós</a></li>       
           <!--    <li><a href="{{Config.base}}financiamento/">Financiamento</a></li>    -->    
              <li><a href="{{Config.base}}contato/fale-conosco/" title="Fale Conosco">Fale Conosco</a></li>
              <li><a href="{{Config.base}}contato/trabalhe-conosco/" title="Trabalhe Conosco">Trabalhe Conosco</a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <ul>
              <li ><span>Afonso Pena<br> <strong>{{Customer.telefone1}}</strong></span></li>
              <li class="soon"><span>Botafogo<br> <strong>{{Customer.telefone2}}</strong></span></li>
              <li ><span >Copacabana<br> <strong>{{Customer.telefone3}}</strong></span></li>
              <li ><span>Flamengo<br> <strong>{{Customer.telefone4}}</strong></span></li>
              <li><span>Saens Pena<br> <strong>{{Customer.telefone5}}</strong></span></li>
              <!-- <li><a  class="top_btn">Área do Corretor <img src="{{Config.base_url}}theme/images/arw.png" alt="" /></a></li> -->
            </ul> 
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="header_bottm">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <nav class="navbar navbar-default nav_top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="/" class="navbar-brand" title="{{Customer.name_full}}">
                <img src="{{Config.base_url}}theme/images/logo.png" class="desk" alt="{{Customer.name_full}}"/>
                <img src="{{Config.base_url}}theme/images/mob_logo.png" class="mobile" alt="{{Customer.name_full}}"/>
              </a>
              <span class="call_btn mobile"><a ><img src="{{Config.base_url}}theme/images/call.png" alt="" /></a></span>
            </div>
          
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav menu_sec">
                <li><a href="{{Config.base}}prontos/" title="Imóveis prontos">Imóveis prontos</a></li>
                    <!-- <li><a href="{{Config.base}}locacao/">Aluguel</a></li> -->
                   <!--  <li class="dropdown">
                      <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lançamentos<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a >Action</a></li>
                        <li><a >Another action</a></li>
                        <li><a >Something else here</a></li>
                      </ul>
                    </li> -->
                    <li><a href="{{Config.base}}contato/venda-seu-imovel/" class="venda_btn" title="Venda seu Imóvel">Venda seu Imóvel</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right menu_rt">
                <li>
                  <a>
                    <span class="left_icon"><img src="{{Config.base_url}}theme/images/top_icon1.png" alt="" /></span> 
                    <span class="rt_txt">central de atendimento <br> <strong>{{Customer.telefone6}}</strong></span>
                  </a>
                </li>
                <li>
                  <a href="{{Config.base}}contato/fale-conosco/" title="Atendimento por e-mail">
                    <span class="left_icon"><img src="{{Config.base_url}}theme/images/top_icon2.png" alt="Atendimento por e-mail" /></span> 
                    <span class="rt_txt">Atendimento<br> por e-mail</span>
                  </a>
                  <a href="/contact/" data-toggle="tooltip" data-placement="left" title="Contact - English Version" class="flag_ingles"> 
                    <span class="separator"></span>
                    <div class="country"></div>
                  </a>
                  
                </li>
               <!--  <li>
                  <a  class="online">
                    <span class="left_icon"><img src="{{Config.base_url}}theme/images/top_icon3.png" alt="" /></span> 
                    <span class="rt_txt">corretor<br> online</span>
                  </a>
                </li> -->
              </ul>
            </div>
            
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>

{# include 'inc/busca-mobile.twig.php' #}

{# include 'inc/prechat-seletor.twig.php' #}