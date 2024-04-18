<?php
class database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "laptrinhweb2";
    private $conn;
    private $pdo;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $conStr = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $this->servername, $this->dbname);
        $this->pdo = new PDO($conStr, $this->username, $this->password);
    }

    function insert_data($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    function modify_data($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    function get_data($sql)
    {
        return $this->conn->query($sql);
    }
    function close_dtb()
    {
        $this->conn->close();
        $this->pdo = null;
    }
    function get_pdo()
    {
        return $this->pdo;
    }
    function changeImgByPDO($filePath, $sql)
    {
        $blob = fopen($filePath, 'rb');
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':img', $blob, PDO::PARAM_LOB);
        return $stmt->execute();
    }







    // hàm thực hiện sql
    function mysqli_query($data){
        $result = $this->conn->query($data);
        if ($result !== FALSE) {
            return $result;
        } else {
            return false;
        }
    } 
    function filteration($data)
    {
        foreach ($data as $key => $value) {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
        }
        return $data;
    }
    function selectAll($table)
    {
        $con = $this->conn;
        $res = mysqli_query($con, "SELECT * FROM $table");
        return $res;
    }
    function select($sql, $values, $datatypes)
    {
        $con = $this->conn;
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //gán giá trị trong $value vào mã sql 
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed -Select");
            }
        } else {
            die("Query cannot be executed -Select");
        }
    }
    function update($sql, $values, $datatypes)
    {
        $con = $this->conn;
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //gán giá trị trong $value vào mã sql 
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed -Update");
            }
        } else {
            die("Query cannot be executed -Update");
        }
    }
    function insert($sql, $values, $datatypes)
    {
        $con = $this->conn;
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //gán giá trị trong $value vào mã sql 
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Insert");
            }
        } else {
            die("Query cannot be executed - Insert");
        }
    }
    function delete($sql, $values, $datatypes)
    {
        $con = $this->conn;
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //gán giá trị trong $value vào mã sql 
            if (mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed -Delete");
            }
        } else {
            die("Query cannot be executed -Delete");
        }
    }
}
