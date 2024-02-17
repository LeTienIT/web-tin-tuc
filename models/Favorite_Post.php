<?php
    class favorite_model
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

        public function check_Favorite($userID,$postID)
        {
            try {
                $this->open_kn();
                $sql = "SELECT * FROM `favorite_post` WHERE `userID`=? and `postID`=?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("ii",$userID,$postID);
                $stmt->execute();
                $rs = $stmt->get_result();
                if($rs->num_rows > 0)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            } catch (Throwable $th) {
                throw $th;
            }
            finally{
                mysqli_close($this->db);
            }
        }

        public function add_Favorite($userID,$postID)
        {
            try {
                $this->open_kn();
                $sql = "INSERT INTO `favorite_post`(`userID`, `postID`) VALUES (?,?)";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("ii",$userID,$postID);
                $stmt->execute();
                if($stmt->affected_rows > 0)
                {
                    return 1; 
                }
                else
                {
                    return 0; 
                }
            } catch (Throwable $th) {
                throw $th;
            }
            finally{
                mysqli_close($this->db);
            }
        }
        public function delete_Favorite($userID,$postID)
        {
            try {
                $this->open_kn();
                $sql = "DELETE FROM `favorite_post` WHERE (`userID`=? AND `postID`=?)";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("ii",$userID,$postID);
                $stmt->execute();
                if($stmt->affected_rows > 0)
                {
                    return 1; 
                }
                else
                {
                    return 0; 
                }
            } catch (Throwable $th) {
                throw $th;
            }
            finally{
                mysqli_close($this->db);
            }
        }
    }