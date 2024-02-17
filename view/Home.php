<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    require_once("../controller/Home_GetTopic_Controller.php");
    require_once("../controller/Home_getPost_Controller.php");

    if(!isset($_SESSION['check_login']) || !($_SESSION["check_login"]))
    {
        $_SESSION["userID"] = '-1';
        $_SESSION["userName"] = "Client";
        $_SESSION["permissionID"] = '0';
        $userName = "Client";
        $permissionID = 0;
    }
    else
    {
        if(isset($_SESSION["userName"]))
        {
            $userName = $_SESSION["userName"];
            $permissionID = $_SESSION["permissionID"];
        }
        else
        {
            $_SESSION["userID"] = '-1';
            $_SESSION["userName"] = "Client";
            $_SESSION["permissionID"] = '0';
            $userName = "Client";
            $permissionID = 0;
        }
    }

    $db = new topic_model();
    $rs = $db->getTopic();
    $_SESSION["last_page"] = "Home.php";

    $d = new post();
    $rd = $d->get_post_all(); 
    if($row = mysqli_fetch_row($rd))
    {
        $id_post = $row[0];
        $img = $row[5];
        $title = $row[6];
        $post_time = $row[2];
        //$url = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($title))) . '-' . $id_post;
    }
    function remove_accents($str) {
        $transliteration_table = array(
            'Á'=>'A', 'À'=>'A', 'Ả'=>'A', 'Ã'=>'A', 'Ạ'=>'A', 'Ă'=>'A', 'Ắ'=>'A', 'Ằ'=>'A', 'Ẳ'=>'A', 'Ẵ'=>'A', 'Ặ'=>'A', 'Â'=>'A', 'Ấ'=>'A', 'Ầ'=>'A', 'Ẩ'=>'A', 'Ẫ'=>'A', 'Ậ'=>'A', 
            'Đ'=>'D', 
            'É'=>'E', 'È'=>'E', 'Ẻ'=>'E', 'Ẽ'=>'E', 'Ẹ'=>'E', 'Ê'=>'E', 'Ế'=>'E', 'Ề'=>'E', 'Ể'=>'E', 'Ễ'=>'E', 'Ệ'=>'E', 
            'Í'=>'I', 'Ì'=>'I', 'Ỉ'=>'I', 'Ĩ'=>'I', 'Ị'=>'I', 
            'Ó'=>'O', 'Ò'=>'O', 'Ỏ'=>'O', 'Õ'=>'O', 'Ọ'=>'O', 'Ô'=>'O', 'Ố'=>'O', 'Ồ'=>'O', 'Ổ'=>'O', 'Ỗ'=>'O', 'Ộ'=>'O', 'Ơ'=>'O', 'Ớ'=>'O', 'Ờ'=>'O', 'Ở'=>'O', 'Ỡ'=>'O', 'Ợ'=>'O', 
            'Ú'=>'U', 'Ù'=>'U', 'Ủ'=>'U', 'Ũ'=>'U', 'Ụ'=>'U', 'Ư'=>'U', 'Ứ'=>'U', 'Ừ'=>'U', 'Ử'=>'U', 'Ữ'=>'U', 'Ự'=>'U', 
            'Ý'=>'Y', 'Ỳ'=>'Y', 'Ỷ'=>'Y', 'Ỹ'=>'Y', 'Ỵ'=>'Y', 
            'á'=>'a', 'à'=>'a', 'ả'=>'a', 'ã'=>'a', 'ạ'=>'a', 'ă'=>'a', 'ắ'=>'a', 'ằ'=>'a', 'ẳ'=>'a', 'ẵ'=>'a', 'ặ'=>'a', 'â'=>'a', 'ấ'=>'a', 'ầ'=>'a', 'ẩ'=>'a', 'ẫ'=>'a', 'ậ'=>'a', 
            'đ'=>'d', 
            'é'=>'e', 'è'=>'e', 'ẻ'=>'e', 'ẽ'=>'e', 'ẹ'=>'e', 'ê'=>'e', 'ế'=>'e', 'ề'=>'e', 'ể'=>'e', 'ễ'=>'e', 'ệ'=>'e', 
            'í'=>'i', 'ì'=>'i', 'ỉ'=>'i', 'ĩ'=>'i', 'ị'=>'i', 
            'ó'=>'o', 'ò'=>'o', 'ỏ'=>'o', 'õ'=>'o', 'ọ'=>'o', 'ô'=>'o', 'ố'=>'o', 'ồ'=>'o', 'ổ'=>'o', 'ỗ'=>'o', 'ộ'=>'o', 'ơ'=>'o', 'ớ'=>'o', 'ờ'=>'o', 'ở'=>'o', 'ỡ'=>'o', 'ợ'=>'o', 
            'ú'=>'u', 'ù'=>'u', 'ủ'=>'u', 'ũ'=>'u', 'ụ'=>'u', 'ư'=>'u', 'ứ'=>'u', 'ừ'=>'u', 'ử'=>'u', 'ữ'=>'u', 'ự'=>'u', 
            'ý'=>'y', 'ỳ'=>'y', 'ỷ'=>'y', 'ỹ'=>'y', 'ỵ'=>'y', 
        );
    
        $str = strtr($str, $transliteration_table);
        $str = preg_replace('/[^a-zA-Z0-9]+/', '-', $str);
        $str = strtolower(trim($str, '-'));
        return $str;
    }
    function create_friendly_url($title, $post_id) {
        $slug = remove_accents($title);
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $slug));
        $url = $slug . '-' . $post_id;
    
        return $url;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../stylers/Home_styler.css">
    <link rel="stylesheet" href="../stylers/footer.css">
    <link rel="stylesheet" href="../stylers/Reponsive_Home.css">
    <title>Home</title>
</head>
<body>
    <div id="main">
        <div id="header">
            <i class="ti-world"></i>
            <h1>Trang Thông Tin</h1>
        </div>
        <div id="navigation_menu">
            <ul>
                <li class="sub_menu_header"><i class="ti-home"></i></li>
                <?php
                    $url1 = create_friendly_url("Tin mới",11111);
                    $url2 = create_friendly_url("Thời sự","1");
                    $url3 = create_friendly_url("Thế giới","2");
                    $url4 = create_friendly_url("Khoa học","4");
                    $url5 = create_friendly_url("Xã hội","3");
                    $url6 = create_friendly_url("Giáo dục","5");
                    $url7 = create_friendly_url("Giải trí","6");
                    $url8 = create_friendly_url("Top comment",111111);
                    if(intval($_SESSION["permissionID"]) === 5)
                    {
                        echo '<li class="sub_menu"><a href="../view/Admin.php?>">Admin</a></li>';
                    }
                ?>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url1;?>">Tin mới</a></li>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url2;?>">Thời Sự</a></li>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url3;?>">Thế giới</a></li>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url4;?>">Khoa học</a></li>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url5;?>">Xã hội</a></li>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url6;?>">Giáo dục</a></li>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url7;?>">Giải trí</a></li>
                <li class="sub_menu"><a href="../controller/Home_Post_Topic.php?url=<?php echo $url8;?>">Top comment</a></li>
            </ul>
            <div class="sub_menu"><a href="../controller/Home_User.php" class="user"><i class="ti-user"></i></a></div>
        </div>
        <div id="navigation_select">
            <div class="time">
                <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $timestamp = time();
                    $formattedDate = date('l, d/m/Y, H:i', $timestamp);
                    echo "<p>".$formattedDate."</p>";
                ?>
            </div>
            <form action="../controller/Home_Post_Topic.php" method="get" class="sub_search">
                <select id="user" name="url" class="cbb_Option">
                    <?php
                        while($row = mysqli_fetch_row($rs))
                        {
                            $url = create_friendly_url($row[1],$row[0]);
                            echo '<option value="'.$url.'"> '.$row[1].' </option>';
                        }
                    ?>
                </select>
                <input type="submit" value="Tìm">
            </form>
        </div>
        <div id="main_content">
            <div class="row_content">

                <div class="column_main">
                    <div class="heading_column">
                        <H3>Tin mới nhất</H3>
                    </div>
                    <div class="column_body">
                        <?php $url = create_friendly_url($title,$id_post); ?>
                        <a href="Post_Content.php?url=<?php echo $url;?>" class="box1">
                            <div class="box_img">
                                <img src="<?php echo isset($img) ? $img : ''; ?>" alt="">
                            </div>
                            <div class="box_text">
                                <div class="heading">
                                    <p><?php echo isset($title) ? $title : ''; ?></p>
                                </div>
                                <div class="sub_heading">
                                    <p>Time: <?php echo isset($post_time) ? $post_time : ''; ?></p>
                                </div>
                            </div>
                        </a>
                        <div class="box2">
                            <?php
                                $dem = 0;
                                while ($row = mysqli_fetch_row($rd)) 
                                {
                                    $url = create_friendly_url($row[6],$row[0]);
                                    echo '<a href="Post_Content.php?url=' . $url . '" class="box">
                                            <div class="box2_text">
                                                <p>'.$row[6].'</p>
                                            </div>
                                            <div class="box2_img">
                                                <img src="'.$row[5].'" alt="">
                                            </div>
                                        </a> ';
                                        $dem++;
                                        if($dem==5)break;
                                }
                            ?>
                             
                        </div>
                    </div>
                    
                </div> 

                <div class="new_column">
                    <div class="heading_column">
                        <H3>Tin tức trong nước</H3>
                    </div>
                    <?php
                        $dp2 = new post();
                        $rp2 = $dp2->get_post_Topic(1);

                        if (mysqli_num_rows($rp2) > 0) {
                            $i = 0;
                            while ($row2 = mysqli_fetch_row($rp2)) 
                            {
                                $url = create_friendly_url($row2[6],$row2[0]);
                                echo '<a href="Post_Content.php?url=' . $url . '" class="box">
                                        <div class="img">
                                            <img src="' . $row2[5] . '" alt="">
                                        </div>
                                        <div class="box_content">
                                            <div class="title">
                                                <h3>' . $row2[6] . '</h3>
                                            </div>
                                            <div class="userName">
                                                <h3>Time: <span>' . $row2[2] . '</span></h3>
                                            </div>
                                        </div>
                                    </a>';
                                $i++;
                                if($i == 5)
                                {
                                    break;
                                }
                            }
                        }
                    ?>

                </div>

                <div class="new_column">
                    <div class="heading_column">
                        <H3>Tin tức quốc tế</H3>
                    </div>
                    <?php
                        $dp3 = new post();
                        $rp3 = $dp3->get_post_Topic(2);

                        if (mysqli_num_rows($rp3) > 0) {
                            $i = 0;
                            while ($row3 = mysqli_fetch_row($rp3)) 
                            {
                                $url = create_friendly_url($row3[6],$row3[0]);
                                echo '<a href="Post_Content.php?url=' . $url . '" class="box">
                                        <div class="img">
                                            <img src="' . $row3[5] . '" alt="">
                                        </div>
                                        <div class="box_content">
                                            <div class="title">
                                                <h3>' . $row3[6] . '</h3>
                                            </div>
                                            <div class="userName">
                                                <h3>Time: <span>' . $row3[2] . '</span></h3>
                                            </div>
                                        </div>
                                    </a>';
                                $i++;
                                if($i == 5)
                                {
                                    break;
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            
            <div class="row_sp">
                <div class="sp_column_info">
                    <div class="heading_column">
                        <H3>Giới thiệu</H3>
                    </div>
                    <div class="info">
                        <p>Chào mừng bạn đến với trang web của chúng tôi 
                            - nơi mang đến những bài viết đa dạng và cảm xúc về nhiều chủ đề giống như báo điện tử. 
                            Khám phá và cảm nhận những điều tuyệt vời mà chúng tôi chia sẻ! 
                            Cảm ơn bạn đã đồng hành cùng chúng tôi
                        </p>
                    </div>
                </div>
                <div class="sp_column_new">
                    <div class="heading_column">
                        <H3>Tin nổi bật</H3>
                    </div>
                    <?php
                        $d2 = new post();
                        $r_view = $d->get_post_view(); 
                        if(mysqli_num_rows($r_view) > 0)
                        {
                            $dem=0;
                            while($row4 = mysqli_fetch_row($r_view))
                            {
                                $url = create_friendly_url($row4[6],$row4[0]);
                                echo '<a href="Post_Content.php?url=' . $url . '" class="box_sp">
                                        <div class="box_sp_text">
                                            <p>'.$row4[6].'</p>
                                        </div>
                                        <div class="box_sp_img">
                                            <img src="'.$row4[5].'" alt="">
                                        </div>
                                    </a>';
                                    $dem++;
                                    if($dem==6)break;
                            }
                        }
                    ?>
                </div>
                <div class="sp_column_new">
                    <div class="heading_column">
                        <H3>Chủ đề hot</H3>
                    </div>
                    <?php
                        $d3 = new topic_model();
                        $r_topic_view = $d3->get_topic_view();
                        if(mysqli_num_rows($r_view) > 0)
                        {
                            $dem=0;
                            while($row5 = mysqli_fetch_row($r_topic_view))
                            {
                                $url = create_friendly_url($row5[1],$row5[0]);
                                echo '<div class="box_sp_title">
                                        <a href="../controller/Home_Post_Topic.php?url=' . $url . '">'.$row5[1].'</a>
                                    </div>';
                                    $dem++;
                                    if($dem==6)break;
                            }
                        }
                    ?>
                </div>
                <div class="sp_column_new">
                    <div class="heading_column">
                        <H3>Liên hệ</H3>
                    </div>
                    <div class="box_sp_contact">
                        <i class="ti-mobile"></i>
                        <p>0926870380</p>
                    </div>
                    <div class="box_sp_contact">
                        <i class="ti-email"></i>
                        <p>laptrinhvuive@gmail.com</p>
                    </div>               
                    <div class="box_sp_contact">
                        <a href="" class="contact"><i style="font-size:22px;" class="ti-facebook"></i></a>
                        <a href="" class="contact"><i style="font-size:22px;" class="ti-youtube"></i></a>
                        <a href="" class="contact"><i style="font-size:22px;" class="ti-github"></i></a>
                    </div>        
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
                        <li>Trụ sở: <span>Vũ Thư - Thái Bình - Việt Nam</span></li>
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