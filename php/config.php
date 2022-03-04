<?php
$conn = mysqli_connect("localhost", "root", "", "chatapp");
if(!$conn){
    echo "database not connected ".mysqli_connect_error();
}
?>