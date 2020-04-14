<?php
$selectedMovie="";
$selectedDate="";
$selectedShowTime="";
$selectedShowType ="";
$selectedTheatreName="";
$availableSeatCount="";
$showID="";
$selectedSeatCount="";
$theatreType="";
$price="";
$totalPrice="";
$discount="";



if(isset($_POST['selectedMovie']) && isset($_POST['selectedDate']) && isset($_POST['selectedShowTime']) && isset($_POST['selectedShowType']) && isset($_POST['selectedTheatreName']) && isset($_POST['availableSeatCount']) && isset($_POST['selectedSeatCount']) && isset($_POST['showID']) && isset($_POST['theatreType']) ){
    $selectedMovie=$_POST['selectedMovie'];
    $selectedDate=$_POST['selectedDate'];
    $selectedShowTime=$_POST['selectedShowTime'];
    $selectedShowType =$_POST['selectedShowType'];
    $selectedTheatreName=$_POST['selectedTheatreName'];
    $availableSeatCount=$_POST['availableSeatCount'];
    $showID=$_POST['showID'];
    $selectedSeatCount=$_POST['selectedSeatCount'];
    $theatreType=$_POST['theatreType'];
}
//echo "$selectedMovie". "--" .$selectedDate."--".$selectedShowTime."--".$selectedTheatreName;

if($theatreType=="VIP"){
    $price = $selectedSeatCount*700;
}
else if($theatreType=="PREMIUM"){
    $price = $selectedSeatCount*500;
}
else if($theatreType=="REGULAR"){
    $price = $selectedSeatCount*300;
}
$totalPrice = $price;
if($selectedDate=="Today"){
    $selectedDate=date("Y-m-d");
}
else if($selectedDate=="Tomorrow"){
    $currentDate = date("Y-m-d");
    $selectedDate = date('Y-m-d', strtotime($currentDate . ' + 1 days'));
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

    
    <script>
        function checkDBBLForm(){
            var printMe = document.getElementById('myBill');
            var wme = window.open("","","width=900, height=700");
            wme.document.write(printMe.outerHTML);
            wme.document.close();
            wme.focus();
            wme.print();
//            wme.close();
        }
    </script>
</head>
<body>
    
<div class="row mt-3 justify-content-around" id="billZone" style="width: 100%; margin-left:10px; margin-bottom: 10px;">
            <div class="col-4">
            <div id="billContainer" style="display: block;">
                    <div id="billBox">
                        <h2>Purchase Order</h2>
                    </div>
                    <div>
                        <table class="myBill" id="myBill">
                            <tr>
                                <td><span>Customer</span></td>
                                <td>:</td>
                                <td><span>Shohag</span></td>
                            </tr>
                            <tr>
                                <td><span>Mail</span></td>
                                <td>:</td>
                                <td><span>shohag@gmail.com</span></td>
                            </tr>
                            <tr>
                                <td><span>Movie</span></td>
                                <td>:</td>
                                <td><span><?php echo $selectedMovie; ?></span></td>
                            </tr>
                            <tr>
                                <td><span>Showtime</span></td>
                                <td>:</td>
                                <td><span><?php echo substr($selectedShowTime,0,5)." ".$selectedTheatreName;?></span></td>
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
                                <td><span><?php echo $price." BDT"; ?></span></td>
                            </tr>
                            <tr>
                                <td><span>Discount</span></td>
                                <td>:</td>
                                <td><span>0 BDT</span></td>
                            </tr>
                            <tr>
                                <td><span>Total Price</span></td>
                                <td>:</td>
                                <td><span><?php echo $totalPrice." BDT";?></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-7">
            <div class="paymentBox" id="paymentArea" style="display: block;">
                    <div class="paymentMethodsHeader" style="margin: 0; padding:0;">
                        <button class="paymentBtn" style="border-bottom-left-radius: 25px; margin:0; padding:0;" onclick="showBkashForm();">bKash</button>
                        <button class="paymentBtn" style=" margin:0; padding:0;" onclick="showStandardCharteredForm();">Standard Chartered</button>
                        <button class="paymentBtn" style="border-top-right-radius: 25px;  margin:0; padding:0;" onclick="showDBBLForm();">DBBL</button>
                    </div>
                    <div class="text-center mt-2">
                        <div id="selectPayMethod" style="border-bottom: 2px #feda6a solid;">
                            <h1>Select Payment Method.</h1>
                        </div>
                        <form action="PaymentPage.php" method="POST" id="bkashForm" style="display: none;">
                            <table style="width:100%;">
                                <tr align="center">
                                    <td>
                                        <label style="font-size: 46px; font-weight:bold; border-bottom: 2px #feda6a solid;">bKash</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-3 mb-1">
                                            <input type="number" class="resetPass-inputs" value="" placeholder="Enter bKash account number." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-1">
                                            <input type="number" class="resetPass-inputs" value="" placeholder="Enter pin number." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-4">
                                            <input type="number" class="resetPass-inputs" value="" placeholder="Enter amount." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <button id="payBtn">Pay</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <form action="PaymentPage.php" method="POST" id="sCardForm" style="display: none;">
                            <table style="width:100%;">
                                <tr align="center">
                                    <td>
                                        <span style="font-size: 46px; font-weight:bold; border-bottom: 2px #feda6a solid;">Standard Chartered</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-3 mb-1">
                                            <input type="number" class="resetPass-inputs" value="" placeholder="Enter card number." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-1">
                                            <input type="text" class="resetPass-inputs" value="" placeholder="Enter account holder name." required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-1">
                                            <input type="date" class="resetPass-inputs" value="" placeholder="Enter expiry date." required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-1">
                                            <input type="number" class="resetPass-inputs" value="" placeholder="Enter pin number." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-1">
                                            <input type="number" class="resetPass-inputs" value="" placeholder="Enter amount." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <button id="payBtn">Pay</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <form action="PaymentPage.php" method="POST" id="dCardForm" style="display: none;">
                            <table style="width:100%;">
                                <tr align="center">
                                    <td>
                                        <span style="font-size: 46px; font-weight:bold; border-bottom: 2px #feda6a solid;">DBBL</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-3 mb-1">
                                            <input type="number" class="resetPass-inputs" value="" id="dbblCardNumber" placeholder="Enter card number." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-1">
                                            <input type="text" class="resetPass-inputs" value="" id="dbblHolderName" placeholder="Enter account holder name." required>
                                        </div>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-1">
                                            <input type="number" class="resetPass-inputs" value="" id="dbblPin" placeholder="Enter pin number." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inuptWithIcon mt-1 mb-4">
                                            <input type="number" class="resetPass-inputs" value="" id="dbblAmount" placeholder="Enter amount." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <button type="submit" name="dbblBtn" id="payBtn" onclick="checkDBBLForm();">Pay</button>
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