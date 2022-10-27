<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $automode = "SELECT * FROM autochat
                    LEFT JOIN users ON users.unique_id = autochat.incoming_msg_id
                    WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})";
        $query_automode = mysqli_query($conn, $automode);
        $result = ['automode'=>0, 'msg_data'=>''];
        if(mysqli_num_rows($query_automode) > 0){
            $row = mysqli_fetch_assoc($query_automode);
            $result['automode'] = $row["mode_status"];
        }
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .='<div class="chat outgoing">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                 </div>
                                </div>';
                }else{
                    $output .='<div class="chat incoming">
                                <img src = "php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                </div>
                                </div>';
                }
            }
            $result['msg_data'] = $output;
            // echo $output;
            // echo json_encode($result);
        }
        echo json_encode($result);
    }else{
        header("location: ../login.php");
    }
?>