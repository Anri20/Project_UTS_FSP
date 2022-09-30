<?php
include "Conn.php";
//include "classEditJadwal.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Jadwal</title>
    <link rel="stylesheet" href="css/editjadwal.css">
    <style>
        tr {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    $sname = "localhost";
    $uname = "root";
    $pass = "";
    $db_name = "uts_fsp_jadwal";

    $conn = new Conn($sname, $uname, $pass, $db_name);

    $sql1 = "select * from hari";
    //$hari = $conn->query($sql1);

    $sql2 = "select * from jam_kuliah";
    //$jam_kuliah = $conn->query($sql2);
    ?>
    <h2>Ubah Jadwal</h2>
    <h3>Mahasiswa: </h3>
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
        while ($row2 = $jam_kuliah->fetch_assoc()) {
            echo "<tr>
                    <td style='min-width: 100px;'>
                    " . substr($row2['jam_mulai'], 0, 5) . " - " . substr($row2['jam_selesai'], 0, 5) . "
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                </tr>";
        }
        ?>
    </table>
    <br>
    <button><a href="index.php">Kembali</a></button>
</body>

</html>