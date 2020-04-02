<?php
include "DatabaseConnection.php";
$result = $cbValue = $cbValue2 = $cbValue3 = $cbValue4 = "";
if (isset($_POST['limitValue'])) {
  $lv = $_POST['limitValue'];
  $sql = "SELECT * FROM movie LIMIT $lv";
  $result = mysqli_query($conn, $sql);
}
else if (isset($_POST['NowShowingPage'])) {
  $pageCount = $_POST['NowShowingPage'];
  echo $pageCount;
  $sql = "SELECT * FROM movie LIMIT $pageCount";
  $result = mysqli_query($conn, $sql);
} 
else if (isset($_POST['searchedKeyWord'])) {
  $sk = $_POST['searchedKeyWord'];
  if ($sk == null) {
    $sql = "SELECT * FROM movie LIMIT 9";
    $result = mysqli_query($conn, $sql);
  } else {
    $sql = "SELECT * from movie where name like '%$sk%'";
    $result = mysqli_query($conn, $sql);
  }
} else if (isset($_POST['actionCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['comedyCBValue'])) {
  $cbValue = $_POST['comedyCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  $cbValue2 = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  $cbValue2 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['comedyCBValue']) && isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['comedyCBValue'];
  $cbValue2 = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['comedyCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['comedyCBValue'];
  $cbValue2 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['horrorCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  $cbValue2 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue']) && isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  $cbValue3 = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2' AND genre='$cbValue3';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  $cbValue3 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2' AND genre='$cbValue3';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue']) && isset($_POST['horrorCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  $cbValue4 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2' AND genre='$cbValue3' AND genre='$cbValue4';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['comedyCBValue'])) {
  $cbValue = $_POST['comedyCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  $cbValue2 = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  $cbValue2 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['comedyCBValue']) && isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['comedyCBValue'];
  $cbValue2 = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['comedyCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['comedyCBValue'];
  $cbValue2 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['horrorCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['horrorCBValue'];
  $cbValue2 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue']) && isset($_POST['horrorCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  $cbValue3 = $_POST['horrorCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2' AND genre='$cbValue3';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  $cbValue3 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2' AND genre='$cbValue3';";
  $result = mysqli_query($conn, $sql);
} else if (isset($_POST['actionCBValue']) && isset($_POST['comedyCBValue']) && isset($_POST['horrorCBValue']) && isset($_POST['dramaCBValue'])) {
  $cbValue = $_POST['actionCBValue'];
  $cbValue2 = $_POST['comedyCBValue'];
  $cbValue4 = $_POST['dramaCBValue'];
  echo $cbValue;
  $sql = "SELECT * from movie where genre='$cbValue' AND genre='$cbValue2' AND genre='$cbValue3' AND genre='$cbValue4';";
  $result = mysqli_query($conn, $sql);
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
        } else {
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
    </div>
</body>

</html>