{% set item = content %}

{% set topicos = item.Topicos|default('') %}
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">    
    $(document).ready(function(){

        var geocoder = new google.maps.Geocoder();

        var address;    
        {% if item.produtotag=='lancamentos' %}
            {% if item.MapaLatitude|default("") and item.MapaLongitude|default("") %}
                address = "{{item.MapaLatitude}}, {{item.MapaLongitude}}";
            {% else %}
                address = "Brasil, {{item.CidadeNome}}, {{item.BairroNome}} - {{item.Localizacao}}";
            {% endif %}
        {% else %}
            address = "Brasil, {{item.EstadoNome}}, {{item.CidadeNome}}, {{item.BairroNome}} - {{item.Logradouro}}";
        {% endif %}

        function initialize() {
            var latitude = "";
            var longitude = ""; 

            geocoder.geocode( { 'address': address}, function(results, status) {
                latitude =  latitude + results[0].geometry.location.lat();
                longitude = longitude + results[0].geometry.location.lng();

                var latlng = new google.maps.LatLng(latitude, longitude);
                var myOptions = {
                  zoom: 14,
                  center: latlng,
                  scrollwheel: false,
                  draggable: false,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                };
             
        
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                
                var image = 'assets/img/icon_placemark_sm.png';
                var imageHover = 'assets/img/icon_placemark_sm.png';
                var myLatLng = new google.maps.LatLng(latitude, longitude);
                var marker = new google.maps.Marker({
                  position: myLatLng,
                  map: map,
                   icon: image
                });
            
                var contentString = ''+
                '<div id="content">'+
                    {% if item.condominionome is defined %}
                    '<h1 class="titulo">{{item.condominionome|convert_encoding("UTF-8","iso-8859-1")}}</h1>'+
                    {% endif %}
                    '<div>'+
                        '<p>{{item.BairroNome|convert_encoding("UTF-8","iso-8859-1")}} {# , item.endereco|convert_encoding("UTF-8","iso-8859-1")#}</p>'+
                    '</div>'+
                '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });
                
                google.maps.event.addListener(marker, 'mouseout', function() {
                    infowindow.close(map,marker);
                });
            
                // Hover
                google.maps.event.addListener(marker, 'click', function() {
                    this.setIcon(imageHover);
                });

                google.maps.event.addListener(marker, 'mouseout', function() {
                    this.setIcon(image);
                });
            });
        }

        // do the magic
        initialize();
    });
</script>
<style type="text/css">
    #map_canvas{
        width: 100%;
        height: 400px;
        margin-top: 50px;
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
<div class="gmaps">
    <div id="map_canvas"></div>
    {% for key, val in topicos if val.Nome == 'Localização' %}
        <!--<div class="col-sm-3"><h4>{{val.Nome}}</h4></div>-->
        <div class="col-sm-12 end-map"><p>{{val.Descricao|raw}}</p></div>
    {% endfor %}
</div>

<!-- END GMAPS -->