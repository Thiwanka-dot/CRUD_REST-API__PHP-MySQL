<?php

$con = mysqli_connect("localhost","root","","crud-api");
if(!$con){
    die ("Connection Failed!" . mysqli_connect_error());
}
else{
    echo "Connection Successful!";
}
?>