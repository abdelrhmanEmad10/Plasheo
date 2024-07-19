<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include_once('./project/conn.php');
        $conn = new Connection;
        session_start();
        $result = $conn->conn->query("UPDATE cart SET quantity=quantity+ {$_POST['Quantity']} WHERE customer_email = '{$_SESSION['email']}' AND product_id = $_POST[Id];");
        if(!$conn->conn->affected_rows){
            $query = "INSERT INTO `cart` ( `customer_email`, `product_id`, `quantity`) VALUES ('$_SESSION[email]',{$_POST['Id']},$_POST[Quantity])";
            try{
                $result = $conn->conn->query($query);
                setcookie("itemAdded","Item has been added to cart successfully",time()+1);
                $_SESSION["cartItems"] += 1;
                header("Location: product1.php?id=$_POST[Id]");
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }else{
            setcookie("itemUpdated","Number of ordered items in cart increased successfully",time()+1);
            header("Location: product1.php?id=$_POST[Id]");
        }
    }
?>