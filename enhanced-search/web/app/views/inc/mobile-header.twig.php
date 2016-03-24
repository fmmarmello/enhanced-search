<section class="main_header2 mobile_header">
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
                {% include 'inc/menu.twig.php' %}
            </nav>
      </div>        
    </div>
  </div>
</section>