<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="./modules/dist/css/profile.css">
        <link rel="stylesheet" href="./modules/dist/css/footer.css">
        <link rel="stylesheet" href="./modules/dist/css/navbar.css">
        <link rel="stylesheet" href="./modules/dist/css/obaidaGlobal.css">
        <style>
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
    <body style="background-color:#f1f1ec">

        <?php
        session_start();
        require "./project/conn.php";
        $query = "SELECT * FROM `customer` WHERE `email` = '$_SESSION[email]'";
        try{
            $conn = new Connection;
            $result = $conn->conn->query($query);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e){
            echo $e->getMessage();
        }
        require "./NAVBAR.php";
        ?>
        <div class="container emp-profile my-5">
            <form method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="profile-head">
                            <div class="row">
                                <h1 class="col-9 font">Hello <?= $_SESSION['name'] ?>,</h1>
                                <div class="col-3">
                                    <a href="logout.php" class="btn btn-danger font">Logout</a>
                                </div>
                            </div>
                            <p class=" text-muted font"><?= $_SESSION['email'] ?></p>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active font" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">About</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Order</button>
                                </li>
                            </ul>
                            </div>
                            <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font" >address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="font"><?= $_SESSION["address"] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font">Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="font"><?= $_SESSION["name"] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font">Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="font"><?=  $_SESSION["email"] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                        if($rows[0]["phone"] ?? ""){

                                            echo "<div class='row'>
                                                <div class='col-md-6'>
                                                    <label>Phone</label>
                                                </div>
                                                <div class='col-md-6'>
                                                    <p>{$rows[0]['phone']}</p>
                                                </div>
                                                </div>";
                                        }
                                        ?>
                                        <?php
                                        if($rows[0]["Birthdate"] ?? ""){
                                            echo "<div class='row'>
                                                <div class='col-md-6'>
                                                    <label>Birth date</label>
                                                </div>
                                                <div class='col-md-6'>
                                                    <p><?=  {$rows[0]['BirthDate']} ?></p>
                                                </div>
                                            </div>";
                                        }
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <?php  
                                            $query = "
                                                SELECT orders.orderKey,orders.customer_email,orders.delivered,orders.product_id,product.name,orders.quantity,orders.total,orders.created_at
                                                from orders inner join product
                                                on orders.product_id = product.product_id
                                                where orders.customer_email = '$_SESSION[email]'
                                                order by orders.created_at
                                                ";
                                            $res = $conn->conn->query($query);
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
                                                        "date" => $val["created_at"],
                                                        "delivered" => $val["delivered"]
                                                    ];
                                                    $pastKey = $val["orderKey"];
                                                }
                                                else{
                                                    $orders[$pastKey]["items"] .= "$val[name] (x$val[quantity])<br>";
                                                    $orders[$pastKey]["total"] += $val["total"];
                                                }
                                            }
                                        ?>

                                        <div class="table-responsive  ">
                                            <table class="table table-responsive " >
                                                <thead>
                                                    <tr class="bg-light">
                                                        <th scope="col" width="10%" class="font">Date</th>
                                                        <th scope="col" width="30%" class="font">Email</th>
                                                        <th scope="col" width="30%" class="font">Purchased</th>
                                                        <th scope="col" width="10%" class="font">Total</th>
                                                        <th scope="col" width="10%" class="font">Deliverted</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($orders as $obj){
                                                        $isdelivered = $obj['delivered']==0?"In proccess⌛":"delivered ✔️";
                                                        echo "<tr>";
                                                        echo "<td class='font' >$obj[date]</td>";
                                                        echo "<td class='font' >$obj[email]</td>";
                                                        echo "<td class='font' >$obj[items]</td>";
                                                        echo "<td class='font' >$obj[total]$</td>";
                                                        echo "<td class='font' >$isdelivered</td>";
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
            </form>           
        </div>
        </div>




        <!-- Bootstrap JavaScript Libraries -->
        <?php require "./FOOTER.php"  ?>
        <script>
            function profiletoggle(){
                document.getElementById("nav-toggle").innerHTML = `<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Hourly Rate</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>10$/hr</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Total Projects</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>230</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Availability</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>6 months</p>
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                                </div>
                            </div>`
            }
        </script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>
