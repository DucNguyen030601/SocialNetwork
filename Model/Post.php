<?php
    class Post{
		public $id;
        public $user_id;
        public $post_text;
		public $created_at;
		public $hidden;

		public const TABLE='posts';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->user_id = $data['user_id']??'';
			$this->post_text = $data['post_text']??'';
			$this->created_at=$data['created_at']??date('Y/m/d H:i:s', time());
			$this->hidden = $data['hidden']??0;
		}
}

?>