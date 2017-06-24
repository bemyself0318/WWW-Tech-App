function inputComment() {
  var dialog = $("#dialog").dialog({
    height: 500,
    width: 400,
    modal: true,
    buttons: {
      "確定": function() {
        dialog.dialog("close");
        getComment();
      }
    },
    draggable: false
  });

}

function getComment() {
  var comment = $("#commentInput").val();
  $("#otherComments").append(
  '<div class="otherDetail" id="otherDetail"><img class="userImg" src="http://'+thisurl+'/assets/css/image/rabbit.jpg"><div class="worlds" id="words">'+comment+'</div></div>'
);
}
