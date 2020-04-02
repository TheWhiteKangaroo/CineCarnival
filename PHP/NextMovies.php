<?php

include "DatabaseConnection.php";
echo "Hellow World!";

if (isset($_POST['limitValue'])) {
  $lv = $_POST['limitValue'];
  echo $lv;
  $sql = "SELECT * FROM movie LIMIT $lv";
  $result = mysqli_query($conn, $sql);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home | CineCarnival</title>
  <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" href="..\CSS/style.css">
  <link rel="stylesheet" href="..\css/bootstrap.min.css">


  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<body>
  <div class="row justify-content-between mt-5">
  <div id="moviesPanel">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      echo "
                                        <div class=" . "col-4" . ">
                                        <div class=" . "card" . " style=" . "width: 18rem;" . ">
                                        <div class=" . "card-body" . ">
                                          <h5 class=" . "card-title" . ">" . $row['name'] . "</h5>
                                          <p class=" . "card-text" . ">" . $row['genre'] . "</p>
                                          <a href=" . "#" . "class=" . "btn btn-primary" . ">Go somewhere</a>
                                        </div>
                                      </div>
                                      </div>
                                        ";
    }
    ?>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="..\css/bootstrap.min.js"></script>
</body>

</html>