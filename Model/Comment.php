<?php
    class Comment{
		public $id;
        public $post_id;
        public $user_id;
        public $comment;
        public $created_at;
		public const TABLE='comments';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->post_id = $data['post_id']??'';
			$this->user_id = $data['user_id']??'';
            $this->comment = $data['comment']??'';
			$this->created_at = $data['created_at']??date('Y/m/d H:i:s', time());
		}
}

?>