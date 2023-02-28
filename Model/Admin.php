<?php
    class Admin{
		public $id;
        public $full_name;
        public $email;     
        public $password;
		public const TABLE='admin';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->full_name = $data['full_name']??'';
			$this->password = $data['password']??'';
			$this->email = $data['email']??'';
		}
}

?>