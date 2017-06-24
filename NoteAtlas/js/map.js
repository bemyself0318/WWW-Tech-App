var allPost = [];
$(document).ready(function() {
  initialMap();
  $(document).tooltip();
  console.log(comment);
});

var userPosition = {lat: 23.5633761, lng: 120.4706944};

function initialMap() {
  //findUser();
  var map = new google.maps.Map(document.getElementById("my_map"), {
    zoom: 15,
    center: userPosition
  });
  inputPost(map);

  for(var i=0; i<outputData.length; i++){
    setPost(map, outputData[i]);
  }

}

function placeMarkAndPanTo(position, map) {
  var marker = new google.maps.Marker({
    position: position,
    map: map
  });
  map.panTo(position);
}

function getWindowContent(data) {
  var userComment = "";
  if(typeof(comment[data["idx"]]) !== 'undefined') {
      comment[data["idx"]].forEach(function(element,index,array) {
        userComment = userComment +'<div class="otherDetail" id="otherDetail"><img class="userImg" src="'+array[index]["photo_url"]+'"><div class="worlds" id="words">'+array[index]["comment"]+'</div></div>'
      });
      userComment ='<div class="otherComments" id="otherComments_'+data["idx"]+'">'+userComment+'</div>';
      console.log(userComment);
    } else {
    userComment = '<div class="otherComments" id="otherComments_'+data["idx"]+'"></div>';
  }
  var content ='<!DOCTYPE html>'+
  '<head>'+
  '<meta http-equiv="content-type" content="text/html; charset=utf-8"/>'+
  '<title>NoteAtlas</title>'+
  '<link rel="stylesheet" type="text/css" href="http://'+thisurl+'css/windowContent.css?9">'+
  '</head>'+
  '<body>'+
  '<div class="allData">'+
    '<div class="commentHeader">'+
      '<p class="title">'+data["title"]+'</p>'+
    '</div>'+
	  '<div class="image">'+
      '<img src="'+data["photo_url"]+'">'+
    '</div>'+
    '<div class="comment">'+
      '<div class="detail">'+data["comment"]+'</div>'+
      '<div class="font-awesome" >'+
        '<i class="fa fa-commenting" aria-hidden="true" onclick="inputComment('+data["idx"]+')"></i>'+
      '</div>'+
    '</div>'+
      userComment
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

function setPost(map, data) {
  var onePost = [];
  onePost["windowContent"] = getWindowContent(data);

  onePost["infowindow"] = new google.maps.InfoWindow({
    content: onePost["windowContent"],
    maxWidth: 600,
  });
  onePost["marker"] = new google.maps.Marker({
    position: {lat: parseFloat(data["latitude"]), lng: parseFloat(data["longtitude"])},
    map: map
  });

  setMarkerClick(onePost,map);
  allPost[data["idx"]] = onePost;
}

function setMarkerClick(onePost,map,data) {
  onePost["marker"].addListener('click', function() {
    onePost["infowindow"].open(map, onePost["marker"]);
    $(".gm-style-iw").attr("style","top: 0px;position: absolute;left: 0px;");
    $(".gm-style-iw div:first-child").attr({style: "overflow-y: auto;"});
    $(".gm-style-iw div:first-child div").attr("style","overflow-y: hidden;overflow-x: hidden;");
    $(".gm-style-iw div:first-child").mCustomScrollbar({
      theme: "minimal-dark",
    });
  });

}
$("#tourist").click(function() {
  allPost.forEach(function(value,index,array) {
    array[index]["marker"].setMap(null);
  });
});
