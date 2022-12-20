<?php
require_once('./config/database.php');
spl_autoload_register(function ($classname) {
    require_once("./app/models/$classname.php");
});

$productModel = new ProductModel();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $itemproduct = $productModel->GetProduct($id);
}


$categoryModel = new CategoryModel();
$categoryList = $categoryModel->GetAllCategory();
if (!empty($_POST['product_name']) && !empty($_POST['product_catid']) && !empty($_POST['product_slug']) && !empty($_POST['product_price']) && !empty($_POST['product_number']) && !empty($_POST['product_sale']) && !empty($_POST['product_detail'])) {
    $product_name = $_POST['product_name'];
    $product_catid = $_POST['product_catid'];
    $product_slug = $_POST['product_slug'];
    $product_number = $_POST['product_number'];
    $product_price = $_POST['product_price'];
    $product_sale = $_POST['product_sale'];
    $product_detail = $_POST['product_detail']; 

    $product_img = $_FILES['product_img']['name'];

    if (is_uploaded_file($_FILES['product_img']['tmp_name']) && move_uploaded_file($_FILES['product_img']['tmp_name'],'public/hinhanh/product/'. $_FILES['product_img']['name'])) 
    {
        // Upload thành công thì thêm vào db;
        if ($productModel->editProduct($product_name, $product_catid, $product_slug, $product_img, $product_number, $product_price, $product_sale, $product_detail,$id)) {
            header('Location: adminproduct.php');
            echo "<script>
            alert('Sửa thành công!');
        </script>";
        }
    } else 
    {
        echo "<script>
            alert('Sửa thất bại!');
        </script>";
    }
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
    <link rel="stylesheet" href="public/assets/css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="public/assets/css/fontawesome.css">
    <link rel="stylesheet" href="public/assets/css/style.css"> -->
    <link rel="stylesheet" href="public/assets/css/templatemo-style.css"> -->
    <link rel="stylesheet" href="public/assets/css/owl.css">
    <link rel="stylesheet" href="public/assets/css/animate.css">
    <link rel="stylesheet" href="public/assets/css/fontawesome.css" />
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
            <div class="col-lg-12">
                <div class="page-content p-0">
                    <div class="addproduct">
                        <div class="container tm-mt-big tm-mb-big">
                            <div class="row">
                                <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
                                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h1 class="tm-block-title d-inline-block" style="color: yellow;padding-bottom: 15px;">edit Product</h1>
                                            </div>
                                        </div>
                                        <form action="" class="tm-edit-product-form" method="post" enctype="multipart/form-data">
                                            <div class="row tm-edit-product-row">
                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="product_name">Tên sản phẩm :</label>
                                                        <input id="product_name" name="product_name" type="text" class="form-control validate" value="<?php echo $itemproduct['product_name']; ?>" required />
                                                    </div>
                                                    <div class="form-group mb-3 py-2">
                                                        <label for="product_catid">Loại : </label>
                                                        <select class="custom-select tm-select-accounts" id="product_catid" name="product_catid">
                                                            <?php
                                                            foreach ($categoryList as $itemcategory) {
                                                            ?>
                                                                <option value="<?php echo $itemcategory['category_id']; ?>" >
                                                                    <div class="text-dark"  value="<?php echo $itemproduct['product_catid']; ?>"><?php echo $itemcategory['category_name']; ?></div>
                                                                </option>
                                                            <?php
                                                            };
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3 py-1">
                                                        <label for="product_slug">Dung lượng
                                                        </label>
                                                        <input id="product_slug" name="product_slug" type="text" class="form-control validate" required  value="<?php echo $itemproduct['product_slug']; ?>"/>
                                                    </div>
                                                    <div class="form-group mb-3 py-1">
                                                        <label for="product_number">Số lượng :
                                                        </label>
                                                        <input id="product_number" name="product_number" type="text" class="form-control validate" required  value="<?php echo $itemproduct['product_number']; ?>"/>
                                                    </div>
                                                    <div class="form-group mb-3 py-1">
                                                        <label for="product_price">Giá :
                                                        </label>
                                                        <input id="product_price" name="product_price" type="text" class="form-control validate" required  value="<?php echo $itemproduct['product_price']; ?>"/>
                                                    </div>
                                                    <div class="form-group mb-3 py-1">
                                                        <label for="product_sale">Khuyến mãi :
                                                        </label>
                                                        <input id="product_sale" name="product_sale" type="text" class="form-control validate" required  value="<?php echo $itemproduct['product_sale']; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">


                                                        <div class="form-group mb-3">
                                                            <label for="description">Giới thiệu :</label>
                                                            <textarea id="product_detail" name="product_detail" class="validate" rows="8" cols="42" required  value="<?php echo $itemproduct['product_detail']; ?>"></textarea>
                                                        </div>
                                                        <div><label for="product_img">Hình ảnh :</label></div>
                                                        <div class="tm-product-img-dummy mx-auto" onclick="document.getElementById('product_img').click();">
                                                            <i class="fas fa-cloud-upload-alt tm-upload-icon"></i>
                                                        </div>
                                                        <div class="custom-file mt-3 mb-3 text-center">
                                                            <input id="product_img" name="product_img" type="file" style="display:none;" value="<?php echo $itemproduct['product_img']; ?>" />
                                                            <input type="button" class="btn btn-primary btn-block mx-auto" value="UPLOAD PRODUCT IMAGE" onclick="document.getElementById('product_img').click();" />
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary btn-block text-uppercase">edit Product Now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="public/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="public/vendor/jquery/jquery-ui.min.js"></script>
</body>

</html>