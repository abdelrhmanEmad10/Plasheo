<?php

class CookieValidator{

    private $key;
    private $email;
    private $data;

    public function __construct(){
        $this->key = $_COOKIE["key"] ?? 0;
        $this->email = $_COOKIE["email"] ?? 0;
    }
    public function validate(){
        if($this->key && $this->email && !isset($_SESSION["email"])){
            include_once("./project/conn.php");
            if (isset($_COOKIE["isAdmin"]) && $_COOKIE["isAdmin"] == 1){
                $query = "SELECT `name`,`address` FROM `admin` WHERE sessKey = '$this->key' AND email = '$this->email'";
            }
            else $query = "SELECT `name`,`address1` FROM `customer` WHERE sessKey = '$this->key' AND email = '$this->email'";
            $x = new Connection;
            $res = $x->conn->query($query);
            if($res->num_rows !== 0){
                $this->data = $res->fetch_all();
                session_start();
                if (isset($_COOKIE["isAdmin"]) && $_COOKIE["isAdmin"] == 1) $_SESSION["isAdmin"] = 1;
                $_SESSION["email"] = $this->email;
                $_SESSION["name"] = $this->data[0][0];
                $_SESSION["address"] = $this->data[0][1];
            }
        }
    }

    public function generateKey($x=20){
        $uniqueKey=strtoupper(substr(sha1(microtime()), rand(0, 5), $x));  
        $uniqueKey  = implode("-", str_split($uniqueKey, 5));
        return $uniqueKey; 
    }
}
?>