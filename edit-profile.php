<?php require_once "controllerUserData.php"; ?>

<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$uid = "";
$tab1 = Array();
$tab2 = Array();
$tab3 = Array();
$tab4 = Array();

if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
      $fetch_info = mysqli_fetch_assoc($run_Sql);
      $uid = $fetch_info['uid'];
      //tab 1
        $sql = "SELECT * FROM userprofile WHERE uid = '$uid'";
        $run_Sql = mysqli_query($con, $sql);
        if($run_Sql){
          $fetch_info = mysqli_fetch_assoc($run_Sql);
          $name = $fetch_info['name'];
          $tab1['fname'] = explode(" ",$name)[0];
          $tab1['lname'] = explode(" ",$name)[1]; 
          $tab1['age'] = $fetch_info['age'];
          $tab1['gender'] = $fetch_info['gender'];
          $tab1['height'] = $fetch_info['height'];
          $tab1['weight'] = $fetch_info['weight'];
          // $tab1['latitude'] = $fetch_info['latitude'];
          // $tab1['longitude'] = $fetch_info['longitude'];
          $tab1['profile_photo'] = $fetch_info['profile_photo'];
          $tab1['bio'] = $fetch_info['bio'];
        }
    }
    //tab 2
    $sql = "SELECT * FROM social WHERE uid = '$uid'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
      $fetch_info = mysqli_fetch_assoc($run_Sql);
      $uid = $fetch_info['uid'];
      $tab2['ig'] = $fetch_info['ig'];
      $tab2['sc'] = $fetch_info['sc'];
      $tab2['twit'] = $fetch_info['twit'];
      $tab2['fb'] = $fetch_info['fb'];
    }
    $sql = "SELECT * FROM career WHERE uid = '$uid'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
      $fetch_info = mysqli_fetch_assoc($run_Sql);
      $tab2['status'] = $fetch_info['status'];
      $tab2['job'] = $fetch_info['job_desc'];
      $tab2['college'] = $fetch_info['college'];
      $tab2['entre'] = $fetch_info['entre'];
      $tab2['owns_biz'] = $fetch_info['owns_biz'];
    }
    //tab 3
    $sql = "SELECT * FROM hobbies WHERE uid = '$uid'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
      $fetch_info = mysqli_fetch_assoc($run_Sql);
      $tab3['streaming_movies_and_shows'] = $fetch_info['streaming_movies_and_shows'];
      $tab3['anime'] = $fetch_info['anime'];
      $tab3['stand_up_comedy'] = $fetch_info['stand_up_comedy'];
      $tab3['reading'] = $fetch_info['reading'];
      $tab3['writing'] = $fetch_info['writing'];
      $tab3['meditation'] = $fetch_info['meditation'];
      $tab3['music'] = $fetch_info['music'];
      $tab3['eating'] = $fetch_info['eating'];
      $tab3['dancing'] = $fetch_info['dancing'];
      $tab3['singing'] = $fetch_info['singing'];
      $tab3['baking'] = $fetch_info['baking'];
      $tab3['cooking'] = $fetch_info['cooking'];
      $tab3['gardening'] = $fetch_info['gardening'];
      $tab3['arts_and_crafts'] = $fetch_info['arts_and_crafts'];
      $tab3['painting'] = $fetch_info['painting'];
      $tab3['sketching'] = $fetch_info['sketching'];
      $tab3['fishing'] = $fetch_info['fishing'];
      $tab3['running'] = $fetch_info['running'];
      $tab3['walking'] = $fetch_info['walking'];
      $tab3['swimming'] = $fetch_info['swimming'];
      $tab3['working_out'] = $fetch_info['working_out'];
      $tab3['yoga'] = $fetch_info['yoga'];
      $tab3['bicycling'] = $fetch_info['bicycling'];
      $tab3['driving'] = $fetch_info['driving'];
      $tab3['riding'] = $fetch_info['riding'];
      $tab3['sports'] = $fetch_info['sports'];
      $tab3['video_games'] = $fetch_info['video_games'];
      $tab3['travelling'] = $fetch_info['travelling'];
      $tab3['hiking'] = $fetch_info['hiking'];
      $tab3['collecting'] = $fetch_info['collecting'];
      $tab4['volunteer_work'] = $fetch_info['volunteer_work'];
      $tab4['working'] = $fetch_info['working'];
      $tab4['audiobooks_and_podcasts'] = $fetch_info['audiobooks_and_podcasts'];
      $tab4['youtube'] = $fetch_info['youtube'];
      $tab4['social_media'] = $fetch_info['social_media'];
      $tab4['housework'] = $fetch_info['housework'];
      $tab4['shopping'] = $fetch_info['shopping'];
      $tab4['coding'] = $fetch_info['coding'];
      $tab4['hacking'] = $fetch_info['hacking'];
      $tab4['photoshop'] = $fetch_info['photoshop'];
      $tab4['video_editing'] = $fetch_info['video_editing'];
      $tab4['filmmaking'] = $fetch_info['filmmaking'];
      $tab4['science'] = $fetch_info['science'];
      $tab4['astronomy'] = $fetch_info['astronomy'];
      $tab4['astrology'] = $fetch_info['astrology'];
    }
}else{
    header('Location: login-user.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style-form-profile.css">

    <style>
     #delete-icon {
      position: absolute;
      bottom: 15px;
      right: 15px;
     }
     .logo {
      position: absolute;
     }
    </style>
</head>
<body>
  <img id="gif" src="./public/assets/43295-heart-fly-transparent-bg.gif" alt="" >

  <a href="home.php" class="logo" title="Home">
    <img src="./public/assets/SoulMate (3).png" alt="logo" height="50">
  </a> 
  <div class="d-flex vh-100 justify-content-center align-items-center">
 <div class="container align-items-center justify-content-center p-3 position-relative">
  <form action="edit-profile.php" method="POST" autocomplete="off" enctype="multipart/form-data">
<!-- tab 1 -->
   <div class="tab">
    <div class="row justify-content-center">
    <h2 class="text-center">Basic Stuff</h2>
   </div>
   <div class="row justify-content-center">
    <div class="alert alert-danger text-center col-8 error-message"></div>
    <div class="alert alert-success text-center col-8 positive-message">Being honest might just give you more matches!</div>
   </div>
     
   <div class="form-row pl-2">
      <h4>Name</h4>
     </div>
     <div class="form-row">
      <div class="col">
       <input type="text" id="fname" class="form-control" placeholder="First name" name="fname" value="<?php echo $tab1['fname'] ?>">
     </div>
     <div class="col">
       <input type="text" id="lname" class="form-control" placeholder="Last name" name="lname" value="<?php echo $tab1['lname'] ?>">
     </div>
     </div>

     <div class="form-row  mt-3 pl-2">
      <div class="col"><h4>Age</h4></div>
      <div class="col"><h4>Gender</h4></div>
      <div class="col"><h4>Height</h4></div>
      <div class="col"><h4>Weight</h4></div>
     </div>
     <div class="form-row">
      <div class="col">
       <input type="text" id="age" class="form-control" placeholder="18" name="age" value="<?php echo $tab1['age'] ?>">
        <div class="invalid-feedback">You must be 18+ to use our services</div>       
      </div>  
      <div class="col">
       <select class="form-control" id="gender" name="gender">
        <option <?php if($tab1['gender'] != "M" && $tab1['gender'] != "F") {  ?> selected <?php } ?>>Select your gender</option>
        <option value="M" <?php if($tab1['gender'] == "M") {  ?> selected <?php } ?>>Male</option>
        <option value="F" <?php if($tab1['gender'] == "F") {  ?> selected <?php } ?>>Female</option>
       </select>
      </div>
      <div class="col">
       <input type="text" class="form-control" placeholder="Eg. 170cms or 5'5ft" name="height" value="<?php echo $tab1['height'] ?>">
      </div>
      <div class="col">
       <input type="text" class="form-control" placeholder="Eg. 70kgs" name="weight" value="<?php echo $tab1['weight'] ?>">
      </div>
     </div>

     <div class="form-row d-none">
      <div class="col">
       <input type="text" class="form-control" id="lat" name='lat' value="<?php echo $tab1['latitude'] ?>">
      </div>
      <div class="col">
       <input type="text" class="form-control" id="long" name='long' value="<?php echo $tab1['longitude'] ?>">
      </div>
     </div>

     <div class="form-row mt-3 pl-2">
      <div class="col-3">
       <h4 title="required">Profile Picture</h4>
       <img id="profile-pic" src="<?php echo $tab1['profile_photo'] ?>" alt="" width="180" height="180" style="border-radius: 50%; object-fit: cover;" title="Click to change">
       <input type="file" id="profile-pic-upload" class="d-none" accept=".png, .jpg, .jpeg" onchange="document.getElementById('profile-pic').src = window.URL.createObjectURL(this.files[0]);" name="profile_photo">
       <input type="text" class="form-control" id="photo-check" hidden>
       <div class="invalid-feedback">Please upload a photo</div>   
      </div>
      <div class="col-9">
       <h4 title="required">Bio</h4>
       <textarea class="form-control" id="bio" rows="7" placeholder="Make it interesting....&#10;Your goal is to impress....." name="bio"><?php echo $tab1['bio'] ?></textarea>
      </div>
     </div>
   </div>
<!-- tab 2 -->
   <div class="tab">
    <div class="row justify-content-center">
    <h2 class="text-center" id="title">Socials</h2>
   </div>
   <div class="row justify-content-center">
    <!-- <div class="alert alert-danger text-center col-8 d-none">We need your location to provide you the right matches!</div> -->
    <div class="alert alert-success text-center col-8" id="message">Let them connect on social media!</div>
   </div>

    <div class="form-row  mt-3 pl-2">
      <div class="col"><h4>Instagram</h4></div>
      <div class="col"><h4>Twitter</h4></div>
      <div class="col"><h4>Snapchat</h4></div>
      <div class="col"><h4>Facebook</h4></div>
     </div>
     <div class="form-row">
      <div class="col"><input type="text" class="form-control" name="ig" value="<?php echo $tab2['ig'] ?>"></div>
      <div class="col"><input type="text" class="form-control" name="twit" value="<?php echo $tab2['twit'] ?>"></div>
      <div class="col"><input type="text" class="form-control" name="sc" value="<?php echo $tab2['sc'] ?>"></div>
      <div class="col"><input type="text" class="form-control" name="fb" value="<?php echo $tab2['fb'] ?>"></div>
     </div>

   <div class="row justify-content-center mt-3">
    <h2 class="text-center" id="title">Career</h2>
   </div>
   <div class="row justify-content-center">
    <!-- <div class="alert alert-danger text-center col-8 d-none">We need your location to provide you the right matches!</div> -->
    <div class="alert alert-success text-center col-8" id="message">What do you do?</div>
   </div>

   <div class="form-row  mt-3 pl-2">
      <div class="col-3"><h4>Status</h4></div>
      <div class="col-3"><h4 id="job-title">Job</h4></div>
      <div class="col"><h4 id="college-title">Location</h4></div>
    </div>
    <div class="form-row">
      <div class="col-3">
       <select id="status" class="form-control" name="status" onchange="changeStatus();">
        <option <?php if($tab2['status'] != "working" && $tab2['status'] != "student") {  ?> selected <?php } ?>>I am...</option>
        <option value="student" <?php if($tab2['status'] == "student") {  ?> selected <?php } ?>>Student</option>
        <option value="working" <?php if($tab2['status'] == "working") {  ?> selected <?php } ?>>Working</option>
       </select>
      </div>
      <div class="col-3"><input id="job" type="text" class="form-control" placeholder="Eg. Software Developer" name="job" value="<?php echo $tab2['job'] ?>"></div>
      <div class="col input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">@</span></div>
        <input type="text" id="college" class="form-control" placeholder="Google Inc" name="college" value="<?php echo $tab2['college'] ?>"></div>
     </div>
     <div class="form-row  mt-3 pl-2">
      <div class="col-4"><h4>Are you an entrepreneur?</h4></div>
      <div class="col"><h4>Your business(es)</h4></div>
    </div>
    <div class="form-row">
     <div class="col-4">
       <select class="form-control" id="entre" name="entre" onchange="changeOwnsBiz();">
        <option value="no" <?php if($tab2['entre'] == "no") {  ?> selected <?php } ?>>No</option>
        <option value="yes" <?php if($tab2['entre'] == "yes") {  ?> selected <?php } ?>>Yes</option>
       </select>
      </div>
      <div class="col">
       <input type="text" class="form-control" id="owns-biz" name="owns_biz" value="<?php echo $tab2['owns_biz'] ?>">
      </div>
    </div>
   </div>
<!-- tab 3 -->
   <div class="tab">
    <div class="row justify-content-center mt-3">
    <h2 class="text-center" id="title">Interests</h2>
    </div>
    <div class="row justify-content-center">
     <!-- <div class="alert alert-danger text-center col-8 d-none">We need your location to provide you the right matches!</div> -->
    <div class="alert alert-success text-center col-8" id="message">So that they know what you like!</div>
    </div>

    <!-- for now it is this, later can convert to clickable pngs or icons -->
    <div class="d-flex flex-wrap justify-content-center">
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="streaming-movies-shows" name="streaming_movies_and_shows" <?php if($tab3['streaming_movies_and_shows'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="streaming-movies-shows">
         Streaming Movies and Shows
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="anime" name="anime" <?php if($tab3['anime'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="anime">
         Anime
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="stand-up" name="stand_up_comedy"<?php if($tab3['stand_up_comedy'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="stand-up">
         Stand-up Comedy
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="reading" name="reading"<?php if($tab3['reading'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="reading">
         Reading
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="writing" name="writing"<?php if($tab3['writing'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="writing">
         Writing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="meditation" name="meditation"<?php if($tab3['meditation'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="meditation">
         Meditation
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="music" name="music"<?php if($tab3['music'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="music">
         Music
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="eating" name="eating"<?php if($tab3['eating'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="eating">
         Eating
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="dancing" name="dancing"<?php if($tab3['dancing'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="dancing">
         Dancing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="singing" name="singing"<?php if($tab3['singing'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="singing">
         Singing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="baking" name="baking"<?php if($tab3['baking'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="baking">
         Baking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="cooking" name="cooking"<?php if($tab3['cooking'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="cooking">
         Cooking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="gardening" name="gardening"<?php if($tab3['gardening'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="gardening">
         Gardening
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="arts-and-crafts" name="arts_and_crafts"<?php if($tab3['arts_and_crafts'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="arts-and-crafts">
         Arts and Crafts
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="painting" name="painting"<?php if($tab3['painting'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="painting">
         Painting
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="sketching" name="sketching"<?php if($tab3['sketching'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="sketching">
         Sketching
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="fishing" name="fishing"<?php if($tab3['fishing'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="fishing">
         Fishing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="running" name="running"<?php if($tab3['running'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="running">
         Running
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="walking" name="walking"<?php if($tab3['walking'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="walking">
         Walking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="swimming" name="swimming"<?php if($tab3['swimming'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="swimming">
         Swimming
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="working-out" name="working_out"<?php if($tab3['working_out'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="working-out">
         Working Out
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="yoga" name="yoga"<?php if($tab3['yoga'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="yoga">
         Yoga
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="bicycling" name="bicycling"<?php if($tab3['bicycling'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="bicycling">
         Bicycling
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="driving" name="driving"<?php if($tab3['driving'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="driving">
         Driving
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="riding" name="riding"<?php if($tab3['riding'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="riding">
         Riding
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="sports" name="sports"<?php if($tab3['sports'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="sports">
         Sports
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="video-games" name="video_games"<?php if($tab3['video_games'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="video-games">
         Video Games
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="travelling" name="travelling"<?php if($tab3['travelling'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="travelling">
         Travelling
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="hiking" name="hiking"<?php if($tab3['hiking'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="hiking">
         Hiking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="collecting" name="collecting"<?php if($tab3['collecting'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="collecting">
         Collecting
       </label>
     </div>        
    </div>
   </div>
<!-- tab 4 -->
   <div class="tab">
    <div class="row justify-content-center mt-3">
    <h2 class="text-center" id="title">Interests</h2>
    </div>
    <div class="row justify-content-center">
     <!-- <div class="alert alert-danger text-center col-8 d-none">We need your location to provide you the right matches!</div> -->
    <div class="alert alert-success text-center col-8" id="message">Yes almost done!</div>
    </div>

    <div class="d-flex flex-wrap justify-content-center">
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="volunteering" name="volunteer_work" <?php if($tab4['volunteer_work'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="volunteering">
         Volunteer Work
       </label>
     </div>  
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="working" name="working" <?php if($tab4['working'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="working">
         Working
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="audiobooks-podcasts" name="audiobooks_and_podcasts" <?php if($tab4['audiobooks_and_podcasts'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="audiobooks-podcasts">
         Audiobooks and Podcasts
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="youtube" name="youtube" <?php if($tab4['youtube'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="youtube">
         YouTube
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="social-media" name="social_media" <?php if($tab4['social_media'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="social-media">
         Social Media
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="housework" name="housework" <?php if($tab4['housework'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="housework">
         Housework
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="shopping" name="shopping" <?php if($tab4['shopping'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="shopping">
         Shopping
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="coding" name="coding" <?php if($tab4['coding'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="coding">
         Coding
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="hacking" name="hacking" <?php if($tab4['hacking'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="hacking">
         Hacking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="photoshop" name="photoshop" <?php if($tab4['photoshop'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="photoshop">
         Photoshop
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="video-editing" name="video_editing" <?php if($tab4['video_editing'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="video-editing">
         Video Editing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="filmmaking" name="filmmaking" <?php if($tab4['filmmaking'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="filmmaking">
         Filmmaking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="science" name="science" <?php if($tab4['science'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="science">
         Science
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="astronomy" name="astronomy" <?php if($tab4['astronomy'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="astronomy">
         Astronomy
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="astrology" name="astrology" <?php if($tab4['astrology'] == "1") {  ?> checked <?php } ?>>
       <label class="form-check-label" for="astrology">
         Astrology
       </label>
     </div>     
    </div>
   </div>

<!-- toggle stuff -->
   <button type="button" class="btn btn-sm btn-outline-secondary previous" disabled>Previous</button>
   <button type="button" class="btn btn-sm btn-outline-success next">Next</button>
   
   <input type="submit" class="btn btn-sm btn-success submit-btn" name="profile-edit-submit" value="Submit">

   <div class="dots mb-3">
     <span class="step" onclick="showTab(0)"></span>
     <span class="step" onclick="showTab(1)"></span>
     <span class="step" onclick="showTab(2)"></span>
     <span class="step" onclick="showTab(3)"></span>
   </div>
  </form>
 </div>


  <div class="modal fade" id="confirm-delete-profile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Delete Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Clicking on yes will <b>PERMANENTLY DELETE</b> your profile</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Oops, my bad!</button>
          <form method="post"><button type="submit" class="btn btn-danger" value="delete profile" name="delete-profile">Yes, do it!</button></form>
        </div>
      </div>
    </div>
  </div> 

  <button class="btn btn-warning" id="delete-icon" title="Delete profile" data-toggle="modal" data-target="#confirm-delete-profile"><i class="fas fa-user-minus"></i></button>
 </div>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="./js/profile.js"></script>

</body>
</html>