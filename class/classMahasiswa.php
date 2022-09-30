<?php
require "Conn.php";
class Mahasiswa extends Conn
{
    public function __construct($sname, $uname, $pass, $db_name)
    {
        parent:: __construct($sname, $uname, $pass, $db_name);
    }

    public function getMahasiswa()
    {
        $sql = "select * from mahasiswa";               
        $res  = $this->conn->query($sql);

        return $res;
    }
} 

?>