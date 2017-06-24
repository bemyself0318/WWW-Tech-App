$("#inputBar").keypress(function(e){
  console.log("456");
  var key = window.event ? e.keyCode : e.which;
  if(key == 13){
    var comment = this.val();
    console.log(comment);
  }
});
$("#inputSubmit").click(function(){
  console.log("123");
});
