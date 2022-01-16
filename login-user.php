<?php require_once "controllerUserData.php"; ?>

<?php 
$email = isset($_SESSION['email']) ? $_SESSION['email'] : false;
$password = isset($_SESSION['password']) ? $_SESSION['password'] : false;
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
        }else if($status == "notverified"){
            header('Location: user-otp.php');
        } else {
            header('Location: home.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-form.css">
    <style>
        #gif {
            z-index: 0;
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            opacity: .5;
            z-index: -2;
        }

        .vr {
            border: .5px solid rgba(0, 0, 0, .1);
            height: 500px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>
</head>
<body>
    <img id="gif" src="./public/assets/43295-heart-fly-transparent-bg.gif" alt="" >

    <div class="container">
        <div class="row">
            <img src="./public/assets/SoulMate (3).png" alt="logo" height="100">
            <div class="vr"></div>
            <div class="col-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Login with your email and password.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>" onkeyup="validateEmail(this.value);">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="signup-user.php">Signup now</a></div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let email = document.getElementById('email');
        function validateEmail(e) {
            console.log(e);
            let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(e.match(regex)) {
                email.classList.remove('is-invalid');
                email.classList.add('is-valid');
            } else {
                email.classList.add('is-invalid');
                email.classList.remove('is-valid');
            }
            email.onblur = () => {
                if(email.value == '') {
                    email.classList.add('is-invalid');
                    email.classList.remove('is-valid');
                } else {
                    validateEmail(email.value);
                }
            }
        }
    </script>    
</body>
</html>