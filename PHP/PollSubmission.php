<?php
session_start();
include "DatabaseConnection.php";
$content = $pollTitle = $pollID = $msg = $movieID = $avgRating = $rating = $userName =$flag="";
$result1 = $result2 = "";
$isRated="false";
if(isset($_SESSION['user_name'])){
    $userName = $_SESSION['user_name'];
}
else{
    $userName="";
}


function checkVoteSubmission($p_id){
    if(isset($_SESSION['voted_polls'])){
        if(isset($_SESSION['voted_polls']) || $_SESSION['voted_polls']!=null || !empty($_SESSION['voted_polls'])){
            $votedPollsArray = $_SESSION['voted_polls'];
            $flag=0;
            for($i=0; $i<count($votedPollsArray); $i++){
                if($p_id==$votedPollsArray[$i]){
                    $flag=1;
                }
                else{
                    $flag=0;
                }
            }
            global $userName, $pollID,$conn;
            $sql = "SELECT customer from vote WHERE p_id='$pollID' AND customer='$userName'";
            $customerRow = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            if($customerRow!=null || isset($customerRow) || !empty($customerRow)){
                $customer = $customerRow['customer'];
                $customer=1;
                
            }
            else{
                $customer=0;
            }
    
            if($customer==0 && $flag==1){
                $flag = 1;
            }
            else if($customer==1 && $flag==0){
                $flag=1;
            }
            else if($customer==1 && $flag==1){
                $flag=1;
            }
            else if($customer==0 && $flag==0){
                $flag=0;
            }
            return $flag;
        }
    }

}

if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $pollTitle = $_POST['pollTitle'];
    $pollID = $_POST['pollID'];
    $flag=checkVoteSubmission($pollID);
    if($flag==1){
        $msg = "You have already voted for this poll!";
    }
    else if($flag==0){
        $query = "INSERT INTO `vote`(`v_id`, `p_id`, `content`, `customer`) VALUES ('0','$pollID','$content','$userName')";
        $result1 = mysqli_query($conn, $query);
        if ($result1) {
            $msg = "Vote submitted for ";
            $_SESSION['voted_polls'] = array();
            array_push($_SESSION['voted_polls'],$pollID);
        } else {
            $msg = "Failed to submit vote!";
        }
    }
}
else if (isset($_POST['rating']) && isset($_POST['movieID'])) {
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
        echo "<script>
        Swal.fire('You have already rated the movie!');
    </script>";
        //header("Refresh:0");
    }

}
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll Submission</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<script>
    function showMessage(){
        Swal.fire('You have already rated the movie!');
}
</script>

<body>
    <?php
     
    
    if ($result1) {
        $query = "SELECT COUNT(content) AS counter1 FROM vote WHERE content=1 AND p_id='$pollID'";
     $counterRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $counter1 = $counterRow['counter1'];

     $query = "SELECT COUNT(content) AS counter2 FROM vote WHERE content=2 AND p_id='$pollID'";
     $counterRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $counter2 = $counterRow['counter2'];

     $query = "SELECT COUNT(content) AS counter3 FROM vote WHERE content=3 AND p_id='$pollID'";
     $counterRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $counter3 = $counterRow['counter3'];

     $query = "SELECT COUNT(content) AS counter4 FROM vote WHERE content=4 AND p_id='$pollID'";
     $counterRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $counter4 = $counterRow['counter4'];
    
     $query = "SELECT content1 FROM poll WHERE p_id='$pollID'";
     $pollRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $content1 = $pollRow['content1'];

     $query = "SELECT content2 FROM poll WHERE p_id='$pollID'";
     $pollRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $content2 = $pollRow['content2'];

     $query = "SELECT content3 FROM poll WHERE p_id='$pollID'";
     $pollRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $content3 = $pollRow['content3'];

     $query = "SELECT content4 FROM poll WHERE p_id='$pollID'";
     $pollRow = mysqli_fetch_assoc(mysqli_query($conn,$query));
     $content4 = $pollRow['content4'];
     
     

    $sql = "SELECT COUNT(*) AS voteCount FROM vote WHERE p_id='$pollID'";
    $voteCountRow = mysqli_fetch_assoc(mysqli_query($conn,$sql));
    $totalVotes = $voteCountRow['voteCount'];
    if($content==1){
        $content = $content1;
    }
    else if($content==2){
        $content = $content2;
    }
    else if($content==3){
        $content = $content3;
    }
    else if($content==4){
        $content = $content4;
    }
    ?>
        <div class="pollTitle">
            <label style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px;"><i class="fas fa-poll"></i> <?php echo $pollTitle; ?> </label>
        </div>
        <div class="pollContentArea">
        <div class="custom-control custom-radio mb-2 ml-3  text-left h6">
                                            <label class="custom-control-label text-dark" for="customControlValidation1"><?php echo $content1." "; ?></label> <span class="text-primary"> <i class="fas fa-thumbs-up"></i> <?php echo " (".$counter1.")";?></span>
                                        </div>
                                        <div class="custom-control custom-radio mb-2  ml-3  text-left h6">
                                            <label class="custom-control-label text-dark" for="customControlValidation2"><?php echo $content2." "; ?></label> <span class="text-success"> <i class="fas fa-thumbs-up"></i> <?php echo " (".$counter2.")";?></span>
                                        </div>
                                        <div class="custom-control custom-radio mb-2 ml-3 text-left h6">
                                            <label class="custom-control-label text-dark" for="customControlValidation3"><?php echo $content3." "; ?></label> <span class="text-warning"> <i class="fas fa-thumbs-up"></i> <?php echo " (".$counter3.")";?></span>
                                        </div>
                                        <div class="custom-control custom-radio mb-2 ml-3  text-left h6">
                                            <label class="custom-control-label text-dark" for="customControlValidation4"><?php echo $content4." "; ?></label> <span class="text-info"> <i class="fas fa-thumbs-up"></i> <?php echo " (".$counter4.")";?></span>
                                        </div>
                                        <span class="text-success text-center"><i class="far fa-grin"></i> <?php echo " " . $msg."$content!"; ?></span><br>
                                        <span class="text-success text-center"><i class="fas fa-poll"></i> <?php echo "Total votes: " . $totalVotes; ?></span>
        </div>
    <?php
    }
    else if($flag==1){
        ?>
             <div class="pollTitle">
            <label style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px;"><i class="fas fa-poll"></i> <?php echo $pollTitle; ?> </label>
        </div>
        <div class="pollContentArea">
      
                                        <span class="text-success text-center"><i class="far fa-grin"></i> <?php echo " " . $msg; ?></span>
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
            <input type="radio" name="rating" id="star-1" onclick="showMessage();"><label for="star-1"></label>
            <input type="radio" name="rating" id="star-2" onclick="showMessage();"><label for="star-2"></label>
            <input type="radio" name="rating" id="star-3" onclick="showMessage();"><label for="star-3"></label>
            <input type="radio" name="rating" id="star-4" onclick="showMessage();"><label for="star-4"></label>
            <input type="radio" name="rating" id="star-5" onclick="showMessage();"><label for="star-5"></label>
        </div>
    <?php
    }
    ?>
</body>

</html>