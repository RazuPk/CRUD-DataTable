<?php

include '../../assests/config/config.php';
$db = new Database();
$conn = $db->db_connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mid = $_POST['mem_id'];
    $query = mysqli_query($conn, "DELETE FROM members WHERE id='$mid'");
    if ($query) {
        echo '1';
    } else {
        echo '0';
    }
}
?>
