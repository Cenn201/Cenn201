<?php
require_once('./config/database.php');
spl_autoload_register(function ($classname) {
    require_once("./app/models/$classname.php");
});


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productModel = new ProductModel();
    $itemproduct = $productModel->GetProduct($id);
    if(!isset($_COOKIE['viewedProduct'])) {
        $value = [$id];
        setcookie('viewedProduct', json_encode($value), time() + 3600);
    }
    else {
        $viewedProduct = json_decode($_COOKIE['viewedProduct'], true);
        if(!in_array($id, $viewedProduct)) {
            if(count($viewedProduct) == 5) {
                array_shift($viewedProduct);
            }
            array_push($viewedProduct, $id);
            setcookie('viewedProduct', json_encode($viewedProduct), time() + 3600);
        }
        else {
            unset($viewedProduct[array_search($id, $viewedProduct)]);
            array_push($viewedProduct, $id);
            setcookie('viewedProduct', json_encode($viewedProduct), time() + 3600);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title><?php echo $itemproduct['product_name']; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


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
    <header class="header-area header-sticky d-inline">
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
                                <input type="text" placeholder="B???n mu???n t??m ..." id='searchText' name="searchText" onkeypress="handle" />
                                <i class="fa fa-search"></i>
                            </form>
                        </div>
                        <!-- ***** Search End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="/Cenn201" class="active">Trang ch???</a></li>
                            <li><a href="">S???n ph???m</a></li>
                            <li><a href="">Tin t???c</a></li>
                            <li><a href="">Gi??? h??ng</a></li>
                            <li><a href="">D??ng nh???p<img src="public/hinhanh/background/profile-header.jpg" alt=""></a></li>
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

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 p-4" style="border-radius: 15%;">
                                <div class="item">
                                    <div>
                                        <img src="public/hinhanh/product/<?php echo $itemproduct['product_img']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 p-4">
                                <h4 class="p-0"><span><?php echo $itemproduct['product_name']; ?></span>
                                    <span style="color: info;"><?php echo $itemproduct['product_slug']; ?></span><br>
                                    <span style="color: red;"><?php echo number_format(sprintf('%0.3f', $itemproduct['product_price'])) . "??"; ?></span>
                                </h4>
                                <div class="text-bottom text-warning">
                                    <ul>
                                        <li>
                                            <i class="fa fa-heart" style='color:#39def3'></i> 48
                                            <i class="fa fa-eye"></i> 2.3M
                                        </li>
                                        <li>
                                            <input type="number" name="" id="" min="0" style="width: 10%;">
                                            <i class='fas fa-cart-plus' style='color: #f3da35'></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php echo $itemproduct['product_detail']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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