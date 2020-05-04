<?php
include "DatabaseConnection.php";
$result = $sql = $showMoviePageResult = $cbValue = $cbValue2 = $cbValue3 = $cbValue4 = $genre = $language = $format = $selectedStatus = "";
$actionCBQuery = $comedyCBQuery = $dramaCBQuery = $horrorCBQuery = " ";
static $cbQuery = " ";
$pageCount = 6;

if (isset($_POST['limitValue'])) {
  $lv = $_POST['limitValue'];
  $selectedStatus = $_POST['selectedStatus'];
  $sql = "SELECT name,mv_id,genre,cover_pic FROM movie WHERE status='$selectedStatus' ORDER BY mv_id DESC LIMIT $lv";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['NowShowingPage'])) {
  $pageCount = $_POST['NowShowingPage'];
  $selectedStatus = $_POST['selectedStatus'];
  $sql = "SELECT name,mv_id,genre,cover_pic FROM movie WHERE status='$selectedStatus' ORDER BY mv_id DESC LIMIT $pageCount";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['UpComingPage'])) {
  $pageCount = $_POST['UpComingPage'];
  $selectedStatus = $_POST['selectedStatus'];
  $sql = "SELECT name,mv_id,genre,cover_pic FROM movie WHERE status='Coming Soon' ORDER BY mv_id DESC LIMIT $pageCount";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['searchedKeyWord'])) {
  $sk = $_POST['searchedKeyWord'];
  $selectedStatus = $_POST['selectedStatus'];
  if ($sk == null) {
    $sql = "SELECT name,mv_id,genre,cover_pic FROM movie WHERE status='$selectedStatus' ORDER BY mv_id DESC LIMIT $pageCount";
    $result = mysqli_query($conn, $sql);

    echo "<script>
          var x = document.getElementById('btnLoadDiv');
          showLoadButton(x);
          </script>";
  } else {
    echo "<script>
    var x = document.getElementById('btnLoadDiv');
    hideLoadButton(x);
    </script>";
    $sql = "SELECT name,mv_id,genre,cover_pic from movie where name like '%$sk%' ORDER BY mv_id DESC LIMIT $pageCount";
    $result = mysqli_query($conn, $sql);
  }
} else if (isset($_POST['genre']) || isset($_POST['language']) || isset($_POST['format'])) {
  $selectedStatus = $_POST['selectedStatus'];
  $sql = "SELECT mv_id,name, genre, cover_pic FROM movie WHERE status='$selectedStatus'";
  if (isset($_POST['genre'])) {
    $genre = implode(", ", $_POST['genre']);
    $sql .= "AND genre LIKE '%$genre%' ";
  }
  if (isset($_POST['language'])) {
    $language = implode(", ", $_POST['language']);
    $sql .= "AND language='$language' ";
  }
  if (isset($_POST['format'])) {
    $format = implode(", ", $_POST['format']);
    $sql .= "AND format='$format' ";
  }
  if ($genre == null && $format == null && $language == null) {
    $sql = "SELECT mv_id,name, genre, cover_pic FROM movie WHERE status='$selectedStatus' ";
  }
  $sql .= " ORDER BY mv_id DESC LIMIT $pageCount";
  $result = mysqli_query($conn, $sql);
} else {
  $selectedStatus = $_POST['selectedStatus'];
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
    function hideLoadButton(x) {
      x.style.display = "none";
    }

    function showLoadButton(x) {
      x.style.display = "block";
    }
  </script>

  <style>
    .card-img-top {
      width: 100%;
      height: 18vw;
      object-fit: cover;
    }
  </style>
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
        echo "<h1><i class=" . "fas fa-search" . "></i>Sorry, No movies found!</h1>";
      } else {
        if (mysqli_num_rows($result) <= 9) {
          echo "<script>
          var x = document.getElementById('btnLoadDiv');
          hideLoadButton(x);
          </script>";
        }
        echo "<script>
          var y = document.getElementById('btnLoadDiv');
          showLoadButton(y);
          </script>";
        while ($row = mysqli_fetch_assoc($result)) {
      ?>

          <div class="col-12 col-sm-4 col-xl-3 mt-1">
            <div class="movieReelPanel" style="margin-top: 2px;">
              <form action="Movies.php" method="GET">
                <img src="<?php echo $row['cover_pic'] ?>" alt="No Cover" style="width:100%; height:250px; margin:0; padding:0;"><br>
                <button type="submit" name="movieNumber" value="<?php echo $row['mv_id']; ?>" id="<?php echo $row['mv_id']; ?>" class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0; height:auto ;min-height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
              </form>
            </div>

          </div>
      <?php
        }
      }


      ?>
    </div>
</body>

</html>