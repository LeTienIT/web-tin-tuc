<?php
    require_once '../models/UserModel.php';
    if(isset($_POST['register']))
    {
        $userID = $_POST['userID'];
        $userName = $_POST['userName'];
        $userPassword = $_POST['userPassword'];

        $user = new userModel();

        if(isset($_POST['checkBox']))
        {
            if(($user->check_nameID($userID)))
            {
                if(($user->userAdd($userID, $userName, "" , "", $userPassword,"0"))==1)
                {
                    header("Location: ../view/register_2.php?error=0");
                }
                else
                {
                    header("Location: ../view/register_2.php?error=1");
                }
            }
            else
            {
                header("Location: ../view/register_2.php?error=2");
            }
        }
        else
        {
            header("Location: ../view/register_2.php?error=3");
        }
    }