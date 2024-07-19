<?php
include_once("./cookieValidator.php");
  $cookie = new CookieValidator;
  $cookie->validate();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

          <a class="navbar-brand" href="./index.php">PLASHOE</a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./men.php">MEN</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./women.php">WOMEN</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./collection.php">COLLECTION</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./lookbook.php">LOOKBOOK</a>
                </li>
                <?php
                
                if (isset($_SESSION["isAdmin"])){
                  echo "<li class='nav-item'>
                  <a class='nav-link' href='Dashboard.php'>Dashboard</a>
              </li>";
                }
                ?>
                

                </ul>

            </div>

            <ul class="nav justify-content-end">

                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="./ourStory.php" style="color: black;">OUR STORY</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="./contact.php" style="color: black;">CONTACT</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="./Cart.php" style="color: black;">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                      </svg>
                      <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                        <?php
                          if(!isset($_SESSION["cartItems"])){
                            $_SESSION["cartItems"] = 0;
                            echo $_SESSION["cartItems"];
                          } else{
                            echo $_SESSION["cartItems"];
                          }
                        ?>
                        <span class="visually-hidden">unread messages</span>
                      </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="
                  <?php
                  if(isset($_SESSION["email"])){
                    echo "./profile.php";
                  }
                  else{
                    echo "./register.php";
                  }
                  ?>
                  " style="color: black;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                      </svg>
                  </a>
                </li>

              </ul>

        </div>

      </nav>

      <form class="d-grid form-inline bg-light d-lg-none w-100" action="http://localhost/project/searchPage.php" method="get">
        <hr class="m-0">
        <div class="container">
          <div class="row w-100 my-3 justify-content-around">
            <input class="col-7" type="search" name="name" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary col-2 my-2 my-sm-0" type="submit">Search</button>
          </div>
        </div>
      </form>
