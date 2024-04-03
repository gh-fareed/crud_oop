<?php
print_r($_POST);
$id = $_POST['sid'];
$table = $_POST['stable'];
echo "Received ID: " . $id . "<br>";
echo "Received Table: " . $table . "<br>";


    class Database{
        public $host , $user , $pass  , $conn = false;
        public $db;
        public $result = array();

        public function __construct(){
            $this->host = $_SERVER['SERVER_NAME'];
            $this->user = "root";
            $this->pass = "";
            $this->db = "test"; 

            if(!$this->conn){
                $this->conn = new mysqli($this->host , $this->user , $this->pass , $this->db);
            }
            if($this->conn->connect_error){
                array_push($this->result ,$this->conn->connect_error );
                return false;
            }
            else{
                return true ;
            } ;
      
            
        }
        private function checkTable($table){
            $sql = "SHOW TABLES LIKE '$table'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
        }
        private function getcolumns($table){
            $sql = "SELECT COLUMN_NAME 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = '$this->db' 
            AND TABLE_NAME = '$table'
            AND ORDINAL_POSITION > 1";
         $result = $this->conn->query($sql);
         $columns = array();
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $columns[] = $row["COLUMN_NAME"];
             }
         } else {
             echo "0 results";
         }
         return $string = implode(", ", $columns);
        }
        function insert($table , $data = array()){
            if($this->checkTable($table)){
            $string = $this->getcolumns($table);
            $values = implode(" ',' " , $data);
            $insert = "insert into $table ($string) value ('$values')";
             if($this->conn->query($insert)){
                echo "records inserted";
                return true;
             }
             else{
                echo $this->conn->error;
                return false;
             }
            }}
            public function update($table,$id){
                $sql = "select * from $table where id = $id";
            }
        
      
        public function __destruct(){
            if($this->conn){
                $this->conn->close();
                return true;
            }
            else{
                return false;
            }
        }
    }

?>