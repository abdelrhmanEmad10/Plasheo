<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include_once('./project/conn.php');
    session_start();
    $query = $_POST['updatetxt'].$_POST['inserttxt'].$_POST['deletetxt'];
    echo $query;
    
    try{
        $conn = new Connection;
        $conn->conn->multi_query($query);
        setcookie("orderPlaced","Order has been placed successfully",time()+1);
        $_SESSION["cartItems"] = 0;
        header("Location: index.php");
    } catch (Exception $e){
        echo $e->getMessage();
        echo $e->getLine();
    }

}else{
    header("Location: cart.php");
}

?>