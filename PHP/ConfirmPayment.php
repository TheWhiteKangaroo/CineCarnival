<?php 
include "DatabaseConnection.php";
date_default_timezone_set("Asia/Dhaka");
$userName = $mail = "";
$fullName = "";
$selectedMovie = "";
$selectedDate = "";
$selectedShowTime = "";
$selectedShowType = "";
$selectedTheatreName = "";
$availableSeatCount = "";
$showID = "";
$selectedSeatCount = "";
$theatreType = "";
$price = "";
$totalPrice = "";
$discount = 0;
$paymentType ="";
$userID="";
$points="";
$pointsInDB="";
$sellingSeatNumber = $soldSeatCount=$availableSeats="";
$discountPercentage=0;

    if(isset($_POST['showID']) && isset($_POST['userID'])){
        $userID = $_POST['userID'];
        $userName = $_POST['userName'];
        $showID = $_POST['showID'];
        $totalPrice = $_POST['totalPrice'];
        $discount = $_POST['discount'];
        $selectedSeatCount = $_POST['seatCount'];
        $selectedMovie = $_POST['selectedMovie'];
        $selectedDate = $_POST['selectedDate'];
        $paymentType =$_POST['paymentType'];
        $selectedShowTime =$_POST['selectedShowTime'];
        $selectedShowType =$_POST['selectedShowType'];
        $selectedTheatreName =$_POST['selectedTheatreName'];
        $theatreType =$_POST['selectedTheatreType'];
        $points = $_POST['points'];
        $discount = $_POST['discount'];
        $discountPercentage = $_POST['discountPercentage'];
    }


$currentDate =date("Y-m-d");
$currentDateTime="";
$currentDateTime=date('Y-m-d H:i:s');
$query = "SELECT first_name, last_name,points FROM customer WHERE c_id='$userID';";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
    $userName = $row['first_name']." ".$row['last_name'];
    $pointsInDB=$row['points'];
}

$query = "SELECT DISTINCT sold_seat,available_seat FROM theatre WHERE theatre_name='$selectedTheatreName' AND s_id='$showID';";

$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
    $sellingSeatNumber= $row['sold_seat'];
    $availableSeats = $row['available_seat'];
    $soldSeatCount = $row['sold_seat'];
}

$sellingSeatNumber++;
$seatString="";

for($i=0; $i<$selectedSeatCount; $i++){
    $seatString .= "HC-".($sellingSeatNumber).", ";
    $sellingSeatNumber++;
}
$seatString=substr_replace($seatString ,"",-1);
$soldSeatCount = $soldSeatCount+$selectedSeatCount;
$availableSeats = $availableSeats-$selectedSeatCount;

$sql = "INSERT INTO `ticket`(`ticket_id`, `c_id`, `show_id`, `price`, `discount`, `sold_date_time`, `seat_number`,`seat_count`,`payment_method`) VALUES ('0','$userID','$showID','$totalPrice','$discount','$currentDate','$seatString','$selectedSeatCount','$paymentType')";
mysqli_query($conn, $sql);

$sql = "UPDATE theatre SET available_seat='$availableSeats', sold_seat='$soldSeatCount' WHERE theatre_name='$selectedTheatreName' AND s_id='$showID';";
mysqli_query($conn, $sql);

$status="";
$points = $points+$pointsInDB;

if($points>=1000){
    $status = "Sapphire";
}
else if($points>=750 && $points<=999){
    $status = "Diamond";
}
else if($points>=500 && $points<=750){
    $status = "Perl";
}
else{
    $status="Regular";
}

if($discountPercentage == 50 ){
    $points=$points-350;
}
else if($discountPercentage == 35 ){
    $points=$points-250;
}
else if($discountPercentage == 25 ){
    $points=$points-200;
}

$sql = "UPDATE customer SET status='$status' , points='$points' WHERE c_id='$userID';";
//echo $sql;
mysqli_query($conn,$sql);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        function printBill(){
            var printMe = document.getElementById('myBill');
            var wme = window.open("", "", "width=900, height=700");
            wme.document.write(printMe.outerHTML);
            wme.document.close();
            wme.focus();
            wme.print();
            //wme.close();
        }
    </script>
</head>
<body>
    <div class="container mt-5 justify-content-center" id="confirmZone">
        <script>
            Swal.fire('Payment Successful!');
        </script>    
            <span class="text-center text-success mb-4" style="font-size: 40px;"><i class="fas fa-check-circle"></i> Payment successful!</span>
            <div id="billContainer" style="display: block;margin-top:30px; padding-bottom:10px;" >
                <div id="billBox">
                    <h2 style="padding-bottom: 10px;"><i class="fas fa-receipt"></i> Purchase Order</h2>
                </div>
                <div>
                    <table class="myBill" id="myBill" style="margin-left: 10px;">
                        <tr>
                            <td><span>Customer</span></td>
                            <td>:</td>
                            <td><span class="text-capitalize"><?php echo $userName; ?></span></td>
                        </tr>

                        <tr>
                            <td><span>Movie</span></td>
                            <td>:</td>
                            <td><span><?php echo $selectedMovie; ?></span></td>
                        </tr>
                        <tr>
                            <td><span>Showtime</span></td>
                            <td>:</td>
                            <td><span><?php echo substr($selectedShowTime, 0, 5) . " " . $selectedTheatreName; ?></span></td>
                        </tr>
                        <tr>
                            <td><span>Format : </span></td>
                            <td>:</td>
                            <td><span><?php echo $selectedShowType; ?></span></td>
                        </tr>
                        <tr>
                            <td><span>Date</span></td>
                            <td>:</td>
                            <td><span><?php echo $selectedDate; ?></span></td>
                        </tr>
                        <tr>
                            <td><span>Theatre Type</span></td>
                            <td>:</td>
                            <td><span><?php echo $theatreType; ?></span></td>
                        </tr>
                        <tr>
                            <td><span>No. of seats</span></td>
                            <td>:</td>
                            <td><span><?php echo $selectedSeatCount; ?></span></td>
                        </tr>
                        <tr>
                            <td><span>Seat No.</span></td>
                            <td>:</td>
                            <td><span><?php echo rtrim($seatString,','); ?></span></td>
                        </tr>
                        <tr>
                            <td><span>Price</span></td>
                            <td>:</td>
                            <td><span><?php echo ($discount+$totalPrice) . " BDT"; ?></span></td>
                        </tr>
                        <tr>
                            <td><span>Discount</span></td>
                            <td>:</td>
                            <td><span><?php echo $discount." BDT";?></span></td>
                        </tr>
                        <tr>
                            <td><span>Total Price</span></td>
                            <td>:</td>
                            <td><span><?php echo $totalPrice . " BDT"; ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="text-center mt-5">
                    <button type="button" class="btn btn-warning" onclick="printBill();"><i class="fas fa-print"></i> Print</button>
                </div>
                <div class="text-center">
                    <a href="ProfilePage.php">Click to check purchase history.</a>
                </div>
    </div>
</body>
</html>