<?php
    class User{
		public $id;
        public $first_name;
        public $last_name;
        public $gender;
        public $email;     
		 public $username;
        public $password;
		public $profile_pic;
		public $created_at;
		public $updated_at;
		public $ac_status;

		public const TABLE='users';
        function __construct($data='') {
			$this->id=$data['id']??'';
			$this->username = $data['username']??'';
			$this->password = $data['password']??'';
			$this->first_name = $data['first_name']??'';
			$this->last_name = $data['last_name']??'';
			$this->gender = $data['gender']??'';
			$this->email = $data['email']??'';
			$this->profile_pic=$data['profile_pic']??'default_profile.jpg';
			$this->created_at=$data['created_at']??date('Y/m/d H:i:s', time());
			$this->updated_at=$data['updated_at']??date('Y/m/d H:i:s', time());
			$this->ac_status=$data['ac_status']??1;
		}
}

?>