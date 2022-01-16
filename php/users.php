<?php
    session_start();
    include_once "/wamp64/www/dating-website/connection.php";
    $outgoing_id = $_SESSION['unique_id'];

    $sql4 = "SELECT uid from usertable where unique_id='$_SESSION[unique_id]'";
    $query4 = mysqli_query($con, $sql4);
    $row4 = mysqli_fetch_assoc($query4);
    $current_user_uid = $row4['uid'];

    $matching_uids_list = Array();
    $sql_matches = "SELECT uid1, uid2 from `match` WHERE (uid1 = '$current_user_uid' OR uid2 = '$current_user_uid') AND status = 'match'";
    $sql_matches_res = mysqli_query($con, $sql_matches);
    while ($row = mysqli_fetch_assoc($sql_matches_res)) {
        $current_user_uid == $row['uid1'] ? $uid2 = $row['uid2'] : $uid2 = $row['uid1'];
        array_push($matching_uids_list, $uid2);
    }
    $matching_uids_list = implode(",", $matching_uids_list);
    
    $sql3 = "SELECT up.*,ut.* FROM userprofile up,usertable ut where up.uid=ut.uid and ut.uid != '$current_user_uid' and ut.uid in ($matching_uids_list)";
    $query3 = mysqli_query($con, $sql3);
    #$row3 = mysqli_fetch_assoc($query3);

    #$sql = "SELECT * FROM usertable WHERE NOT unique_id = {$outgoing_id} ORDER BY uid DESC";
    #$query = mysqli_query($con, $sql);
    $output = "";
    if(!$query3 || mysqli_num_rows($query3) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query3) > 0){
        include_once "data.php";
    }
    echo $output;
?>