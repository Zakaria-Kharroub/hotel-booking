<?php
include '../connect.php';

if (isset($_POST['updatebtn'])) {
    $id_hotel = $_POST['id_hotel'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $requeteUpdate = "UPDATE hotel SET name_hotel = ?, email = ?, telephone = ? WHERE id_hotel = ?";
    $prepareHotel = mysqli_prepare($conn, $requeteUpdate);
    mysqli_stmt_bind_param($prepareHotel, 'sssi', $name, $email, $telephone, $id_hotel);

    $requeteUpdateLocal = "UPDATE location SET city = ?, address = ? WHERE id_hotel = ?";
    $prepareLocal = mysqli_prepare($conn, $requeteUpdateLocal);
    mysqli_stmt_bind_param($prepareLocal, 'ssi', $city, $address, $id_hotel);

    if (mysqli_stmt_execute($prepareHotel) && mysqli_stmt_execute($prepareLocal)) {
        header("Location: ../propriet.php");
    } else {
        echo "error " . mysqli_error($conn);
    }
}
?>