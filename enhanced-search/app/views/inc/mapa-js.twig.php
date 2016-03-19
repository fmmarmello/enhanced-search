{#<script>/* 

  arquivo twig necessario para receber as 
  variaveis do Controller e construir o 
  mapa de imoveis

*/</script>#}

<style type="text/css">
  #map_canvas{
    height: 640px;
  }
</style>

<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="assets/jvs/markerclusterer.js"></script>
<script src="assets/jvs/oms.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //cabeçalho reduzido para mapa 
    $(".main_header, .mobile_header").addClass("fixed");
    initialize();
  });

  // simples funcao para verificar se a variavel eh vazia
  function vazio(variavel){
    if(variavel==undefined){
      return true;
    }
    if(variavel==null){
      return true;
    }
    if(variavel==0){
      return true;
    }
    if(variavel==""){
      return true;
    }
    return false;
  }


  // gera o json que sera usado para criar os marcadores no mapa
  function placeMarkersOnMap( markers ){
    var marksArray = [];
    var markObj;

    markers = JSON.parse(markers);
    $.each(markers, function(i, item) {
      // verifica se a latitude ou a longitude estao zeradas
      if( (vazio(item.mapalongitude)) || (vazio(item.mapalatitude)) ){
        // do nothing
      }else{      
        markObj = {
          titulo:     item.codigo, 
          markId:     i, 
          id:         item.id, 
          valor:      item.valorvenda, 
          imgurl:     item.imgurl, 
          latitude:   item.mapalatitude, 
          longitude:  item.mapalongitude
        };
        marksArray.push(markObj);
      }      
    });
    
    return marksArray;
  }


  jQuery(function($) {
      // Asynchronously Load the map API 
      // var script = document.createElement('script');
      // script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
      // document.body.appendChild(script);
  });

  var map;
  var oms;
  var coordInfoWindow;
  var markers = [];

  // marcador do mapa criado pela lista lateral
  var listaMark;


  function geraMark( marker ){

      var markImage = 'assets/img/icon_placemark_sm.png';
      var markImageHover = 'assets/img/icon_placemark_sm.png';

      var Mark = marker;

      // seta a posicao do marker no mapa
      var position = new google.maps.LatLng(Mark.latitude, Mark.longitude);

      // gera a janela de info do marker
      var infoContent = "<span class='lateral-direita'><span class='mapa-geral-lista'><span class='produto-item'><img class='infobox-arr' src='assets/img/infobox_arr.png'>"+
                        "<div class='product-item'>"+
                        $("#data-fichaid-"+Mark.id).html()+
                        "</div></span></span></span>";

     
      // gera os marcadores de acordo com a lista de imoveis retornada na variavel global 'markers'
      marker = new google.maps.Marker({
          //animation: google.maps.Animation.DROP,
          position: position,
          map: map,
          icon: markImage,
          fichaid: Mark.id,
          // title: Mark.titulo,
          title: null,
          labelContent: infoContent,
          labelClass: "labels" // the CSS class for the label
      });    

      console.log(map); 
      map.setZoom(15); 
      oms.addMarker(marker);  // <-- here

      return marker;
  }

  function initialize() {

      var bounds = new google.maps.LatLngBounds();

      var mapOptions = {
          mapTypeId: 'roadmap', 
         // scrollwheel: false,
      };
                      
      // Display a map on the page
      map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
      map.setTilt(45);

      // inicializa o InfoWindow
      coordInfoWindow = new google.maps.InfoWindow();

      // inicializa o spiderfy
      oms = new OverlappingMarkerSpiderfier(map, {
        keepSpiderfied: true
      });

      // Multiple Markers
      var markersList = "";
      var dataPost = {};
          dataPost['finalidade'] = "{{content[0].produtotag}}";
      
      var ws_route = "";
      if(dataPost['finalidade']=='lancamentos'){
          ws_route = "buscaEmpreendimentos";
      }else{
          ws_route = "buscaImoveis";
      }

      console.log("/ws/"+ws_route+"/json"); 

      $.post( "/ws/"+ws_route+"/json", dataPost )
        .done(function( dataResponse ) {

          console.log(dataResponse); 
          // console.log(dataResponse);

          // apos retornar o json com os imoveis, chama a funcao que popula os markers no mapa
          markers = placeMarkersOnMap(dataResponse);
                              
          var markersClust = [];
          // corre o array de marcadores de os coloca no mapa
          for( i = 0; i < markers.length; i++ ) {
              // associa o objeto do laco
              var marker = geraMark(markers[i]);

              // agrega os marcadores para depois centralizar o mapa
              bounds.extend(marker.position);

              // console.log(markers[i]);

                
              // Allow each marker to have an info window    
              oms.addListener('click', function(marker, event) {
              
                      if(listaMark==null){}else{
                        listaMark.setMap(null);      
                      }
              
                      console.log(marker);
                      //debugger
                      coordInfoWindow.setContent(marker.labelContent);
                      coordInfoWindow.setPosition(marker.position);
                      coordInfoWindow.open(map, marker);

                      var center = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                      map.panTo(center);

                      // $("div.gm-style-iw").prev().remove();
                      $("div.gm-style-iw").prev().addClass(marker.labelClass);
                      $("div.gm-style-iw").next().addClass("bt-close");
                  // }
              // })(marker, i));
              });


              markersClust.push(marker);
          }
          
          // centraliza o mapa de acordo com todos os marcadores gerados
          map.fitBounds(bounds);

          /*CLUSTER STYLES*/
            //set style options for marker clusters (these are the default styles)
            //do menor para o maior

            mcOptions = {
              averageCenter: true,
              text:null,
              labelContent:null,
              title:null,
              maxZoom: 16,
              styles: [{
                        height: 53,
                        url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m1.png",
                        width: 53
                      },
                      {
                        height: 56,
                        url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m2.png",
                        width: 56
                      },
                      {
                        height: 66,
                        url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m3.png",
                        width: 66
                      },
                      {
                        height: 78,
                        url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m4.png",
                        width: 78
                      },
                      {
                        height: 90,
                        url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m5.png",
                        width: 90
                      }]
            }
          /*FIM CLUSTER STYLES*/
          var markerCluster = new MarkerClusterer(map, markersClust, mcOptions);


          // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
          var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
              this.setZoom(12);
              google.maps.event.removeListener(boundsListener);
          });

          // subustituindo a centralizacao acima para centralizad 
          // centro do rio  -22.8826629,-43.2259015
          // em sao conrado -22.9544846,-43.2660792
          var newCenter = new google.maps.LatLng("-22.9544846", "-43.2660792");
          map.setCenter(newCenter);

          // remove o spinner e o bg do loader //tck#2599
          $("#loader-spinner-mapa").remove();
          $("#bg-loader").remove();

        });

      
  }



  $(document).ready(function(){

    // evento do clique da lista lateral de imoveis
    // centraliza o mapa com hover no imovel da lista e mostra o infobox dele
    $("#mapa-geral-lista .produto-item .produto-mapa").click(function(){
      // zera o marcador atual do mapa
      if(listaMark==null){}else{
        listaMark.setMap(null);      
      }


      // captura a global markers
      var aMarks = markers;     

      var i;
      var imvId = $(this).attr("data-produtoid");
      var latitude = $(this).attr("data-latitude");
      var longitude = $(this).attr("data-longitude");
      var center = new google.maps.LatLng(latitude, longitude);
      // var InfoWindow = new google.maps.InfoWindow();
      map.panTo(center);

      // corre a array de Marks criados para encontrar o que foi clicado
      for (i = 0; i < aMarks.length; i++) {
          var oMark = aMarks[i];
          if( (oMark.id==imvId) ){
            debugger
            listaMark = geraMark(oMark);

            // configura e exibe o infobox do produto
            coordInfoWindow.setContent(listaMark.labelContent);
            coordInfoWindow.setPosition(listaMark.position);
            coordInfoWindow.open(map, listaMark);      

            // adiciona as classes para formatar os elementos
            $("div.gm-style-iw").prev().addClass(listaMark.labelClass);
            $("div.gm-style-iw").next().addClass("bt-close");
          }
      }
    });

  // adiciona a classe ativa para o botao do mapa
  $(".mapa-geral ul.mapa-geral-menu li.menu-item.{{content[0].produtotag}}").addClass("active");
  // posiciona o select na finalidade ativa
  $("#selFinalidade").val("{{content[0].produtotag}}");

  });  
</script>
