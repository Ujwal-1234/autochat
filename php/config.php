<?php
$conn = mysqli_connect("localhost", "itsujwal_autochat", "Ujwal@1234", "itsujwal_autochat");
if(!$conn){
    echo "database not connected ".mysqli_connect_error();
}
?>