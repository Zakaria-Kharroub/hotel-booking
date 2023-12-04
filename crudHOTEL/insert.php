<?php
include '../connect.php';

if (isset($_POST['ok'])) {
    $id_hotel = $_POST['id_hotel'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $requeteInsert = "INSERT INTO hotel (name_hotel, email, telephone) VALUES ('$name', '$email', '$telephone')";
    $resultaInsert = mysqli_query($conn, $requeteInsert);
    
    
    $id_hotel = mysqli_insert_id($conn);  
    
    $requeteInsertLocation = "INSERT INTO location (city, address, id_hotel) VALUES ('$city', '$address', '$id_hotel')";
    $resultatInsertLocation = mysqli_query($conn, $requeteInsertLocation);

    if ($resultaInsert && $resultatInsertLocation) {
        header("Location: ../propriet.php");
    } else { 
        echo "error : " . mysqli_error($conn);
    }
}
?>