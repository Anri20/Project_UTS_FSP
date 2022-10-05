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
        $sql = "SELECT m.nama, jk.jam_mulai, jk.jam_selesai, h.nama as namaHari From mahasiswa m inner join jadwal j on m.nrp = j.nrp inner join jam_kuliah jk on j.idjam_kuliah = jk.idjam_kuliah inner join hari h on j.idhari = h.idhari where m.nrp = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $nrp);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }
} 


?>