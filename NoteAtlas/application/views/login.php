<!DOCTYPE html>
<script>
 var thisurl = "<?=$THISURL?>";
</script>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>NoteAtlas</title>
<link rel="stylesheet" type="text/css" href="http://<?=$THISURL?>css/login.css?3">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://<?=$THISURL?>js/login.js?59" type="text/javascript"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="347915221284-2v51dqrh8hd1spe8cvc9vvkva2iou509.apps.googleusercontent.com">
</head>
<body id="body" class="activity-bg">
	<div class="g-signin2" data-onsuccess="onSignIn"></div>
  <div class="flexBox">
    <div class="loginPosition">
      <div class="welcome">Welcome NoteAtlas</div>
      <div class="buttonPosition">
        <button type="button" id="loginButton" class="loginButton">Login</button>
      </div>  
    </div>	
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
	$.post('google_login',data,function() {
			location.reload();
	});
}
</script>
