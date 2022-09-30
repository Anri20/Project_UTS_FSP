<?php
require("Conn.php");
class Edit extends Conn
{
    public function __construct($sname, $uname, $pass, $db_name)
    {
        parent:: __construct($sname, $uname, $pass, $db_name);
    }

    public function getJadwal($nrp)
    {
        $sql = "select * from jadwal where nrp = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $nrp);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }

    public function selectJadwal()
    {
        $sql = "select * from jadwal ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $nrp);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }
}
