<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modules/dist/css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="modules/dist/css/home.css">
    <link rel="stylesheet" href="modules/dist/css/search.css">
    <title>Document</title>
</head>
<body style="background-color:#f1f1ec">
    <?php
    require "./NAVBAR.php";
    ?>

    <!-- NAVBAR -->
    <div class="container my-5 p-3 bg-light">
        <div class='container-fluid my-3'>
            <div class='row'>
                <div class='col'>
                    <h1 class='display-1 font-weight-bold fw-normal' style="color: #6e7051;">Shop</h1>
                </div>
            </div>
            <div class='row'>
                <div class='col d-flex align-items-center'>
                    <button class="filter p-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#side" aria-controls="offcanvasWithBothOptions">
                        <span><i class="fa fa-bars" style="color: #fff;"></i></span> FILTER SHOES
                    </button>
                    <p class=" ms-2 mb-0 font-italic">Showing 8 items</p>

                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="side">
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <form class="d-grid form-inline w-100" method="post">
                                <div class="container">
                                    <div class="row w-100 my-3 justify-content-around">
                                        <input class="col-7" type="search" name="Product-Name" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-primary col-4 my-2 my-sm-0" type="submit">Search</button>
                                    </div>
                                </div>
                                <hr class="m-0">
                            </form><br>
                            <!-- ----------------------------filter------------------------------- -->
                            <h3>Filter by price</h3>
                            <div aria-hidden="true">
                                <!-- ------- slider-------- -->
                                <div class="slider">
                                    <div class="progress">
                                    </div>
                                </div>
                                <!-- <div class="range-input">
                                    <input type="range" step="1" min="40" value="2500" max="110" class="range-min">
                                    <input type="range" step="1" min="40" value="7500" max="110" class="range-max">
                                </div>
                                <div class="price-input">
                                    <input type="number" class="input-min" value="2500">
                                    <input type="number" class="input-max" value="7500">
                                </div> -->
                            </div>

                        <!-- -----------list categories------------- -->

                        <div class="categories">
                            <ul>
                                <li><a href="">Men</a> <span style="color:rgb(151,154,155) ;">()</span>
                                </li>
                                <li><a href="">Women</a> <span style="color:rgb(151,154,155) ;">()</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                </div>
                <div class='col-3 d-grid'>
                    <div class="row align-items-center align-content-center justify-content-center">
                        <select class="col form-select">
                            <option selected>Default sorting</option>
                            <option value="pop">Sort by popularity</option>
                            <option value="avg">Sort by avarage rating</option>
                            <option value="lst">Sort by latest</option>
                            <option value="lth">Sort by price: low to hight</option>
                            <option value="htl">Sort by price: hight to low</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    if($_POST['Product-Name']){
                        $name = $_POST['Product-Name'];
                        $query = "SELECT * FROM `product` WHERE LOWER(name) LIKE '%$name%'";
                        require './project/conn.php';
                        $x = new Connection;
                        $result= $x->conn->query($query);
                        $rows= $result->fetch_all(MYSQLI_ASSOC);
                        // echo "<pre>";
                        // print_r($rows);
                        // echo "<\pre>";
                        if($result->num_rows >0){
                            foreach($rows as $row){
                                echo "<a class='col-6 col-lg-4' href='./product1.php?id={$row['product_id']}' style='text-decoration: none;'>
                                <div class='card mt-3 border-0'>
                                <img class='card-img-top' src='{$row['img-path']}' alt='Card image cap'>
                                <div class='card-body text-center'>
                                <h5 class='card-title'>{$row['name']}</h5>
                                <p class='card-text text-muted lead'>
                                    <s class=' text-muted'>\${$row['price']}</s>
                                    <span class='d-inline-block ms-2 font-weight-bold'>\${$row['price']}</span>
                                </p>
                                </div>
                                </div>
                                </a>";
                            }
                        }else{
                            echo "<div class='row'>
                                        <div class='col'><div class='zfound'><p>No products were found matching your selection.</p></div></div>
                                    </div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>