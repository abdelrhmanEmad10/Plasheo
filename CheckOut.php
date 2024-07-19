<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>CheckOut</title>
    <style>
        body{
            background-color: #f1f1ef;
        }
        .order-items{
            height: max-content;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand m-auto" href="./index.php">Home</a>
    </nav>
    <div class="container my-5">
        <div class="checkout bg-light d-grid">
            <div class="row pt-4 justify-content-center text-center">
                <h5 class="display-1 col font-weight-bold">Checkout</h5>
            </div>
            <div class="row p-5">
                <div class="info col-12 col-lg-8">
                    <h3 class="font-weight-bold">Customer information</h3>
                    <input type="Email" class=" form-control-lg col-12 my-3 border-1" placeholder="Enter Your Email:" name="Email">
                    <h3 class="font-weight-bold">Billing details</h3>
                    <div class="d-grid">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class=" form-control-lg w-100 mt-3 border-1" placeholder="First Name:" name="FirstName">
                            </div>
                            <div class="col-6">
                                <input type="text" class=" form-control-lg w-100 mt-3 border-1" placeholder="last Name:" name="lastName">
                            </div>
                            <div class="col-12">
                                <input type="text" class=" form-control-lg col-12 mt-3 border-1" placeholder="Company Name:" name="Company">
                            </div>
                            <div class="col-12">
                                <select class="form-select form-select-lg col-12 p-2 mt-3 border-1" aria-label="Default select example">
                                    <option selected value="egypt">Egypt</option>
                                    <option value="libya">Libya</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="lebanon">lebanon</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <input type="text" class=" form-control-lg w-100 mt-3 border-1" placeholder="Town or city:" name="town">
                            </div>
                            <div class="col-4">
                                <input type="text" class=" form-control-lg w-100 mt-3 border-1" placeholder="state:" name="state">
                            </div>

                            <div class="col-4">
                                <input type="text" class=" form-control-lg w-100 mt-3 border-1" placeholder="PostCode:" name="post-code">
                            </div>
                            <div class="col-6">
                                <input type="text" class=" form-control-lg w-100 mt-3 border-1" placeholder="House number:" name="house">
                            </div>
                            <div class="col-6">
                                <input type="text" class=" form-control-lg w-100 mt-3 border-1" placeholder="Floor and Apartment:" name="floor-apartment">
                            </div>
                            <div class="col-12">
                                <input type="number" class=" form-control-lg w-100 mt-3 border-1" placeholder="Floor and Apartment:" name="lastName">
                            </div>
                        </div>
                    </div>
                    <h3 class="font-weight-bold my-3">Additional information</h3>
                    <textarea name="info" class="w-100 p-2" placeholder="Any additional notes about order:"></textarea>
                    <h3 class="font-weight-bold my-3">Your payment</h3>
                    <button class="m-auto btn btn-lg btn-secondary">Pay Now</button>
                </div>


                <div class="your-order col-12 my-5 my-lg-0 col-lg-4 ">
                    <h3 class="font-weight-bold mb-3">Your Order</h3>
                    <div class="order-items rounded border border-dark w-100 d-grid">
                        <div class="row ms-1 pt-2 justify-content-between w-100 p-2">
                            <h5 class="text-muted col-3 d-inline-block ps-1">Product</h5>
                            <h5 class="text-muted col-3 me-3 me-lg-2 d-inline-block">SubTotal</h5>
                        </div>

                        <hr>

                        <div class="item p-1 row align-items-center ms-1 align-content-center justify-content-around w-100">
                            <img src="img/shoe-1.jpg" class="rounded col-2" width="40" height="40" alt="..">
                            <p class="text-muted col-7 ">Men's Black Running X <span class="quantity">3</span></p>
                            <p class="text-muted font-weight-bold me-4 me-lg-3 col-2">$239.70</p>
                        </div>

                        <hr>

                        <div class="item p-1 row align-items-center ms-1 align-content-center justify-content-around w-100">
                            <img src="img/shoe-1.jpg" class="rounded col-2" width="40" height="40" alt="..">
                            <p class="text-muted col-7 ">Men's Black Running X <span class="quantity">3</span></p>
                            <p class="text-muted font-weight-bold me-4 me-lg-3 col-2">$239.70</p>
                        </div>

                        <hr>

                        <div class="item p-1 row align-items-center ms-1 align-content-center justify-content-around w-100">
                            <img src="img/shoe-1.jpg" class="rounded col-2" width="40" height="40" alt="..">
                            <p class="text-muted col-7 ">Men's Black Running X <span class="quantity">3</span></p>
                            <p class="text-muted font-weight-bold me-4 me-lg-3 col-2">$239.70</p>
                        </div>

                        <hr>

                        <div class="row mx-1 p-2 align-items-center justify-content-between w-100">
                            <h3 class="text-muted col-3 d-inline-block ps-1">Total</h3>
                            <h5 class="text-muted col-3 font-weight-bold me-2 me-lg-1 d-inline-block">$239.70</h5>
                        </div>
    
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>