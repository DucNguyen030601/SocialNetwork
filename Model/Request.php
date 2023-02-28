<?php
    class Request{
		public $id;
        public $from_user_id;
        public $to_user_id;
		public const TABLE='message_requests';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->from_user_id = $data['from_user_id']??'';
            $this->to_user_id = $data['to_user_id']??'';
		}
}

?>