<?php
    session_start();
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    class Database{
        private  $HOST_NAME = 'localhost';
        private  $USER_NAME = 'root';
        private  $PASSWORD = '';
        private  $DB_NAME = 'pictogram';
        private $conn;
        function __construct()
        {
            $this->conn= new mysqli($this->HOST_NAME,$this->USER_NAME,$this->PASSWORD,$this->DB_NAME);
            if($this->conn->connect_error)
           {
               die("Connection failed: " . $this->conn->connect_error);
           }
           mysqli_set_charset($this->conn,"utf8");
        }
        public function getID()
        {
            return $this->conn->insert_id;
        }
       
        public function close()
        {
            $this->conn->close();
        }
        public function execute_error()
        {
            return $this->conn->error;
        }
        public function getRow($query)
        {
            $result = $this->conn->query($query);
            return $result->fetch_array(1);
        }
        public function getAllData($query)
        {
            $data = array();
            $result = $this->conn->query($query);
            while($row = $result->fetch_array(1))
            {
                $data[] = (object)$row;
            }
            return $data;
        }
        public function execute($query)
        {
            return $this->conn->query($query); 
        }
        public function Where($where=[],$table=[],$select=['*'],$orderby=['id','asc'])
		{
            $columns = implode(',',$select);
            $orderBy = implode(' ',$orderby);
            $Table = implode(',',$table);
            $Where = $this->stringWhere($where,'AND');
			$query="SELECT $columns FROM $Table WHERE $Where ORDER BY $orderBy";
            return $this->getAllData($query);
		}
        public function Show($table,$select=['*'],$orderby=['id','asc'])
		{
            $columns = implode(',',$select);
            $orderBy = implode(' ',$orderby);
			$query="SELECT $columns FROM $table ORDER BY $orderBy";
            return $this->getAllData($query);
		}
        
        function stringWhere($where=[],$k)
        {
            $s='';
            $i=0;
            foreach ($where as $key => $data) {
                $i++;
                if(count((array)$data)!=1) $s.= "$key = {$data[0]}";
                else $s.= "$key = '$data'";
                if(count($where)!=$i) 
                {
                    $s.=" $k ";
                }
            }
            return $s;
        }
        public function SingleOrDefault($where=[],$table,$select=['*'],$orderby=['id','asc'])
		{
            $columns = implode(',',$select);
            $orderBy = implode(' ',$orderby);
            $Where = $this->stringWhere($where,'AND');
			$query="SELECT $columns FROM $table WHERE $Where ORDER BY $orderBy";
            return (object)$this->getRow($query);
		}
        public function Add($table,$object)
        {
            $columns = '';
            $values ='';
            $i=0;
            foreach ($object as $key => $data)
            {
                $i++;
                $columns.=$key;
                $values.="'$data'";
                if(count((array)$object)!=$i) 
                {
                    $columns.=',';
                    $values.=',';
                }
            }
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
            return $this->execute($query);

        }
        public function Update($table,$object)
        {
            $set = $this->stringWhere((array)$object,',');
            $query = "UPDATE $table SET $set WHERE id = {$object->id}";
            return $this->execute($query);
        }
        public function Delete($table,$object)
        {
            $where = $this->stringWhere((array)$object,'AND');
            $query ="DELETE from $table where $where";
            return $this->execute($query);
        }
        
    }
?>