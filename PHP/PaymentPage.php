<?php
session_start();
include "DatabaseConnection.php";
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
$discountPercentage = 0;
$points="";
$status="";
$currentDate = $currentDateTime="";
$currentDateTime=date('Y-m-d H:i:s');

if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
    $query = "SELECT first_name, last_name,c_id,status,mail FROM customer WHERE user_name='$userName' OR mail='$userName';";
    $result  = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $fullName = $row['first_name'] . " " . $row['last_name'];
        $mail = $row['mail'];
        $userID = $row['c_id'];
        $status = $row['status'];
    }
}

if (isset($_POST['selectedMovie']) && isset($_POST['selectedDate']) && isset($_POST['selectedShowTime']) && isset($_POST['selectedShowType']) && isset($_POST['selectedTheatreName']) && isset($_POST['availableSeatCount']) && isset($_POST['selectedSeatCount']) && isset($_POST['showID']) && isset($_POST['theatreType'])) {
    $selectedMovie = $_POST['selectedMovie'];
    $selectedDate = $_POST['selectedDate'];
    $selectedShowTime = $_POST['selectedShowTime'];
    $selectedShowType = $_POST['selectedShowType'];
    $selectedTheatreName = $_POST['selectedTheatreName'];
    $availableSeatCount = $_POST['availableSeatCount'];
    $showID = $_POST['showID'];
    $selectedSeatCount = $_POST['selectedSeatCount'];
    $theatreType = $_POST['theatreType'];
}
//echo "$selectedMovie" . "--" . $selectedDate . "--" . $selectedShowTime . "--" . $selectedTheatreName;

if ($theatreType == "VIP") {
    $price = $selectedSeatCount * 600;
    $points=$selectedSeatCount*75;
} else if ($theatreType == "PREMIUM") {
    $price = $selectedSeatCount * 450;
    $points=$selectedSeatCount*50;
} else if ($theatreType == "REGULAR") {
    $price = $selectedSeatCount * 250;
    $points=$selectedSeatCount*25;
}

$totalPrice = $price;

if($status=="Sapphire"){
    $discount=$totalPrice*0.50;
    $discountPercentage = 50;
    $totalPrice = $totalPrice - $discount;
}
else if($status=="Diamond"){
    $discount=$totalPrice*0.35;
    $discountPercentage = 35;
    $totalPrice = $totalPrice - $discount;
}
else if($status=="Perl"){
    $discount=$totalPrice*0.25;
    $discountPercentage = 25;
    $totalPrice = $totalPrice - $discount;
}

if ($selectedDate == "Today") {
    $selectedDate = date("Y-m-d");
} else if ($selectedDate == "Tomorrow") {
    $currentDate = date("Y-m-d");
    $selectedDate = date('Y-m-d', strtotime($currentDate . ' + 1 days'));
}

/*
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['dbblBtn'])){
    $sql = "INSERT INTO `ticket`(`ticket_id`, `c_id`, `show_id`, `price`, `discount`, `sold_date_time`, `payment_method`) VALUES ('0','$userID','$showID','$totalPrice','$discount','$currentDateTime','DBBL')";
    mysqli_query($conn, $sql);
    echo "Inserted!";
}
*/
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        function confirmMyPayment(e){
            
            var showID = <?php echo json_encode($showID); ?>;
            var userName = <?php echo json_encode($fullName); ?>;
            var userID = <?php echo json_encode($userID); ?>;
            var totalPrice = <?php echo json_encode($totalPrice); ?>;
            var discount = <?php echo json_encode($discount); ?>;
            var seatCount = <?php echo json_encode($selectedSeatCount); ?>;
            var selectedDate = <?php echo json_encode($selectedDate); ?>;
            var selectedMovie = <?php echo json_encode($selectedMovie); ?>;
            var selectedTheatreType = <?php echo json_encode($theatreType); ?>;
            var selectedTheatreName = <?php echo json_encode($selectedTheatreName); ?>;
            var selectedShowTime = <?php echo json_encode($selectedShowTime); ?>;
            var selectedShowType = <?php echo json_encode($selectedShowType); ?>;
            var points = <?php echo json_encode($points); ?>;
            var discount = <?php echo json_encode($discount); ?>;
            var discountPercentage = <?php echo json_encode($discountPercentage); ?>;
            
            var paymentType="";
            if(e=="dbblPayBtn"){
                paymentType = "DBBL Payment ";
                var amount = document.getElementById('dbblAmount').value;
                var holderName = document.getElementById('dbblHolderName').value;
                var pin = document.getElementById('dbblPin').value;
                var cardNumber = document.getElementById('dbblCardNumber').value;
                if(amount!=null && amount!='undefined' && amount!="" && holderName!=null && holderName!='undefined' && holderName!="" && pin!=null && pin!='undefined' && pin!="" && cardNumber!=null && cardNumber!='undefined' && cardNumber!=""){
                    if(amount!=totalPrice || amount!=Math.ceil(totalPrice) || amount!=Math.floor(totalPrice)){
                        Swal.fire('Please enter correct amount!');
                    }
                    else{
                        document.getElementById('paymentArea').style.display="none";
                        document.getElementById('billContainer').style.display="none";
                        
                        $(document).ready(function() {  
                            $("#confirmZone").load("ConfirmPayment.php",{
                                showID :showID,
                                userID :userID,
                                userName:userName,
                                totalPrice:totalPrice,
                                discount:discount,
                                seatCount:seatCount,
                                selectedDate:selectedDate,
                                selectedMovie: selectedMovie,
                                paymentType:paymentType,
                                selectedShowTime: selectedShowTime,
                                selectedShowType : selectedShowType,
                                selectedTheatreName: selectedTheatreName,
                                selectedTheatreType:selectedTheatreType,
                                points: points,
                                discount:discount,
                                discountPercentage:discountPercentage
                            });
                        
                        });
                    }
                }
                else{
                    Swal.fire('Please fill up all the field!');
                }
                
            }
            else if(e=="SCPayBtn"){
                paymentType = "SCB Payment ";
                var amount = document.getElementById('SCBAmount').value;
                var holderName = document.getElementById('SCBHolderName').value;
                var pin = document.getElementById('SCBPinNumber').value;
                var cardNumber = document.getElementById('SCBCardNumber').value;
                var expiryDate = document.getElementById('SCBExpiryDate').value;
                if(amount!=null && amount!='undefined' && amount!="" && holderName!=null && holderName!='undefined' && holderName!="" && pin!=null && pin!='undefined' && pin!="" && cardNumber!=null && cardNumber!='undefined' && cardNumber!="" && expiryDate!=null && expiryDate!='undefined' && expiryDate!=""){
                    if(amount!=totalPrice || amount!=Math.ceil(totalPrice) || amount!=Math.floor(totalPrice)){
                        Swal.fire('Please enter correct amount!');
                    }
                    else{
                        document.getElementById('paymentArea').style.display="none";
                        document.getElementById('billContainer').style.display="none";
                        
                        $(document).ready(function() {  
                            $("#confirmZone").load("ConfirmPayment.php",{
                                showID :showID,
                                userID :userID,
                                userName:userName,
                                totalPrice:totalPrice,
                                discount:discount,
                                seatCount:seatCount,
                                selectedDate:selectedDate,
                                selectedMovie: selectedMovie,
                                paymentType:paymentType,
                                selectedShowTime: selectedShowTime,
                                selectedShowType : selectedShowType,
                                selectedTheatreName: selectedTheatreName,
                                selectedTheatreType:selectedTheatreType,
                                points:points,
                                discountPercentage:discountPercentage
                            });
                        
                        });
                    }
                }
                else{
                    Swal.fire('Please fill up all the field!');
                }
            }
            else if(e=="bKashPayBtn"){
                paymentType = "bKash Payment";              
                var amount = document.getElementById('bKashAmount').value;
                var holderName = document.getElementById('bKashPin').value;
                var cardNumber = document.getElementById('bKashAccountNumber').value;
                if(amount!=null && amount!="undefined" && amount!="" && holderName!=null && holderName!="undefined" && holderName!="" && cardNumber!=null && cardNumber!="undefined" && cardNumber!=""){
                    if(amount!=totalPrice || amount!=Math.ceil(totalPrice) || amount!=Math.floor(totalPrice)){
                        Swal.fire('Please enter correct amount!');
                    }
                    else{
                        document.getElementById('paymentArea').style.display="none";
                        document.getElementById('billContainer').style.display="none";
                        
                        $(document).ready(function() {  
                            $("#confirmZone").load("ConfirmPayment.php", {
                                showID :showID,
                                userID :userID,
                                userName:userName,
                                totalPrice:totalPrice,
                                discount:discount,
                                seatCount:seatCount,
                                selectedDate:selectedDate,
                                selectedMovie: selectedMovie,
                                paymentType:paymentType,
                                selectedShowTime: selectedShowTime,
                                selectedShowType : selectedShowType,
                                selectedTheatreName: selectedTheatreName,
                                selectedTheatreType:selectedTheatreType,
                                points:points,
                                discountPercentage:discountPercentage
                            });
                        
                        });
                    }
                }
                else{
                    Swal.fire('Please fill up all the field!');
                }
            }
        }
    </script>
    <style>
        .payBtn {
    background-color: #feda6a;
    height: 50px;
    width: 33%;
    font-size: 22px;
    border-top-left-radius: 15px;
    border-bottom-right-radius: 15px;
    outline: none;
    border-style: none;
    box-shadow: 5px 10px 10px gray;
}

.payBtn:hover {
    transform: scale(1.1);
}
    </style>
</head>

<body>

    <div class="row" id="confirmZone">
            
    </div>

    <div class="row mt-3 mb-5 no-gutters justify-content-around" id="billZone" style="width: 100%; margin-left:10px; margin-bottom: 10px;">
        <div class="col-4">
            <div id="billContainer" style="display: block;">
                <div id="billBox">
                    <h2 style="padding-bottom: 10px;"><i class="fas fa-receipt"></i> Purchase Order</h2>
                </div>
                <div>
                    <table class="myBill" id="myBill">
                        <tr>
                            <td><span>Customer</span></td>
                            <td>:</td>
                            <td><span class="text-capitalize"><?php echo $fullName; ?></span></td>
                        </tr>

                        <tr>
                            <td><span>Movie</span></td>
                            <td>:</td>
                            <td><span class="text-capitalize"><?php echo $selectedMovie; ?></span></td>
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
                            <td><span>Price</span></td>
                            <td>:</td>
                            <td><span><?php echo $price . " BDT"; ?></span></td>
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
        </div>
        <div class="col-7">
            <div class="paymentBox" id="paymentArea" style="display: block;">
                <div class="paymentMethodsHeader" style="margin: 0; padding:0;">
                    <button class="paymentBtn" style="border-bottom-left-radius: 25px; margin:0; padding:0;" onclick="showBkashForm();"><i class="fas fa-coins"></i> bKash</button>
                    <button class="paymentBtn" style=" margin:0; padding:0;" onclick="showStandardCharteredForm();"><i class="fas fa-money-check"></i> Standard Chartered</button>
                    <button class="paymentBtn" style="border-top-right-radius: 25px;  margin:0; padding:0;" onclick="showDBBLForm();"><i class="far fa-credit-card"></i> DBBL</button>
                </div>
                <div class="text-center mt-2">
                    <div id="selectPayMethod" style="border-bottom: 2px #feda6a solid;">
                        <h1>Select Payment Method</h1>
                    </div>
                    <form action="" method="" id="bkashForm" style="display: none;">
                        <table style="width:100%;">
                            <tr align="center">
                                <td>
                                    <label style="font-size: 46px; font-weight:bold; border-bottom: 2px #feda6a solid;">bKash</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-3 mb-1">
                                        <input type="number" class="resetPass-inputs" id="bKashAccountNumber" value="" placeholder="Enter bKash account number." required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-1">
                                        <input type="password" class="resetPass-inputs" id="bKashPin" value="" placeholder="Enter pin number." required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-4">
                                        <input type="number" class="resetPass-inputs" id="bKashAmount" value="" placeholder="Enter amount." required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <button id="bKashPayBtn" class="payBtn" onclick="confirmMyPayment(this.id);"><i class="fas fa-coins"></i> Pay</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <form action="" method="" id="sCardForm" style="display: none;">
                        <table style="width:100%;">
                            <tr align="center">
                                <td>
                                    <span style="font-size: 46px; font-weight:bold; border-bottom: 2px #feda6a solid;">Standard Chartered</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-3 mb-1">
                                        <input type="number" class="resetPass-inputs" id="SCBCardNumber" value="" placeholder="Enter card number." required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-1">
                                        <input type="text" class="resetPass-inputs" id="SCBHolderName" value="" placeholder="Enter account holder name." required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-1">
                                        <input type="date" class="resetPass-inputs" id="SCBExpiryDate" value="" placeholder="Enter expiry date." required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-1">
                                        <input type="password" class="resetPass-inputs" id="SCBPinNumber" value="" placeholder="Enter pin number." required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-1">
                                        <input type="number" class="resetPass-inputs" id="SCBAmount" value="" placeholder="Enter amount." required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <button type="button" id="SCPayBtn" class="payBtn" onclick="confirmMyPayment(this.id);"><i class="fas fa-credit-card"></i> Pay</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <form action="" method="" id="dCardForm" style="display: none;">
                        <table style="width:100%;">
                            <tr align="center">
                                <td>
                                    <span style="font-size: 46px; font-weight:bold; border-bottom: 2px #feda6a solid;">DBBL</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-3 mb-1">
                                        <input type="number" class="resetPass-inputs" value="" id="dbblCardNumber" placeholder="Enter card number.">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-1">
                                        <input type="text" class="resetPass-inputs" value="" id="dbblHolderName" placeholder="Enter account holder name.">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-1">
                                        <input type="password" class="resetPass-inputs" value="" id="dbblPin" placeholder="Enter pin number.">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="inuptWithIcon mt-1 mb-4">
                                        <input type="number" class="resetPass-inputs" value="" id="dbblAmount" placeholder="Enter amount.">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <button type="button" name="dbblBtn" id="dbblPayBtn" class="payBtn" onclick="confirmMyPayment(this.id);"><i class="fas fa-money-bill-wave"></i></i> Pay</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>