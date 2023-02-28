<?php
    class Report{
		public $id;
        public $user_id;
        public $reporter_id;
        public $type;
        public $type_id;

		public const TABLE='report_list';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->user_id = $data['user_id']??'';
			$this->reporter_id = $data['reporter_id']??'';
            $this->type = $data['type']??'';
            $this->type_id = $data['type_id']??'';
		}
}

?>