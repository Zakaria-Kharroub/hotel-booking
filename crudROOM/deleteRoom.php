<?php
include '../connect.php';
if(isset($_POST['deletebtn']) && isset($_POST['id_hotel'])){  
    $id_hotel = $_POST['id_hotel'];  
    $deleteRoom = "DELETE FROM room WHERE id_room = $id_hotel";
    if(mysqli_query($conn, $deleteRoom)){
        header("Location:../room.php");
    }else{
        echo "error " . mysqli_error($conn);
    }
} 
?>