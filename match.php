<?php require_once "controllerUserData.php"; ?>

<?php 
 $email = $_SESSION['email'];
 $password = $_SESSION['password'];
 if($email != false && $password != false){
   if(isset($_POST['match-redirect-uid1'])) {
    $_SESSION['uid1'] = $_POST['match-redirect-uid1'];
    $_SESSION['uid2'] = $_POST['match-redirect-uid2'];
   }
   $uid_curr_user = $_SESSION['uid1'];

   $sql = "SELECT * FROM usertable WHERE email = '$email'";
   $run_Sql = mysqli_query($con, $sql);
   if($run_Sql){
       $fetch_info = mysqli_fetch_assoc($run_Sql);
       // $uid_curr_user = $fetch_info['uid'];
       $status = $fetch_info['status'];
       $code = $fetch_info['code'];
       if($status == "verified"){
           if($code != 0){
               header('Location: reset-code.php');
           }
       }else{
           header('Location: user-otp.php');
       }
   }

   //fetch notifs
   function dateFormatter($date) {
     $today = date("d M, Y");
     if($today == $date) return "Today";
     $arr = explode(",", $date);
     $year = $arr[1];
     $arr = explode(" ", $arr[0]);
     $day = intval($arr[0]);
     $month = $arr[1];
     $diff = intval(substr($today, 0, 2)) - $day;
     if($diff == 1) return "Yesterday";
     else return $date;
   }

   $notifs_content_seen = Array();
   $notifs_date_seen = Array();
   $notifs_content_unseen = Array();
   $notifs_date_unseen = Array();
   $sql = "SELECT type, content, DATE_FORMAT(created_at, '%d %b, %Y') as created_at, seen_by_user FROM notification WHERE uid='$uid_curr_user' ORDER BY nid DESC";
   $run_Sql = mysqli_query($con, $sql);
   while ($row = mysqli_fetch_assoc($run_Sql)) {
     if($row['seen_by_user'] == 'yes') {
       array_push($notifs_content_seen, $row['content']);
       array_push($notifs_date_seen, dateFormatter($row['created_at']));
     } else {
       array_push($notifs_content_unseen, $row['content']);
       array_push($notifs_date_unseen, dateFormatter($row['created_at']));      
     }
   }

   //fetch matches
   $matches = Array();
   $query = "SELECT uid1, uid2, status, DATE_FORMAT(created_at, '%d %b, %Y') as matched_at FROM `match` WHERE (uid1 = '$uid_curr_user' OR uid2 = '$uid_curr_user') AND status = 'match'";
   $res = mysqli_query($con, $query);
   while ($row = mysqli_fetch_assoc($res)) {
     $uid_curr_user == $row['uid1'] ? $uid2 = $row['uid2'] : $uid2 = $row['uid1'];
     //fetch fname, age of other partner
     $query_inner = "SELECT name, age FROM userprofile WHERE uid='$uid2'";
     $res_inner = mysqli_query($con, $query_inner);
     $fetch_inner = mysqli_fetch_assoc($res_inner);
     $name_inner = ucfirst(explode(" ", $fetch_inner['name'])[0]);
     $age = $fetch_inner['age'];
     $date = dateFormatter($row['matched_at']);
     array_push($matches, Array("name" => $name_inner, "age" => $age, "date" => $date, "id" => $uid2));
   }

   //fetch profile details of both
   $query = "SELECT * FROM userprofile WHERE uid='$uid_curr_user'";
   $res = mysqli_query($con, $query);
   $fetch = mysqli_fetch_assoc($res);
   $fname_curr_user = ucfirst(explode(" ", $fetch['name'])[0]);
   $name_curr_user = ucwords($fetch['name']);
   $age_curr_user = $fetch['age'];
   $height_curr_user = $fetch['height'];
   $weight_curr_user = $fetch['weight'];
   $latitude_curr_user = $fetch['latitude'];
   $longitude_curr_user = $fetch['longitude'];
   $profile_photo_curr_user = $fetch['profile_photo'];
   $bio_curr_user = nl2br($fetch['bio']);

   $uid2 = $_SESSION['uid2'];
   $query = "SELECT * FROM userprofile WHERE uid='$uid2'";
   $res = mysqli_query($con, $query);
   $fetch = mysqli_fetch_assoc($res);
   $fname_uid2 = ucfirst(explode(" ", $fetch['name'])[0]);
   $name_uid2 = ucwords($fetch['name']);
   $age_uid2 = $fetch['age'];
   $height_uid2 = $fetch['height'];
   $weight_uid2 = $fetch['weight'];
   $latitude_uid2 = $fetch['latitude'];
   $longitude_uid2 = $fetch['longitude'];
   $profile_photo_uid2 = $fetch['profile_photo'];
   $bio_uid2 = nl2br($fetch['bio']);

   //store current match date
   $date_curr_match = "";
   foreach($matches as $match) {
     if($match['name'] == $fname_uid2) {
      $date_curr_match = $match['date'];
      break;
     }
   }

   //fetch common hobbies
    $col_names = Array("streaming movies and shows","anime","stand up comedy","reading","writing","meditation","music","eating","dancing","singing","baking","cooking","gardening","arts and crafts","painting","sketching","fishing","running","walking","swimming","working out","yoga","bicycling","driving","riding","sports","video games","travelling","hiking","collecting","volunteer work","working","audiobooks and podcasts","youtube","social media","housework","shopping","coding","hacking","photoshop","video editing","filmmaking","science","astronomy","astrology");
    $common_hobbies = Array();

    $q1 = "SELECT * FROM hobbies WHERE uid='$uid_curr_user'";
    $r1 = mysqli_query($con, $q1);
    $row1 = mysqli_fetch_array($r1);
    $q2 = "SELECT * FROM hobbies WHERE uid='$uid2'";
    $r2 = mysqli_query($con, $q2);
    $row2 = mysqli_fetch_array($r2);
    for($i = 1; $i < count($col_names) + 1; $i++) {
        if($row1[$i] == 1 && $row2[$i] == 1)
            array_push($common_hobbies, ucwords($col_names[$i - 1]));
    }
 } else {
    header('Location: login-user.php');
 } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo $fname_curr_user; ?>💛<?php echo $fname_uid2; ?></title>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet" href="./css/style-match.css">

<style>
  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
  html,body{
      font-family: 'Poppins', sans-serif;
  }
  
  body {
      overflow: hidden;
  }

  .toast.fade {
    transition: all 1.5s ease !important;
  }
  
  a, a:hover, a:focus, a:active {
      text-decoration: none;
      color: inherit;
  }
  
  .popover-header {
      text-align: center;
      padding: 15px !important;
  }
  
  .notif-old {
      filter: opacity(.6);
  }
  
  .notif-text {
      font-size: .9rem;
  }
  
  .notif-date {
      font-size: .8rem;
  }
  /* linear-gradient(0deg, rgba(0,0,0,0.49933476808692223) 0%, rgba(255,255,255,0) 100%) */
</style>
</head>

<body>
<!-- GIF BACKGROUND -->
  <img id="gif" src="./public/assets/43295-heart-fly-transparent-bg.gif" alt="" >

<!-- TOAST -->
  <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != "") { ?>
    <div style="position: relative;">
      <div style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 2;" >
        <div class="toast" style="min-width: 250px;">
          <div class="toast-header" style="background: #f5f5f5;">
            <strong class="mr-auto" style="font-size: 18px;"><?php echo $_SESSION['msg_header']; unset($_SESSION['msg_header']); ?></strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
              <span >&times;</span>
            </button>
          </div>
          <div class="toast-body">
            <?php echo $_SESSION['msg'] . $fname_uid2 . "!"; unset($_SESSION['msg']); ?>
          </div>
        </div> 
      </div>
    </div>
  <?php } ?>  


<!-- HIDDEN INPUTS  -->
  <input type="text" class="uid-curr-user" hidden value="<?php echo $uid_curr_user; ?>">
  <input type="text" class="latitude-curr-user" hidden value="<?php echo $latitude_curr_user; ?>">
  <input type="text" class="longitude-curr-user" hidden value="<?php echo $longitude_curr_user; ?>">
  <input type="text" class="latitude-uid2" hidden value="<?php echo $latitude_uid2; ?>">
  <input type="text" class="longitude-uid2" hidden value="<?php echo $longitude_uid2; ?>">

<!-- REDIRECT TO MATCH FORM -->
<form action="match.php" method="POST" id="match-redirect-form" hidden>
  <input type="text" id="match-redirect-uid1" name="match-redirect-uid1" value="<?php echo $uid_curr_user; ?>">
  <input type="text" id="match-redirect-uid2" name="match-redirect-uid2">
</form>


<!-- LOADER -->
 <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
 <div class="loader-container">
  <div>
   <lottie-player id="lottie-player-heart" src="./public/assets/lf30_editor_drzgxbyf.json"  background="transparent"  speed="1.2"  style="width: 300px; height: 300px;" loop autoplay></lottie-player>
  </div>
 </div>


<!-- HEART B/W CARDS -->
  <lottie-player id="lottie-player-match" src="./public/assets/lf30_editor_dsef2mjx.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;" loop autoplay></lottie-player>
  <hr class="hr-left">
  <hr class="hr-right">


<!-- NAVBAR -->
 <nav class="navbar navbar-light navbar-expand" >
  <a class="navbar-brand ml-5" href="home.php">
    <img src="./public/assets/SoulMate (3).png" alt="logo" height="60">
  </a>   
  <div class="navbar-nav ml-auto mr-5 d-flex align-items-end">
  <div class="nav-item h5 mb-0 pr-3" style="font-size: 24px; cursor: pointer;" ><a href="users.php">Chat</a></div> 
   <div class="nav-item h5 mb-0" style="font-size: 24px; cursor: pointer;<?php if(count($matches) != 0) echo "background-color: #FBCBD0;"; else echo "background-color: #F5E6E8;"; ?>" tabindex="50"  data-toggle="popover-matches" data-trigger="focus" data-placement="bottom" title="Your Matches">Matches</div>
   <div class="nav-item ml-4" style="position: relative;"><img src="<?php echo $profile_photo_curr_user; ?>" alt="profile pic" class="avatar" height="60" width="60" style="border-radius: 50%; cursor: pointer; object-fit: cover;" tabindex="50" data-toggle="popover-profile-icon" data-trigger="focus" data-placement="bottom" title="Hello, <?php echo $fname_curr_user; ?>!">

    <?php if(count($notifs_content_unseen) == 0) {?>
      <span class="badge badge-light" style="position: absolute !important; right:2px; cursor: pointer;" tabindex="50" data-toggle="popover-notifs" data-trigger="focus" data-placement="bottom" title="Notifications"><span id="span-num">0</span></span>    
    <?php } else { ?>
      <span class="badge badge-danger" style="position: absolute !important; right:2px; cursor: pointer;" tabindex="50" data-toggle="popover-notifs" data-trigger="focus" data-placement="bottom" title="Notifications"><span id="span-num"><?php echo count($notifs_content_unseen) ?></span></span>   
    <?php } ?>  
  </div>
  </div>
</nav>


<!-- CARDS -->
  <div class="tinder loaded">
    <div class="tinder--cards">
      <div class="tinder--card left" style="background: linear-gradient(0deg, rgba(0,0,0,0.30885857761073177) 0%, rgba(255,255,255,0) 100%), url(<?php echo $profile_photo_curr_user; ?>); background-repeat: no-repeat; background-position: center center; background-size: cover;" onmouseover="showBio(this);" onmouseout="hideBio(this);">
        <div class="card-info">
          <h4><?php echo $fname_curr_user; ?><span class="lead">, <?php echo $age_curr_user; ?></span></h4>
          <p><?php echo $bio_curr_user; ?></p>
      </div>
      </div>    
      <div class="tinder--card right" style="background: linear-gradient(0deg, rgba(0,0,0,0.30885857761073177) 0%, rgba(255,255,255,0) 100%), url(<?php echo $profile_photo_uid2; ?>); background-repeat: no-repeat; background-position: center center; background-size: cover;" onmouseover="showBio(this);" onmouseout="hideBio(this);">
        <div class="card-info">
          <h4><?php echo $fname_uid2; ?><span class="lead">, <?php echo $age_uid2; ?></span></h4>
          <p><?php echo $bio_uid2; ?></p>
        </div>
      </div>    
    </div>
  </div>


<!-- BLOCK USER BTN -->
  <button class="block-btn btn btn-warning btn-sm" title="Block user" data-toggle="modal" data-target="#confirm-block-user"><i class="fas fa-ban"></i></button>

   <div class="modal fade" id="confirm-block-user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Block User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>By clicking yes, you will no longer be able to chat/match with this user</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Oops, my bad!</button>
          <form method="post">
            <input type="text" name="curr_uid" value="<?php echo $uid_curr_user; ?>" hidden>
            <input type="text" name="uid_to_be_blocked" value="<?php echo $uid2; ?>" hidden>
            <button type="submit" class="btn btn-danger" name="block-matched-user" value="delete profile">Yes, do it!</button>
        </form>
        </div>
      </div>
    </div>
  </div>  
  <div class="hover-msg lead">Hover to see more!</div>


<!-- HEADERS ANIMATION -->
  <!-- header-1 -->
  <p class="header-1 matching-hobbies text-monospace">Matched <span style='font-size: 32px;'><?php echo $date_curr_match; ?></span></p>
  <!-- header-2 -->
  <input type="text" hidden id="hobbies-count" value="<?php echo count($common_hobbies); ?>">
  <?php if(count($common_hobbies) > 0) { ?>
    <p class="header-2 matching-hobbies text-monospace" onmouseover="showCommonHobbies(this);" onmouseout="hideCommonHobbies(this);"><em style="font-size: 32px;"><?php echo count($common_hobbies); ?></em> <?php if(count($common_hobbies) == 1) echo "common hobby!"; else echo "hobbies in common!" ?></p>
    <i class="caret-2 fas fa-caret-up"></i>
  <?php } ?>  
  <!-- header-3 -->
  <div class="popover-2 matching-hobbies-content"><p><?php echo implode(" | ", $common_hobbies); ?></p></div>
  <p class="header-3 matching-hobbies text-monospace" onmouseover="showCommonHobbies(this);" onmouseout="hideCommonHobbies(this);"><em id="distance-between" style="font-size: 32px;">3</em>kms apart!</p>
  <i class="caret-3 fas fa-caret-up"></i>
  <div class="popover-3 matching-hobbies-content"><p><em>“Love will travel as far as you let it. It has no limits.”</em></p></div>
  

<!-- POPOVERS -->
<ul id="popover-content-profile-icon" class="list-group" style="display: none;">
 <span class="list-group-item btn btn-outline-success rounded"><a href="edit-profile.php">Edit profile</a></span>
 <div class="dropdown-divider"></div>
 <span class="list-group-item btn btn-outline-danger rounded"><a href="logout-user.php">Logout</a></span>
</ul>

<ul id="popover-content-matches" class="list-group" style="display: none;">
  <?php if(count($matches) == 0) { ?>
    <li class="list-group-item btn btn-light text-left d-flex flex-column pl-2 pb-0 mb-2 rounded disabled"><b>Sorry ☹</b><p class="font-weight-light">No matches yet.....</p></li>
  <?php } else { ?>  
    <?php for($i = 0; $i < count($matches); $i++) { ?>
      <li class="match-li list-group-item btn btn-light text-left d-flex flex-column pl-2 pb-0 mb-2 <?php if($i == 0) echo 'rounded-top'; elseif($i == count($matches) - 1) echo 'rounded-bottom'; elseif($i == 0 && $i == count($matches) - 1) echo "rounded"; ?>" style="cursor: pointer;"><b class="match-li-b"><?php echo $matches[$i]['name']; ?>, <?php echo $matches[$i]['age']; ?></b><p class="match-li-p font-weight-light">Matched <?php echo $matches[$i]['date']; ?></p><span class="d-none"><?php echo $matches[$i]['id']; ?></span></li>
    <?php } ?>  
  <?php } ?>  
</ul>

<ul id="popover-content-notifs" class="list-group" style="display: none;">
  <?php if(count($notifs_content_unseen) != 0) { ?>
    <?php for($i = 0; $i < count($notifs_content_unseen); $i++) { ?>  
      <li class="list-group-item btn btn-light text-left d-flex flex-column pl-2 pb-0 mb-2 <?php if($i == 1) echo "rounded-top" ?>"><p class="notif-text mb-0"><?php echo $notifs_content_unseen[$i] ?></p><p class="font-weight-light notif-date"><?php echo $notifs_date_unseen[$i] ?></p></li>
      <?php } ?>
      <div class="dropdown-divider"></div>
  <?php } ?>
  <?php if(count($notifs_content_seen) != 0) {  ?>
    <?php for($i = 0; $i < count($notifs_content_seen); $i++) { ?>  
      <li class="list-group-item btn btn-light text-left d-flex flex-column pl-2 pb-0 mb-2 notif-old <?php if($i == count($notifs_content_seen) - 1) echo "rounded-bottom" ?>"><p class="notif-text mb-0"><?php echo $notifs_content_seen[$i] ?></b><p class="font-weight-light notif-date"><?php echo $notifs_date_seen[$i] ?></p></li>
    <?php } ?>
  <?php } ?>  
</ul>


<!-- SCRIPTS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
  //to activate profile icon popover
  $(function() {
    $('[data-toggle="popover-profile-icon"]').popover({
    html: true,
      content: function() {
        return $('#popover-content-profile-icon').html();
      }
    });
  });

    //to activate matches popover
    $(function() {
    $('[data-toggle="popover-matches"]').popover({
    html: true,
      content: function() {
        return $('#popover-content-matches').html();
      }
    });
  });

    //to activate notifs popover
    $(function() {
    $('[data-toggle="popover-notifs"]').popover({
    html: true,
      content: function() {
        return $('#popover-content-notifs').html();
      }
    });
  });

    //activate toasts
    $(document).ready(function(){
        $(".toast").toast({
          autohide: false
        });
    });

    $(document).ready(function(){
      $('.toast').toast('show');
    });
  </script>
  <script src="./js/matchPage.js"></script>
</body>
</html>