<div id="footer_map">
    
</div>

<style>
    #footer_map{
        width: 100%; 
        height: 180px;
    }
</style>
<script>
    $(document).ready(function($) {
        // Asynchronously Load the map API 
        var script = document.createElement('script');
        script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
        document.body.appendChild(script);

    });

        function initialize() {
            var geocoder = new google.maps.Geocoder();
            var bounds = new google.maps.LatLngBounds();
            var count = 0; 
            var image = 'assets/img/icon_placemark_sm.png';
            var imageHover = 'assets/img/icon_placemark_sm.png';
            var mapOptions = {
                mapTypeId: 'roadmap',
            };
                            
            // Display a map on the page
            var  map = new google.maps.Map(document.getElementById("footer_map"), mapOptions);
            //map.setTilt(45);
                
            // Multiple Markers
           
            var markers = [
                {% for end in Enderecos %}
                    '{{end.endereco|convert_encoding("UTF-8", "iso-8859-1")}}',
                {% endfor %}
            ];

            
                
            // Display multiple markers on a map
            //var infoWindow = new google.maps.InfoWindow(), marker, i;
            
            // Loop through our array of markers & place each one on the map  
            for( i = 0; i < markers.length; i++ ) {
                geocoder.geocode( { 'address': markers[i] }, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    
                    bounds.extend(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: results[0].formatted_address, 
                        icon:image
                    });

                    var content = "<h5>"+results[0].formatted_address+'</h5>'; 

                    var infowindow = new google.maps.InfoWindow()

                    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                        return function() {
                           infowindow.setContent(content);
                           infowindow.open(map,marker);
                        };
                    })(marker,content,infowindow)); 

                    //seta a primeira filial como centro do mapa
                    if (count == 0) {
                        map.setCenter(results[0].geometry.location);
                        map.setZoom(10);        
                    }
                    count++; 

                  } 
                });

                //var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                // bounds.extend(position);
                // marker = new google.maps.Marker({
                //     position: position,
                //     map: map,
                //     title: markers[i][0]
                // });
                
                // Allow each marker to have an info window    
                // google.maps.event.addListener(marker, 'click', (function(marker, i) {
                //     return function() {
                //         //infoWindow.setContent(infoWindowContent[i][0]);
                //         //infoWindow.open(map, marker);
                //     }
                // })(marker, i));

                // Automatically center the map fitting all markers on the screen
                map.fitBounds(bounds);
            }

            // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(5);
                google.maps.event.removeListener(boundsListener);
            });
            
        }
   
</script>

