<?php
session_start();
include "DatabaseConnection.php";
$content = $pollTitle = $pollID = $msg = $movieID = $avgRating = $rating = $userName = "";
$result1 = $result2 = "";
$isRated="false";
if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $pollTitle = $_POST['pollTitle'];
    $pollID = $_POST['pollID'];

    $query = "INSERT INTO `vote`(`v_id`, `p_id`, `content`, `c_id`) VALUES ('0','$pollID','$content','0')";
    $result1 = mysqli_query($conn, $query);
    if ($result1) {
        $msg = "Vote submitted!";
    } else {
        $msg = "Failed to submit vote!";
    }
} else if (isset($_POST['rating']) && isset($_POST['movieID'])) {
    $movieID = $_POST['movieID'];
    $rating = $_POST['rating'];
    //echo $movieID;
    $isRated = "false";

    if (isset($_SESSION['rated_movies'])) {
        for ($i = 0; $i < count($_SESSION['rated_movies']); $i++) {
            if ($_SESSION['rated_movies'][$i] == $movieID) {
                $isRated = "true";
                $msg = "You have already rated this movie.";
            }
        }
    }

    if ($isRated == "false") {

        if ($_POST['userName'] != null && isset($_POST['userName'])) {
            $userName = $_POST['userName'];
        } else {
            $userName = "";
        }
        $sql = "SELECT rating AS avg_rating FROM rating WHERE movie_id='$movieID' ORDER BY r_id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        //$avgRating=0;

        while ($row = mysqli_fetch_assoc($result)) {
            $avgRating = $row['avg_rating'];
        }
        $avgRating = (int) $avgRating;

        $sql = "SELECT COUNT(*) AS total_rating FROM rating WHERE movie_id=$movieID";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $total_rating = $row['total_rating'];
        }

        if (!isset($avgRating) || $avgRating == 0) {
            $avgRating = $rating;
        } else {
            $avgRating = $avgRating + (($rating - $avgRating) / ($total_rating + 1));
        }


        $query = "INSERT INTO `rating`(`r_id`, `movie_id`, `rating`, `customer`) VALUES ('0','$movieID','$avgRating','$userName')";
        $result2 = mysqli_query($conn, $query);
        if ($result2) {
            $msg = "Rating Submitted*";
            $_SESSION['rated_movies'] = array();
            array_push($_SESSION['rated_movies'], $movieID);
        } else {
            $msg = "Could not submit rating*";
        }
    } else if ($isRated == "true") {
        $msg = "You have already rated the movie!";
        echo "<script>alert('You have already rated the movie!');</script>";
        //header("Refresh:0");
    }
}
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll Submission</title>
</head>

<body>
    <?php
    if ($result1) {
    ?>
        <div class="pollTitle">
            <label style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px;"><i class="fas fa-poll"></i> <?php echo $pollTitle; ?> </label>
        </div>
        <div class="pollContentArea">
            <h5 class="text-light"><i class="far fa-grin"></i> <?php echo " " . $msg; ?></h5>
        </div>
    <?php
    }
    ?>


    <?php
    if ($result2) {
    ?>
        <div class="rating-wrapper mt-2" style="border: 1px green solid;height:40px; border-radius:5px; padding-left:10px; padding-top:10px;">
            <i>
                <h6 class="text-success font-weight-bolder"><i class="far fa-grin"></i> <?php echo " " . $msg; ?></h6>
            </i>
        </div>
    <?php
    }
    ?>

    <?php
    if ($isRated == "true") {
    ?>
        <div class="rating-wrapper">
            <input type="radio" name="rating" id="star-1" onclick="contentSubmission('5');"><label for="star-1"></label>
            <input type="radio" name="rating" id="star-2" onclick="contentSubmission('4');"><label for="star-2"></label>
            <input type="radio" name="rating" id="star-3" onclick="contentSubmission('3');"><label for="star-3"></label>
            <input type="radio" name="rating" id="star-4" onclick="contentSubmission('2');"><label for="star-4"></label>
            <input type="radio" name="rating" id="star-5" onclick="contentSubmission('1');"><label for="star-5"></label>
        </div>
    <?php
    }
    ?>
</body>

</html>