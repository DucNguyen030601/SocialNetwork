<?php
    class Block{
		public $id;
        public $user_id;
        public $blocked_user_id;

		public const TABLE='block_list';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->user_id = $data['user_id']??'';
			$this->blocked_user_id = $data['blocked_user_id']??'';
		}
}

?>