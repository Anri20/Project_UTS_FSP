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

    public function getJadwalMahasiswa($nrp)
    {
        $sql = "select idhari, idjam_kuliah, from jadwal where nrp = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $nrp);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }
} 

?>