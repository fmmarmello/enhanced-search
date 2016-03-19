<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    
    $(document).ready(function(){

        var geocoder = new google.maps.Geocoder();

        var address;        
        {% if item.produtotag =='lancamentos' %}
            {% if item.mapalatitude != ""  and item.mapalongitude != "" %}
                address = "{{item.mapalatitude}}, {{item.mapalongitude}}";
                console.log(1);
            {% else %}
            console.log('nao tem latlong');
                address = "{{item.empreendimentonome|convert_encoding('UTF-8','iso-8859-1')}} ,  {{item.estadonome|convert_encoding('UTF-8','iso-8859-1')}}, {{item.cidade|convert_encoding('UTF-8','iso-8859-1')}}, {{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}}, {{item.endereco|convert_encoding('UTF-8','iso-8859-1')}}, Brasil";
            {% endif %}
            console.log('lancamentos');
        {% else %}
        console.log('imovel');
            address = "Brasil, {{item.cep}}, {{item.estadonome|convert_encoding('UTF-8','iso-8859-1')}}, {{item.cidade|convert_encoding('UTF-8','iso-8859-1')}}, {{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}}, {{item.endereco|convert_encoding('UTF-8','iso-8859-1')}}";        
        {% endif %}
        console.log(address);

        function initialize() {
            var latitude = "";
            var longitude = ""; 

            geocoder.geocode( { 'address': address}, function(results, status) {
                console.log(results);
                console.log(status);
                latitude =  latitude + results[0].geometry.location.lat();
                longitude = longitude + results[0].geometry.location.lng();

                var latlng = new google.maps.LatLng(latitude, longitude);
                var myOptions = {
                  zoom: 14,
                  center: latlng,
                  scrollwheel: false,
                  styles : [{
                    /*"stylers": [
                      { "hue": "#0091ff" },
                      { "lightness": 20 },
                      { "saturation": -20 }
                    ]*/
                  }],
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                };
             
        
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                
                var image = 'assets/img/custom/icon_placemark.png';
                var imageHover = 'assets/img/custom/icon_placemark_hover.png';
                var myLatLng = new google.maps.LatLng(latitude, longitude);
                
                var circle = new google.maps.Circle({
                  strokeColor: '#EC2027',
                  //strokeOpacity: 0.8,
                  strokeWeight: 2,
                  fillColor: '#EC2027',
                  fillOpacity: 0.35,
                  map: map,
                  center: myLatLng,
                  radius: 200 //Math.sqrt(citymap[city].population) * 100
                });



                // var marker = new google.maps.Marker({
                //   position: myLatLng,
                //   map: map,
                //   //icon: image
                // });
            
                // var contentString = ''+
                // '<div id="content">'+
                //     {% if item.condominionome %}
                //     '<h1 class="titulo">{{item.condominionome|convert_encoding("UTF-8","iso-8859-1")}}</h1>'+
                //     {% endif %}
                //     '<div>'+
                //         '<p>{{item.bairronome|convert_encoding("UTF-8","iso-8859-1")}}, {{item.endereco|convert_encoding("UTF-8","iso-8859-1")}}</p>'+
                //     '</div>'+
                // '</div>';

                // var infowindow = new google.maps.InfoWindow({
                //     content: contentString
                // });
                
                // google.maps.event.addListener(marker, 'click', function() {
                //     infowindow.open(map,marker);
                // });
                
                // google.maps.event.addListener(marker, 'mouseout', function() {
                //     infowindow.close(map,marker);
                // });
            
                // // Hover
                // google.maps.event.addListener(marker, 'click', function() {
                //     this.setIcon(imageHover);
                // });

                // google.maps.event.addListener(marker, 'mouseout', function() {
                //     this.setIcon(image);
                // });
            });
        }

        // do the magic
        initialize();
    });
</script>
<style type="text/css">
    #map_canvas{
        width: 100%;
        height: 550px;
        float:left;
    }
    #map_canvas .titulo{
        font-family: Helvetica, Arial, Sans-serif;
        font-size: 12px;
        margin: 0;
        color: #07406a;
    }
    #map_canvas p{
        font-family: Helvetica, Arial, Sans-serif;
        font-size: 12px;
        margin: 0;
    }
</style>

<!-- BEGIN GMAPS -->    
    <div class="row">
        <div class="container">          
            <div class="dit_txt">
              <h3>Localização</h3>
            
        {% if item.produtotag is defined %}
            {% if item.produtotag == "lancamentos" %}
            <p>{{item.endereco|convert_encoding('UTF-8','iso-8859-1')}} - {{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}} - {{item.cidade|convert_encoding('UTF-8','iso-8859-1')}}, {{item.estadonome|convert_encoding('UTF-8','iso-8859-1')}}</p>
            {% else %}
            <p>{{item.estadonome|convert_encoding('UTF-8','iso-8859-1')}} - {{item.cidade|convert_encoding('UTF-8','iso-8859-1')}} - {{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}}</p>
            {% endif %}
        {% else %}
            <p>{{item.endereco|convert_encoding('UTF-8','iso-8859-1')}} - {{item.bairronome|convert_encoding('UTF-8','iso-8859-1')}} - {{item.cidade|convert_encoding('UTF-8','iso-8859-1')}}</p>
        {% endif %}
            </div>
        </div>
    </div>
<section class="map" id="map">
    <div class="col-lg-6 col-md-6 col-sm-12" style="margin:0;padding:0;">
        <div id="map_canvas"></div>
    </div>
    {% include 'helpers/bloco-interessado.twig.php' %}    
</section>

<!-- END GMAPS -->