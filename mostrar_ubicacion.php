<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    
    <div id="map"></div>
    <script>
      function initMap() {
        
		var uluru = {lat: <?php echo $latitud ?>, lng: <?php echo $longitud ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMtQv2rF0nW7vo-M2LmsXI68SxizTSBt8&callback=initMap">
    </script>
  </body>
</html>