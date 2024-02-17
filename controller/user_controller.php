<?php   
    session_start();
    require_once "../models/UserModel.php";
    if(isset($_POST["updateUser"]))
    {
        $userName = $_POST['userName'];
        $userPhone = $_POST['userPhone'];
        $userEmail = $_POST['userEmail'];
        $passOld = $_POST['userPassID'];
        $passNew = $_POST['userPassN'];
        if(isset($_SESSION["userID"]))
        {
            $userID = $_SESSION["userID"];
            $user = new userModel();
            $rs = $user->get_user_id($userID);
            if($rs)
            {
                $row = mysqli_fetch_row($rs);
                $passID = $row[5];
                if(strcmp($passID,$passOld)==0)
                {
                    $check = $user->update_user($userID, $userName, $userPhone, $userEmail, $passNew);
                    header("Location: ../view/user.php?error=0");
                }
                else
                {
                    header("Location: ../view/user.php?error=1");
                }
            }
            else
            {
                header("Location: ../view/user.php?error=2");
            }
        }
        else
        {
            header("Location: ../view/user.php?error=2");
        }
    }
    else if(isset($_POST["backHome"]))
    {
        header("Location: ../view/Home.php");
    }
    else if(isset($_POST["userLogout"]))
    {
        header("Location: Home_Logout_Controller.php");
    }
    