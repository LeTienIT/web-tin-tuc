<?php
    require_once "../models/Thong_Ke.php";
    $thong_ke = new thong_ke_du_lieu();

    $duong_dan = $thong_ke->ghi_du_lieu_txt(); 
    if($duong_dan != null)
    {
        echo '<h1 style="display:flex;justify-content: center;align-items: center;width: 100%; height:100%;text-align:center;"> 
                Dữ liệu đã được lưu trong: <a href='.$duong_dan.' target = "_ blank">'.$duong_dan.'</a>
            </h1>' ;
    }
    else
    {
        echo '<h1>Lỗi. Không thể ghi dữ liệu ra file</h1>' ;
    }