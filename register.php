<?php
require_once './config/database.php';
spl_autoload_register(function ($className) {
    require_once "./app/models/$className.php";
});

if (isset($_POST['username']) && isset($_POST['password'])) {

    if ($_POST['password'] == $_POST['Confirmpassword']) {
        $userModel = new userModel();
        if ($userModel->register($_POST['username'], $_POST['password'])) {
            echo "<script>alert('Đăng ký thành công!');</script>";
            
        } else {
            echo "<script>alert('Tài khoản đã tồn tại!');</script>";
        }
    } else {
        echo "<script>alert('Mật khẩu không trùng!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <link rel="stylesheet" href="public/assets/css/login.css">
    <link rel="stylesheet" href="public/assets/css/fontawesome.css">
</head>

<body class="align">
    <header class="header header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="/Cenn201" class="logo">
                            <img src="public/hinhanh/background/logo.gif" alt="">
                        </a>
                </div>
                </nav>
            </div>
        </div>
        </div>
    </header>

    <div class="grid">

        <form action="" method="POST" class="form login">

            <div class="form__field">
                <label for="login__username"><svg class="icon">
                        <use xlink:href="#icon-user"></use>
                    </svg><span class="hidden">Username</span></label>
                <input autocomplete="username" id="login__username" type="text" name="username" class="form__input" placeholder="Username" required>

            </div>

            <div class="form__field">
                <label for="login__password"><svg class="icon">
                        <use xlink:href="#icon-lock"></use>
                    </svg><span class="hidden">Password</span></label>
                <input id="login__password" type="password" name="password" class="form__input" placeholder="Password new" required>

            </div>
            <div class="form__field">
                <label for="login__password"><svg class="icon">
                        <use xlink:href="#icon-lock"></use>
                    </svg><span class="hidden">Confirm password</span></label>
                <input id="login__password" type="password" name="Confirmpassword" class="form__input" placeholder="Confirm password" required>

            </div>

            <div class="form__field">
                <input type="submit" value="Register">
            </div>

            <p class="text--center">is a member? <a href="login.php">Sign in</a> <svg class="icon">
                    <use xlink:href="#icon-arrow-right"></use>
                </svg></p>
        </form>


        <svg xmlns="http://www.w3.org/2000/svg" class="icons">
            <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
                <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
            </symbol>
            <symbol id="icon-lock" viewBox="0 0 1792 1792">
                <path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z" />
            </symbol>
            <symbol id="icon-user" viewBox="0 0 1792 1792">
                <path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z" />
            </symbol>
        </svg>

</body>

</html>