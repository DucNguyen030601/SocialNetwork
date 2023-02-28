<?php
    class Like{
		public $id;
        public $post_id;
        public $user_id;

		public const TABLE='likes';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->post_id = $data['post_id']??'';
			$this->user_id = $data['user_id']??'';
		}
}

?>