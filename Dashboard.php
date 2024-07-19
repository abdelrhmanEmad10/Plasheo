<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Order Dashboard</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="./modules/dist/css/footer.css">
    <link rel="stylesheet" href="./modules/dist/css/profile.css">
    <link rel="stylesheet" href="./modules/dist/css/NavBar.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;

        }

        .search {

            top: 6px;
            left: 10px;
        }

        .form-control {

            border: none;
            padding-left: 32px;
        }

        .form-control:focus {

            border: none;
            box-shadow: none;
        }

        .green {

            color: green;
        }
    </style>
</head>
<?php 
session_start();
if(!isset($_SESSION["isAdmin"])){
    header("Location: index.php");
}
?>

<body  style="background-color:#f1f1ec">
    <?php
        require "./project/conn.php";
        $connector = new Connection;
        $query = "
        SELECT orders.orderKey,orders.customer_email,orders.product_id,product.name,orders.quantity,orders.total,orders.created_at
        from orders inner join product
        on orders.product_id = product.product_id
        where orders.delivered = 0
        order by orders.created_at
        ";

        $res = $connector->conn->query($query);

        $result = $res->fetch_all(MYSQLI_ASSOC);
        $orders = [];
        $pastKey = "";
        foreach($result as $val){
            if ($pastKey !== $val["orderKey"]){
                $orders[$val["orderKey"]] = [
                    "key" => $val["orderKey"],
                    "email" => $val["customer_email"],
                    "items" => "$val[name] (x$val[quantity])<br>",
                    "total" => $val["total"],
                    "date" => $val["created_at"]
                ];
                $pastKey = $val["orderKey"];
            }
            else{
                $orders[$pastKey]["items"] .= "$val[name] (x$val[quantity])<br>";
                $orders[$pastKey]["total"] += $val["total"];
            }
        }
    ?>
    <?php require "./NAVBAR.php" ?>

    <?php
    $query = "SELECT * FROM `customer` WHERE `email` = '$_SESSION[email]'";
    try{
        $result = $connector->conn->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e){
        echo $e->getMessage();
    }
    ?>
        <div class="container emp-profile my-5">
            <form method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="profile-head">
                            <div class="row">
                                <h1 class="col-12">Hello To Admin Dashboard,</h1>
                            </div>
                                <p class=" text-muted"><?= $_SESSION['email'] ?> <span class=" text-danger">(Admin)</span></p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Products</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Orders</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="mx-5 my-5 text-center">
        <table class="table table-bordered ">
            <thead>
                <th>
                    Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Rate
                </th>
                <th>
                    Description
                </th>   
                <th>
                    Stock
                </th>
                <th>
                    Category
                </th>
                <th>
                    Action
                </th>
            </thead>

            <?php
            include_once ("./project/conn.php");
            try {
                $conn = new Connection;
                $reslut= $conn->conn->query("SELECT*FROM`product`");
                $row = $reslut -> fetch_all(MYSQLI_ASSOC);
            } catch (Exception $e) {
                die("cannot get data".$e->getMessage());
            }
            foreach ($row as $row) {
                $id=$row['product_id'];
                echo '<tr>';
                foreach ($row as $key => $value) {
                    if ($key != "product_id" && $key != "img-path" && $key != 'created_at' && $key != "updated_at") {
                        if ($value == 1 && $key == "category_id") $value =  "male";
                        else if ($value == 2 && $key == "category_id") $value = "female";
                        else if ($key == "price") $value = $value."$";
                        else if ($key == "rate") $value = $value." <i class='fa-solid fa-star text-warning'></i>";
                        echo "<td>".$value."</td>";
                    }
                }echo "<td class='p-3'>
                <div class='btn-group'>
                    <a class='btn btn-sm btn-success 'href='http://localhost/project/update.php?id=$id'>Update</a>
                    <a class='btn btn-sm btn-danger 'href='http://localhost/project/delete.php?id=$id'>Delete</a>
                </div>
                </td>
                ";
                echo"</tr>";

            }?>

        </table>
        <a class='btn btn-primary' href='add.php' style="border-radius: 0px;">Add New Shoe</a>
    </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="container">
                                            <div class="table-responsive">
                                                <table class="table table-responsive " >
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th scope="col" width="10%">Date</th>
                                                            <th scope="col" width="30%">Email</th>
                                                            <th scope="col" width="30%">Purchased</th>
                                                            <th scope="col" width="10%">Total</th>
                                                            <th scope="col" width="10%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach($orders as $obj){
                                                            echo "<tr>";
                                                            echo "<td>$obj[date]</td>";
                                                            echo "<td>$obj[email]</td>";
                                                            echo "<td>$obj[items]</td>";
                                                            echo "<td>$obj[total]$</td>";
                                                            echo "<td><a class = 'btn btn-success' href='delivered.php?key=$obj[key]'>Deliver</a></td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
            </form>           
        </div>
        </div>


    <?php require "./FOOTER.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>