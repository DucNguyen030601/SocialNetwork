<?php
    class Follow{
		public $id;
        public $follower_id;
        public $user_id;

		public const TABLE='follow_list';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->follower_id = $data['follower_id']??'';
			$this->user_id = $data['user_id']??'';
		}
}

?>