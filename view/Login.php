<?php
    if (!isset($_SESSION)) {
        session_start();
    }   
    $_SESSION["check_login"] = FALSE;
    $_SESSION["userName"] = "Client";
    $_SESSION["permissionID"] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylers/Login_Styler.css">
    <link rel="stylesheet" href="../stylers/footer.css">
    <title>Trang đăng nhập</title>
</head>
<body>
    <section>
        <div class="leaves">
            <div class="set">
                <div><img src="../img_login/leaf_01.png" alt=""></div>
                <div><img src="../img_login/leaf_02.png" alt=""></div>
                <div><img src="../img_login/leaf_03.png" alt=""></div>
                <div><img src="../img_login/leaf_04.png" alt=""></div>
                <div><img src="../img_login/leaf_01.png" alt=""></div>
                <div><img src="../img_login/leaf_02.png" alt=""></div>
                <div><img src="../img_login/leaf_03.png" alt=""></div>
                <div><img src="../img_login/leaf_04.png" alt=""></div>
                <div><img src="../img_login/leaf_05.png" alt=""></div>
                <div><img src="../img_login/leaf_05.png" alt=""></div>
                <div><img src="../_login/leaf_05.png" alt=""></div>
                <div><img src="../img_login/leaf_05.png" alt=""></div>
            </div>
        </div>
        <img src="../img_login/bg2.jpg" alt="" class="bg">
        <img src="../img_login/trees2.png" alt="" class="trees">
        <img src="../img_login/girl.png" alt="" class="girl">
        <form action="../controller/Login_Controller.php" method="POST" class="login">
            <h2>Sign In</h2>
            <?php
                if(isset($_GET['error']))
                {
                    echo '<h5 style="width:100%;padding 5px 2px;text-align:center;background:pink;color:red;margin: 10px 0 5px;border-radius:10px;margin-bottom: 10px;">Sai tài khoản/mật khẩu</h5>';
                }
                if(isset($_GET['error1']))
                {
                    echo '<h5 style="width:100%;padding 5px 2px;text-align:center;background:pink;color:red;margin: 10px 0 5px;border-radius:10px;margin-bottom: 10px;">Tài khoản chưa được kích hoạt</h5>';
                }
            ?>
            <div class="inputBox">
                <input type="text" placeholder="Username" name="user" required>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="Password" name="pass" required>
            </div>
            <div class="inputBox">
                <input type="submit" value="Login" id="btn" name="login">
            </div>
            <div class="group">
                <a href="#">Forgot Password</a>
                <a href="login_2.php">Sign Up</a>
            </form>
        </div>
    </section>
</body>
</html>