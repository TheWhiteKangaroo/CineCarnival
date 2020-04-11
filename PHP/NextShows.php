<?php
include "DatabaseConnection.php";
date_default_timezone_set("Asia/Dhaka");
$currentDate = date("Y-m-d");
if (isset($_POST['showDate'])) {
    $showDate = $_POST['showDate'];
    $query = "SELECT DISTINCT m.name, m.mv_id FROM movie AS m left JOIN shows as s on s.movie_id=m.mv_id WHERE show_date='$showDate'; ";
    if($showDate==null || !isset($showDate)){
        $query = "SELECT DISTINCT m.name, m.mv_id FROM movie AS m left JOIN shows as s on s.movie_id=m.mv_id WHERE show_date='$currentDate'; ";
    }
    $result = mysqli_query($conn, $query);
}
else{
    $query = "SELECT DISTINCT m.name, m.mv_id FROM movie AS m left JOIN shows as s on s.movie_id=m.mv_id WHERE show_date='$currentDate'; ";
    $result = mysqli_query($conn, $query);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Next page</title>
</head>

<body>
    <div class="row" id="showtimeSection">
        <div class="col" style="width: 100%;">
            <table class="table table-striped table-dark" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col" style="width: 300px;">Movie</th>
                        <th scope="col">Shows</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) == 0) {
                        echo "
                                                    <tr>
                                                        <td colspan=" . "2" . "><span><i class=" . "fas fa-search" . "></i>Sorry, No Shows Found!</span></td>
                                                    </tr>
                                                ";
                    }
                    while ($row = mysqli_fetch_assoc($result)) {

                        $movieName = $row['name'];
                        $showtime = "";
                    ?>
                        <tr>
                            <td><?php echo $movieName; ?></td>
                            <?php
                            $result4 = mysqli_query($conn, "SELECT show_time FROM shows WHERE movie_id='$row[mv_id]';");
                            while ($newRow = mysqli_fetch_assoc($result4)) {
                                $tempTime = $newRow['show_time'];
                                $result5 = mysqli_query($conn, "SELECT theatre_id,show_type FROM shows WHERE movie_id='$row[mv_id]' AND show_time='$tempTime';");
                                while ($lastRow = mysqli_fetch_assoc($result5)) {
                                    if ($lastRow['theatre_id'] == 1) {
                                        if (substr($newRow['show_time'], 0, 5) > 12) {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                        } else {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                        }
                                        echo " <td><span class=" . "bg-success" . ">" . $showtime . "</span></td>";
                                    } else if ($lastRow['theatre_id'] == 2) {
                                        if (substr($newRow['show_time'], 0, 5) > 12) {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                        } else {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                        }
                                        echo " <td><span class=" . "bg-primary" . ">" . $showtime . "</span></td>";
                                    } else if ($lastRow['theatre_id'] == 3) {
                                        if (substr($newRow['show_time'], 0, 5) > 12) {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                        } else {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                        }
                                        echo " <td><span class=" . "bg-warning" . ">" . $showtime . "</span></td>";
                                    }
                                }
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
</body>

</html>