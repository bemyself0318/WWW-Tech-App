$(document).ready(function() {
    $("#setPlace").mCustomScrollbar({
      theme: "minimal-dark",
    });
});
function inputComment(pidx) {
  var dialog = $("#dialog").dialog({
    height: 500,
    width: 400,
    modal: true,
    buttons: {
      "確定": function() {
        dialog.dialog("close");
        var comment = $("#commentInput").val();
        $.post("ajaxComment",{pidx: pidx, comment: comment}, function(rtn) {
          console.log(rtn);
          setComment(comment, pidx, rtn[0]["photo_url"]);
        });
      }
    },
    draggable: false
  });
}

function setComment(comment, pidx, url) {
  $("#otherComments_"+pidx).append(
  '<div class="otherDetail" id="otherDetail"><img class="userImg" src="'+url+'"><div class="worlds" id="words">'+comment+'</div></div>'
  );
}

function inputPost(map) {
  var pidx;
  map.addListener('click', function(e) {
    var ret = $("#fileuploader").uploadFile({
      url: "ajaxUpload",
        fileName: "myfile",
        acceptFiles: "image/*",
        statusBarWidth: 320,
        dragdropWidth: 320,
        showPreview: true,
        maxFileCount: 1,
        allowdTypes:"jpg,png,gif",
        previewHeight: "300px",
        previewWidth: "300px",
        showDelete: true,
        deleteCallback: function(data,pd)
        {
          $.post("ajaxImgDelete",{op: "delete",name: data["fileName"]});
        },
        returnType: "json",
        onSuccess: function(files,data,xhr,pd) {
          pidx = data["pidx"];
        }
      });
    var setPlacedialog = $("#setPlace").dialog({
      height: 500,
        width: 400,
        modal: true,
        buttons: {
          "確定": function() {
            setPlacedialog.dialog("close");
            comment = $("#postComment").val();
            title = $("#postTitle").val();
            $.post("ajaxInputPost",{lat: e.latLng.lat(), lng: e.latLng.lng(), comment: comment,idx: pidx, title: title},function(rtn) {
              if(rtn) {
                setPost(map,rtn["inputData"][0]);
              }
            });
          }
        },
        draggable: false
    });
  });

}
