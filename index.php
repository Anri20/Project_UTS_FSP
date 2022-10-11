<?php
require("class/classMahasiswa.php");

// For Hosting
// $sname = "localhost";
// $uname = "id19682257_hennvis";
// $pass = "7eGwCAa!mo9D-EVg";
// $db_name = "id19682257_uts_fsp_jadwal";

// For Local
$sname = "localhost";
$uname = "root";
$pass = "";
$db_name = "uts_fsp_jadwal";

$mahasiswa = new Mahasiswa($sname, $uname, $pass, $db_name);

$sql1 = "select * from hari";
$hari = $mahasiswa->query($sql1);

$sql2 = "select * from jam_kuliah";
$jam_kuliah = $mahasiswa->query($sql2);

$res = $mahasiswa->query("select * from mahasiswa");

if (isset($_POST['mahasiswa'])) {
    $pilihan = $_POST['mahasiswa'];
    setcookie('nrp', $_POST['mahasiswa'], time() + (3600), "/");
    while ($row = $res->fetch_assoc()) {
        if ($row['nrp'] == $pilihan) {
            setcookie('mahasiswa', $row['nama'], time() + (3600), "/");
        }
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal</title>

    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 style="text-align: center">Jadwal</h2>
        <div class="search">
            <form action="index.php" method="post">
                Mahasiswa: <select name="mahasiswa" id="mahasiswa">
                    <option hidden>--Silakan Pilih Nama--</option>
                    <?php
                    $pilihan = '';

                    if (isset($_POST['mahasiswa'])) {
                        while ($row = $res->fetch_assoc()) {
                            if ($row['nrp'] == $pilihan) {
                                echo "<option value='" . $row['nrp'] . "' selected>" . $row['nama'] . "</option>";
                            } else {
                                echo "<option value='" . $row['nrp'] . "'>" . $row['nama'] . "</option>";
                            }
                        }
                    } else if (isset($_COOKIE['nrp'])) {
                        $pilihan = $_COOKIE['nrp'];
                        while ($row = $res->fetch_assoc()) {
                            if ($row['nrp'] == $pilihan) {
                                echo "<option value='" . $row['nrp'] . "' selected>" . $row['nama'] . "</option>";
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
            <table>
                <tr>
                    <td></td>
                    <?php
                    while ($row1 = $hari->fetch_assoc()) {
                        echo "<td>" . $row1['nama'] . "</td>";
                    }
                    ?>
                </tr>
                <?php
                $i = 1;
                while ($row2 = $jam_kuliah->fetch_assoc()) {
                    for ($j = 1; $j <= 7; $j++) {
                        $jadwal = $mahasiswa->getJadwalMahasiswa($pilihan, $j, $i);

                        if ($j == 1) {
                            $minggu = ($jadwal->num_rows > 0) ? "&#10003;" : "";
                        } else if ($j == 2) {
                            $senin = ($jadwal->num_rows > 0) ? "&#10003;" : "";
                        } else if ($j == 3) {
                            $selasa = ($jadwal->num_rows > 0) ? "&#10003;" : "";
                        } else if ($j == 4) {
                            $rabu = ($jadwal->num_rows > 0) ? "&#10003;" : "";
                        } else if ($j == 5) {
                            $kamis = ($jadwal->num_rows > 0) ? "&#10003;" : "";
                        } else if ($j == 6) {
                            $jumat = ($jadwal->num_rows > 0) ? "&#10003;" : "";
                        } else if ($j == 7) {
                            $sabtu = ($jadwal->num_rows > 0) ? "&#10003;" : "";
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
        <div class="button">
            <form action="editjadwal.php" method="post">
                <?php
                if (isset($pilihan)) {
                    echo "<input type='hidden' name='nrp' value='$pilihan'>";
                }

                if (isset($_POST['mahasiswa'])) {
                    echo '<input type="submit" value="Ubah Jadwal">';
                } else if (isset($_COOKIE['mahasiswa'])) {
                    echo '<input type="submit" value="Ubah Jadwal">';
                } else {
                    echo '<input type="submit" value="Ubah Jadwal" disabled>';
                }
                ?>
            </form>
        </div>

    </div>

</body>

</html>