<?php
    class Notification{
		public $id;
        public $from_user_id;
        public $to_user_id;
        public $message;
        public $created_at;
        public $read_status;
        public $url;

		public const TABLE='notifications';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->from_user_id = $data['from_user_id']??'';
            $this->to_user_id = $data['to_user_id']??'';
            $this->message = $data['message']??'';
			$this->created_at = $data['created_at']??date('Y/m/d H:i:s', time());
            $this->read_status = $data['read_status']??0;
            $this->url = $data['url']??'';
		}
}

?>