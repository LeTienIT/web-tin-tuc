<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylers/register_2.css">
    <title>Register</title>
</head>
<body>
    <header>
    </header>
    <div class="wrapper">
        <span class="borderLine"></span>
        <div class="form-box login">
            <h2>Register</h2>
            <?php
                if(isset($_GET['error']) && $_GET['error']==0)
                {
                    echo '<h5 style="width:100%;padding 5px 2px;text-align:center;background:pink;color:green;margin: 10px 0 5px;border-radius:10px;margin-bottom: 10px;">Đăng ký thành công</h5>';
                }
                else if(isset($_GET['error']) && $_GET['error']==1)
                {
                    echo '<h5 style="width:100%;padding 5px 2px;text-align:center;background:pink;color:red;margin: 10px 0 5px;border-radius:10px;margin-bottom: 10px;">Đăng ký thất bại, Thử lại sau</h5>';
                }
                else if(isset($_GET['error']) && $_GET['error']==2)
                {
                    echo '<h5 style="width:100%;padding 5px 2px;text-align:center;background:pink;color:red;margin: 10px 0 5px;border-radius:10px;margin-bottom: 10px;">Tên đăng nhập đã được sử dụng</h5>';
                }
                else if(isset($_GET['error']) && $_GET['error']==3)
                {
                    echo '<h5 style="width:100%;padding 5px 2px;text-align:center;background:pink;color:red;margin: 10px 0 5px;border-radius:10px;margin-bottom: 10px;">Hãy tích vào đồng ý</h5>';
                }
            ?>
            <form action="../controller/Register_2.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
                    <input type="text" name="userID" required>
                    <label for="">Tên đăng nhập</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="userName" required>
                    <label for="">Tên người dùng</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="userPassword" required>
                    <label for="">Mật khẩu</label>
                </div>
                <div class="remember-forgot">
                    <label for=""><input type="checkbox" name="checkBox">I agree to the terms & conditions</label>
                </div>
                <button type="submit" class="btn" name="register">Register</button>
                <div class="login-register">
                    <p>
                        Already have an account?
                        <a href="login_2.php" class="login-link">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" > </script> 
    <script  nomodule  src = "https://unpkg .com/ionicons@7.1.0/dist/ionicons/ionicons.js" ></script>
</body>
</html>