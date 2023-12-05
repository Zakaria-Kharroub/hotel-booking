<?php
include 'connect.php';
$requeteSelect = "SELECT * FROM room";
$resultatSelect = mysqli_query($conn, $requeteSelect);

$reqeteHotel="SELECT * FROM hotel";
$resultatHotel=mysqli_query($conn,$reqeteHotel);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class='container'>

<!-- start navar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid">
    
    <a class="navbar-brand" href="">
      Dashboard
    </a>

  
    <div class="navbar-nav ms-auto">
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="images/avatar.png" alt="Profile" width="30" height="30" class="d-inline-block align-top rounded-circle">
          Zakaria
          </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="">profil</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="">logOut</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- end nav -->


<center>
<button type="button" class="btn btn-success mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#ajouterModal">
  ajouter room
  </button>
</center>


</center>
<table class="table align-middle mt-2 bg-white">
  <thead class="bg-light">
    <tr>
      <th><h4>numer</h4></th>
      <th><h4>prix</h4></th>
      <th><h4>status</h4></th>
      <th><h4>name hotel</h4></th>
      <th><h4>edit / delete</h4></th>
    </tr>
  </thead>

  <tbody>
  <?php
    while ($row = mysqli_fetch_assoc($resultatSelect)) {

        $requeteHotel = "SELECT * FROM hotel WHERE id_hotel = " . $row['id_hotel'];
        $resultHotel = mysqli_query($conn, $requeteHotel);

        if ($resultHotel) {
            $rowHotel = mysqli_fetch_assoc($resultHotel);

            echo "<tr>";
            echo "<td>
                    <div class='d-flex align-items-center'>
                        <img src='images/hotel-img.webp' alt='' style='width: 45px; height: 45px' class='rounded-circle' />
                        <div class='ms-3'>
                            <h6 class='fw-bold mb-1 text-center'>" . $row['id_room'] . "</h6>
                        </div>
                    </div>
                  </td>";
            echo "<td>
                    <h6 class='fw-normal mb-1' >" . $row['prix'] . "<span>$</span></h6>
                  </td>";
            echo "<td class='status'>
                  <h6 class='fw-normal mb-1  status-text' style='width: fit-content;height:20px;padding:3px 5px 5px 5px;border-radius:7px;'>" . $row['status'] . "</h6>
                </td>";
            echo "<td>
                    <h6 class='fw-normal mb-1'>" . $rowHotel['name_hotel'] . "</h6>
                  </td>";
            echo "<td class='d-flex'>
            <button type='button' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#updateModal'>Edit</button>
            <form action='crudROOM/deleteRoom.php' method='post' class='ms-2'>
                        <input type='hidden' name='id_hotel' value='" . $row['id_room'] . "'>
                        <button type='submit' name='deletebtn' class='btn btn-danger' style='height: 40px;'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        } else {
            echo "error : " . mysqli_error($conn);
        }
    }
    ?>




<!-- Modal -->
<div class="modal fade" id="ajouterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="crudROOM/insertRoom.php" method="POST">
                <div class="modal-body">
                    <!-- number -->
                    <div>
                        <label for="number" class="form-label">number</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>

                    <!-- prix -->
                    <div>
                        <label for="prix" class="form-label">prix</label>
                        <input type="prix" class="form-control" id="prix" name="prix" required>
                    </div>

                    <!-- status -->
                    <div>
                        <label for="status" class="form-label">status</label>
                        <select name="status" id="status" class="form-select" aria-label="Default select example">
                          <option value="Available">Available</option>
                          <option value="Occupied">Occupied</option>
                          <option value="Under Maintenance">Under Maintenance</option>
                        </select>
                    </div>
                    
                    
                    <!-- hotel -->
                    <div>
                    <label for="hoteh" class="form-label">hothel</label>
                    <select name="hotel" id="hotel-select" class="form-select" aria-label="Default select example">
                         <?php
                            while ($row = mysqli_fetch_assoc($resultatHotel)) {
                                echo "<option value='" . $row['id_hotel'] . "'>" . $row['name_hotel'] . "</option>";
                            }
                            ?>
                     </select>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">reset</button>
                    <button type="submit" name='ok' class="btn btn-primary">ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>



    
<script src='js/script.js'></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
