<?php
    session_start();
    if((isset($_SESSION["check_login"])) && ($_SESSION["check_login"]==true))
    {
        header("Location: ../view/user.php");
    }
    else
    {
        header("Location: ../view/login_2.php");
    }