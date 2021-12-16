<?php

include '../../assests/config/config.php';
$db = new Database();
$conn = $db->db_connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mid=$_POST['mem_id'];
    $query = mysqli_query($conn, "SELECT * FROM members WHERE id='$mid'");
    while ($row = mysqli_fetch_array($query)) {
        $sub_row = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "address" => $row['address'],
            "contact" => $row['contact'],
            "active" => $row['active']
        );
    }
    echo json_encode($sub_row);
}
?>
