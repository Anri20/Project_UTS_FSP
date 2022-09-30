<?php
require("Conn.php");
class Edit extends Conn
{
    public function __construct($sname, $uname, $pass, $db_name)
    {
        parent:: __construct($sname, $uname, $pass, $db_name);
    }

    public function getJadwal($nrp, $idhari, $idjam_kuliah)
    {
        $sql = "select * from jadwal where nrp = ? and idhari = ? and idjam_kuliah = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $nrp, $idhari, $idjam_kuliah);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }

    public function insertJadwal($nrp, $idhari, $idjam_kuliah){
        $sql = "insert into jadwal(nrp, idhari, idjam_kuliah) values (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $nrp, $idhari, $idjam_kuliah);
        $stmt->execute();
    }

    public function deleteJadwal($nrp, $idhari, $idjam_kuliah){
        $sql = "delete from jadwal where nrp = ? and idhari = ? and idjam_kuliah = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $nrp, $idhari, $idjam_kuliah);
        $stmt->execute();
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
