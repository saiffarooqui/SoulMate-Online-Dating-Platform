<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "/wamp64/www/dating-website/connection.php";
        $logout_id = mysqli_real_escape_string($con, $_GET['logout_id']);
        if(isset($logout_id)){
            $active = "Offline now";
            $sql = mysqli_query($con, "UPDATE usertable SET active = '{$active}' WHERE unique_id={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login-user.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login-user.php");
    }
?>