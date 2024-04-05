<?php
    class database{
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "laptrinhweb2"; 
        private $conn;

        function __construct() {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // if($this->conn){
            //     echo "Ket noi thanh cong";
            // }else{
            //     echo "Ket noi that bai";
            // }
        }

        function insert_data($sql){
            if ($this->conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        
        function get_data($sql){
            return $this->conn->query($sql);
        }
        function close_dtb(){
            $this->conn->close();
        }

    }

?>