<!DOCTYPE html>
<html lang="en">
<?php
$id = $_GET['id'];
$query = "SELECT * FROM `product` WHERE product_id =$id";
require './project/conn.php';
$x = new Connection;

// getting product info
$result= $x->conn->query($query);
$rows= $result->fetch_all(MYSQLI_ASSOC);
$product= $rows[0];

// number of rows in table
$allProducts= $x->conn->query('SELECT * FROM product');
$NofRows = $allProducts->num_rows;
$allProducts= $allProducts->fetch_all(MYSQLI_ASSOC);

for($i=0;$i<sizeof($allProducts);$i++){
    if($allProducts[$i]['product_id'] == $id){
        $prevId = $allProducts[$i-1]['product_id'] ?? $allProducts[$i]['product_id'];
        $nextId = $allProducts[$i+1]['product_id'] ?? $allProducts[$i]['product_id'];
    }
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./modules/dist/css/Product1.css">
    <link rel="stylesheet" href="./modules/dist/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>product</title>
</head>

<body style="background-color:#f1f1ec">
        <p class="text-center mb-0 p-2 text-body-tertiary fs-6 fw-semibold bg-secondary-subtle">Free Express Shipping on all
            orders with all duties included 
        </p>
        <?php require './NAVBAR.php' ?>
        <form class="d-grid form-inline bg-light w-100 d-lg-none">
            <hr class="m-0">
            <div class="container">
                <div class="row w-100 my-3 justify-content-around">
                    <input class="col-7" type="search" name="Product-Name" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success col-2 my-2 my-sm-0" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
        <div class="container bg-white " style="margin-top: 3rem; margin-bottom: 3rem;">
            <div class="row row-cols-sm-1 row-cols-md-2 ">
                <div class="col col-6 text-center">
                    <img src="<?php echo $product['img-path']  ?>" alt="img1" class="rounded img-fluid w-75 "
                        style="margin-top: 5%; margin-bottom: 5%;">
                </div>
                <div class="col col-5" style="margin-top: 2%;margin-bottom: 5%;">
                    <div class="" style="justify-content: space-between; display: flex;">
                        <div>
                            <a href="#"
                                style="text-decoration: none;color: #677050;cursor: pointer;font-size: large;"><?php echo $product['category_id']==1?"Men":'Women'  ?></a>
                        </div>
                        <div>
                            <a href="http://localhost/project/product1.php?id=<?php echo $prevId ?>" aria-disabled="true" class="btn " style="background-color:#677050; color: white;"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                </svg></a>

                            <a href="http://localhost/project/product1.php?id=<?php echo $nextId ?>" class="btn" style="background-color: #677050 ;color: white;"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />

                                </svg></a>
                        </div>
                    </div>
                    <div class="my-1">
                        <?php
                            if($_COOKIE["itemAdded"] ?? ""){
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>{$_COOKIE["itemAdded"]}!</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                ";
                            }
                            if($_COOKIE["itemUpdated"] ?? ""){
                                echo "
                                <div class='alert alert-primary alert-dismissible fade show' role='alert'>
                                    <strong>{$_COOKIE["itemUpdated"]}!</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                ";
                            }
                        ?>
                    </div>
                    <div class="text-start">
                        <p class="text-dark fw-semibold fs-2 d-inline"><?php echo $product['name'] ?></p>
                    </div>
                    <p>
                        <span class="text-body-tertiary fw-bold fs-3">$<?php echo $product['price'] ?></span>
                        <span class="text-body-tertiary fs-5 fw-semibold"> & Free shiping </span>
                    </p>
                    <p class="text-body-tertiary fw-semibold fs-5" id="description"><?php echo $product['description'] ?>
                    </p>


                    <form action="./addToCart.php" id='addToCartForm' method="post">
                                <div class="d-flex text-center btn-group " style="width: fit-content; margin-bottom: 2%;">
                                <button type="button" class="btn btn-outline-secondary bg-none text-dark"
                                    id="minusButton" style="border-radius: 0;">-</button>
                                <button type="button" class="btn border-start-0 border-end-0 bg-none text-dark" id="number"
                                    disabled style="border-radius: 0;">1</button>
                                <button type="button" class="btn btn-outline-secondary bg-none text-dark"
                                    id="plusButton" style="border-radius: 0;">+</button>
                                
                                <a class="btn"
                                    style="background-color: #677050; text-decoration:none;  color: white; margin-left: 1rem; border-radius: 0;" id="add-to-cart" onclick="addToCart(<?php echo $id ?>)">ADD TO CART</a>
                                </div>
                            </form>


                    <div class="border-top">
                        <p class="text-body-tertiary mt-2">Category:
                            <a href="#" style="text-decoration: none;color: #6A6E09;"><?php echo $product['category_id']==1?"Men":'Women'  ?></a>
                        </p>
                    </div>
                    <div class="text-center border" style="position: relative; padding: 30px;">
                        <span class="text-body-tertiary fw-bold fs-5"
                            style="position: absolute; top: 0; margin-top: -15px; margin-left: -125px; background-color: white;">Guaranteed
                            Safe Checkout</span>
                        <div style="justify-content: space-around;">
                            <img src="./img/v2.jpg" alt="img1" class="rounded img-fluid  " style="width: 50%;">
                        </div>

                    </div>
                </div>
            </div>
            <div class="border-top " style="padding: 1rem;margin: 1rem;">
                <button class='btn bg-none text-dark fs-4' onclick='showDescription()'>Description</button>
                <button class='btn bg-none text-dark fs-4' onclick='showReview()'>Review</button>
                <div id='displayText' class='text-body-tertiary fs-5 fw-semibold '>
                </div>
            </div>
            <div class="p-4">
                <h1>Related Products</h1>
                <div class="row row-cols-md-3 row-cols-sm-1">
                    <?php 
                        for($i=0;$i<3;$i++){
                            echo "<div class='fw-bold text-center col imgc'>
                            <a href='http://localhost/project/product1.php?id={$allProducts[$i]['product_id']}' style='text-decoration: none;'>
                            <img src='./{$allProducts[$i]['img-path']}' alt='img1' class='rounded img-fluid w-95 '>
                            <div class='qv'>
                                <p class='pqv'>Quick View</p>
                            </div>
                            <div class='col'>
                                <a href='#' style='text-decoration: none;color:black;cursor: pointer ;'>{$allProducts[$i]['name']}</a>
                                <br>
                                <span class='text-body-tertiary fw-bold fs-6'>\${$allProducts[$i]['price']}</span>
                                <br>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                            </div>
                            </a>
                        </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php require './FOOTER.php' ?>
</div>
    <script>
        let number = 1;
        function updateNumber(value) {
        number = Math.max(1, number + value);
        document.getElementById("number").innerText = number;
        }

        document.getElementById("plusButton").addEventListener("click", function () {
        updateNumber(1);
        });

        let description = document.getElementById("description").innerHTML

        console.log(description);

        document.getElementById("minusButton").addEventListener("click", function () {
        updateNumber(-1);
        });

        function addToCart (id , quantity=document.getElementById("number").innerText){
            let email = '<?= $_SESSION['email'] ?? '' ?>'
            if (email){
                document.getElementById('addToCartForm').innerHTML += `<input type="text" class=" d-none" value='${quantity}' id="Quantity" name="Quantity"><input type="text" value='${id}' class=" d-none" id="Id" name="Id">`
                document.getElementById("addToCartForm").submit();
            }else{
                alert('You need to Login.')
            }
        }

        function showDescription() {
        document.getElementById("displayText").innerText = description;
        }

        function showReview(){
        document.getElementById("displayText").innerHTML =
            "there are no reviews yet <br><div class='border border-2 container' style='padding: 1rem;'><h3>be the first to review</h3> <p>Your email address will not be published. Required fields are marked *</p> <div class='rate'> <p class='d-inline'>Your rate <span class='Required'>*</span></p> <input type='radio' id='star5' name='rate' value='5' /> <label for='star5' title='text'>5 stars</label> <input type='radio' id='star4' name='rate' value='4' /> <label for='star4' title='text'>4 stars</label> <input type='radio' id='star3' name='rate' value='3' /> <label for='star3' title='text'>3 stars</label> <input type='radio' id='star2' name='rate' value='2' /> <label for='star2' title='text'>2 stars</label> <input type='radio' id='star1' name='rate' value='1' /> <label for='star1' title='text'>1 star</label> </div> <br> <br><p>Your Review <span class='Required'>*</span></p><textarea class='w-100' row='10'></textarea><form class='row g-3'><div class='col-md-6'><label for='inputEmail4' class='form-label'>Email<span class='Required'>*</span></label><input type='email' class='form-control ' id='inputEmail4'></div><div class='col-md-6'><label for='inputPassword4' class='form-label'>Name<span class='Required'>*</span></label><input type='text' class='form-control ' id='inputPassword4'></div><div class='col-12'><div class='form-check'><input class='form-check-input' type='checkbox' id='gridCheck'><label class='form-check-label' for='gridCheck'>Save my name, email, and website in this browser for the next time I comment.</label></div></div><div class='col-12'><button type='submit' class='btn text-light' style='background-color: #6A6E09;'>submit</button></div></form></div></div> ";
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>