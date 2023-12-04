<?php
include 'connect.php';
$requeteSelect = "SELECT * FROM hotel";
$resultatSelect = mysqli_query($conn, $requeteSelect);
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
  ajouter hothel
  </button>
</center>



<table class="table align-middle mt-2 bg-white">
  <thead class="bg-light">
    <tr>
      <th><h4>Name</h4></th>
      <th><h4>Email</h4></th>
      <th><h4>Telephone</h4></th>
      <th><h4>Localisation</h4></th>
      <th><h4>edit / delete</h4></th>
    </tr>
  </thead>

  <tbody>
    <?php
while ($row = mysqli_fetch_assoc($resultatSelect)) {
  
  $requeteLocalisation = "SELECT * FROM location WHERE id_hotel = " . $row['id_hotel'];
  $resultatLocalisation = mysqli_query($conn, $requeteLocalisation);
  
  
  if ($resultatLocalisation) {
      $localisation = mysqli_fetch_assoc($resultatLocalisation);

      
      echo "<tr>";
      echo "<td>
              <div class='d-flex align-items-center'>
                <img src='images/hotel-img.webp' alt='' style='width: 45px; height: 45px' class='rounded-circle' />
                <div class='ms-3'>
                  <h6 class='fw-bold mb-1'>" . $row['name_hotel'] . "</h6>
                </div>
              </div>
            </td>";
      echo "<td>
              <h6 class='fw-normal mb-1'>" . $row['email'] . "</h6>
            </td>";
      echo "<td>
              <h6 class='fw-normal mb-1'>" . $row['telephone'] . "</h6>
            </td>";
      echo "<td>
                <h6 class='fw-normal mb-1'>" . ($localisation ? $localisation['city'] . " - " . $localisation['address'] : 'location not available') . "</h6>
            </td>";
      echo "<td class='d-flex'>
           
              <button type='button' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#updateModal{$row['id_hotel']}'>Edit</button>

              <form action='crudHOTEL/delete.php' method='post'class='ms-2'>
                  <input type='hidden' name='id_hotel' value='" . $row['id_hotel'] . "'>
                  <button type='submit' name='deletebtn' class='btn btn-danger' style='height: 40px;'>delete</button>
              </form>
            </td>";
      echo "</tr>";
  } else {
      
      echo "<tr><td colspan='5'>error location </td></tr>";
  }
}
?>

<!-- modal update -->

<?php

$resultatSelect = mysqli_query($conn, $requeteSelect);
while ($row = mysqli_fetch_assoc($resultatSelect)) {
    $requeteLocalisation = "SELECT * FROM location WHERE id_hotel = " . $row['id_hotel'];
    $resultatLocalisation = mysqli_query($conn, $requeteLocalisation);
    $localisation = mysqli_fetch_assoc($resultatLocalisation);
    
    $modalUpdt = "<div class='modal fade' id='updateModal{$row['id_hotel']}' tabindex='-1' aria-labelledby='updateModalLabel{$row['id_hotel']}' aria-hidden='true'>".
    "    <div class='modal-dialog'>".
    "        <div class='modal-content'>".
    "            <div class='modal-header'>".
    "                <h5 class='modal-title' id='updateModalLabel{$row['id_hotel']}'>Modifier hôtel</h5>".
    "                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>".
    "            </div>".
    "            <form action='crudHOTEL/update.php' method='POST'>".
    "                <div class='modal-body'>".
    "                    <input type='hidden' name='id_hotel' value='{$row['id_hotel']}'>".
    "                    <label for='name_update' class='form-label'>Nom</label>".
    "                    <input type='text' class='form-control' id='name_update' name='name' value='{$row['name_hotel']}' required>".
    "                    <label for='email_update' class='form-label'>Email</label>".
    "                    <input type='email' class='form-control' id='email_update' name='email' value='{$row['email']}' required>".
    "                    <label for='telephone_update' class='form-label'>Téléphone</label>".
    "                    <input type='tel' class='form-control' id='telephone_update' name='telephone' value='{$row['telephone']}' required>".
    "                    <label for='city_update' class='form-label'>Ville</label>".
    "                    <input type='text' class='form-control' id='city_update' name='city' value='{$localisation['city']}' required>".
    "                    <label for='address_update' class='form-label'>Adresse</label>".
    "                    <input type='text' class='form-control' id='address_update' name='address' value='{$localisation['address']}' required>".
    "                </div>".
    "                <div class='modal-footer'>".
    "                    <button type='button' class='btn btn-secondary' type='reset'>reset</button>".
    "                    <button type='submit' name='updatebtn' class='btn btn-primary'>update</button>".
    "                </div>".
    "            </form>".
    "        </div>".
    "    </div>".
    "</div>";

echo $modalUpdt;
}
?>



  </tbody>
</table>

<!-- modal ajouter  -->

<!-- Modal -->
<div class="modal fade" id="ajouterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau hôtel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insert.php" method="POST">
                <div class="modal-body">
                    <!-- name -->
                    <div>
                        <label for="nom" class="form-label">name</label>
                        <input type="text" class="form-control" id="nom" name="name" required>
                    </div>

                    <!-- email -->
                    <div>
                        <label for="email" class="form-label">email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- téléphone -->
                    <div>
                        <label for="telephone" class="form-label">telephone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" required>
                    </div>
                     <!-- localisation -->
                    <!-- city -->
                    <div>
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <!-- address -->
                    <div>
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <input type="hidden" name="id_hotel" value="">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">reset</button>
                    <button type="submit" name='ok' class="btn btn-primary">ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
