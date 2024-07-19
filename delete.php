<?php
$id=$_GET['id'];
require ("./project/conn.php");
try {
    $conn = new Connection;
    $conn -> conn -> query("DELETE FROM `product` where `product_id`=$id");
    header("location:http://localhost/project/dashboard.php");
} catch (Exception $e) {
    die("cannot delete".$e->getMessage());
}