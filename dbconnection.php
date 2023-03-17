<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "billal";


$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn)
{


}

else{
    echo "error". mysqli_connect_error();
}





?>