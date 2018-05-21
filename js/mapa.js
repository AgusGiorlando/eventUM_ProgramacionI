var map;
var geocoder;
var infoWindow;
var marker;
window.onload = function () {
	var latLng = new google.maps.LatLng(-32.8914378,-68.8643043);
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
					document.getElementById('geocoding').innerHTML = 'No se encontraron resultados';
				}
			} else {
				document.getElementById('geocoding').innerHTML = 'Geocodificación  ha fallado debido a: ' + status;
			}
		});
	});
}