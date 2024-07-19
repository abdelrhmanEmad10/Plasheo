<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shoe</title>
    <link rel="stylesheet" href="./modules/dist/css/obaidaGlobal.css">
    <link rel="stylesheet" href="./modules/dist/css/obaidaContact.css">
    <link rel="stylesheet" href="./modules/dist/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php
        if(isset($_POST["submit"])){
            require "validator.php";
            $validation = new Validator($_POST,"contact");
            $errors = $validation->validateForm();
        }
    ?>
</head>

<body>
    <?php require "NAVBAR.php" ?>
    <h1 class="font text-center my-5" style="font-size:65px;">Contact</h1>
    <div class="contianer m-auto d-grid " style="background-color:#f1f1ec;width:95%;">
        <div class="row section">
            <div class="contactFull col-12 col-md-4 d-flex flex-column justify-content-between ">
                <div class="contactSections d-flex flex-column mt-2 mb-4 " style="border-width:0px 0px 1px 0px;border-color:#e6e6e1;border-style: solid;">
                    <p class="font" style="font-size:20px;">
                        <i class="fa-solid fa-mobile-screen-button mx-2" style="color:#677050;"></i>
                        Products & order
                    </p>
                    <p class="font" style="font-size:17px;color:grey">
                        (+1) 123-456-7890
                        available 24/7
                    </p>
                </div>
                <div class="contactSections d-flex flex-column mt-2 mb-4 " style="border-width:0px 0px 1px 0px;border-color:#e6e6e1;border-style: solid;">
                    <p class="font" style="font-size:20px;">
                        <i class="fa-solid fa-mobile-screen-button mx-2" style="color:#677050;"></i>
                        Info & enquiries
                    </p>
                    <p class="font" style="font-size:17px;color:grey">
                        (+1) 123-456-7890
                        available 24/7
                    </p>
                </div>
                <div class="contactSections d-flex flex-column mt-2 mb-4 " style="border-width:0px 0px 1px 0px;border-color:#e6e6e1;border-style: solid;">
                    <p class="font" style="font-size:20px;">
                        <i class="fa-solid fa-location-dot mx-2" style="color:#677050;"></i>
                        Store locator
                    </p>
                    <p class="font" style="font-size:17px;color:grey">
                        Find our retail near you
                    </p>
                </div>
                <div class="contactSections d-flex flex-column mt-2 mb-4 " style="border-width:0px 0px 1px 0px;border-color:#e6e6e1;border-style: solid;">
                    <p class="font" style="font-size:17px;">
                        STAY IN TOUCH
                    </p>
                    <div class="d-flex justify-content-evenly mb-3 " style="width:40%">
                        <a class="fa-brands fa-facebook text-decoration-none" style="color:#677050;font-size:20px;"></a>
                        <a class="fa-brands fa-twitter text-decoration-none" style="color:#677050;font-size:20px;"></a>
                        <a class="fa-brands fa-youtube text-decoration-none" style="color:#677050;font-size:20px;"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex">
                <form method="post" class="contactForm w-100 ">
                    <div class="mb-4">
                        <label for="name" class="font label mb-3" style="font-size:20px;">Name<i class="text-danger">*</i></label>
                        <input type="text" name="name" id="name" class="form-control" style="border-radius:2px;height:45px;font-size:23px;" value ="<?=htmlspecialchars($_POST["name"] ?? "")?>">
                        <p class="font text-danger mt-3"><?=$errors["name"] ?? ""?></p>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="font label mb-3" style="font-size:20px;">Email<i class="text-danger">*</i></label>
                        <input type="text" name="email" id="email" class="form-control" style="border-radius:2px;height:45px;font-size:23px;" value ="<?=htmlspecialchars($_POST["email"] ?? "")?>">
                        <p class="font text-danger mt-3"><?=$errors["email"] ?? ""?></p>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="font label mb-3" style="font-size:20px;">Comment or Message<i class="text-danger">*</i></label>
                        <textarea type="text" name="comment" id="comment" class="form-control" style="border-radius:2px;height:45px;font-size:23px;height:140px"><?=htmlspecialchars($_POST["comment"] ?? "")?></textarea>
                        <p class="font text-danger mt-3"><?=$errors["comment"] ?? ""?></p>
                    </div>
                    <input class="btn mt-3" type="submit" value="SEND MESSAGE" id="submit" name="submit">
                </form>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <p class="font text-center" style="font-size:50px;margin-top:100px">Frequently Asked Questions</p>
        <p class="text-center mb-5" style="font-size:19px;font-weight:300;color:grey;">Purus amet scelerisque nisl nibh felis massa a enim gravida</p>
        <center>
            <hr class="accor">
        </center>
        <div class="accor accordion m-auto" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button font" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Quam ligula tristique sed leo nunc aenean amet
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed font" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Tortor eget a a tincidunt est viverra turpis
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed font" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Quis cras urna diam id nec amet
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed font" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Id congue bibendum velit blandit massa elementum
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require './FOOTER.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>