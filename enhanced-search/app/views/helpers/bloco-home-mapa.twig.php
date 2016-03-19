
<script>
    jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var geocoder = new google.maps.Geocoder(); 
    var mapOptions = {
        mapTypeId: 'roadmap', 
        scrollwheel: false,
        mapTypeControl: true,
        scaleControl: true, 
        zoomControl: true,
        styles : [
            {
                "featureType": "landscape.man_made",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#f7f1df"
                    }
                ]
            },
            {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#d0e3b4"
                    }
                ]
            },
            {
                "featureType": "landscape.natural.terrain",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#fbd3da"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#bde6ab"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffe15f"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#efd151"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "black"
                    }
                ]
            },
            {
                "featureType": "transit.station.airport",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#cfb2db"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#a2daf2"
                    }
                ]
            }
        ],
    
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    // cria os endereços 
    var markers = [
        {% for imovel in content if imovel.mapalatitude != "" and imovel.mapalongitude != "" %}    
            
            {lat:{{imovel.mapalatitude}}, lng:{{imovel.mapalongitude}}},
            
        {% endfor %}    
    ];

    console.log(markers); 
           
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {


        var mkr = markers[i]; 
        //geocoder - recebe o endereço e retorna a latitude e longitude
        geocoder.geocode({'location': mkr}, function (results,status) { 
            
            //se o endereço for válido
            if (status == google.maps.GeocoderStatus.OK) {
                //var p = results[0].geometry.location;
                var lat = mkr.lat;
                var lng = mkr.lng;
                
                var position = new google.maps.LatLng(lat, lng);
            
                bounds.extend(position);
                
                var image = "/web/assets/img/icon_placemark_sm.png";
                //var imageHover = '/web/assets/img/icon_placemark_hover.png';
                
                //cria um placemark no endereço setado
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i], 
                    icon: image
                });

                // conteúdo para aparecer ao clicar no marker
                var infoWindowContent = '<div class="info_content"><h3>Localização</h3><p>'+results[0].formatted_address+'</p></div>';

                // Allow each marker to have an info window    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent(infoWindowContent);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));

              
                // Hover
                // google.maps.event.addListener(marker, 'click', function() {
                //     this.setIcon(imageHover);
                // });

                google.maps.event.addListener(marker, 'mouseout', function() {
                    this.setIcon(image);
                });

                // Automatically center the map fitting all markers on the screen
                map.fitBounds(bounds);
            }
        });
    }
    
    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(15);
        google.maps.event.removeListener(boundsListener);
    });
    
}
</script>
<style>
    
    #map_wrapper {
        height: 400px;
        margin-top: 30px; 
        margin-bottom: 30px;
    }

    #map_canvas {
        width: 100%;
        height: 100%;
    }
</style>

<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>