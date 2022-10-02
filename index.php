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

    $sql2 = "select * from jam_kuliah";
    $jam_kuliah = $conn->query($sql2);
    ?>
        <h2 style="text-align: center">Jadwal</h2>
        <div style="margin: 30px">
            <?php
            $mahasiswa = new Mahasiswa("localhost", "root", "", "uts_fsp_jadwal");
            $res = $mahasiswa->getMahasiswa();
            echo "<span>Mahasiswa: <select name='Mahasiswa' id='mahasiswa'>
            <option>--Silahkan Pilih Nama--</option>";
            while ($row = $res->fetch_assoc()) {
                echo "<option>" . $row['nama'] . "</option>";
            }
            echo "</select> 
            <form method='GET'>
            <button>Pilih</button>";          
            ?>
        </div>
        <div class="table">
            <table class="demo">
                <tr>
                    <td></td>
                    <?php
                    while ($row1 = $hari->fetch_assoc()) {
                        echo "<td class='demo td'>" . $row1['nama'] . "</td>";
                    }
                    ?>
                </tr>
                <?php
                while ($row2 = $jam_kuliah->fetch_assoc()) {
                    echo "<tr>
                    <td style='min-width: 100px;'>
                    " . substr($row2['jam_mulai'], 0, 5) . " - " . substr($row2['jam_selesai'], 0, 5) . "
                    </td>
                    <td>
                       
                    </td>
                    <td>
                       
                    </td>
                    <td>
                       
                    </td>
                    <td>
                       
                    </td>
                    <td>
                       
                    </td>
                    <td>
                       
                    </td>
                    <td>
                    
                    </td>
                </tr>";
                }
                echo "</form>";
                ?>
        </div>
        <div style="text-align: center">
            <button><a href="editjadwal.php">Ubah Jadwal</a></button>
        </div>

    </div>

</body>

</html>
</body>

</html>