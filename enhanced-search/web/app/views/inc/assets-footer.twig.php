<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{Config.base_url}}theme/js/bootstrap.js"></script>
<script src="{{Config.base_url}}theme/js/bootstrap-carousel.js"></script>

<script src="{{Config.base_url}}theme/js/application.js"></script>
<!-- OR -->
<!-- <script src="{{Config.base_url}}theme/js/docs.min.js"></script> -->
 
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{Config.base_url}}theme/js/ie10-viewport-bug-workaround.js"></script>
<script src="{{Config.base_url}}theme/js/freshslider.min.js"></script>
<script src="{{Config.base_url}}theme/js/jquery.selectBox.js"></script>
<script src="{{Config.base_url}}theme/js/owl.carousel.js"></script>
<script src="{{Config.base_url}}assets/jvs/jquery.number.min.js"></script>
<script src="{{Config.base_url}}assets/jvs/jquery.mask.js"></script>
<script src="{{Config.base_url}}theme/js/jquery.validate.min.js"></script>

{% if 'preview' not in ROTA %}
  <script src="{{Config.base_url}}assets/jvs/moveDivOnScroll.js"></script>
{% endif %}
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>

<script src="assets/jvs/inforce.js"></script>
<script src="assets/jvs/custom-cleaned.js"></script>

{% if scripts is defined %}
  {% for script in scripts %}
    <script src="{{Config.base_url}}{{script}}"></script>
  {% endfor %}
{% endif %}

<script language="javascript" type="text/javascript">
  $(document).ready( function() {
    
    
    $('#open').click(function(){
      $('#hide').slideToggle();
    });

    $('#open2').click(function(){
      $('#hide2').slideToggle();
    });

    $('[data-toggle="tooltip"]').tooltip(); 

    // $(".input-range-home").keyup(function(e){
    //     $(this).val(format($(this).val()));
    //     console.log($(this).val()); 
    // });

    // $(".input-range").keyup(function(e){
    //     $(this).val(format($(this).val()));
    // });

    var statusEsconde = true; 
    $('.mais').click(function(event) {
      if (statusEsconde){
        $('.estica-esconde').css({height: 'auto'});
        statusEsconde = false;
        $(this).text("Veja Menos -");
      }else{
        $('.estica-esconde').css({height: '180px'});
        statusEsconde = true;
        $(this).text("Veja Mais +");
      }
    });

   
    var selects = $("select.selectBox").selectBox();
    

    $('.input-telefone').mask('(999) 9999-99999');
    $('.input-moeda').number( true, 2 );
   
    var s0 = $("#unranged").freshslider({
        step: 10,
        unit:'%',
        enabled:false
    });



    var s3 = $("#unranged-value").freshslider({
        step: 10,
        value:10
    });

    var s4 = $("#ranged-value").freshslider({
        range: true,
        step:10,
        value:[4, 60],
        onchange:function(low, high){
            console.log(low, high);
        }
    });


      var s0 = $("#unranged").freshslider({
        step: 10,
        unit:'%',
        enabled:false
    });

    var s1 = $("#ranged").freshslider({
        range:true,
        step:0.1,
        text:false,
        onchange:function(low, high){
            console.log(low, high);
        }
    });
    
     var s1 = $("#ranged2").freshslider({
        range:true,
        step:0.1,
        text:false,
        onchange:function(low, high){
            console.log(low, high);
        }
    });
    
     var s1 = $("#ranged5").freshslider({
        range:true,
        step:0.1,
        text:false,
        onchange:function(low, high){
            console.log(low, high);
        }
    });
    
     var s1 = $("#ranged6").freshslider({
        range:true,
        step:0.1,
        text:false,
        onchange:function(low, high){
            console.log(low, high);
        }
    });
    
     var s1 = $("#ranged7").freshslider({
        range:true,
        step:0.1,
        text:false,
        onchange:function(low, high){
            console.log(low, high);
        }
    });

    var s2 = $("#unranged-value").freshslider({
        step: 1,
        value:10
    });

    var s3 = $("#ranged-value").freshslider({
        range: true,
        step:1,
        value:[4, 60],
        onchange:function(low, high){
            console.log(low, high);
        }
    });

    // funcao que captura o enter quando pressionado com 
    // o cursor do typeahead/hogan    
  });
</script>

<script>
    $(document).ready(function() {

      var sync1 = $("#sync1");
      var sync2 = $("#sync2");

      sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: true,
        pagination:false,
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
      });

      sync2.owlCarousel({
        items : 5,
        itemsDesktop      : [1199,4],
        itemsDesktopSmall     : [979,4],
        itemsTablet       : [767,3],
        itemsMobile       : [479,2],
        pagination:false,
        responsiveRefreshRate : 100,
        afterInit : function(el){
          el.find(".owl-item").eq(0).addClass("synced");
        }
      });

      function syncPosition(el){
        var current = this.currentItem;
        $("#sync2")
          .find(".owl-item")
          .removeClass("synced")
          .eq(current)
          .addClass("synced")
        if($("#sync2").data("owlCarousel") !== undefined){
          center(current)
        }

      }

      $("#sync2").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
      });

      function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

        var num = number;
        var found = false;
        for(var i in sync2visible){
          if(num === sync2visible[i]){
            var found = true;
          }
        }

        if(found===false){
          if(num>sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", num - sync2visible.length+2)
          }else{
            if(num - 1 === -1){
              num = 0;
            }
            sync2.trigger("owl.goTo", num);
          }
        } else if(num === sync2visible[sync2visible.length-1]){
          sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
          sync2.trigger("owl.goTo", num-1)
        }
      }

    });
    </script>
  

<script>
    $(document).ready(function() {
      var owl = $("#owl-demo");
      owl.owlCarousel({
        itemsCustom : [
        [0, 1],
        [450, 2],
        [600, 3],
        [700, 3],
        [1000, 3],
        [1200, 4],
        [1400, 4],
        [1600, 4]
        ],
        navigation : true
      });
    });
</script>
    
<script>
    $(document).ready(function() {
      var owl = $("#owl-demo2");
      owl.owlCarousel({
        itemsCustom : [
        [0, 1],
        [450, 1],
        [600, 2],
        [700, 2],
        [1000, 3],
        [1200, 4],
        [1400, 4],
        [1600, 4]
        ],
        navigation : true
      });
    });
</script>
       
<script>
$(document).ready(function() {
  var owl = $("#owl-demo3");
  owl.owlCarousel({
    itemsCustom : [
    [0, 1],
    [450, 1],
    [600, 2],
    [700, 2],
    [1000, 3],
    [1200, 4],
    [1400, 4],
    [1600, 4]
    ],
    navigation : true
  });

  if ($('#nivo-lightbox-demo a').length)
    $('#nivo-lightbox-demo a').nivoLightbox({ effect: 'fade' });   
  
  //fechar galeria de fotos ao apertar a tecla esc/escape
  $(document).keyup(function(e) {
    if (e.keyCode == 27) {
      fechaGaleria();
    }
    if(e.keyCode == 37){ //left arrow
      $(sync1).trigger('owl.prev');$(sync2).trigger('owl.prev');
    }
    if(e.keyCode == 39){ //right arrow
      $(sync1).trigger('owl.next');$(sync2).trigger('owl.next');
    }
  });

});
</script>
    

<script>
  $(window).scroll(function() {    
      var scroll = $(window).scrollTop();

      if (scroll >= 100) {
          $(".header_bottm").addClass("fixed");
      } else {
          $(".header_bottm").removeClass("fixed");
      }
  });
</script>


<script>
    function fechaGaleria(){
      $('#light, #light2, #fade').css('display','none');      
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    var format = function(num){
        
        var str = num.toString().replace("R$ ", ""), parts = false, output = [], i = 1, formatted = null;
        
        if(str.indexOf(",") > 0) {
            parts = str.split(",");
            str = parts[0];
        }
        
        str = str.split("").reverse();
        for(var j = 0, len = str.length; j < len; j++) {
            if(str[j] != ".") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(".");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return(formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
    }
</script>