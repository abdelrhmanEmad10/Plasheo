<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="modules/dist/css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="modules/dist/css/home.css">
    <style>
        .imgc {
            position: relative;
            display: inline-block;
        }
        .qv {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            width: 95%;
        }

        .imgc:hover .qv {
            opacity: 1;
        }

        .pqv {
            text-decoration: none;
            color: white;
            cursor: default;
            width: 100%;
            background-color: black;
            opacity: 0.7;
            margin-top: 75%;
        }
    </style>
</head>

<body>
<?php
require "./NAVBAR.php";
?>
<!-- Navebar -->


</nav>
    <div class="container-fluid">
        <?php
            if($_COOKIE["orderPlaced"] ?? ""){
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>{$_COOKIE["orderPlaced"]}!</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <div class="w-100 img-holder my-5 pt-5">
            <div class="mt-5 h-100 d-grid">
                <div class="row">
                    <h1 class="text-white display-3 col-12 ms-5 font">Love the Planet <br> we walk on</h1>
                    <p class="text-white info mt-3 col-12 ms-5">Bibendum fermentum, aenean donec pretium aliquam blandit <br> tempor imperdiet arcu arcu ut nunc in dictum mauris at ut.</p>
                    <a href="./Men.php" class="btn btn-lg btn-outline-light col-12 col-lg-3 mt-3 rounded-0 ms-5">SHOP MEN</a>
                    <a href="./women.php" class="btn btn-lg btn-outline-light col-12 col-lg-3 mt-3 rounded-0 ms-5">SHOP WOMEN</a>
                </div>
            </div>
        </div>
        
        <hr class="h-50">
        
        <div class="w-100 h-50 my-5 row justify-content-center">
            <img src="img/A-shoe.jpg" class="col-lg-6 col-10" alt="shoe">
            <div class="col-lg-6 col-10 d-flex flex-column  justify-content-center">
                <p class="text-about">About Us</p>
                <h1 class="display-4" style="font-weight: bold;">Selected materials <br> designed for comfort <br> and sustainability</h1>
                <p class="text-muted h5 mt-3 lead" style="line-height: normal;">Nullam auctor faucibus ridiculus dignissim sed et <br> auctor sed eget auctor nec sed elit nunc, magna non<br> urna amet ac neque ut quam enim pretium risus <br> gravida ullamcorper adipiscing at ut magna.</p>
            </div>
        </div>

        <hr class="h-50">

        <div class="shoe my-5 p-5">
            <center>
                <h1 class=" font-weight-bold mt-3">See how your shoes are made</h1>
                <p class="text-muted h5 mt-3 lead" style="line-height: normal;">Urna, felis enim orci accumsan urna blandit egestas mattis egestas feugiat viverra ornare donec <br> adipiscing semper aliquet integer risus leo volutpat nulla enim ultrices</p>
            </center>
            <div class="component d-grid mt-5 ">
                <div class="row justify-content-around">
                    <div class="d-flex col-6 col-lg-3 flex-column">
                     <div class="d-flex flex-column  justify-content-center">
                         <p class="text-about">01.</p>
                         <h1 class="font" style="font-weight: bold;">Pet canvas</h1>
                         <p class="text-muted h5 mt-3 lead" style="line-height: normal;">Morbi eget bibendum sit <br> adipiscing morbi ac nisl vitae <br> maecenas nulla cursus</p>
                     </div>
                     <hr>
                     <div class="d-flex  flex-column  justify-content-center">
                         <p class="text-about">02.</p>
                         <h1 class="font" style="font-weight: bold;">Algae foam</h1>
                         <p class="text-muted h5 mt-3 lead" style="line-height: normal;">Morbi eget bibendum sit <br> adipiscing morbi ac nisl vitae <br> maecenas nulla cursus</p>
                     </div>
                 </div>
                 <img src="img/comp-shoe.png" class="h-100 col-5 shoe-img"  alt="ss">
                 <div class="d-flex flex-column col-6 col-lg-3">
                     <div class="d-flex flex-column  justify-content-center">
                         <p class="text-about ml-auto">03.</p>
                         <h1 class=" ml-auto"  style="font-weight: bold;">Organic cotton</h1>
                         <p class="text-muted h5 mt-3 ml-auto lead" style="line-height: normal;">Morbi eget bibendum sit <br> adipiscing morbi ac nisl vitae <br> maecenas nulla cursus</p>
                     </div>
                     <hr>
                     <div class="d-flex flex-column  justify-content-center">
                         <p class="text-about ml-auto">04.</p>
                         <h1 class=" ml-auto" style="font-weight: bold;">Upcycled plastic</h1>
                         <p class="text-muted h5 mt-3 ml-auto lead" style="line-height: normal;">Morbi eget bibendum sit <br> adipiscing morbi ac nisl vitae <br> maecenas nulla cursus</p>
                     </div>
                 </div>
                </div>
               
                
            </div>
        </div>

        <hr class="h-50">

        <div class="shoes  container p-3">
            <div class="row justify-content-between"><h4 class="col-3">New Products</h4> <a href="./collection.php" class="col-2 me-end">All products</a></div>
            <div class="row">
                <!-- {$allProducts[$i]['img-path']} -->
                <?php
                include_once("./project/conn.php");
                $query = "SELECT *
                FROM product
                LIMIT 3;";
                $x = new Connection;
                $result = $x->conn->query($query);
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($rows as $row){
                    $formattedPrice = number_format($row["price"], 2);
                    $rating = str_repeat('★', round($row["rate"])) . str_repeat('☆', 5 - round($row["rate"]));
                    echo '<div class="col-6 fw-bold col-lg-4 mt-3 mb-4">'; //margin t b
                    echo '<a href="http://localhost/project/product1.php?id='.$row["product_id"].'" class=" text-dark h-100" style="text-decoration: none;">';
                    echo '<div class="card border-0 text-center  h-100">';
                    echo '<img src="./' . htmlspecialchars($row["img-path"]) . '" class="card-img-top" alt="./download.jpgrow["name"]) ">';
                    echo '<div class="card-body">';
                    echo '<h4 class="card-title">' . htmlspecialchars($row["name"]) . '</h4>';
                    echo '<p class="price">$' . $formattedPrice . '</p>';
                    echo '<div class="stars">' . $rating . '</div>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <hr>

        <div class="cate d-grid my-5 p-3">
            <div class="row justify-content-around">
                <div class="men  mt-2 col-12 col-lg-5">
                    <center>
                        <h1 class="text-white">
                            MEN
                        </h1>
                        <a href="./Men.php" class="btn btn-lg btn-outline-light rounded-0">SHOP MEN</a>
                    </center>
                </div>
                <div class="women  mt-2 col-12 col-lg-5">
                    <center>
                        <h1 class="text-white">
                            WOMEN
                        </h1>
                        <a href="./women.php" class="btn btn-lg btn-outline-light rounded-0">SHOP WOMEN</a>
                    </center>
                </div>
            </div>
        </div>
        <div class="recycle d-grid">
                <div class="row justify-content-center">
                    <div class="recycle-about text-muted text-center d-flex flex-column col-12 col-lg-6 justify-content-around p-5">
                        <p>Eu eget felis erat mauris aliquam mattis lacus, arcu leo <br> aliquam sapien pulvinar laoreet vulputate sem aliquet <br> phasellus egestas felis, est, vulputate morbi massa <br> mauris vestibulum dui odio.</p>
                        <div>
                            <img src="img/recycled-shoe-badge-1.svg" class="ml-4" alt="sdad">
                            <img src="img/recycled-shoe-badge-2.svg" class="ml-4" alt="sdad">
                            <img src="img/recycled-shoe-badge-3.svg" class="ml-4" alt="sdad">
                        </div>
                    </div>
                    <div class="recycle-image col-12 col-lg-6 p-5">
                        <center>
                            <img src="img/recycled-shoe-store-recycled-circle-iamge.jpg" style="border-radius: 50%;"  alt="ss">
                        </center>
                    </div>
                </div>
        </div>

        <hr>

        <div class="review my-5 d-grid">
            <div class="row my-5 justify-content-center">
                <center>
                    <p class="display-4 m-auto font-weight-bold col-12">Our Customers speak for us</p>
                </center>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star-half" style="color:#f6aa28;" aria-hidden="true"></i>

                            </h5>
                            <p class="card-text review-text font-weight-bold">“Felis semper duis massa scelerisque ac amet porttitor ac tellus venenatis aliquam varius mauris integer”</p>
                            <p class="card-text font-weight-bold">
                                <img src="img/recycled-shoe-store-customer-avatar-image-3.jpg" class=" rounded-circle" alt=""> <span class=" pl-1 lead font-italic">Jennifer Lawernce</span>
                            </p>
                            
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>

                            </h5>
                            <p class="card-text review-text font-weight-bold">“Felis semper duis massa scelerisque ac amet porttitor ac tellus venenatis aliquam varius mauris integer”</p>
                            <p class="card-text font-weight-bold">
                                <img src="img/recycled-shoe-store-customer-avatar-image-2.jpg" class=" rounded-circle" alt=""> <span class=" pl-1 lead font-italic">Abdallah wael</span>
                            </p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star" style="color:#f6aa28;" aria-hidden="true"></i>
                            <i class="fa fa-star-half" style="color:#f6aa28;" aria-hidden="true"></i>

                            </h5>
                            <p class="card-text review-text font-weight-bold">“Felis semper duis massa scelerisque ac amet porttitor ac tellus venenatis aliquam varius mauris integer”</p>
                            <p class="card-text font-weight-bold">
                                <img src="img/recycled-shoe-store-customer-avatar-image-1.jpg" class=" rounded-circle" alt=""> <span class=" pl-1 lead font-italic">Adele Laurie</span>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <h5 class="font-weight-bold text-center col-12">4.8 average rating from 1814 reviews</h5>
            </div>
        </div>
    </div>
    <?php
        require "./FOOTER.php"
    ?>
    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>