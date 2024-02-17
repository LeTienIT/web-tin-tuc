<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    require_once("../controller/Home_getPost_Controller.php");
    require_once("../controller/Home_GetTopic_Controller.php");
    require_once("../models/Chuan_hoa_url.php");
    $chuan_hoa = new chuan_hoa_url();

    $userName = $_SESSION["userName"];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../stylers/Post_Topic.css">
    <link rel="stylesheet" href="../stylers/Reponsive_Post_Topic.css">
    <link rel="stylesheet" href="../stylers/footer.css">
    <title>Danh sách bài viết</title>
</head>
<body>
    <div id="main">
        <div id="header">
            <i class="ti-world"></i>
            <h1>Trang Thông Tin</h1>
        </div>
        <div class="back_home">
            <a href="../view/Home.php"><i class="ti-arrow-left"></i><span>Trở về</span></a>
        </div>
        <div class="main_content">
            <?php
                //$topicID = $_GET['topicID'];
                if (isset($_GET['url'])) {
                    $friendly_url = $_GET['url'];
                    $last_hyphen_pos = strrpos($friendly_url, '-');
                    $topicID = substr($friendly_url, $last_hyphen_pos + 1);
                    $problematic_string = $topicID;
                    $topicID = str_replace(array('.', "'"), '', $problematic_string);
                }
                $_SESSION["last_page"] = "Post_Topic.php?url=' . $friendly_url . '";
                if ($topicID == '11111')
                {
                    echo '<div class="topic">
                            <h1>Các bài viết mới nhất</h1>
                        </div>';
                }
                else if($topicID == '111111')
                {
                    echo '<div class="topic">
                            <h1>Các bài viết comment nhiều nhất</h1>
                        </div>';
                }
                else
                {
                    $dp = new topic_model();
                    $rps = $dp->get_topic_id($topicID);
                    if($rps)
                    {
                        $rp = mysqli_fetch_row($rps);
                        echo '<div class="topic">
                            <h1>'.$rp[0].'</h1>
                        </div>';
                    }
                    else
                    {
                        echo '<div class="topic">
                            <h1>Lỗi!!</h1>
                        </div>';
                    }
                }
            ?>        
            <div class="post">
                <?php
                    //$topicID = $_GET['topicID'];
                    $db = new post();
                    if ($topicID == '11111')
                    {
                        $rs = $db->get_post_all();
                    } 
                    else if($topicID == '111111')
                    {
                        $rs = $db->get_post_comment();
                    }
                    else
                    {
                        $rs = $db->get_post_Topic($topicID);
                    }
                    if($rs)
                    {
                        if (mysqli_num_rows($rs) > 0)
                        {
                            while($row = mysqli_fetch_row($rs))
                            {
                               $url = $chuan_hoa->create_friendly_url($row[6],$row[0]);
                                echo '<a href="Post_Content.php?url=' . $url . '" class="box_main">
                                        <div class="img">
                                            <img src="' . $row[5] . '" alt="">
                                        </div>
                                        <div class="title">
                                            <h3>' . $row[6] . '</h3>
                                        </div>
                                        <div class="date_time">
                                            <h3>Ngày đăng: <span>' . $row[2] . '</span></h3>
                                        </div>
                                        <div class="userName">
                                            <h3>Tác giả: <span>' . $row[4] . '</span></h3>
                                        </div>
                                    </a> ';
                            }
                            echo '<p style="text-align:center;color:black;font-size:16px;display:block;width:100%;">Không còn bài viết khác</p>';
                        }
                        else
                        {
                            echo '<h3 style="text-align: center;padding: 5px 10px;color: red; font-size=22px;">Không có bài viết nào cho chủ đề này</h3>';
                             
                        }
                        
                    }
                    else
                    {
                        echo "Không thể truy xuất csdl: '.$rs.'";
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