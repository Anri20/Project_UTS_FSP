<?php
require("class/classEditJadwal.php");

$sname = "localhost";
$uname = "root";
$pass = "";
$db_name = "uts_fsp_jadwal";

$conn = new Edit($sname, $uname, $pass, $db_name);

$nrp = $_POST['nrp'];

$empty = [
    '1_1', '1_2', '1_3', '1_4', '1_5', '1_6', '1_7',
    '2_1', '2_2', '2_3', '2_4', '2_5', '2_6', '2_7',
    '3_1', '3_2', '3_3', '3_4', '3_5', '3_6', '3_7',
    '4_1', '4_2', '4_3', '4_4', '4_5', '4_6', '4_7',
    '5_1', '5_2', '5_3', '5_4', '5_5', '5_6', '5_7',
    '6_1', '6_2', '6_3', '6_4', '6_5', '6_6', '6_7',
    '7_1', '7_2', '7_3', '7_4', '7_5', '7_6', '7_7',
    '8_1', '8_2', '8_3', '8_4', '8_5', '8_6', '8_7',
    '9_1', '9_2', '9_3', '9_4', '9_5', '9_6', '9_7',
    '10_1', '10_2', '10_3', '10_4', '10_5', '10_6', '10_7',
    '11_1', '11_2', '11_3', '11_4', '11_5', '11_6', '11_7',
    '12_1', '12_2', '12_3', '12_4', '12_5', '12_6', '12_7'
];

$arr = [];
for ($i = 1; $i <= 12; $i++) {
    for ($j = 1; $j <= 7; $j++) {
        if (isset($_POST[$i . '_' . $j])) {
            array_push($arr, $_POST[$i . '_' . $j]);
        }
    }
}

foreach ($arr as $value) {
    unset($empty[array_search($value, $empty)]);
}

// var_dump($arr);
// echo '<br>';
// var_dump($empty);

// delete with $empty
foreach ($empty as $e) {
    $temp = explode('_', $e);
    $result = $conn->getJadwal($nrp, $temp[1], $temp[0]);
    if ($result->num_rows > 0) {
        // delete
        $conn->deleteJadwal($nrp, $temp[1], $temp[0]);
    }
}
echo '<br>';
// insert with $arr
foreach ($arr as $a) {
    $temp = explode('_', $a);
    $result = $conn->getJadwal($nrp, $temp[1], $temp[0]);
    if ($result->num_rows <= 0) {
        // insert
        $conn->insertJadwal($nrp, $temp[1], $temp[0]);
    }
}

header('Location: editjadwal.php?msg=success');
