<?php
include '../connect.php';

if (isset($_POST['deletebtn']) && isset($_POST['id_hotel'])) {
    $id_hotel = $_POST['id_hotel'];

    $deleteLocal = "DELETE FROM location WHERE id_hotel = $id_hotel";
    $deleteLocationResult = mysqli_query($conn, $deleteLocal);

    $deleteHotel = "DELETE FROM hotel WHERE id_hotel = $id_hotel";
    $deleteHotelResult = mysqli_query($conn, $deleteHotel);

    if ($deleteLocationResult && $deleteHotelResult) {
        header("Location:../propriet.php");
    } else {
        echo "error " . mysqli_error($conn);
    }
}
?>