<?php
require_once('./config/database.php');
spl_autoload_register(function ($classname) {
  require_once("./app/models/$classname.php");
});

$productModel = new ProductModel();
$productList = $productModel->GetAllProducts();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>NguyenXuanChien_21211TT1565</title>
    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="public/assets/css/cart.css">
    <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="public/assets/css/fontawesome.css">
    <link rel="stylesheet" href="public/assets/css/style.css"> -->
    <link rel="stylesheet" href="public/assets/css/owl.css">
    <link rel="stylesheet" href="public/assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky d-block">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="/Cenn201" class="logo">
                            <img src="public/hinhanh/background/logo.gif" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Search End ***** -->
                        <div class="search-input">
                            <form id="search" action="search.php" method="GET">
                                <input type="text" placeholder="Bạn muốn tìm ..." id='searchText' name="searchText" onkeypress="handle" />
                                <i class="fa fa-search"></i>
                            </form>
                        </div>
                        <!-- ***** Search End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="/Cenn201" class="active">Trang chủ</a></li>
                            <li class="nav-item dropdown d-flex">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sản Phẩm
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li><a href="">Giỏ hàng</a></li>
                            <li><a href="">Dăng nhập<img src="public/hinhanh/background/profile-header.jpg" alt=""></a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-dark"">
                <div class=" page-content p-0">

                <!-- ***** Banner Start ***** -->
                <section class="h-100 h-custom">
                        <div class=" container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <div class="card shopping-cart" style="border-radius: 15px;">
                                <div class="card-body text-black">

                                    <div class="row">
                                        <div class="col-lg-6 px-5 py-4">
                                            <?php
                                            foreach ($productList as $itemproduct) {
                                            ?>
                                                <div class="d-flex align-items-center mb-5">
                                                    <div class="flex-shrink-0">
                                                        <img src="public/hinhanh/product/<?php echo $itemproduct['product_img']; ?>" class="img-fluid" style="width: 100px; height: 110px;" alt="Generic placeholder image">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <a href="#!" class="float-end text-black"><i class="fas fa-times"></i></a>
                                                        <h5 class="text-primary"><?php echo $itemproduct['product_name']; ?></h5>
                                                        <h6 style="color: #9e9e9e;"><?php echo $itemproduct['product_slug']; ?></h6>
                                                        <div class="d-flex align-items-center">

                                                            <p class="fw-bold mb-0 me-5 pe-3"><span style="color: red;"><?php echo number_format(sprintf('%0.3f', $itemproduct['product_price'])) . "đ"; ?></span></p>
                                                            <div class="def-number-input number-input safari_only">
                                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                                                <input class="quantity fw-bold text-black" min="0" name="quantity" value="0" type="number">
                                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            };
                                            ?>
                                            <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">

                                            <div class="d-flex justify-content-between px-x">
                                                <p class="fw-bold">Discount:</p>
                                                <p class="fw-bold">95$</p>
                                            </div>
                                            <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                                                <h5 class="fw-bold mb-0">Total:</h5>
                                                <h5 class="fw-bold mb-0">2261$</h5>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 px-5 py-4">

                                            <form class="">

                                                <div class="form-outline">
                                                    <label class="form-label">Full name : </label>
                                                    <input type="text" id="fullname" class="form-control form-control-lg" siez="17"/>
                                                </div>

                                                <div class="form-outline mb-5">
                                                    <label class="form-label">Phone number :</label>
                                                    <input type="text" id="phonenumber" class="form-control form-control-lg" siez="17" />
                                                </div>
                                                <label class="form-label">address :</label>
                                                <input type="text" id="address" class="form-control form-control-lg" />

                                                <button type="button" class="btn btn-primary btn-block btn-lg my-3">Buy now</button>

                                                </h5>

                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
    </div>
    <!-- ***** Most Popular End ***** -->

    <!-- ***** Gaming Library Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>

                        <i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i>Design: <a href="https://www.facebook.com/Cen201" target="_blank" title="free CSS templates">Cenn201</a> <i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i>
                        <br>
                        Nguyễn Xuân Chiến _ 21211TT1565
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/assets/js/owl-carousel.js"></script>
    <script src="public/assets/js/tabs.js"></script>
    <script src="public/assets/js/popup.js"></script>
    <script src="public/assets/js/custom.js"></script>
</body>

</html>