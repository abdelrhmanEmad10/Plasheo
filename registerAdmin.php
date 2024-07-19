<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./modules/dist/css/obaidaGlobal.css">
    <link rel="stylesheet" href="./modules/dist/css/footer.css">

    <?php
    if (isset($_POST["submit"])) {
        require "validator.php";
        $validation = new Validator($_POST, "register");
        $errors = $validation->validateForm();
        if (sizeof($errors) == 0) {
            require "./project/conn.php" ;
            require "cookieValidator.php";
            $connector = new Connection;
            $cookieValidatorKey = new CookieValidator;
            $key = $cookieValidatorKey->generateKey();
            $_POST = array_map(function ($obj) {
                return trim($obj);
            }, $_POST);
            $address2 = $_POST["address2"] ?? "NULL";
            $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
            try {
                $res = $connector->conn->query("SELECT * FROM `customer` WHERE `email` = '$_POST[email]'");
                if ($res->num_rows){
                    throw new Exception("E-mail");
                }
                $res = $connector->conn->query("SELECT * FROM `customer` WHERE `phone` = '$_POST[phone]'");
                if ($res->num_rows){
                    throw new Exception("Phone");
                }
                $query = "INSERT INTO `admin`(`sessKey`, `name`, `address`, `password`, `email`, `phone`, `BirthDate`) VALUES ('$key','$_POST[firstName] $_POST[lastName]','$_POST[address]','$password','$_POST[email]','$_POST[phone]','$_POST[birthDate]')";
                $connector->conn->query($query);
                session_start();
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["address"] = $_POST["address"];
                $_SESSION["name"] = "$_POST[firstName] $_POST[lastName]";
                $_SESSION["isAdmin"] = 1;
                setcookie("isAdmin",1,time()+(365*24*60*60));
                setcookie("email",$_POST["email"],time()+(365*24*60*60));
                setcookie("key",$key,time()+(365*24*60*60));
                header("Location: index.php");
            } catch (Exception $e){
                echo mysqli_error($connector->conn);
                if(preg_match("/'email'$/", mysqli_error($connector->conn)) || $e->getMessage() === "E-mail"){
                    $errors["email"] = "E-mail is already taken";
                }
                else if(preg_match("/'phone'$/", mysqli_error($connector->conn)) || $e->getMessage() === "Phone"){
                    $errors["phone"] = "Phone number is already taken";
                }
            }
        }
    }
    
    ?>
</head>

<body>
    <?php require "./NAVBAR.php"?>
    <?php
    if(isset($_SESSION["email"])){
        header("Location: index.php");
    }
    ?>
    
    <p class="text-center font" style="font-size:46px;">Register</p>
    <form method="post" class="p-4 w-75 my-5 m-auto d-grid" style="background-color: #f1f1ec;">
        <div class="row">
            <div class=" col-12 col-md-6">
                <label class="form-label font" for="firstName">First Name<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($_POST["firstName"] ?? " ") ?>">
                <p class="font text-danger"><?= $errors["firstName"] ?? " " ?></p>
            </div>
            <div class=" col-12 col-md-6">
                <label class="form-label font" for="lastName">Last Name<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($_POST["lastName"] ?? " ") ?>">
                <p class="font text-danger"><?= $errors["lastName"] ?? " " ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="form-label font" for="email">E-mail<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? " ") ?>">
                <p class="font text-danger"><?= $errors["email"] ?? " " ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="form-label font" for="phone">Phone number<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="number" name="phone" id="phone" value="<?= htmlspecialchars($_POST["phone"] ?? " ") ?>">
                <p class="font text-danger"><?= $errors["phone"] ?? " " ?></p>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label font" for="birthDate">Birth Date<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="date" name="birthDate" id="birthDate" value="<?= htmlspecialchars($_POST["birthDate"] ?? " ") ?>">
                <p class="font text-danger"><?= $errors["birthDate"] ?? " " ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label class="form-label font" for="address">Address<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="text" name="address" id="address" value="<?= htmlspecialchars($_POST["address"] ?? " ") ?>">
                <p class="font text-danger"><?= $errors["address"] ?? " " ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="form-label font" for="password">Password<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="password" name="password" id="password">
                <p class="font text-danger"><?= $errors["password"] ?? " " ?></p>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label font" for="repeatPassword">Repeat Password<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="password" name="repeatPassword" id="repeatPassword">
                <p class="font text-danger"><?= $errors["repeatPassword"] ?? " " ?></p>
            </div>
            <div class="col-12">
                <label class="form-label font" for="adminPassword">Admin shared password<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="password" name="adminPassword" id="adminPassword">
                <p class="font text-danger"><?= $errors["adminPassword"] ?? " " ?></p>
            </div>
        </div>
        <div class="row">
            <input class="btn w-50 mt-3 m-auto" id="submit" type="submit" name="submit">
            <p class="font text-center mt-3">already have an account? <a href="login.php">Sign in</a></p>
        </div>
    </form>

    <?php require './FOOTER.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>