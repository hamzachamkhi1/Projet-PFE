<?php
include '../connection.php';
if (isset($_POST['delete_row'])) {
    $row_no = $_POST['row_id'];
    mysqli_query($conn, "DELETE from room where id='$row_no'");
    mysqli_query($conn, "DELETE from images_room where id_room='$row_no'");

    echo "success";
    exit();
}
