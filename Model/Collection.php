<?php
    class Collection{
		public $id;
        public $post_id;
        public $file_name;
		public $type;

		public const TABLE='collections';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->post_id = $data['post_id']??'';
			$this->file_name = $data['file_name']??'';
			$this->type=$data['type']??'';
		}
}

?>