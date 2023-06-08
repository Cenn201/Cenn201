<?php
require_once('./config/database.php');
spl_autoload_register(function ($classname) {
    require_once("./app/models/$classname.php");
});

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryModel = new CategoryModel();
    $item = $categoryModel->GetCategory($id);
    $productModel = new ProductModel();
    $productList = $productModel->GetEightProductByCategory($id);
}
    $categoryList = $categoryModel->GetAllCategory();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>NguyenXuanChien_21211TT1565</title>
    <!-- Bootstrap core CSS -->
    <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="public/assets/css/fontawesome.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
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
                            <li id="menu">
                <a href="#">Sản Phẩm</a>
                <ul>
                  <?php
                  foreach ($categoryList as $itemcategory) {
                  ?>

                    <li><a href="category_product.php?id=<?php echo $itemcategory['category_id']; ?>"><?php echo $itemcategory['category_name']; ?></a></li>
                  <?php
                  };
                  ?>
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
            <div class="col-lg-12">
                <div class="page-content">

                    <!-- ***** Banner Start ***** -->
                    <div class="main-banner">
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7 text-end">
                                <div class="header-text">
                                    <h6>Welcome to Cenn201</h6>
                                    <h4><em>Điện thoại <br>
                                        </em> Hàng đầu-uy tín-chất lượng</h4>
                                    <div class="main-button">
                                        <a href="/SanPham.php">Sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Banner End ***** -->

                    <!-- ***** Most Popular Start ***** -->
                    <div class="most-popular">
                        <h2 class="divider line glow" contenteditable><?php echo $item['category_name']; ?></h2>
                        <div class="row">
                            <<div class="col-lg-12">
                                <div class="row">
                                    <?php

                                    foreach ($productList as $itemproduct) {
                                    ?>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="item">

                                                <a href="/Cenn201/product.php?id=<?php echo $itemproduct['product_id']; ?>">
                                                    <img width="100px" height="190px" src="public/hinhanh/product/<?php echo $itemproduct['product_img']; ?>" alt="">
                                                </a>
                                                <br>
                                                <div class="item-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-7 item-content1">
                                                                <h4 class="p-0 mt-3"><span><?php echo $itemproduct['product_name']; ?></span><?php echo $itemproduct['product_slug']; ?>
                                                                    <br>
                                                                    <span style="color: red;"><?php echo number_format(sprintf('%0.3f', $itemproduct['product_price'])) . "đ"; ?></span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-md-5 p-0 item-conten2">
                                                                <ul>
                                                                    <li>
                                                                        <i class="fa fa-heart" style='color:#39def3'> <?php echo $itemproduct['product_like']; ?></i>
                                                                    </li>
                                                                    <li><i class="fa fa-eye"></i> <?php echo $itemproduct['product_view']; ?></li>
                                                                    <li>
                                                                        <i class='fas fa-cart-plus' style='color: #f3da35'></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    };
                                    ?>
                                </div>
                        </div>
                    </div>
                    <h2 class="divider line glow" contenteditable>The end</h2>
                </div>
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