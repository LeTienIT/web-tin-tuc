<?php
    session_start();
    require_once "../models/UserModel.php";
    require_once "../models/PostModel.php";
    require_once "../models/Chuan_hoa_url.php";

    $_SESSION["last_page"] = "user.php";
    if(isset($_SESSION["userID"]))
    {
        $userID = $_SESSION["userID"];
        $user = new userModel();
        $post = new post_model();

        $rs = $user->get_user_id($userID);
        $rs_favorite = $post->get_post_favorite_userID($userID);

        if($rs)
        {
            $row = mysqli_fetch_row($rs);
            $ten = $row[2];
            $sdt = $row[3];
            $email = $row[4];
        }
        else
        {
            $ten = "";
            $sdt = "";
            $email = "";
        }
    }
    else
    {
        header("Location: login_2.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../stylers/Home_styler.css">
    <link rel="stylesheet" href="../stylers/user.css">
    <link rel="stylesheet" href="../stylers/footer.css">
    <title>Thông tin cá nhân</title>
</head>
<body>
    <div id="main">
        <div id="header">
            <i class="ti-world"></i>
            <h1>Trang Thông Tin</h1>
        </div>
        <div id="content_user">
            <div class="info_user">
                <H1>Thông tin cá nhân</H1>
                <form action="../controller/user_controller.php" method="post"class="form-box-user">
                    <div class="form-user">
                        <label for="">Tên</label>
                        <input type="text" name="userName" id="" value="<?php echo $ten; ?>">
                    </div>
                    <div class="form-user">
                        <label for="">SĐT</label>
                        <input type="text" name="userPhone" id="" value="<?php echo $sdt; ?>">
                    </div>
                    <div class="form-user">
                        <label for="">Email</label>
                        <input type="text" name="userEmail" id="" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-user">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="userPassID" id="">
                    </div>
                    <div class="form-user">
                        <label for="">Mật khẩu mới</label>
                        <input type="password" name="userPassN" id="" placeholder="Nếu không đổi mật khẩu thì nhập lại mật khẩu cũ">
                    </div>
                    <p class="thong_bao" style="<?php if(isset($_GET["error"]) && $_GET["error"]==0)echo "color: green;"; ?>">
                        <?php
                            if(isset($_GET["error"]) && $_GET["error"]==0)
                            {
                                echo "Cập nhật dữ liệu thành công";
                            }
                            else if(isset($_GET["error"]) && $_GET["error"]==1)
                            {
                                echo "Mật khẩu hiện tại của tài khoản không chính xác";
                            }
                            else if(isset($_GET["error"]) && $_GET["error"]==2)
                            {
                                echo "Cập nhật dữ liệu thất bại";
                            }
                        ?>
                    </p>
                    <div class="form-user-button">
                        <input type="submit" name="userLogout" value="Đăng xuất">
                        <input type="submit" name="updateUser" value="Cập nhật">
                        <input type="reset" value="Đặt lại">
                        <input type="submit" name="backHome" value="Home">
                    </div>
                </form>
            </div>
            <div class="favorite_post">
                <H1>Các bài viết yêu thích</H1>
                <div class="favorite-content">
                    <?php
                       if($rs_favorite)
                       {
                        $chuan_hoa = new chuan_hoa_url();
                            while($row = mysqli_fetch_row($rs_favorite))
                            {
                                $url = $chuan_hoa->create_friendly_url($row[6],$row[0]);
                                echo '<a href="Post_Content.php?url='.$url.'" class="box">
                                        <div class="box_text">
                                            <p>'.$row[6].'</p>
                                        </div>
                                        <div class="box_img">
                                            <img src="'.$row[5].'" alt="">
                                        </div>
                                        <form action="../controller/Favorite_Controller.php" method="post" class="btn_delete">
                                            <input type="submit" name="delete" value="Xóa">
                                            <input type="hidden" name="postID_favorite" value="'.$row[0].'">
                                        </form>
                                    </a> ';
                            }
                       } 
                    ?>
                    
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="top_footer">
                <div class="about_us">
                    <h2>Về chúng tôi</h2>
                    <p>
                        Chúng tôi tin rằng thông tin là sức mạnh, và chúng tôi cam kết giúp bạn hiểu rõ hơn về thế giới, xã hội và các sự kiện quan trọng.
                         Chúng tôi sẽ không ngừng phát triển và nâng cấp trải nghiệm của bạn trên trang web của chúng tôi.
                          Cảm ơn bạn đã đồng hành cùng chúng tôi trong việc khám phá thế giới thông qua từng dòng tin tức
                    </p>
                </div>
                <div class="info_address">
                    <h2>Địa chỉ liên hệ</h2>
                    <ul>
                        <li>Trụ sở: <span>Vũ Thư - Việt Nam - Thái Bình</span></li>
                        <li>Số điện thoại: <span>0926870380</span></li>
                        <li>Email: <span>ledactien2002@gmail.com</span></li>
                        <li>Mobile <span>0123456789</span></li>
                    </ul>
                </div>
            </div>
            <div class="bottom_footer">
                <div class="copy_right">
                        <p>Copyright © 2002 Le Tien - All rights reserved</p>
                </div>
                <div class="icon">
                    <a href=""><i class="ti-facebook"></i></a>
                    <a href=""><i class="ti-youtube"></i></a>
                    <a href=""><i class="ti-instagram"></i></a>
                    <a href=""><i class="ti-pinterest"></i></a>
                    <a href=""><i class="ti-twitter"></i></a>
                    <a href=""><i class="ti-linkedin"></i></a>   
                </div>
            </div>
        </div>
    </div>
</body>
</html>