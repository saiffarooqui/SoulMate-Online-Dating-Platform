<?php
    while($row = mysqli_fetch_assoc($query3)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['active'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
/*
        $sql4 = "SELECT uid from usertable where unique_id='$_SESSION[unique_id]'";
        $query4 = mysqli_query($con, $sql4);
        $row4 = mysqli_fetch_assoc($query4);
        $current_user_uid = $row4['uid'];

        $sql3 = "SELECT up.uid,up.name,profile_photo,ut.unique_id FROM userprofile up,usertable ut where up.uid=ut.uid and ut.uid != '$current_user_uid'";
        $query3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($query3);
*/
        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="'. $row['profile_photo'] .'" alt="">
                    <div class="details">
                        <span>'. $row['name'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>