<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    #map {
      height: 70%;
    }
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      text-align:center
    }	
  </style>
</head>
<body>
<?php require_once '../init.php';   include 'header.php';  ?>
<h3 style="margin-top:70px;">Add or Update My Location</h3>
<div id="map"></div>
 <a class="btn btn-success" style="margin:50px"  onclick="savedb()">save</a>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlslFcjl7vMnMmQXYIkLygMURUsVJG20E&callback=initMap">
  </script>
  <script>
  var map;
  // define global array to store markers added
  let markersArray; 
  
  function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 35.566864, lng: 45.416107},
        zoom: 8
      });

      map.addListener('click', function(e) {
    console.log(e.latLng);
    addMarker(e.latLng);
  });
    }
  
  // define function to add marker at given lat & lng
  function addMarker(latLng) {
    let marker = new google.maps.Marker({
        map: map,
        position: latLng,
        draggable: true
    });
    //store the marker object drawn on map in global array
    markersArray=marker;
  
    // console.log(marker.getPosition().lng());
  }
  function jsonParse() {
        try {
            var json = JSON.parse(text);
        } 
        catch(e) {
            return false;
        }
        return json;
    }
  function savedb(){
    
   if(markersArray!=undefined){
    
    var data = "lat=" + markersArray.getPosition().lat() + '&lng=' + markersArray.getPosition().lng();
    var xmlhttp = new XMLHttpRequest();
     
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               alert(this.responseText);
               window.location.href = 'mapPharmacy.php'
           }
       };
       xmlhttp.open("GET", "addmylocation.php?"+data, true);
       xmlhttp.send();
   }
      
  }
 

</script>

</body>
</html>