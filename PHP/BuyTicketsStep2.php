<?php
session_start();
echo $_SESSION['selectedMovie'];
include "DatabaseConnection.php";
$query1 = $result1 = "";
if (isset($_POST['selectedMovieName'])) {
    $movieID = "";
    $movieName = $_POST['selectedMovieName'];
    $query1 = "SELECT mv_id FROM movie WHERE name='$movieName';";
    $result1 = mysqli_query($conn, $query1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $movieID = $row['mv_id'];
    }
    $query1 = "select s.show_time,s.s_id,s.show_type, t.theatre_id,t.theatre_name, m.name FROM shows as s LEFT join theatre as t on t.theatre_id=s.theatre_id LEFT JOIN movie as m on m.mv_id=s.movie_id WHERE movie_id='$movieID'";
    $result1 = mysqli_query($conn, $query1);
}
?>
<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <div id="ticketingSection">
        <select name="showSelectDropDown" class="movieDropBtn" id="showSelectDropDown" onchange="getSelectedShow();">
        echo "<option  disabled selected>Select a show.</option>";
            <?php
            if(mysqli_num_rows($result1) == 0){
                echo "<option  disabled selected>No Show Available</option>";
            }else{
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo "
                                        <option value=" . $row['s_id'] . ">" . substr($row['show_time'],0,5) ."  ".$row['theatre_name']. " ".$row['show_type']. "</option>
                                    ";
                }
            }
            ?>
        </select>
    </div>
</body>

</html>