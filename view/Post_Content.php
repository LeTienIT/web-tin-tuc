<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    require_once("../controller/Home_getPost_Controller.php");
    require_once("../models/CommentsModel.php");
    require_once("../models/Chuan_hoa_url.php");
    require_once("../models/Favorite_Post.php");

    $chuan_hoa = new chuan_hoa_url();

    $userName = $_SESSION["userName"];
    $permissionID = $_SESSION["permissionID"];
    if(isset($_SESSION["userID"]))
    {
        $userID = $_SESSION["userID"];
    }
    else{
        $userID = -1;
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../stylers/Post_Content.css">
    <link rel="stylesheet" href="../stylers/Reponsive_Post.css">
    <link rel="stylesheet" href="../stylers/footer.css">
    <title>Nội dung bài viết</title>
</head>
<body>
    <div id="main">
        <div id="header">
            <i class="ti-world"></i>
            <h1>Trang Thông Tin</h1>
        </div>
        <div class="back_home">
            <a href="<?php echo $_SESSION["last_page"]; ?>"><i class="ti-arrow-left"></i><span>Trở về</span></a>
        </div>
        <div class="main_content">
            <?php
                if (isset($_GET['url'])) {
                    $friendly_url = $_GET['url'];
                    $last_hyphen_pos = strrpos($friendly_url, '-');
                    $postID = substr($friendly_url, $last_hyphen_pos + 1);
                }
                //$postID = $_GET['id'];
                $d = new post();
                $r = $d->get_post_postID($postID);
                $p = mysqli_fetch_row($r);

                $favorite = new favorite_model();
                if($favorite->check_Favorite($userID,$postID)==true)
                {
                    $valueFavorite = "Thêm yêu thích ❤️";
                }
                else
                {
                    $valueFavorite = "Yêu thích ✔️";
                }
            ?>
            <div class="content">
                <div class="post_header">
                    <h1><?php echo $p[0]; ?></h1>
                </div>
                <div class="post_info">
                    <div class="box">
                        <h3>Tác giả: <span><?php echo $p[1]; ?></span></h3>
                    </div>
                    <div class="box">
                        <h3>Ngày viết: <span><?php echo $p[2]; ?></span></h3>
                    </div>
                    <div class="box">
                        <h3>Chủ để: <span><?php echo $p[3]; ?></span></h3>
                    </div>
                    <form action="../controller/Favorite_Controller.php" method="post" class="box">
                        <input type="submit" name="favorite_add" value="<?php echo $valueFavorite ?>">
                        <input type="hidden" name="postID" VALUE="<?php echo $postID; ?>">
                        <input type="hidden" name="url_post" VALUE="<?php echo $friendly_url; ?>">
                    </form>
                </div>
                <div class="post_content">
                    <?php echo $p[4]; ?>
                </div>
            </div>
            <div class="sub_content">
                <p class="sub_content_heading">
                    Bài viết cùng chủ đề
                </p>
                <div class="sub_content_main">
                    <?php
                        $postTopic = $p[6];
                        $d1 = new post();
                        $r1 = $d1->get_post_topic_view($postTopic,$postID);
                        if(mysqli_num_rows($r1) > 0)
                        {
                            $dem=0;
                            while($row4 = mysqli_fetch_row($r1))
                            {
                                $url = $chuan_hoa->create_friendly_url($row4[6],$row4[0]);
                                echo '<a href="Post_Content.php?url=' . $url . '" class="box_sp">
                                        <div class="box_sp_text">
                                            <p>'.$row4[6].'</p>
                                        </div>
                                        <div class="box_sp_img">
                                            <img src="'.$row4[5].'" alt="">
                                        </div>
                                    </a>';
                                $dem++;
                                if($dem==4)break;
                            }
                        }
                    ?>
                </div>
                
            </div>
            <form method="post" action="../controller/Add_Comment_Controller.php" class="add_comment" id="comments">
                <textarea name="ct_comment" id="" cols="50" rows="3" placeholder="Nhập bình luận" required></textarea>
                <input type="hidden" name="postID" id="" value = "<?php echo $postID; ?>">
                <input type="submit" name="" id="" value="Bình luận">
            </form>
            <div class="sub_comment">
                <?php
                    $cm = new comment_model();
                    $rms = $cm->get_comment($postID);
                    while($rm = mysqli_fetch_row($rms))
                    {
                        echo '<div class="box_comment">
                                <h3 class="user_name">'.$rm[3].'</h3>
                                <p>'.$rm[4].'</p>
                            </div>';
                    }
                ?> 
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