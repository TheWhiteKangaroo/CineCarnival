<?php

include "DatabaseConnection.php";
$perSeatPrice = $showType = $theatreType = $theatreID = $showTime = $showDate =$theatreName= $availableSeats = "";
$selectedMovieName="";
$selectedDate=$selectedShowID="";
if (isset($_POST['selectedShowID']) && isset($_POST['selectedMovie']) && isset($_POST['selectedDate'])) {
    $selectedShowID = $_POST['selectedShowID'];
    $selectedDate = $_POST['selectedDate'];
    $selectedMovieName = $_POST['selectedMovie'];
    

    $query = "SELECT * FROM shows WHERE s_id='$selectedShowID';";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $theatreID = $row['theatre_id'];
        $showDate = $row['show_date'];
        $showTime = $row['show_time'];
        $showType = $row['show_type'];
    }
    $query = "SELECT * FROM theatre WHERE theatre_id = '$theatreID';";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $availableSeats = $row['available_seat'];
        $theatreType = $row['theatre_type'];
        $theatreName = $row['theatre_name'];
    }
}

/*
echo "Data : "."<br>";
echo $selectedDate."<br>";
echo $selectedMovieName."<br>";
echo $showTime."<br>";
echo $showType."<br>";
echo $theatreName."<br>";
echo $showDate."<br>";
echo $availableSeats."<br>";
*/
?>

<!DOCTYPE html>
<html>

<head>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        var selectedMovie = '<?php echo $selectedMovieName; ?>';
        var selectedDate = '<?php echo $selectedDate; ?>';
        var selectedShowTime = '<?php echo $showTime; ?>';
        var selectedShowType = '<?php echo $showType; ?>';
        var selectedTheatreName = '<?php echo $theatreName; ?>';
        var availableSeatCount = '<?php echo $availableSeats; ?>';
        var theatreType = '<?php echo $theatreType; ?>';
        var showID = '<?php echo $selectedShowID; ?>';
        var selectedSeatCount="";
        function checkAvailableSeat() {
            var x = document.getElementById('seatSelectionDropDown');
             selectedSeatCount = parseInt(x.options[x.selectedIndex].text);
              savailableSeatCount = '<?php echo $availableSeats; ?>';
            
            if (selectedSeatCount > availableSeatCount) {  
                Swal.fire({
                title: 'Requested number of seats not available.',
                showClass: {
                    popup: 'animated fadeInDown faster'
                },
                hideClass: {
                    popup: 'animated fadeOutUp faster'
                }
                })
                document.getElementById('proceedDiv').style.display="none";

            }
            else if (selectedSeatCount < availableSeatCount) {
                document.getElementById('proceedDiv').style.display="block";
            }
        }

        function showConfirmPage(){
            document.getElementById('chooseTicketSection').style.display="none";
            document.getElementById('billContainer').style.display="block";
            document.getElementById('paymentArea').style.display="block";
             $(document).ready(function() {
            
                $("#billZone").load("PaymentPage.php", {
                    msg: selectedMovie,
                    selectedMovie : selectedMovie,
                    selectedDate : selectedDate,
                    selectedShowTime : selectedShowTime,
                    selectedShowType : selectedShowType,
                    selectedTheatreName : selectedTheatreName,
                    availableSeatCount : availableSeatCount,
                    selectedSeatCount : selectedSeatCount,
                    showID : showID,
                    theatreType : theatreType
                });
            
        });
        }

       
    </script>

    <script>
        function generateBillingMsg(){

        }
        function showPopUp(){
            Swal.fire({
            title: 'You Will Be Redirected To Payment.',
            showClass: {
                popup: 'animated fadeInDown faster'
            },
            hideClass: {
                popup: 'animated fadeOutUp faster'
            }
            })
        }
    </script>
</head>

<body>
    <div id="seatAndPaymentSection">
        <div>
            <select name="seatSelectionDropDown" class="movieDropBtn" id="seatSelectionDropDown" onchange="checkAvailableSeat();">
                <option value="" disabled selected>Select number of seats</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="text-center" id="proceedDiv" style="display: none;">
        <button id="confirmBtn" type="button" onclick="showConfirmPage();">Proceed</button>
    </div>
    </div>

    
        <div class="row mt-3 justify-content-around" id="billZone">
            <div class="col-4">
            <div id="billContainer" style="display: none;">
                    <div id="billBox">
                        <h2>Purchase Order S3</h2>
                    </div>
                    <div id="myBill">
                        <table>
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
                                <td><?php echo $selectedMovie; ?></td>
                            </tr>
                            <tr>
                                <td><span>Showtime</span></td>
                                <td>:</td>
                                <td><span><?php echo $showTime." ".$theatreName." ".$showType; ?></span></td>
                            </tr>
                            <tr>
                                <td><span>Date</span></td>
                                <td>:</td>
                                <td><span><?php echo $selectedDate; ?></span></td>
                            </tr>
                            <tr>
                                <td><span>No. of seats</span></td>
                                <td>:</td>
                                <td><span><?php echo "2"; ?></span></td>
                            </tr>
                            <tr>
                                <td><span>Price</span></td>
                                <td>:</td>
                                <td><span>1200 BDT</span></td>
                            </tr>
                            <tr>
                                <td><span>Discount</span></td>
                                <td>:</td>
                                <td><span>0 BDT</span></td>
                            </tr>
                            <tr>
                                <td><span>Total Price</span></td>
                                <td>:</td>
                                <td><span>1200 BDT</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-7">
            <div class="paymentBox" id="paymentArea" style="display: none;">
                    <div class="paymentMethodsHeader" style="margin: 0; padding:0;">
                        <button class="paymentBtn" style="border-bottom-left-radius: 25px; margin:0; padding:0;" onclick="showBkashForm();">Bkash</button>
                        <button class="paymentBtn" style=" margin:0; padding:0;" onclick="showStandardCharteredForm();">Standard Chartered</button>
                        <button class="paymentBtn" style="border-top-right-radius: 25px;  margin:0; padding:0;" onclick="showDBBLForm();">DBBL</button>
                    </div>
                    <div class="text-center mt-2">
                        <div id="selectPayMethod" style="border-bottom: 1px #feda6a solid;">
                            <h1>Select Payment Method.</h1>
                        </div>
                        <form action="" id="bkashForm" style="display: none;">
                            <table style="width:100%;">
                                <tr align="center">
                                    <td>
                                        <label style="font-size: 46px; font-weight:bold; border-bottom: 1px #feda6a solid;">bKash</label>
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
                        <form action="" id="sCardForm" style="display: none;">
                            <table style="width:100%;">
                                <tr align="center">
                                    <td>
                                        <span style="font-size: 46px; font-weight:bold; border-bottom: 1px #feda6a solid;">Standard Chartered</span>
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
                        <form action="" id="dCardForm" style="display: none;">
                            <table style="width:100%;">
                                <tr align="center">
                                    <td>
                                        <span style="font-size: 46px; font-weight:bold; border-bottom: 1px #feda6a solid;">DBBL</span>
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
                    </div>
                </div>
            </div>
        </div>
        
   
    
</body>

</html>