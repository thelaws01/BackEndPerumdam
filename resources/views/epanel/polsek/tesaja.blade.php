<!DOCTYPE html>
<html>
<head>
  <title>Leaflet mobile example</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />

  <script data-require="leaflet@0.7.3" data-semver="0.7.3" src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>

  <style>
    body {
      padding: 0;
      margin: 0;
    }
    html, body, #map {
      height: 100%;
    }
  </style>
</head>
<body>
  <div id="map"></div>

  <script>
    var map = L.map('map');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    }).addTo(map);

    // placeholders for the L.marker and L.circle representing user's current position and accuracy    
    var current_position, current_accuracy;

    function onLocationFound(e) {
      // if position defined, then remove the existing position marker and accuracy circle from the map
      if (current_position) {
          map.removeLayer(current_position);
          map.removeLayer(current_accuracy);
      }

      var radius = e.accuracy / 2;

      current_position = L.marker(e.latlng).addTo(map);

      current_accuracy = L.circle(e.latlng, radius).addTo(map);
    }

    function onLocationError(e) {
      alert(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    // wrap map.locate in a function    
    function locate() {
      map.locate({setView: true, maxZoom: 16});
    }

    // call locate every 3 seconds... forever
    setInterval(locate, 3000);

  </script>
</body>
</html> 