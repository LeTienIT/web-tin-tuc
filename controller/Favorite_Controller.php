<?php
    session_start();
    require_once "../models/Favorite_Post.php";

    $favorite = new favorite_model();

    if(isset($_POST["favorite_add"]))
    {
        if(isset($_SESSION["userID"]) && ($_SESSION["userID"] != -1))
        {
            $userID = $_SESSION["userID"];
            $postID = $_POST["postID"];
            $url_post = $_POST["url_post"];

            if($favorite->check_Favorite($userID,$postID)==true)
            {
                if($favorite->add_Favorite($userID,$postID)==1)
                {
                    header("Location: ../view/Post_Content.php?url=".$url_post);
                }
                else
                {
                    echo "Đã xảy ra lỗi, vui lòng thử lại sau";
                }
            }
            else
            {
                if($favorite->delete_Favorite($userID,$postID)==1)
                {
                    header("Location: ../view/Post_Content.php?url=".$url_post);
                }
                else
                {
                    echo "Đã xảy ra lỗi, vui lòng thử lại sau";
                }
            }
        }
        else
        {
            header("Location: ../view/login_2.php");
        }
    }
    else if(isset($_POST["delete"]))
    {
        if(isset($_SESSION["userID"]) && ($_SESSION["userID"] != -1))
        {
            $userID = $_SESSION["userID"];
            $postID = $_POST["postID_favorite"];
            if($favorite->delete_Favorite($userID,$postID)==1)
                {
                    header("Location: ../view/user.php");
                }
                else
                {
                    echo "Đã xảy ra lỗi, vui lòng thử lại sau";
                }
        }
        else
        {
            header("Location: ../view/login_2.php");
        }
    }
    