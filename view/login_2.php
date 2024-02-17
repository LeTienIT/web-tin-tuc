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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylers/style_2.css">
    <title>Login</title>
</head>
<body>
    <header>
    </header>
    <div class="wrapper">
        <span class="borderLine"></span>
        <div class="form-box login">
            <h2>Login</h2>
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
            <form action="../controller/Login_Controller.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="user" required>
                    <label for="">Tên đăng nhập</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="pass" required>
                    <label for="">Mật khẩu</label>
                </div>
                <div class="remember-forgot">
                    <label for=""><input type="checkbox" name="" id="">Remember me</label>
                    <a href="Forgot_Pass.php">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="register_2.php" class="register-link">Register account?</a></p>
                </div>
            </form>
        </div>
    </div>
    <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" > </script> 
    <script  nomodule  src = "https://unpkg .com/ionicons@7.1.0/dist/ionicons/ionicons.js" ></script>
</body>
</html>