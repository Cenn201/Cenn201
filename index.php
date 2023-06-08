<?php
include 'function.php';
session_start();
$user = isset($_SESSION['uml_user']) ? $_SESSION['uml_user'] : [];
require_once('./config/database.php');
spl_autoload_register(function ($classname) {
  require_once("./app/models/$classname.php");
});


$productModel = new ProductModel();
if (isset($_POST['like-id'])) {
  $id = $_POST['like-id'];
  if (!isset($_COOKIE['likedProduct'])) {
    $value = [$id];
    $productModel->likeProductNoLogin($id);
    setcookie('likedProduct', json_encode($value), time() + 3600);
  } else {
    $likedProduct = json_decode($_COOKIE['likedProduct']);
    if (!in_array($id, $likedProduct)) {
      $productModel->likeProductNoLogin($id);
      array_push($likedProduct, $id);
      setcookie('likedProduct', json_encode($likedProduct), time() + 3600);
    } else {
      unset($likedProduct[array_search($id, $likedProduct)]);
      $productModel->unlikeProductNoLogin($id);
      setcookie('likedProduct', json_encode($likedProduct), time() + 3600);
    }
  }
}

$viewedProductList = [];
if (isset($_COOKIE['viewedProduct'])) {
  $arrId = json_decode($_COOKIE['viewedProduct'], true);
  $viewedProductList = $productModel->getProductByIds($arrId);
}

$categoryModel = new CategoryModel();
$categoryList = $categoryModel->GetAllCategory();
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 8;
$totalPage = ceil($productModel->getIDProduct() / $perPage);
$productList = $productModel->getProductsByPage($page, $perPage);
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
            <a href="./index.php" class="logo">
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
              <li><a href="./index.php" class="active">Trang chủ</a></li>

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
              <li><a href="./cart.php">Giỏ hàng</a></li>
              <?php if (isset($user['user_username'])) {
              ?>
                <li id="menu">
                  <a href="" style="width: 165px;"><?php echo $user['user_username']; ?> <img src="public/hinhanh/background/profile-header.jpg" alt=""></a>

                  <ul>
                    <li>
                      <?php if ($user['user_username'] == 'admin') {
                        echo '<a href="./adminproduct.php" class="drop-item" target="_blank">Quản lý sản phẩm</a>';
                      }
                      ?>
                    </li>
                    <li><a href="./logout.php" class="drop-item">Đăng xuất</a></li>
                  </ul>


                <?php } else {
                ?>
                  <li><a href="./login.php">Đăng nhập<img src="public/hinhanh/background/profile-header.jpg" alt=""></a></li>
                <?php
              }
                ?>
                </li>
                </li>
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
          <div class="most-popular">
            <div class="row">
              <div class="col-lg-12">
                <hr style="color: white;">
                <h5 class="text-center">VỪA XEM</h5>
                <hr style="color: white;">
                <div class="heading-section">
                  <hr>
                  </h4>
                </div>
                <div class="row">
                  <?php
                  foreach ($viewedProductList as $viewedItem) {
                  ?>
                    <div class="col-md-3" style="padding: 10px;">
                      <div class="item">
                        <form action="" method="post">
                          <a href="./product.php?id=<?php echo $viewedItem['product_id']; ?>">
                            <img src="public/hinhanh/product/<?php echo $viewedItem['product_img']; ?>" width="200px" height="170px" alt="">
                          </a>
                          <div class="container p-0">
                            <div class="row">
                              <div class="col-md-7 mt-3 pe-0">
                                <a href="./product.php?id=<?php echo $viewedItem['product_id']; ?>">
                                  <h5 style="font-size: 15px;    height: 66px;"><?php echo $viewedItem['product_name']; ?><br><?php echo $viewedItem['product_slug']; ?></h5>
                                  <h4><span style="color: red;"><?php echo number_format(sprintf('%0.3f', $viewedItem['product_price'])) . "đ"; ?></span></h4>
                                </a>
                              </div>
                              <div class="col-md-5 mt-2">
                                <form action="./index.php" action="POST">
                                  <input type="hidden" name="like-id" value="<?php echo $viewedItem['product_id']; ?>">
                                  <div class="d-flex">
                                    <button class="btn btn p-0">
                                      <h4><i class="fa fa-heart" style="color:#d141cc;"> <?php echo $viewedItem['product_like']; ?></i></h4>
                                    </button>
                                    <button class="btn btn p-0" disabled>
                                      <h4><i class="fa fa-eye" style="color:#b1d141;"> <?php echo $viewedItem['product_view'] ?></i></h4>
                                    </button>
                                  </div>
                                  <h4><span><a href="./cart.php?id=<?php echo $viewedItem['product_id'] ?>" class="btn btn-success">Mua ngay</a></span></h4>
                                </form>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                </div>
                <hr style="color: white;">
                <h4 class="text-center">TẤT CẢ ĐIỆN THOẠI</h4>
                <hr style="color: white;">
                <div class="heading-section">
                  <hr>
                  </h4>
                </div>
                <div class="container">
                  <div class="row">
                    <?php foreach ($productList as $item) {
                    ?>
                      <div class="col-md-3" style="padding: 10px;">
                        <div class="item">
                          <form action="" method="post">
                            <a href="./product.php?id=<?php echo $item['product_id']; ?>">
                              <img src="public/hinhanh/product/<?php echo $item['product_img']; ?>" width="200px" height="170px" alt="">
                            </a>
                            <div class="container p-0">
                              <div class="row">
                                <div class="col-md-7 mt-3 pe-0">

                                  <a href="./product.php?id=<?php echo $item['product_id']; ?>">
                                    <h5 style="font-size: 15px;    height: 66px;"><?php echo $item['product_name']; ?><br><?php echo $item['product_slug']; ?></h5>

                                    <h4><span style="color: red;"><?php echo number_format(sprintf('%0.3f', $item['product_price'])) . "đ"; ?></span></h4>
                                  </a>
                                </div>
                                <div class="col-md-5 mt-2">
                                  <form action="#" action="POST">
                                    <input type="hidden" name="like-id" value="<?php echo $item['product_id']; ?>">
                                    <div class="d-flex">
                                      <button class="btn btn p-0">
                                        <h4><i class="fa fa-heart" style="color:#d141cc;"> <?php echo $item['product_like']; ?></i></h4>
                                      </button>
                                      <button class="btn btn p-0" disabled>
                                        <h4><i class="fa fa-eye" style="color:#b1d141;"> <?php echo $item['product_view'] ?></i></h4>
                                      </button>
                                    </div>
                                    <h4><span><a href="./cart.php?id=<?php echo $item['product_id'] ?>" class="btn btn-success">Mua ngay</a></span></h4>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <nav aria-label="Page navigation example" style="color: black; padding: 80px 0 0 0">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <?php if ($page == 1) {
                    ?>
                      <a class="page-link" href="./index.php?page=<?php echo $page ?>" style="color: black;">
                        <i class="fa-solid fa-angle-left"></i>
                      </a>
                    <?php } else {
                    ?>
                      <a class="page-link" href="./index.php?page=<?php echo $page - 1 ?>" style="color: black;">
                        <i class="fa-solid fa-angle-left"></i>
                      </a>
                    <?php
                    }
                    ?>
                  </li>
                  <?php for ($i = 1; $i <= $totalPage; $i++) {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="./index.php?page=<?php echo $i; ?>" style="color: black;"><?php echo $i ?> </a>
                    </li>
                  <?php
                  } ?>
                  <li class="page-item">
                    <?php if ($totalPage == $page) {
                    ?>
                      <a class="page-link" href="./index.php?page=<?php echo $page ?>" style="color: black;">
                      <?php } else {
                      ?>
                        <a class="page-link" href="./index.php?page=<?php echo $page + 1 ?>" style="color: black;">
                        <?php
                      }
                        ?>
                        <i class="fa-solid fa-angle-right"></i>
                        </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- ***** Gaming Library Start ***** -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p>

              <i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i>Design: <a href="https://www.facebook.com/Cen201" target="_blank" title="free CSS templates">index.php</a> <i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i><i class="fa-solid fa-skull-crossbones fa-fade"></i>
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
    <script src="public/assets/js/isotope.min.js"></script>
    <script src="public/assets/js/owl-carousel.js"></script>
    <script src="public/assets/js/tabs.js"></script>
    <script src="public/assets/js/popup.js"></script>
    <script src="public/assets/js/custom.js"></script>
</body>

</html>