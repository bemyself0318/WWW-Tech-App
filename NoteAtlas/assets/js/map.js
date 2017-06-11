$(document).ready(function() {
  initialMap();
});

var userPosition = {lat: 23.5633761, lng: 120.4706944};

function initialMap() {
  //findUser();
  var map = new google.maps.Map(document.getElementById("my_map"), {
    zoom: 15,
    center: userPosition
  });

  var windowContent = getWindowContent();

  var infowindow = new google.maps.InfoWindow({
    content: windowContent,
    maxWidth: 600,
  });
  var marker = new google.maps.Marker({
    position: userPosition,
    map: map
  });


  marker.addListener('click', function() {
    infowindow.open(map, marker);
    $(".gm-style-iw").attr("style","top: 0px;position: absolute;left: 0px;");
    $(".gm-style-iw div:first-child").attr({style: "overflow-y: auto;"});
    $(".gm-style-iw div:first-child div").attr("style","overflow-y: hidden;overflow-x: hidden;");
    $(".gm-style-iw div:first-child").mCustomScrollbar({
      theme: "minimal-dark",
    });
  });

}

function placeMarkAndPanTo(position, map) {
  var marker = new google.maps.Marker({
    position: position,
    map: map
  });
  map.panTo(position);
}

function getWindowContent() {
  var content ='<!DOCTYPE html>'+
  '<head>'+
  '<meta http-equiv="content-type" content="text/html; charset=utf-8"/>'+
  '<title>NoteAtlas</title>'+
  '<link rel="stylesheet" type="text/css" href="http://'+thisurl+'/assets/css/windowContent.css?9">'+
  '</head>'+
  '<body>'+
  '<div class="allData">'+
    '<div class="header">'+
      '<p class="title">四杯兔子</p>'+
    '</div>'+
	  '<div class="image">'+
      '<img src="http://'+thisurl+'/assets/css/image/rabbit.jpg">'+
    '</div>'+
    '<div class="comment">'+
      '<div class="detail">There are four cute rabbits!!</br>So cute!!</div>'+
      '<div class="font-awesome" >'+
        '<i class="fa fa-commenting" aria-hidden="true" onclick="inputComment()"></i>'+
      '</div>'+
    '</div>'+
    '<div class="otherComments" id="otherComments">'+
    '</div>'+
  '</div>'+
  '</body>'+
  '</html>';
  return content;
}



//If want to get user position, the server must be https
function findUser() {
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longtitude
      };

      setPosition(pos);
    },function(error){
      alert(error.message);
    });
   } else{
     setPosition({lat: 23.5633761, lng: 120.4706944});
   }
}

function setPosition(pos) {
  userPosition = pos;
}
