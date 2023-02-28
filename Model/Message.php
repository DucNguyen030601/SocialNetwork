<?php
    class Message{
		public $id;
        public $from_user_id;
        public $to_user_id;
        public $msg;
        public $read_status;
        public $request;
        public $created_at;

		public const TABLE='messages';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->from_user_id = $data['from_user_id']??'';
			$this->to_user_id = $data['to_user_id']??'';
            $this->msg = $data['msg']??'';
            $this->read_status = $data['read_status']??0;
            $this->request = $data['request']??0;
			$this->created_at = $data['created_at']??date('Y/m/d H:i:s', time());
		}
}

?>