<?php

$key = $_GET["key"];
require "./project/conn.php";
$query = "UPDATE `orders` SET `delivered`= 1 WHERE `orderKey` = '$key'";
$connector = new Connection;
$connector->conn->query($query);
header("Location: Dashboard.php");