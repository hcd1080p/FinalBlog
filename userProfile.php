<?php
require "db/db.php";
$mydb = new Database();
session_unset();
session_destroy();
header("location: ./index.php");
?>
