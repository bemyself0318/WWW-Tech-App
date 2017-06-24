$(document).ready(function(){
  var images = ["login-bg1.jpg","login-bg2.jpg","login-bg3.jpg"];
  var num = 1;
  setInterval(function () {
    $("#body").css('background-image','url(http://'+thisurl+'/assets/css/image/' + images[num%3] +')');
    num++;
  },5000);
});


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
	$.post('google_login',data.function(){
		location.href="http://"+BASE_URL+"/map/mapoverview";
	});
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
  });
}

$("#loginButton").click(function() {
  console.log("123");
  $(".abcRioButtonContentWrapper").click();
})


