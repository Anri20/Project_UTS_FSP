<?php
require("class/classEditJadwal.php");
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
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <?php
    $sname = "localhost";
    $uname = "root";
    $pass = "";
    $db_name = "uts_fsp_jadwal";

    $conn = new Edit($sname, $uname, $pass, $db_name);

    $sql1 = "select * from hari";
    $hari = $conn->query($sql1);

    $sql2 = "select * from jam_kuliah";
    $jam_kuliah = $conn->query($sql2);

    $mahasiswa = '';
    if (isset($_COOKIE['nrp'])) {
        $mahasiswa = $_COOKIE['mahasiswa'];
    } else {
        header('Location: index.php?message=1');
    }
    ?>
    <h2>Ubah Jadwal</h2>
    <h3>Mahasiswa: <?php echo $mahasiswa ?></h3>
    <section style="display: inline-block;">
        <form action="editjadwal_crud.php" method="post" id="formEdit">
            <table id="jadwal">
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
                $nrp = $_COOKIE['nrp'];
                while ($row2 = $jam_kuliah->fetch_assoc()) {
                    for ($j = 1; $j <= 7; $j++) {
                        $jadwal = $conn->getJadwal($nrp, $j, $i);
                        if ($j == 1) {
                            $minggu = ($jadwal->num_rows > 0) ? "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "' checked>" : "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "'>";
                        } else if ($j == 2) {
                            $senin = ($jadwal->num_rows > 0) ? "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "' checked>" : "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "'>";
                        } else if ($j == 3) {
                            $selasa = ($jadwal->num_rows > 0) ? "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "' checked>" : "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "'>";
                        } else if ($j == 4) {
                            $rabu = ($jadwal->num_rows > 0) ? "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "' checked>" : "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "'>";
                        } else if ($j == 5) {
                            $kamis = ($jadwal->num_rows > 0) ? "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "' checked>" : "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "'>";
                        } else if ($j == 6) {
                            $jumat = ($jadwal->num_rows > 0) ? "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "' checked>" : "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "'>";
                        } else if ($j == 7) {
                            $sabtu = ($jadwal->num_rows > 0) ? "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "' checked>" : "<input type='checkbox' id='" . $i . "_" . $j . "' class='checkbox' name='" . $i . "_" . $j . "' value='" . $i . "_" . $j . "'>";
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
                echo "<input type='hidden' name='nrp' value='$nrp'>";

                ?>
            </table>
        </form>
        <br>
        <div style="display: flex; justify-content: space-between;">
            <button><a href="index.php">Kembali</a></button>
            <button type="submit" form="formEdit">Submit</button>
        </div>
    </section>
</body>
<script>
    // let arr = []
    // $('#jadwal').find('input:checkbox').each(function() {
    //     if ($(this).prop('checked') == true) {
    //         arr.push($(this).val());
    //     }

    //     $.ajax({
    //         type: 'POST',
    //         url: 'editjadwal_crud.php',
    //         data: {
    //             'arr': arr
    //         },
    //     }).done(function(resp) {
    //         // alert('success');
    //     })
    // })
    // console.log(arr);
    // $('.checkbox').change(function() {
    //     if ($(this).prop('checked') == true) {
    //         arr.push($(this).val());
    //     } else {
    //         let remove_item = $(this).val();
    //         arr = jQuery.grep(arr, function(value) {
    //             return value != remove_item;
    //         })
    //     }

    //     // console.log(arr);

    //     $.ajax({
    //         type: 'POST',
    //         url: 'editjadwal_crud.php',
    //         data: {
    //             'arr': arr
    //         },
    //     }).done(function(resp) {
    //         // alert('success');
    //     })
    // })
</script>

</html>