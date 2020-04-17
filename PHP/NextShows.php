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
    <style>
        .timeLabels{
            border: 1px white solid;
            border-top-right-radius: 7px;
            border-bottom-left-radius: 7px;
            height: 30px;
        }
    </style>
<head>
    <title>Next page</title>
</head>

<body>
    <div class="row" id="showtimeSection" style="width: 100%">
        <div class="col" style="width: 100%;">
            <table class="table table-striped table-dark" style="width: 100%;">
                <thead style="width: 100%">
                    <tr style="width: 100%">
                        <th scope="col" style="width: 200px;">Movie</th>
                        <th scope="col">Shows</th>
                    </tr>
                </thead>
                <tbody style="width: 100%">
                    <?php
                    if (mysqli_num_rows($result) == 0) {
                        echo "
                                                    <tr style="."width: 100%".">
                                                        <td colspan=" . "2" . "><span><i class=" . "fas fa-search" . "></i>Sorry, No Shows Found!</span></td>
                                                    </tr>
                                                ";
                    }
                    while ($row = mysqli_fetch_assoc($result)) {

                        $movieName = $row['name'];
                        $showtime = "";
                    ?>
                        <tr style="width: 100%">
                            <td><?php echo $movieName; ?></td>
                            <?php
                            $result4 = mysqli_query($conn, "SELECT DISTINCT show_time FROM shows WHERE movie_id='$row[mv_id]';");
                            while ($newRow = mysqli_fetch_assoc($result4)) {
                                $tempTime = $newRow['show_time'];
                                $result5 = mysqli_query($conn, "SELECT t.theatre_type,s.theatre_id,s.show_type FROM shows AS s LEFT JOIN theatre AS t ON s.theatre_id=t.theatre_id WHERE movie_id='$row[mv_id]' AND show_time='$tempTime';");
                                while ($lastRow = mysqli_fetch_assoc($result5)) {
                                    if ($lastRow['theatre_type'] == "REGULAR") {
                                        if (substr($newRow['show_time'], 0, 5) > 12) {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                        } else {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                        }
                                        echo " <td><span class=" . "timeLabels" ." style="."background-color:#f0ad4e;".">" . $showtime . "</span></td>";
                                    } else if ($lastRow['theatre_type'] == "PREMIUM") {
                                        if (substr($newRow['show_time'], 0, 5) > 12) {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                        } else {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                        }
                                        echo " <td><span class=" . "timeLabels" ." style="."background-color:#5cb85c;".">" . $showtime . "</span></td>";
                                    } else if ($lastRow['theatre_type'] == "VIP") {
                                        if (substr($newRow['show_time'], 0, 5) > 12) {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                        } else {
                                            $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                        }
                                        echo " <td><span class=" . "timeLabels" ." style="."background-color:#0275d8;".">" . $showtime . "</span></td>";
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