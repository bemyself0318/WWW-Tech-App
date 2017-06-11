$(document).ready(function(){
  var images = ["login-bg1.jpg","login-bg2.jpg","login-bg3.jpg"];
  var num = 1;
  setInterval(function () {
    $("#body").css('background-image','url(http://'+thisurl+'/assets/css/image/' + images[num%3] +')');
    num++;
  },5000);
});
