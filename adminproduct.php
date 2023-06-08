<?php
require_once('./config/database.php');
spl_autoload_register(function ($classname) {
    require_once("./app/models/$classname.php");
});
session_start();
$user = isset($_SESSION['uml_user']) ? $_SESSION['uml_user'] : [];
$productModel = new ProductModel();
$productList = $productModel->GetAllProducts();
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $productModel->deleteproduct($id);
    echo "<h4>Xoá thành công</h4>";
}
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

    <link rel="stylesheet" href="public/assets/css/edit.css">
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
                            <li class="nav-item dropdown d-flex">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sản Phẩm
                                </a>
                            </li>
                            <li><a href="">Giỏ hàng</a></li>
                            <li><a href="" style="width: 165px;"><?php echo $user['user_username']; ?> <img src="public/hinhanh/background/profile-header.jpg" alt=""></a></li>
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
                    <a href="addproduct.php">
                        <div class="btn btn-danger">Thêm sản phẩm</div>
                    </a>

                    <!-- ***** Most Popular Start ***** -->
                    <div class="container">
                        <table class="table">
                            <tr>
                                <td>
                                    <h5>Hình ảnh</h5>
                                </td>
                                <td>
                                    <h5>Mã</h5>
                                </td>
                                <td>
                                    <h5>Tên sản phẩm</h5>
                                </td>
                                <td>
                                    <h5>Rom</h5>
                                </td>

                                <td>
                                    <h5>Số lượng</h5>
                                </td>
                                <td>
                                    <h5>giá</h5>
                                </td>
                                <td>
                                    <h5>giá khuyến mãi </h5>
                                </td>

                                <td>
                                    <h5>chức năng</h5>
                                </td>
                            </tr>
                            <?php
                            foreach ($productList as $item) {
                            ?>
                                <tr>
                                    <td>
                                        <img src="public/hinhanh/product/<?php echo $item['product_img'] ?>" alt="" class="img-fluid" style="width: 100px">
                                    </td>
                                    <td><?php echo $item['product_id'] ?></td>
                                    <td><?php echo $item['product_name'] ?></td>
                                    <td><?php echo $item['product_slug'] ?></td>
                                    <td><?php echo $item['product_number'] ?></td>
                                    <td><?php echo $item['product_price'] ?></td>
                                    <td><?php echo $item['product_sale'] ?></td>
                                    <td>
                                        <a href="editproduct.php?id=<?php echo $item['product_id'] ?>" class="btn btn-primary">Edit</a>
                                        <form action="adminproduct.php" method="post" onsubmit="return confirm('Co xoa khong?')">
                                            <input type="hidden" name="deleteId" value="<?php echo $item['product_id'] ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
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