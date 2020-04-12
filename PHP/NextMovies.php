<?php
include "DatabaseConnection.php";
$result = $sql = $showMoviePageResult = $cbValue = $cbValue2 = $cbValue3 = $cbValue4 = $genre = $language = $format = $selectedStatus="";
$actionCBQuery = $comedyCBQuery = $dramaCBQuery = $horrorCBQuery = " ";
static $cbQuery = " ";
$pageCount = 9;

if (isset($_POST['limitValue'])) {
  $lv = $_POST['limitValue'];
  $selectedStatus=$_POST['selectedStatus'];
  $sql = "SELECT name,mv_id,genre FROM movie WHERE status='$selectedStatus' ORDER BY mv_id DESC LIMIT $lv";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['NowShowingPage'])) {
  $pageCount = $_POST['NowShowingPage'];
  $selectedStatus=$_POST['selectedStatus'];
  $sql = "SELECT name,mv_id,genre FROM movie WHERE status='$selectedStatus' ORDER BY mv_id DESC LIMIT $pageCount";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['UpComingPage'])) {
  $pageCount = $_POST['UpComingPage'];
  $selectedStatus=$_POST['selectedStatus'];
  $sql = "SELECT name,mv_id,genre FROM movie WHERE status='Coming Soon' ORDER BY mv_id DESC LIMIT $pageCount";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['searchedKeyWord'])) {
  $sk = $_POST['searchedKeyWord'];
  $selectedStatus=$_POST['selectedStatus'];
  if ($sk == null) {
    $sql = "SELECT name,mv_id,genre FROM movie WHERE status='$selectedStatus' ORDER BY mv_id DESC LIMIT $pageCount";
    $result = mysqli_query($conn, $sql);
  } else {
    echo "<script>
    var x = document.getElementById('btnLoadDiv');
    hideLoadButton(x);
    </script>";
    $sql = "SELECT name,mv_id,genre from movie where name like '%$sk%' ORDER BY mv_id DESC LIMIT $pageCount";
    $result = mysqli_query($conn, $sql);
  }
} else if (isset($_POST['genre']) || isset($_POST['language']) || isset($_POST['format'])) {
  $selectedStatus=$_POST['selectedStatus'];
  $sql = "SELECT mv_id,name, genre, cover_pic FROM movie WHERE status='$selectedStatus'";
  echo $selectedStatus;
  if (isset($_POST['genre'])) {
    $genre = implode(", ", $_POST['genre']);
    $sql .= "AND genre='$genre' ";
  }
  if (isset($_POST['language'])) {
    $language = implode(", ", $_POST['language']);
    $sql .= "AND language='$language' ";
  }
  if (isset($_POST['format'])) {
    $format = implode(", ", $_POST['format']);
    $sql .= "AND format='$format' ";
  }

  echo $genre . "<br>";
  echo $language . "<br>";
  echo $format . "<br>";
  if($genre==null && $format==null && $language==null){
    $sql = "SELECT mv_id,name, genre, cover_pic FROM movie WHERE status='$selectedStatus' ";
  } 
  $sql .= " ORDER BY mv_id DESC LIMIT $pageCount";
  echo $sql;
  $result = mysqli_query($conn, $sql);
}
else{
  $selectedStatus =$_POST['selectedStatus'];
  $sql = "SELECT * FROM movie WHERE status='$selectedStatus' ORDER BY mv_id DESC LIMIT $pageCount";
  $result = mysqli_query($conn, $sql);
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Movies</title>
  <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
      function hideLoadButton(x){
        x.style.display="none";
      }
      function showLoadButton(x){
        x.style.display="block";
      }
    </script>
</head>

<body>
  <div class="col-12">
    <div class="row justify-content-start mt-0 mb-0" id="movieSection">
      <?php
        if (mysqli_num_rows($result) == 0) {
          echo "<script>
          var x = document.getElementById('btnLoadDiv');
          hideLoadButton(x);
          </script>";
          echo "<h1><i class="."fas fa-search"."></i>Sorry, No movies found!</h1>";
        } else {
          if(mysqli_num_rows($result)<=9){
            echo "<script>
          var x = document.getElementById('btnLoadDiv');
          hideLoadButton(x);
          </script>";
          }
          echo "<script>
          var x = document.getElementById('btnLoadDiv');
          showLoadButton(x);
          </script>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "
                                          <div class=" . "col-4" . ">
                                          <div class=" . "card movieCard-box" . "style=" . "width: 18rem;" . ">
                                          <form action=" . "Movies.php" . " method=" . "GET" . ">
                                              <img class=" . "card-img-top" . " src=" . "..\images/NoTimeToDie.jpg" . " alt=" . "Card image cap" . ">
                                              <div class=" . "card-body" . ">
                                                  <p class=" . "card-text" . ">
                                                      <span><b>" . $row['name'] . "</b></span><br>
                                                      <span>" . $row['genre'] . "</span><br>
                                                      <button type=" . "submit" . " name=" . "movieNumber" . " value=" . $row['mv_id'] . " id = " . $row['mv_id'] . " class=" . "movieCard-buttons" . ">Details</button>
                                                  </p>
                                              </div>
                                              </form>
                                              </div>
                                              <br>
                                        </div>
                                          ";
          }
        }


      ?>
    </div>
</body>

</html>