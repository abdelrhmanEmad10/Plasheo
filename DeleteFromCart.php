<?php
include_once('./project/conn.php');
$conn = new Connection;
session_start();
try{
    $result = $conn->conn->query("DELETE FROM `cart` WHERE `customer_email` = '{$_SESSION['email']}' AND `product_id` = {$_GET['id']}");
    setcookie("itemDeleted","Item deleted successfully.",time()+1);
    $_SESSION["cartItems"] -= 1;
    header("Location: Cart.php");
} catch (Exception $e){
    echo $e->getMessage();
}
?>