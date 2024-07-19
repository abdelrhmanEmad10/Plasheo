<?php
include_once("./project/conn.php");
$conn = new Connection;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["submit"])) {
        include_once("./validator.php");
        $form = new Validator($_POST, "product");
        $errs = $form->validateForm();
        if (sizeof($errs) == 0) {
            $_POST = array_map(function ($obj) {
                return trim($obj);
            }, $_POST);
            try {
                
                $x = $conn->conn->prepare("INSERT INTO `product`(`name`, `img-path`, `price` , `category_id`, `rate`, `description`, `stock`) VALUES (?,?,?,?,?,?,?)");
                $x->bind_param("ssdidsi",$_POST["name"],$_POST["img-path"],$_POST['price'],$_POST['category_id'],$_POST['rate'],$_POST['description'],$_POST['stock']);
                $x->execute();
                $x->close();
                header("location:http://localhost/project/dashboard.php");
            } catch (Exception $e) {
                die("cannot insert" . $e->getMessage());
            }
        }
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./modules/dist/css/footer.css">
    <link rel="stylesheet" href="./modules/dist/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>

<body>
    <?php require "./NAVBAR.php" ?>
    <div class="container my-5">
        <form method="post">
            <form method="post" class="d-grid">
                <div class="row mb-3">
                    <div class="col-12 col-lg-4">
                        <label class="form-label"> Name </label>
                        <input class="form-control" name="name" type="text">
                        <p class="text-danger"><?= $errs["name"] ?? "" ?></p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="form-label"> img-path </label>
                        <input class="form-control" name="img-path" type="text">
                        <p class="text-danger"><?= $errs["img-path"] ?? "" ?></p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="form-label"> Price </label>
                        <input class="form-control" name="price" type="number">
                        <p class="text-danger"><?= $errs["price"] ?? "" ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-4">
                        <label class="form-label"> Rate </label>
                        <input class="form-control" name="rate" type="number" step="0.01">
                        <p class="text-danger"><?= $errs["rate"] ?? "" ?></p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="form-label"> Category </label>
                        <select class="form-select" name="category_id">
                            <?php

                            if ($res["category_id"] == 1) {
                                $male = "selected";
                            } else if ($res["category_id"] == 2) {
                                $female = "selected";
                            } else {
                                $default = "selected";
                            }

                            ?>
                            <option <?= $default ?? "" ?> hidden></option>
                            <option <?= $male ?? "" ?> value='1'>male</option>
                            <option <?= $female ?? "" ?> value='2'>female</option>;


                        </select>
                        <p class="text-danger"><?= $errs["category_id"] ?? "" ?></p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="form-label"> Stock </label>
                        <input class="form-control" name="stock" type="text">
                        <p class="text-danger"><?= $errs["stock"] ?? "" ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label"> Description </label>
                        <textarea class="form-control" name="description" rows='5'></textarea>
                        <p class="text-danger"><?= $errs["description"] ?? "" ?></p>
                    </div>
                </div>
                <button class="col-1 btn btn-primary mt-3" style="border-radius: 0px;" name="submit" type="submit">
                    Update
                </button>
            </form>
        </form>
    </div>
    <?php require "./FOOTER.php" ?>
</body>

</html>