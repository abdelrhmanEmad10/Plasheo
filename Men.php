<?php

include "./Shoes Project/configre.php";
// Fetch products from the database

$sql = "SELECT product_id, name, price, `img-path`, description, rate FROM product WHERE category_id=1";
$sort_options = [
  '' => 'Default sorting',
  'pop' => 'Sort by Popularity',
  'avg' => 'Sort by avarage rating',
  'lst' => 'Sort by latest',
  'lth' => 'Sort by price: low to high',
  'htl' => 'Sort by price: high to low'
];
// Default sorting option
$sort_option = '';
if (isset($_GET['sort'])) {
  $sort_option = $_GET['sort'];
}

echo "<p class='text-center mb-0 p-2 text-body-tertiary fs-6 fw-semibold bg-secondary-subtle d-none d-lg-block'>Free Express Shipping on all
orders with all duties included 
</p>";
require("./NAVBAR.php");

if (isset($_GET['input_min']) || isset($_GET['input_max'])) {
  $minPrice = $_GET['input_min'];
  $maxPrice = $_GET['input_max'];

  $sql .= " AND price BETWEEN " . $minPrice . " AND " . $maxPrice;
}

// Add sort options to SQL query
if (isset($_GET['sort']) && $_GET['sort'] == 'pop') {
  $sql .= " ORDER BY rate DESC, price DESC";
} elseif (isset($_GET['sort']) && $_GET['sort'] == 'avg') {
  $sql .= " ORDER BY rate DESC";
} elseif (isset($_GET['sort']) && $_GET['sort'] == 'lst') {
  $sql .= " ORDER BY product_id DESC";
} elseif (isset($_GET['sort']) && $_GET['sort'] == 'lth') {
  $sql .= " ORDER BY price ASC";
} elseif (isset($_GET['sort']) && $_GET['sort'] == 'htl') {
  $sql .= " ORDER BY price DESC";
} else {
  $sql .= " ORDER BY product_id ASC";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>PLASHOE || Men Shoe</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Shoes Project/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Shoes Project/style.css">
  <link rel="stylesheet" href="./Shoes Project/Navbar-footer/NavBar.css">
  <link rel="stylesheet" href="./Shoes Project/Navbar-footer/footer.css">
</head>

<body>
  <div class="container mb-4" id="page">
    <div class="row">
      <h1 class="header">Men</h1>
    </div>
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col ff">
        <button class="filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#side" aria-controls="offcanvasWithBothOptions">
          <span class="menue-icon" style="color: #fff;">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
          </span> FILTER SHOES</button>
        <?php
        if ($result->num_rows == 1) {
          echo "<p class='results'>Showing the single result</p>";
        } else {
          echo "<p class='results'>Showing all " . $result->num_rows . " results</p>";
        }
        ?>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="side" aria-labelledby="offcanvasWithBothOptionsLabel">
          <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <!-- ----------------------------filter------------------------------- -->
            <h3 class="mb-4 my-2">Search by name</h3>
            <form class="d-grid form-inlinew-100" action="http://localhost/project/searchPage.php" method="get">
                <div class="row w-100 justify-content-center">
                  <input class="col-12" type="search" name="name" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-secondary col-5 my-2" type="submit">Search</button>
              </div>
            </form>
            <hr>
            <h3 class="mb-4 mt-2">Filter by price</h3>

            <div class="wrapper">
              <form id="form1" method="get">
                <div class="slider">
                  <div class="progress"></div>
                </div>
                <div class="range-input">
                  <input onchange="submitFormOnChange()" type="range" class="range-min" min="40" max="110" value="40" step="1">
                  <input onchange="submitFormOnChange()" type="range" class="range-max" min="40" max="110" value="110" step="1">
                </div>
                <div class="price-input">
                  <div class="field btn">
                    <span>$</span>
                    <input name="input_min" onchange="submitFormOnChange()" type="text" class="input-min" value="40">
                  </div>
                  <div class="field btn">
                    <span>$</span>
                    <input name="input_max" onchange="submitFormOnChange()" type="text" class="input-max" value="110">
                  </div>
                </div>
                <button id="resetButton" style="display: none;" onclick="resetValues()">Reset</button>
              </form>
            </div>



            <!-- -----------list categories------------- -->

            <div class="categories mt-4">
              <ul>
                <li><a href="">Men</a> <span style="color:rgb(151,154,155) ;">(<?php
                                                                                $sql2 = "SELECT product_id, name, price, `img-path`, description, rate FROM product WHERE category_id =1";
                                                                                $result1 = $conn->query($sql2);
                                                                                echo $result1->num_rows;
                                                                                ?>)</span>
                </li>
                <li><a href="">Women</a> <span style="color:rgb(151,154,155) ;">(<?php
                                                                                  $sql3 = "SELECT product_id, name, price, `img-path`, description, rate FROM product WHERE category_id =2";
                                                                                  $result2 = $conn->query($sql3);
                                                                                  echo $result2->num_rows;
                                                                                  ?>)</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- ---------select--------- -->
      <div class="col ll justify-content-start ">
        <form id="form2" method="get">
          <select onchange="submitFormOnChange2()" aria-label="Default select example" class="form-select" name="sort" id="sort">
            <?php foreach ($sort_options as $value => $label) : ?>
              <option value="<?php echo $value; ?>" <?php echo $value === $sort_option ? 'selected' : ''; ?>>
                <?php echo $label; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </form>


        <div class="layout">
          <span onclick="toggleLayout('grid')" id="grid">
            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="bi bi-grid-fill" viewBox="0 0 16 16">
              <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z" />
            </svg>
          </span>
          <span id="list" onclick="toggleLayout('list')">
            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512">
              <path d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
            </svg>
          </span>
        </div>
      </div>
    </div>
    
    <!-- -------------------dynamic cards------------------- -->
    <?php
    if ((isset($_GET['input_min']) || isset($_GET['input_max']))&&($minPrice != 40||$maxPrice != 110)) {
      echo '<div class="row mt-2">';
      echo "<h1 class='active'>Active filters</h1>";
      echo '<div class="fill-cont">';
      if (isset($_GET['input_min'])&&$minPrice != 40) {
        echo '<a style="text-decoration:none;" href="./women.php" class="fil" onclick="updateMin()">
      <span class="clear"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgb(110,112,81)" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
    </svg></span>
    Min $' . number_format($minPrice, 2) . '</a>';
      }
      if (isset($_GET['input_max'])&&$maxPrice != 110) {
        echo '<a style="text-decoration:none;" href="./women.php" class="fil" onclick="updateMax()">
      <span class="clear"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgb(110,112,81)" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
    </svg></span>
    Max $' . number_format($maxPrice, 2) . '</a>';
      }
      echo '</div>';
      echo '</div>';
    }
    
    // Start the Bootstrap card deck
    echo '<div id="cards" class="grid row row-cols-2 row-cols-sm-3">';
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $formattedPrice = number_format($row["price"], 2);
        $rating = str_repeat('★', round($row["rate"])) . str_repeat('☆', 5 - round($row["rate"]));
        echo '<div class="col mt-3 mb-4">'; //margin t b
        echo '<a href="http://localhost/project/product1.php?id='.$row["product_id"].'" class=" h-100" style="text-decoration: none;">';
        echo '<div class="card h-100">';
        echo '<img src="./' . htmlspecialchars($row["img-path"]) . '" class="card-img-top" alt="./download.jpgrow["name"]) ">';
        echo '<div class="card-body">';
        echo '<h4 class="card-title">' . htmlspecialchars($row["name"]) . '</h4>';
        echo '<p class="price">$' . $formattedPrice . '</p>';
        echo '<div class="stars">' . $rating . '</div>';
        echo '<div class="card-text">' .  htmlspecialchars($row["description"]) . '</div>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo "<div class='container mt-3'>
      <div class='row'>
          <div class='zfound'><p>No products were found matching your selection.</p></div>
      </div>
    </div>";
    }

    echo '</div>';
    echo '</div>';
    $conn->close();
    ?>
  </div>
  <script src="./Shoes Project/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  
  <script src="./Shoes Project/script.js">
    const priceInput = document.querySelectorAll(".price-input input")
    <?php echo'priceInput[0]='.$minPrice?>
    <?php echo'priceInput[1]='.$maxPrice?>
  </script>;
  <script>
    function submitFormOnChange() {
      document.getElementById("form1").submit();
    }
    function submitFormOnChange2() {
      document.getElementById("form2").submit();
    }
  </script>
</body>

</html>
<?php
require("./FOOTER.php");
?>