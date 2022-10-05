<?php
require ("Conn.php");
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

    public function getJadwalMahasiswa($nrp,$idhari,$idjam_kuliah)
    {
        $sql = "SELECT * FROM jadwal where nrp = ? and idhari = ? and idjam_kuliah = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $nrp,$idhari,$idjam_kuliah);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }
}
