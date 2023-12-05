<?php
include '../connect.php';

if(isset($_POST['updatebtn'])){
    $id_room = $_POST['id_room'];
    $number = $_POST['number'];
    $prix = $_POST['prix'];
    $status = $_POST['status'];
    $id_hotel = $_POST['hotel'];

    $updateRoom = "UPDATE room SET number = ?, prix = ?, status = ?, id_hotel = ? WHERE id_room = ?";
    $stmt = mysqli_prepare($conn, $updateRoom);
    mysqli_stmt_bind_param($stmt, 'ssssi', $number, $prix, $status, $id_hotel, $id_room);

    if(mysqli_stmt_execute($stmt)){
        header("Location: ../room.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>