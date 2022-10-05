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
    <script src="js/jquery-3.6.1.min.js"></script>
    <style>
        td{
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        $mahasiswa = new Mahasiswa("localhost", "root", "", "uts_fsp_jadwal");
        
        $sql1 = "select * from hari";
        $hari = $mahasiswa->query($sql1);

        $sql2 = "select * from jam_kuliah";
        $jam_kuliah = $mahasiswa->query($sql2);
        ?>
        <h2 style="text-align: center">Jadwal</h2>
        <div style="margin: 30px">
            <form action="index.php" method="post">
                Mahasiswa: <select name="mahasiswa" id="mahasiswa">
                    <option hidden>--Silakan Pilih Nama--</option>
                    <?php
                    $res = $mahasiswa->query("select * from mahasiswa");
                    if (isset($_POST['mahasiswa'])) {
                        $pilihan = $_POST['mahasiswa'];
                        setcookie('nrp', $_POST['mahasiswa'], time() + (86400));
                        while ($row = $res->fetch_assoc()) {
                            if ($row['nrp'] == $pilihan) {
                                echo "<option value='" . $row['nrp'] . "' selected>" . $row['nama'] . "</option>";
                                setcookie('mahasiswa', $row['nama'], time() + (86400));
                            } else {
                                echo "<option value='" . $row['nrp'] . "'>" . $row['nama'] . "</option>";
                            }
                        }
                    } else {
                        while ($row = $res->fetch_assoc()) {
                            echo "<option value='" . $row['nrp'] . "'>" . $row['nama'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <input type='submit' name='btnsubmit' id='btnsubmit' value='Pilih'>
            </form>
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
                $i = 1;
                // echo $jam_kuliah->num_rows;
                 while ($row2 = $jam_kuliah->fetch_assoc()) {
                     //echo "test <br>";
                     //echo $i;
                     for ($j = 1; $j <= 7; $j++) {
                        //  echo $i."_".$j."<br>";
                        $jadwal = $mahasiswa->getJadwalMahasiswa($pilihan, $j, $i);
                        // echo $jadwal->num_rows."<br>";
                        if ($j == 1) {
                            $minggu = ($jadwal->num_rows > 0) ? "v" : "";
                        } else if ($j == 2) {
                            $senin = ($jadwal->num_rows > 0) ? "v" : "";
                        } else if ($j == 3) {
                            $selasa = ($jadwal->num_rows > 0) ? "v" : "";
                        } else if ($j == 4) {
                            $rabu = ($jadwal->num_rows > 0) ? "v" : "";
                        } else if ($j == 5) {
                            $kamis = ($jadwal->num_rows > 0) ? "v" : "";
                        } else if ($j == 6) {
                            $jumat = ($jadwal->num_rows > 0) ? "v" : "";
                        } else if ($j == 7) {
                            $sabtu = ($jadwal->num_rows > 0) ? "v" : "";
                        }

                       
                
                    }
                    echo "<tr>
                    <td style='min-width: 100px;'>
                    " . substr($row2['jam_mulai'], 0, 5) . " - " . substr($row2['jam_selesai'], 0, 5) . "
                    </td>
                    <td>
                        $minggu
                    </td>
                    <td>
                        $senin
                    </td>
                    <td>
                        $selasa
                    </td>
                    <td>
                        $rabu
                    </td>
                    <td>
                        $kamis
                    </td>
                    <td>
                        $jumat
                    </td>
                    <td>
                        $sabtu
                    </td>
                </tr>";
                     $i++;
                }

                ?>
            </table>
        </div>
        <div style="text-align: center">
            <form action="editjadwal.php" method="post">
                <?php
                if (isset($pilihan)) {
                    echo "<input type='hidden' name='nrp' value='$pilihan'>";
                }
                ?>
                <input type="submit" value="Ubah Jadwal">
            </form>
        </div>

    </div>

</body>
<script>
    // $('#Mahasiswa').change(function() {
    //     localStorage.nrp = $('#Mahasiswa').val();
    // })
    // $('#btnsubmit').click(function(){
    //     alert($pilihan);
    // })
</script>

</html>