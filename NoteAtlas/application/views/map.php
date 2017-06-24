 <!DOCTYPE html>
<script>
   var thisurl = "<?=$THISURL?>";
   var comment = [];
   var outputData = [];
   var i = 0;
    <?php foreach($outputData as $post): ?>
      outputData[i] = [];
      <?php foreach($post as $key => $value): ?>
        outputData[i]["<?=$key?>"] = "<?=$value?>";
      <?php endforeach; ?>
      i++;
    <?php endforeach; ?>
    
      <?php foreach($comment as $key1 => $postComment):?>
      <?php if($postComment):?>
        i = 0;  
        comment["<?=$key1?>"] = [];
      <?php foreach($postComment as $oneComment):?>
        comment["<?=$key1?>"][i] = [];
      <?php foreach($oneComment as $key2 => $title):?>
        comment["<?=$key1?>"][i]["<?=$key2?>"] = "<?=$title?>";
      <?php endforeach;?>
        i++;
      <?php endforeach;?>
      <?php endif;?>
      <?php endforeach;?>
  </script>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <title>NoteAtlas</title>
  <link rel="stylesheet" type="text/css" href="http://<?=$THISURL?>css/map.css?6">
  <link rel="stylesheet" type="text/css" href="http://<?=$THISURL?>css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="http://<?=$THISURL?>js/scrollbar/jquery.mCustomScrollbar.css?2">
  <link href="http://<?=$THISURL?>js/jquery-ui/jquery-ui.css" rel="stylesheet">
  <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkK7yfHy6-WQkww1x_AUp_vRovSGeT82k" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="http://<?=$THISURL?>js/jquery-ui/external/jquery/jquery.js"></script>
  <script src="http://<?=$THISURL?>js/jquery-ui/jquery-ui.js"></script>
  <script src="http://<?=$THISURL?>js/map.js?59" type="text/javascript"></script>
  <script src="http://<?=$THISURL?>js/input.js?59" type="text/javascript"></script>
  <script src="http://<?=$THISURL?>js/scrollbar/jquery.mCustomScrollbar.concat.min.js?1" type="text/javascript"></script>

<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
<meta name="google-signin-client_id" content="347915221284-2v51dqrh8hd1spe8cvc9vvkva2iou509">
</head>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>
<body>
  <header class="header">
    <img class="nullset" src="http://<?=$THISURL?>css/image/nullset.png">
    <div><i class="fa fa-rocket" aria-hidden="true" title="Traveler"></i></div>
    <div><i class="fa fa-arrows" id="tourist"aria-hidden="true" title="Tourist"></i></div>
    <div><i class="fa fa-sign-out" aria-hidden="true" title="Sign Out" onclick="signOut();"></i></div>
  </header>
	<div id="my_map" class="map"></div>
  <div id="dialog" class="dialog" style="display:none">
   <textarea id="commentInput" class="commentInput" placeholder="寫下的你想法吧"></textarea>
  </div>
  <div id="setPlace" class="setPlace  mCustomScrollbar">
    <input id="postTitle" class="postTitle" type="text" placeholder="給個標題吧">
    <div id="fileuploader">Uploader</div>
    <div class="postCommentPosition">
      <textarea id="postComment" class="postComment" placeholder="寫下的你想法吧"></textarea>
    </div>
  </div>
</body>
</html>
<script>

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
			$.get("../login/google_logout", function(){
				location.href="http://"+ "<?=$THISURL?>" +"/index.php/login/noteatlas";
			});
  });
}

function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
</script>
