<?php
    include 'db_connection.php';
    $conn = OpenCon();

    $id = $_GET['ward_id'];

    $q = "DELETE from quarantine_ward where Q_Ward_id = $id";

    mysqli_query($conn, $q);

    header('location:quarantine_show.php');
    CloseCon($conn);

?>
