<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Google Maps  Weater Layer</title>
		<style type="text/css">
			html { height: 100% }
			body { height: 100%; margin: 0px; padding: 0px }
			#map_canvas { height: 100% }
		</style>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMtQv2rF0nW7vo-M2LmsXI68SxizTSBt8&callback=initMap"></script>
        <script type="text/javascript">
			<!-- //
			var map;
			var geocoder;
			var infoWindow;
			var marker;
			window.onload = function () {
				var latLng = new google.maps.LatLng(<?php echo $latitud; ?>, <?php echo $longitud; ?>);
				var opciones = {
					center: latLng,
					zoom: 15,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var map = new google.maps.Map(document.getElementById('map_canvas'), opciones);
				geocoder = new google.maps.Geocoder();
				infowindow = new google.maps.InfoWindow();
            
				google.maps.event.addListener(map, 'click', function(event) {
					geocoder.geocode({'latLng': event.latLng}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							if (results[0]) {
								document.getElementById('direccion').value = results[0].formatted_address;
								document.getElementById('coordenadas').value = results[0].geometry.location;
								if (marker) {
									marker.setPosition(event.latLng);
								} else {
									marker = new google.maps.Marker({
									position: event.latLng,
									map: map});
								}
								infowindow.setContent(results[0].formatted_address+'<br/> Coordenadas: '+results[0].geometry.location);
								infowindow.open(map, marker);
							} else {
								document.getElementById('geocoding').innerHTML =
								'No se encontraron resultados';
							}
						} else {
							document.getElementById('geocoding').innerHTML =
							'Geocodificación  ha fallado debido a: ' + status;
						}
					});
				});
      
			}
			// -->
		</script>
    </head>
    <body>
		<div style="height: 500px" align="middle" > 
			<input type="text" id="direccion" name="direccion" size="40" value="<?php echo $evento[0]['direccion']; ?>"/>
			<input type="text" id="coordenadas" name="coordenadas" size="40" value="<?php echo $coordenadas; ?>"/>
			<br/>
			<span id="geocoding"></span>
			<br/>
			<div id="map_canvas" style="width:70%; height:80%"></div>
		</div>
    </body>
</html>​