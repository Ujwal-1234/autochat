<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $result["result"]="error";
        $get_status = "SELECT * FROM `autochat`
                    LEFT JOIN users ON users.unique_id = autochat.incoming_msg_id
                    WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})";
        $_get_query = mysqli_query($conn, $get_status);
        $row = mysqli_fetch_assoc($_get_query);
        if(mysqli_num_rows($_get_query)>0){
            switch($row['mode_status']){
                case '0' : $sql = "UPDATE `autochat` SET `mode_status`= '1' WHERE (`outgoing_msg_id`={$outgoing_id} AND `incoming_msg_id`={$incoming_id})"; break;
                case '1' : $sql = "UPDATE `autochat` SET `mode_status`= '0' WHERE (`outgoing_msg_id`={$outgoing_id} AND `incoming_msg_id`={$incoming_id})"; break;
            }   
        }else{
            $sql = "INSERT INTO `autochat`(`incoming_msg_id`, `outgoing_msg_id`, `mode_status`) VALUES ({$incoming_id},{$outgoing_id},'1')";
        }
        if(mysqli_query($conn, $sql)){
            $result = ["result"=>"success"];
        }
        return json_encode($result);
    }
?>