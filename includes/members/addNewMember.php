<?php

include '../../assests/config/config.php';
$db = new Database();
$conn = $db->db_connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['mid'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $active = $_POST['active'];

    if ($id) {
        $query = mysqli_query($conn, "UPDATE members SET name='$name',address='$address',contact='$contact',active='$active' WHERE id='$id'");
    } else {
        $query = mysqli_query($conn, "INSERT INTO members (name,address,contact,active) VALUES ('$name','$address','$contact','$active')");
    }

    if ($query) {
        sleep(2);
        echo '1';
    } else {
        echo '0';
    }
}

