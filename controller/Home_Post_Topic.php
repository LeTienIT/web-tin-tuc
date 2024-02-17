<?php

    if (isset($_GET['url'])) {
        $friendly_url = $_GET['url'];
        $last_hyphen_pos = strrpos($friendly_url, '-');
        $topicID = substr($friendly_url, $last_hyphen_pos + 1);
    }

    //$topicID = $_GET["postID"];

    $host = "localhost";
    $username = "root";
    $pass = "";
    $database = "web_tin_tuc";

    $db = mysqli_connect($host,$username,$pass,$database);
    if($db->connect_error)
    {
        die("LỖI: Không thể kêt nối đến cơ sở dữ liệu.");
    }
    else
    {
        try
        {
            $sql2 = "UPDATE topic SET view = view + 1 WHERE topicID = $topicID";
            mysqli_query($db,$sql2);
        }
        catch (Throwable $th) {
            throw $th;
        }
        finally
        {
            mysqli_close($db);
        }
        
    }
    
    $redirectURL = "../view/Post_Topic.php?url=' . $friendly_url . '";
    header("Location: $redirectURL");
    exit();
?>