  <!DOCTYPE html>
  <script>
   var thisurl = "<?=$THISURL?>";
  </script>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <title>NoteAtlas</title>
  <link rel="stylesheet" type="text/css" href="http://<?=$THISURL?>/assets/css/map.css?2">
  <link rel="stylesheet" type="text/css" href="http://<?=$THISURL?>/assets/css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="http://<?=$THISURL?>/assets/js/scrollbar/jquery.mCustomScrollbar.css?2">
  <link href="http://<?=$THISURL?>/assets/js/jquery-ui/jquery-ui.css" rel="stylesheet">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkK7yfHy6-WQkww1x_AUp_vRovSGeT82k" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="http://<?=$THISURL?>/assets/js/jquery-ui/external/jquery/jquery.js"></script>
  <script src="http://<?=$THISURL?>/assets/js/jquery-ui/jquery-ui.js"></script>
  <script src="http://<?=$THISURL?>/assets/js/map.js?59" type="text/javascript"></script>
  <script src="http://<?=$THISURL?>/assets/js/input.js?59" type="text/javascript"></script>
  <script src="http://<?=$THISURL?>/assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js?1" type="text/javascript"></script>
<!--below for google login -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="347915221284-2v51dqrh8hd1spe8cvc9vvkva2iou509.apps.googleusercontent.com">
</head>
<body>
	 <a href="#" onclick="signOut();">Sign out</a>
	<div id="my_map" class="map"></div>
  <div id="dialog" class="dialog" style="display:none">
   <textarea id="commentInput" class="commentInput" placeholder="寫下的你想法吧"></textarea>
  </div>
</body>
</html>
<script>

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  //console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  //console.log('Name: ' + profile.getName());
  //console.log('Image URL: ' + profile.getImageUrl());
  //console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
	var data = {
							'name':	profile.getName(),
							'photo_url' : profile.getImageUrl(),
							'google_idx' : profile.getId(),
							'gmail' : profile.getEmail()
			};
	console.log(data);
	$.post('google_login',data);
}
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
  });
}
</script>
