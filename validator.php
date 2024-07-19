<?php

class Validator{
    private $data;
    private $errors = [];
    private $case;

    public function __construct($data,$case)
    {
        $this->data = $data;
        $this->case = $case;
    }
    public function validateForm(){
        if($this->case === "register"){
            $this->valdiateFirstName();
            $this->valdiateLastName();
            $this->valdiateEmail();
            $this->validatePhone();
            $this->validateBirthDate();
            $this->validateAddress();
            $this->valdiatePassword();
            $this->valdiatePasswordMatch();
        }
        else if ($this->case === "registerAdmin"){
            $this->valdiateFirstName();
            $this->valdiateLastName();
            $this->valdiateEmail();
            $this->validatePhone();
            $this->validateBirthDate();
            $this->validateAddress();
            $this->valdiatePassword();
            $this->valdiatePasswordMatch();
            $this->valdiateAdminPassword();
        }
        else if($this->case === "login"){
            $this->validateEmpty("email",$this->data["email"]);
            $this->validateEmpty("password",$this->data["password"]);
        }
        else if ($this->case === "contact"){
            $this->validateEmpty("name",$this->data["name"]);
            $this->valdiateEmail();
            $this->validateEmpty("comment",$this->data["comment"]);
        }
        else if ($this->case === "product"){
            $this->validateEmpty("name",$this->data["name"]);
            $this->validateEmpty("img-path",$this->data["img-path"]);
            $this->valdiatePrice();
            $this->valdiateRate();
            $this->valdiateCategory();
            $this->valdiateStock();
            $this->validateEmpty("description",$this->data["description"]);
        }
        return $this->errors;
    }
    private function valdiateStock(){
        $val = trim($this->data["stock"]);
        if(empty($val) && $val !== "0"){
            $this->addError("stock","Stock cannot be empty");
        }
        else if(!preg_match("/^[0-9]*$/",$val)){
            $this->addError("stock","Stock can only be integers");
        }
    }
    private function valdiateCategory(){
        $val = trim($this->data["category_id"]);
        if(empty($val)){
            $this->addError("category_id","Category cannot be empty");
        }
        else if($val !== "1" && $val !== "2"){
            $this->addError("category_id","invalid category");
        }
    }
    private function valdiatePrice(){
        $val = trim($this->data["price"]);
        if(empty($val)){
            $this->addError("price","Price cannot be empty");
        }
        else if(!preg_match("/^[0-9]*.?[0-9]*$/",$val)){
            $this->addError("price","invalid price");
        }
    }
    private function valdiateRate(){
        $val = trim($this->data["rate"]);
        if(empty($val)){
            $this->addError("rate","rate cannot be empty");
        }
        else if(!preg_match("/^[0-4]*.?[0-9]*$/",$val) || $val > 5){
            $this->addError("rate","Maximum rate is 5");
        }
    }
    private function valdiateFirstName(){
        $val = trim($this->data["firstName"]);
        if(empty($val)){
            $this->addError("firstName","First name cannot be empty");
        }
        else if(!preg_match("/^[a-zA-z]{1,}$/",$val)){
            $this->addError("firstName","First name can only contain letters");
        }
    }
    private function validateBirthDate(){
        $val = trim($this->data["birthDate"]);
        if(empty($val)){
            $this->addError("birthDate","Birth date cannot be empty");
        }
        else if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$val)){
            $this->addError("birthDate","Invalid Date");
        }
        else{
            $arr = explode("-",$val);
            if(!checkdate($arr[1],$arr[2],$arr[0])){
                $this->addError("birthDate","Invalid Date");
            }
            else if(mktime(0,0,0,$arr[1],$arr[2],$arr[0]) > time()){
                $this->addError("birthDate","Invalid Date");
            }
        }   
    }
    private function validatePhone(){
        $val = trim($this->data["phone"]);
        if(empty($val)){
            $this->addError("phone","Phone cannot be empty");
        }
        else if (!preg_match("/^01[0125][0-9]{8}$/",$val)){
            $this->addError("phone","Invalid phone number");
        }
    }
    private function validateEmpty($key,$val){
        $val = trim($val);
        if(empty($val)){
            $this->addError($key,ucfirst($key)." cannot be empty");
        }
    }
    private function validateAddress(){
        $val = trim($this->data["address"]);
        if(empty($val)){
            $this->addError("address","Address cannot be empty");
        }
    }
    private function valdiateLastName(){
        $val = trim($this->data["lastName"]);
        if(empty($val)){
            $this->addError("lastName","Last name cannot be empty");
        }
        else if(!preg_match("/^[a-zA-z]{1,}$/",$val)){
            $this->addError("lastName","Last name can only contain letters");
        }
    }
    private function valdiateEmail(){
        $val = trim($this->data["email"]);
        if(empty($val)){
            $this->addError("email","E-mail cannot be empty");
        }
        else if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9. -]+\.[a-zA-Z]{2,4}$/",$val)){
            $this->addError("email","invalid E-mail address");
        }
    }
    private function valdiateAdminPassword(){
        $val = trim($this->data["adminPassword"]);
        if(empty($val)){
            $this->addError("adminPassword","Admin shared password cannot be empty");
        }
        else if($this->data["adminPassword"] !== "KalbazKalabezoYah"){
            $this->addError("adminPassword","invalid admin password");
        }
    }
    private function valdiatePassword(){
        $val = trim($this->data["password"]);
        if(empty($val)){
            $this->addError("password","Password cannot be empty");
        }
        else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,16}$/",$val)){
            $this->addError("password","Password must be 8-16 characters long and contain a lowercase letter, uppercase letter ,number and a specail character");
        }
    }
    private function valdiatePasswordMatch(){
        $val = trim($this->data["repeatPassword"]);
        if(empty($val)){
            $this->addError("repeatPassword","Repeat password cannot be empty");
        }
        else if(trim($this->data["password"]) !== $val){
            $this->addError("repeatPassword","Passwords do not match");
        }
    }
    private function addError($key,$message){
        $this->errors["$key"] = $message;
    }
}

?>