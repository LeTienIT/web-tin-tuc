<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    require_once "../models/CommentsModel.php";
    require_once "../models/PostModel.php";
    class comment
    {
        private $postID;
        private $userID;
        private $userName;
        private $content;
        private $db;
        public function __construct()
        {
            $this->postID = $_POST["postID"];
            $this->userID = $_SESSION["userID"];
            $this->userName = $_SESSION["userName"];
            $this->content = $_POST["ct_comment"];
            $this->db = new comment_model();
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
            $slug = $this->remove_accents($title);
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $slug));
            $url = $slug . '-' . $post_id;
        
            return $url;
        }
        public function tao_URL()
        {
            $modelPost = new post_model();
            $rs = $modelPost->get_post_id($this->postID);
            $row = mysqli_fetch_row($rs);
            $title = $row[0];
            $url = $this->create_friendly_url($title,$this->postID);
            return $url;
        }
        public function add_cm()
        {
            $rs = $this->db->add_comment($this->postID,$this->userID,$this->userName,$this->content);
            $url = $this->tao_URL();
            if($rs == 1)
            {
                header('Location: ../view/Post_Content.php?url=' .$url . '#comments');
            }
            else
            {
                echo '<h1 style="font-size: 20px;color: red;text-align:center;padding:20px 10%;">Lỗi thêm nội dung</h1>';
            }
        }
    }
    $add = new comment();
    $add->add_cm()
?>