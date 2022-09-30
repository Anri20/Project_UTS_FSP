<?php
class Conn
{
    protected $conn;

    public function __construct($sname, $uname, $pass, $db_name)
    {
        $this->conn = mysqli_connect($sname, $uname, $pass, $db_name);

        if ($this->conn->connect_errno) {
            die('Connection Failed!. Failed to connect to MySQL = ' + $this->conn->connect_errno);
        }
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    function __destruct()
    {
        $this->conn->close();
    }
}
