<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION["email"])) {
    $query = "select customer_email, cart.product_id, stock , quantity, `img-path`, name, price
        FROM cart INNER JOIN product
        on cart.product_id = product.product_id
        where cart.customer_email = '$_SESSION[email]';";
    require './project/conn.php';
    $conn = new Connection;
    $result = $conn->conn->query($query);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
} else {
    header("Location: home.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Cart.css">
    <link rel="stylesheet" href="./modules/dist/css/NavBar.css">
    <link rel="stylesheet" href="./modules/dist/css/Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body style="background-color:#f1f1ec">
    <p class="text-center m-0 p-2 text-body-tertiary fs-6 fw-semibold bg-secondary-subtle">
        Free Express Shipping on all orders with all duties included
    </p>
    <?php require './NAVBAR.php' ?>

    </form>
    <div class="container bg-white text-center row" style="margin-top: 8rem; margin-bottom: 10rem;margin-left: auto; margin-right: auto;width: 80%;">
        <p class="fw-bold " style="font-size:3rem;">Cart</p>
        <?php
        if ($_COOKIE["itemDeleted"] ?? "") {
            echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>{$_COOKIE["itemDeleted"]}!</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
        }
        ?>
        <div class="row row-cols-lg-2 row-cols-md-1">
            <div class="col-lg-8 col-md-12 table-responsive" style="margin-left: auto; ">
                <table class="table table-bordered">
                    <thead>
                        <tr class="row text-body-tertiary">
                            <th scope="col" class="col" style="width: 5rem;"></th>
                            <th scope="col" class="col text-body-tertiary" style="width: 5rem;">Product</th>
                            <th scope="col" class="col text-body-tertiary" style="width: 5rem;">Price</th>
                            <th scope="col" class="col text-body-tertiary" style="width: 5rem;"> Quantity </th>
                            <th scope="col" class="col text-body-tertiary" style="width: 5rem;">SubTotal</th>
                            <th scope="col" class="col text-body-tertiary" style="width: 5rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $errHappened = false;
                        $updatetxt = '';
                        $inserttxt = '';
                        $cookie = new CookieValidator;
                        $key = $cookie->generateKey(40);
                        $deletetxt = "DELETE FROM `cart` WHERE `customer_email` = '{$_SESSION['email']}';";
                        if (!empty($rows)) {
                            foreach ($rows as $row) {
                                $row['Err'] = "";
                                if ($row['quantity'] > $row['stock']) {
                                    $row['Err'] = "There are only $row[stock] availble of $row[name]";
                                    $errHappened = true;
                                }
                                $mssg = $row['Err'] ?? '';
                                $totalOfOneProduct = $row['quantity'] * $row['price'];
                                $total += $totalOfOneProduct;
                                echo "<tr class='row'>
                                <th scope='row' class='col' style='width: 5rem;'>
                                    <img src='./{$row['img-path']}' alt='img1' class='rounded img-fluid h-50'>
                                </th>
                                <td class='col'>
                                    <a href='./product1.php?id={$row['product_id']}' style='text-decoration: none;color: grey;cursor: pointer'>{$row['name']}</a>
                                </td>
                                <td class='col' style='width: 5rem;'>
                                    <span class='text-body-tertiary fw-bold fs-6' id='price'>\${$row['price']}</span>
                                </td>
                                <td class='col ' style='width: 5rem;'>
                                    
                                    <button type='button' class='btn btn-light bg-none text-dark text-center' id='number'
                                        disabled style='border-radius: 0;height: min-content;width: 1rem;'>{$row['quantity']}</button>
                                    <br><span class='text-danger'>$row[Err]</span>
                                    
                                </td>
                                <td class='col' style='width: 5rem;'>
                                    <span class='text-body-tertiary fw-bold fs-6' id='st'>$$totalOfOneProduct</span>
                                </td>
                                <td class='col' style='width: 5rem;'>
                                    <a href='./deleteFromCart.php?id={$row['product_id']}'>
                                        <i class='fa-solid fa-circle-minus text-danger'></i>
                                    </a>
                                </td>
                            </tr>";
                                $updatetxt .= "UPDATE `product` SET `stock`= `stock` - $row[quantity] WHERE `product_id` = $row[product_id];";
                                $inserttxt .= "INSERT INTO `orders`(`quantity`, `total`, `address`, `customer_email`, `product_id`, `orderKey`) VALUES ($row[quantity],$totalOfOneProduct,'{$_SESSION['address']}','$_SESSION[email]',$row[product_id],'$key');";
                            }
                        } else {
                            $errHappened = true;
                            echo "<tr class='row '>
                                <th scope='row' class='col'>
                                    No product
                                </th>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style=" margin:auto ;" class="col-lg-3 col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="row">
                            <th scope="col">Cart Totals</th>
                        </tr>
                    </thead>
                    <tbody class="" style="justify-content: center;text-align: center;">
                        <tr class="row">
                            <th>
                                <p class="text-body-tertiary fw-lighter" id="CartTotal">Total <span>$<?= $total ?></span></p>
                            </th>
                        </tr>
                        <tr class="row">
                            <th>
                                <form action="./placeOrder.php" id="placeOrderForm" method="post">
                                    <a id="placeOrder" <?= $errHappened ? '' : "onClick='placeOrder()'" ?> class="btn" style="background-color: #6A6E09;width: 100%;color: white; border-radius: 0px; text-decoration:none;">Place Order</a>
                                </form>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <?php require './FOOTER.php' ?>

</body>
<script src="./modules/dist/js/Cart.js"></script>
<script>
    function placeOrder() {
    console.log(5);
        document.getElementById('placeOrderForm').innerHTML +=
            "<textarea name='inserttxt' class='d-none'><?= $inserttxt ?></textarea><textarea name='updatetxt' class='d-none'><?= $updatetxt ?></textarea><textarea name='deletetxt' class='d-none'><?= $deletetxt ?></textarea>"
        document.getElementById('placeOrderForm').submit()
    }
</script>
<script src="https://kit.fontawesome.com/8c78e594e2.js" crossorigin="anonymous"></script>

</html>