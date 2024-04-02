<?php 
require_once 'conexao.php';
$id = $_GET['id'];
$row = mysql_fetch_array(mysql_query("SELECT * FROM fornecedores JOIN enderecos ON (fornecedores.idendereco = enderecos.idendereco) WHERE fornecedores.idfornecedor = '$id'")) or die(mysql_error());
$latitude = $row['lat'];
$longitude = $row['lon'];
$distancia = $row['distancia'];

?>

<!DOCTYPE html>
<html>
  <head>
    <!-- This stylesheet contains specific styles for displaying the map
         on this page. Replace it with your own styles as described in the
         documentation:
         https://developers.google.com/maps/documentation/javascript/tutorial -->
    <link rel="stylesheet" href="/maps/documentation/javascript/demos/demos.css">
    <meta charset="utf-8">
    <style type="text/css">
    *{
      margin: 0px;
      padding: 0px;
    }
      #map
      {
        width: 100%;
        height: 800px;

      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var porigem = {lat: <?php echo $latitude;?>, lng: <?php echo $longitude;?>};
        var pdestino = {lat: -23.2612421, lng: -51.1432839};

        var map = new google.maps.Map(document.getElementById('map'), {
          center: porigem,
          scrollwheel: true,
          zoom: 7
        });

        var directionsDisplay = new google.maps.DirectionsRenderer({
          map: map
        });

        // Set destination, origin and travel mode.
        var request = {
          destination: pdestino,
          origin: porigem,
          travelMode: 'DRIVING'
        };

        // Pass the directions request to the directions service.
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function(response, status) {
          if (status == 'OK') {
            // Display the route on the map.
            directionsDisplay.setDirections(response);
          }
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMdHGZ5XyEuW7d6xXt7Vg1GrcqJAP7JXY&callback=initMap"
        async defer></script>
    <script type="text/javascript">
    window.setInterval(mudaT, 1000);
    function mudaT() {
      var tamanho = document.getElementById('map').offsetWidth;
      document.getElementById('map').style.height = (tamanho/16)*9+'px';
    }   
    </script>
  </body>
</html>