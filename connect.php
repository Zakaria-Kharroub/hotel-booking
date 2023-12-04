<?php
$conn = mysqli_connect('localhost', 'root', '','youbooking');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>