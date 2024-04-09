<?php
    class database{
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "laptrinhweb2"; 
        private $conn;
        private $pdo;

        function __construct() {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            $conStr = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $this->servername, $this->dbname);
            $this->pdo = new PDO($conStr, $this->username, $this->password);
        }

        function insert_data($sql){
            if ($this->conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        function modify_data($sql){
            if ($this->conn->query($sql) === TRUE){
                return true;
            }else{
                return false;
            }
        }
        function get_data($sql){
            return $this->conn->query($sql);
        }
        function close_dtb(){
            $this->conn->close();
            $this->pdo = null;
        }
        function get_pdo(){
            return $this->pdo;
        }
        function changeImgByPDO($filePath, $sql) {
            $blob = fopen($filePath, 'rb');
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':img', $blob, PDO::PARAM_LOB);
            return $stmt->execute();
        }
    }

?>