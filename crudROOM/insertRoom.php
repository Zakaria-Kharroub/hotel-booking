<?php
include '../connect.php';

if(isset($_POST['ok'])){
    $number = $_POST['number'];
    $prix = $_POST['prix'];
    $status = $_POST['status'];
    $id_hotel = $_POST['hotel'];

    $insertRoom = "INSERT INTO room (id_room, prix, status, id_hotel) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertRoom);
    mysqli_stmt_bind_param($stmt, 'sssi', $number, $prix, $status, $id_hotel);

    if(mysqli_stmt_execute($stmt)){
        header("Location: ../room.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>