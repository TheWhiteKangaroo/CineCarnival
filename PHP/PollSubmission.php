<?php
include "DatabaseConnection.php";
$content=$pollTitle=$pollID=$msg="";
if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $pollTitle = $_POST['pollTitle'];
    $pollID = $_POST['pollID'];
    
    
    $query = "INSERT INTO `vote`(`v_id`, `p_id`, `content`, `c_id`) VALUES ('0','$pollID','$content','0')";
    $result=mysqli_query($conn, $query);
    if($result){
        $msg="Vote submitted!";
    }
    else{
        $msg="Failed to submit vote!";
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
    <div class="pollTitle">
        <label style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px;"><i class="fas fa-poll"></i> <?php echo $pollTitle; ?> </label>
    </div>
    <div class="pollContentArea">
        <h5 class="text-light"><i class="far fa-grin"></i> <?php echo " ".$msg;?></h5>
    </div>
</body>

</html>