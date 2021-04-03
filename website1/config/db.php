<?php
//create connection
/* define("DB_HOST", "localhost");

define("DB_USER", "root");

define("DB_PASS", "");

define("DB_NAME", "phpblog"); */

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//check connection
if(mysqli_connect_errno()) {
    //if true then connection failed
    echo "Connection to Database Failed". mysqli_connect_errno();
}

?>