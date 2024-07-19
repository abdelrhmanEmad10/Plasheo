<?php
session_start();
if (isset($_SESSION["email"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./modules/dist/css/obaidaGlobal.css">
    <link rel="stylesheet" href="./modules/dist/css/obaidaLogin.css">
    <link rel="stylesheet" href="./modules/dist/css/footer.css">

    <?php
    if (isset($_POST["submit"])) {
        require "validator.php";
        $validation = new Validator($_POST, "login");
        $errors = $validation->validateForm();
        if (sizeof($errors) == 0) {
            $_POST = array_map(function ($obj) {
                return trim($obj);
            }, $_POST);
            require "./project/conn.php";
            $connector = new Connection;
            $query = "SELECT `sessKey`,`name`,`password`,`address1` FROM `customer` WHERE `email` = '$_POST[email]'";
            $res = $connector->conn->query($query);
            if ($res->num_rows !== 0) {
                $result = $res->fetch_row();
                if (password_verify($_POST["password"], $result[2])) {
                    session_start();
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["name"] = $result[1];
                    $_SESSION["address"] = $result[3];
                    setcookie("email", $_POST["email"], time() + (365 * 24 * 60 * 60));
                    setcookie("key", $result[0], time() + (365 * 24 * 60 * 60));
                    header("Location: index.php");
                } else {
                    $errors["password"] = "Invalid password";
                }
            } else {
                $query = "SELECT `sessKey`,`name`,`password`,`address` FROM `admin` WHERE `email` = '$_POST[email]'";
                $res = $connector->conn->query($query);
                if ($res->num_rows !== 0) {
                    $result = $res->fetch_row();
                    if (password_verify($_POST["password"], $result[2])) {
                        session_start();
                        $_SESSION["email"] = $_POST["email"];
                        $_SESSION["name"] = $result[1];
                        $_SESSION["address"] = $result[3];
                        $_SESSION["isAdmin"] = 1;
                        setcookie("isAdmin", 1, time() + (365 * 24 * 60 * 60));
                        setcookie("email", $_POST["email"], time() + (365 * 24 * 60 * 60));
                        setcookie("key", $result[0], time() + (365 * 24 * 60 * 60));
                        header("Location: index.php");
                    }else {
                        $errors["password"] = "Invalid password";
                    }
                } else {
                    $errors["email"] = "Email doesn't exist";
                }
            }
        }
    }
    ?>
    <style>
        .loginForm {
            width: 25% !important;
            margin-bottom: 158px;
            background-color: #f1f1ec;
        }


        @media only screen and (max-width:1280px) {

            .loginForm {
                width: 75% !important;
                background-color: #f1f1ec;
                margin-bottom: 158px;

            }

        }
    </style>
</head>

<body>
    <?php require "NAVBAR.php" ?>
    <p class="text-center font mt-5" style="font-size:46px;">Login</p>
    <form method="post" class="p-4 mt-5 mx-auto d-grid loginForm">
        <div class="row">
            <div class="col-12">
                <label class="form-label font" for="email">E-mail<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="email" for="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                <p class="font text-danger"><?= $errors["email"] ?? " " ?></p>
            </div>
            <div class="col-12">
                <label class="form-label font" for="password">Password<i class="text-danger">*</i></label>
                <input class="form-control mb-3" type="password" for="password" id="password" name="password" value="<?= htmlspecialchars($_POST["password"] ?? "") ?>">
                <p class="font text-danger"><?= $errors["password"] ?? " " ?></p>
            </div>
        </div>
        <div class="row">
            <input class="btn w-50 mt-3 m-auto" id="submit" type="submit" name="submit">
            <p class="font text-center mt-3">Are you new over here? <a href="register.php">Sign up</a></p>
        </div>
    </form>

    <?php require './FOOTER.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>