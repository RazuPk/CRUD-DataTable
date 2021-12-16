<?php

include '../../assests/config/config.php';
$db = new Database();
$conn = $db->db_connect();

$query = mysqli_query($conn, "SELECT * FROM members");

$rows = array();
$n = 1;
while ($row = mysqli_fetch_array($query)) {
    $sub_row = array(
        "sn" => $n++,
        "id" => $row['id'],
        "name" => $row['name'],
        "address" => $row['address'],
        "contact" => $row['contact'],
        "active" => $row['active']
    );
    $rows[] = $sub_row;
}
echo json_encode($rows);
?>
