<?php
// require("class/classEditJadwal.php");
require("class/classMahasiswa.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <div class="container">
    <?php
    $conn = new mysqli("localhost","root","","uts_fsp_jadwal");
    $sql1 = "select * from hari";
    $hari = $conn->query($sql1);
    $mahasiswa = new Mahasiswa("localhost", "root", "", "uts_fsp_jadwal");
    $listHari = array();
    $sql2 = "select * from jam_kuliah";
    $jam_kuliah = $conn->query($sql2);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $jadwalmahasiswa = $mahasiswa->getJadwalMahasiswa($id);   
      }
      else{
          $id = 0;        
      }
    ?>
        <h2 style="text-align: center">Jadwal</h2>
        <div style="margin: 30px">
            <?php
            
            // $res = $mahasiswa->getMahasiswa();
            $res = $conn->query("select * from mahasiswa");
            echo "Mahasiswa: <select name='id'>
            <option id = '0'>--Silahkan Pilih Nama--</option>";
            while ($row = $res->fetch_assoc()) {             
                echo "<option id='".$row['nrp']."'>".$row['nama']."</option>";
            }
            echo "</select> 
            <form method='GET' action='index.php'>
            <input type='submit' name='submit' value='simpan'\>";          
            ?>
        </div>
        <div class="table">
            <table class="demo">
                <tr>
                    <td></td>
                    <?php
                    while ($row1 = $hari->fetch_assoc()) {
                        echo "<td class='demo td'>" . $row1['nama'] . "</td>";
                        $listHari[] = $row1['nama']; 
                    }
                    ?>
                </tr>
                <?php
                while ($row2 = $jam_kuliah->fetch_assoc()) {
                    echo "<tr>
                    <td style='min-width: 100px;'>
                    " . substr($row2['jam_mulai'], 0, 5) . " - " . substr($row2['jam_selesai'], 0, 5);
                    $sql3 = "SELECT m.nama, jk.jam_mulai, jk.jam_selesai, h.nama as namaHari From mahasiswa m inner join jadwal j on m.nrp = j.nrp inner join jam_kuliah jk on j.idjam_kuliah = jk.idjam_kuliah inner join hari h on j.idhari = h.idhari";
                    $datajadwal = $conn->query($sql3);
                    
                    foreach ($listHari as $key => $value) {
                        echo "<td>";
                        while($row3 = $hari->fetch_assoc()){
                            if($row3['namaHari'] == $value)
                            {
                                echo "v";
                            }
                        }
                        echo "</td>";
                    }
                echo "</tr>";
                }
                echo "</form>";
                ?>
            </table>
        </div>
        <div style="text-align: center">
            <button><a href="editjadwal.php">Ubah Jadwal</a></button>
        </div>

    </div>

</body>

</html>