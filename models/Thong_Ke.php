<?php
    class thong_ke_du_lieu
    {
        private $host = "localhost";
        private $username = "root";
        private $pass = "";
        private $database = "web_tin_tuc";
        private $db;

        public function open_kn()
        {
            $this->db = mysqli_connect($this->host,$this->username,$this->pass,$this->database);
            if($this->db->connect_error)
            {
                die("LỖI: Không thể kêt nối đến cơ sở dữ liệu.");
            }
            else
            {
                mysqli_query($this->db,"SET NAME 'utf8'");
            }
        }

        public function ghi_du_lieu_txt()
        {
            $sql_Topic = "SELECT `topicName`,`view` FROM `topic` WHERE 1";
            $sql_Post = "SELECT `postHeader`,`view` FROM `posts` WHERE postStatus = '1' ORDER BY `view` DESC LIMIT 20";

            $thang_hien_tai = date('m');
            $nam_hien_tai = date('Y');

            $duong_dan_thongke = '../thong_ke/';
            $ten_tep = $thang_hien_tai . '-' . $nam_hien_tai . '.txt';

            $duong_dan_tep = $duong_dan_thongke . $ten_tep;

            try 
            {
               $this->open_kn();
               $rs_Title = mysqli_query($this->db,$sql_Topic);
               $rs_Post = mysqli_query($this->db,$sql_Post);

               $tep = fopen($duong_dan_tep, 'w');

               if($tep)
               {
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $timestamp = time();
                    $formattedDate = date('l, d/m/Y, H:i', $timestamp);

                    $ngay_thong_ke = "##########Ngày cập nhật: ".$formattedDate. "\n";

                    fwrite($tep,$ngay_thong_ke);
                    fwrite($tep,"##########Danh sách tổng lượt truy cập vào các chủ đề \n");
                    while($row_Title = mysqli_fetch_row($rs_Title))
                    {
                        $data = $row_Title[0] . ' - ' . $row_Title[1] . "\n";
                        fwrite($tep,$data);
                    }
                    fwrite($tep,"##########Top 100 bài viết có lượt tổng lượt truy cập cao nhất \n");
                    while($row_Post = mysqli_fetch_row($rs_Post))
                    {
                        $data = $row_Post[0] . ' - ' . $row_Post[1] . "\n";
                        fwrite($tep,$data);
                    }
                    fclose($tep);
                    return $duong_dan_tep;
               }
               return null;

            } catch (Throwable $th) 
            {
                throw $th;
                return null;
            }
            finally
            {
                mysqli_close($this->db);
            }

        }
    }