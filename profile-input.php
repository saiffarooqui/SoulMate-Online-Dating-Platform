<?php require_once "controllerUserData.php"; ?>

<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $profile_created = $fetch_info['profile_created'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
            if($profile_created == "yes") {
              header('Location: home.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create your Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-form-profile.css">
    <style>
      .logo {
      position: absolute;
     }
    </style>
</head>
<body>
  <img id="gif" src="./public/assets/43295-heart-fly-transparent-bg.gif" alt="" >

  <a href="javascript:void(0);" class="logo" title="Home">
    <img src="./public/assets/SoulMate (3).png" alt="logo" height="50">
  </a> 

  <div class="d-flex vh-100 justify-content-center align-items-center">
 <div class="container align-items-center justify-content-center p-3 position-relative">
  <form action="profile-input.php" method="POST" autocomplete="off" enctype="multipart/form-data">
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
       <input type="text" id="fname" class="form-control" placeholder="First name" name="fname">
     </div>
     <div class="col">
       <input type="text" id="lname" class="form-control" placeholder="Last name" name="lname">
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
       <input type="text" id="age" class="form-control" placeholder="18" name="age">
       <div class="invalid-feedback">You must be 18+ to use our services</div> 
      </div>
      <div class="col">
       <select id="gender" class="form-control" name="gender">
        <option selected>Select your gender</option>
        <option value="M">Male</option>
        <option value="F">Female</option>
       </select>
      </div>
      <div class="col">
       <input type="text" class="form-control" placeholder="Eg. 170cms or 5'5ft" name="height" value="">
      </div>
      <div class="col">
       <input type="text" class="form-control" placeholder="Eg. 70kgs" name="weight" value="">
      </div>
     </div>

     <!-- <div class="form-row mt-3 pl-2">
      <div class="col"><h4>Latitude</h4></div>
      <div class="col"><h4>Longitude</h4></div>
     </div> -->
     <div class="form-row d-none">
      <div class="col">
       <input type="text" class="form-control" id="lat" name='lat'>
      </div>
      <div class="col">
       <input type="text" class="form-control" id="long" name='long'>
      </div>
     </div>

     <div class="form-row mt-3 pl-2">
      <div class="col-3">
       <h4 title="required">Profile Picture</h4>
       <img id="profile-pic" src="profile-icon-png-910.png" alt="" width="180" height="180" style="border-radius: 50%;" title="Click to change">
       <input type="file" id="profile-pic-upload" class="d-none" accept=".png, .jpg, .jpeg" onchange="document.getElementById('profile-pic').src = window.URL.createObjectURL(this.files[0]);" name="profile_photo">
       <input type="text" class="form-control" id="photo-check" hidden>
       <div class="invalid-feedback">Please upload a photo</div>
      </div>
      <div class="col-9">
       <h4 title="required">Bio</h4>
       <textarea id="bio" class="form-control" rows="7" placeholder="Make it interesting....&#10;Your goal is to impress....." name="bio"></textarea>
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
      <div class="col"><input type="text" class="form-control" name="ig" value=""></div>
      <div class="col"><input type="text" class="form-control" name="twit" value=""></div>
      <div class="col"><input type="text" class="form-control" name="sc" value=""></div>
      <div class="col"><input type="text" class="form-control" name="fb" value=""></div>
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
        <option selected>I am...</option>
        <option value="student">Student</option>
        <option value="working">Working</option>
       </select>
      </div>
      <div class="col-3"><input id="job" type="text" class="form-control" placeholder="Eg. Software Developer" name="job"></div>
      <div class="col input-group">
        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">@</span></div>
        <input type="text" id="college" class="form-control" placeholder="Eg. Google Inc" name="college" value=""></div>
     </div>
     <div class="form-row  mt-3 pl-2">
      <div class="col-4"><h4>Are you an entrepreneur?</h4></div>
      <div class="col"><h4>Your business(es)</h4></div>
    </div>
    <div class="form-row">
     <div class="col-4">
       <select class="form-control" name="entre" id="entre" onchange="changeOwnsBiz();">
        <option value="no" selected>No</option>
        <option value="yes">Yes</option>
       </select>
      </div>
      <div class="col">
       <input type="text" class="form-control" name="owns_biz" value="" id="owns-biz">
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
       <input class="form-check-input" type="checkbox" value="1" id="streaming-movies-shows" name="streaming_movies_and_shows">
       <label class="form-check-label" for="streaming-movies-shows">
         Streaming Movies and Shows
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="anime" name="anime">
       <label class="form-check-label" for="anime">
         Anime
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="stand-up" name="stand_up_comedy">
       <label class="form-check-label" for="stand-up">
         Stand-up Comedy
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="reading" name="reading">
       <label class="form-check-label" for="reading">
         Reading
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="writing" name="writing">
       <label class="form-check-label" for="writing">
         Writing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="meditation" name="meditation">
       <label class="form-check-label" for="meditation">
         Meditation
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="music" name="music">
       <label class="form-check-label" for="music">
         Music
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="eating" name="eating">
       <label class="form-check-label" for="eating">
         Eating
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="dancing" name="dancing">
       <label class="form-check-label" for="dancing">
         Dancing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="singing" name="singing">
       <label class="form-check-label" for="singing">
         Singing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="baking" name="baking">
       <label class="form-check-label" for="baking">
         Baking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="cooking" name="cooking">
       <label class="form-check-label" for="cooking">
         Cooking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="gardening" name="gardening">
       <label class="form-check-label" for="gardening">
         Gardening
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="arts-and-crafts" name="arts_and_crafts">
       <label class="form-check-label" for="arts-and-crafts">
         Arts and Crafts
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="painting" name="painting">
       <label class="form-check-label" for="painting">
         Painting
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="sketching" name="sketching">
       <label class="form-check-label" for="sketching">
         Sketching
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="fishing" name="fishing">
       <label class="form-check-label" for="fishing">
         Fishing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="running" name="running">
       <label class="form-check-label" for="running">
         Running
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="walking" name="walking">
       <label class="form-check-label" for="walking">
         Walking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="swimming" name="swimming">
       <label class="form-check-label" for="swimming">
         Swimming
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="working-out" name="working_out">
       <label class="form-check-label" for="working-out">
         Working Out
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="yoga" name="yoga">
       <label class="form-check-label" for="yoga">
         Yoga
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="bicycling" name="bicycling">
       <label class="form-check-label" for="bicycling">
         Bicycling
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="driving" name="driving">
       <label class="form-check-label" for="driving">
         Driving
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="riding" name="riding">
       <label class="form-check-label" for="riding">
         Riding
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="sports" name="">
       <label class="form-check-label" for="sports">
         Sports
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="video-games" name="video_games">
       <label class="form-check-label" for="video-games">
         Video Games
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="travelling" name="travelling">
       <label class="form-check-label" for="travelling">
         Travelling
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="hiking" name="hiking">
       <label class="form-check-label" for="hiking">
         Hiking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="collecting" name="collecting">
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
       <input class="form-check-input" type="checkbox" value="1" id="volunteering" name="volunteer_work">
       <label class="form-check-label" for="volunteering">
         Volunteer Work
       </label>
     </div>  
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="working" name="working">
       <label class="form-check-label" for="working">
         Working
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="audiobooks-podcasts" name="audiobooks_and_podcasts">
       <label class="form-check-label" for="audiobooks-podcasts">
         Audiobooks and Podcasts
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="youtube" name="youtube">
       <label class="form-check-label" for="youtube">
         YouTube
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="social-media" name="social_media">
       <label class="form-check-label" for="social-media">
         Social Media
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="housework" name="housework">
       <label class="form-check-label" for="housework">
         Housework
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="shopping" name="shopping">
       <label class="form-check-label" for="shopping">
         Shopping
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="coding" name="coding">
       <label class="form-check-label" for="coding">
         Coding
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="hacking" name="hacking">
       <label class="form-check-label" for="hacking">
         Hacking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="photoshop" name="photoshop">
       <label class="form-check-label" for="photoshop">
         Photoshop
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="video-editing" name="video_editing">
       <label class="form-check-label" for="video-editing">
         Video Editing
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="filmmaking" name="filmmaking">
       <label class="form-check-label" for="filmmaking">
         Filmmaking
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="science" name="science">
       <label class="form-check-label" for="science">
         Science
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="astronomy" name="astronomy">
       <label class="form-check-label" for="astronomy">
         Astronomy
       </label>
     </div>   
     <div class="form-check m-2 col-3">
       <input class="form-check-input" type="checkbox" value="1" id="astrology" name="astrology">
       <label class="form-check-label" for="astrology">
         Astrology
       </label>
     </div>     
    </div>
   </div>

<!-- toggle stuff -->
   <button type="button" class="btn btn-sm btn-outline-secondary previous" disabled>Previous</button>
   <button type="button" class="btn btn-sm btn-outline-success next">Next</button>
   
   <input type="submit" class="btn btn-sm btn-success submit-btn" name="profile-submit" value="Submit">
   <!-- tried adding confirm submit modal but it didn't work -->

   <div class="dots mb-3">
     <span class="step" onclick="showTab(0)"></span>
     <span class="step" onclick="showTab(1)"></span>
     <span class="step" onclick="showTab(2)"></span>
     <span class="step" onclick="showTab(3)"></span>
   </div>
  </form>
 </div>
 </div>
 <script src="./js/profile.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>