<?php
session_start();
if (isset($_SESSION["email"])){
    require "./cookieValidator.php";
    require "./project/conn.php";
    $cookie = new CookieValidator;
    $key = $cookie->generateKey();
    $x = new Connection;
    $query = "UPDATE `customer` SET `sessKey`='$key' WHERE `email` = '$_SESSION[email]'";
    if (isset($_SESSION["isAdmin"])) $query = "UPDATE `admin` SET `sessKey`='$key' WHERE `email` = '$_SESSION[email]'";
    $x->conn->query($query);
}
session_destroy();
setcookie("email","",time()-1);
setcookie("key","",time()-1);
if (isset($_COOKIE["isAdmin"])) setcookie("isAdmin","",time()-1);
header("Location: index.php");