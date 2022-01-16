<?php
    session_start();
    include_once "/wamp64/www/dating-website/connection.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);

    #$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $sql = "select * from usertable ut, userprofile up where (ut.uid = up.uid) and (ut.unique_id != '$outgoing_id') and (name like '%$searchTerm%')";
    $output = "";
    $query3 = mysqli_query($con, $sql);
    if(mysqli_num_rows($query3) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>