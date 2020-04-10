<?php
include "DatabaseConnection.php";
$resul=$sql=$showMoviePageResult = $cbValue = $cbValue2 = $cbValue3 = $cbValue4 ="";
$actionCBQuery=$comedyCBQuery=$dramaCBQuery=$horrorCBQuery=" ";
static $cbQuery=" ";
$pageCount=9;

if (isset($_POST['limitValue'])) {
  $lv = $_POST['limitValue'];
  $sql= "SELECT * FROM movie WHERE status='Now Showing' ";
  $result = mysqli_query($conn, $sql);
}
else if (isset($_POST['NowShowingPage'])) {
  $pageCount = $_POST['NowShowingPage'];
  $sql= "SELECT * FROM movie WHERE status='Now Showing' ";
  $result = mysqli_query($conn, $sql);
} 
else if (isset($_POST['UpComingPage'])) {
  $pageCount = $_POST['UpComingPage'];
  $sql = "SELECT * FROM movie WHERE status='Coming Soon' ";
  $result = mysqli_query($conn, $sql);
}
else if (isset($_POST['searchedKeyWord'])){
  $sk = $_POST['searchedKeyWord'];
  if ($sk == null) {
    $sql = "SELECT * FROM movie ";
    $result = mysqli_query($conn, $sql);
  } else {
    $sql = "SELECT * from movie where name like '%$sk%'";
    $result = mysqli_query($conn, $sql);
  }
}
else if(isset($_POST['loadMoviePage'])){
    $movie_id = $_POST['loadMoviePage'];
    $showMovieQuery = "SELECT * FROM movie WHERE mv_id= '$movie_id' ";
    showMoviePage($showMovieQuery);
}

if (isset($_POST['actionCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $sql.= " AND genre='$cbValue' ";
}
if (isset($_POST['comedyCBValue'])) {
  $cbValue = $_POST['comedyCBValue'];
  $sql.= " AND genre='$cbValue' ";
}
if (isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  $sql.= "AND genre='$cbValue' ";
}
if (isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['dramaCBValue'];
  $sql.= "AND genre='$cbValue' ";
}



?>
<!DOCTYPE html>
<html>

<head>
  <title>Movies</title>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
</head>

<body>
  <div class="col-12">
    <div class="row justify-content-start mt-0 mb-0" id="movieSection">
      <?php
      while ($row = mysqli_fetch_assoc($result)) {

        if (mysqli_num_rows($result)<1) {
          echo "Empty Result!";
        }
        else {
          echo "
                                        <div class=" . "col-4" . ">
                                        <div class=" . "card movieCard-box" . "style=" . "width: 18rem;" . ">
                                            <a href=" . "#" . "><img class=" . "card-img-top" . " src=" . "..\images/NoTimeToDie.jpg" . " alt=" . "Card image cap" . "></a>
                                            <div class=" . "card-body" . ">
                                                <p class=" . "card-text" . ">
                                                    <span><b>" . $row['name'] . "</b></span><br>
                                                    <span>" . $row['genre'] . "</span><br>
                                                    <button class=" . "movieCard-buttons" . ">Showtime</button>
                                                </p>
                                            </div>
                                            </div>
                                            <br>
                                      </div>
                                        ";
        }
      }
      ?>
      <?php
        function showMoviePage($query){
          global $conn, $result;
          $result =mysqli_query($conn,$query);
          while($row=mysqli_fetch_assoc($result)){
            echo "
            <div class=" . "col-12" . ">
              <div class="."mybox".">
                <h1>".$row['name']."</h1>
              <div>
            </div>
            ";
          }
        }
      ?>
    </div>


</body>

</html>