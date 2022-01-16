<?php require_once "controllerUserData.php"; ?>
<?php 
    $email = $_SESSION['email'];
    if($email == false){
    header('Location: login-user.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
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
            height: 330px;
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
            <div class="col-md-4 form">
                <form action="new-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
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
                        <label for="password" class="form-label">New Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
            <div class="vr"></div>
            <img src="./public/assets/SoulMate (3).png" alt="logo" height="100">
        </div>
    </div>
    
</body>
</html>