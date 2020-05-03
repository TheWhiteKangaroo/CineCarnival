<?php
session_start();
$userName = "";
if (!isset($_SESSION['user_name'])) {
    $_SESSION['msg'] = "First sign in to buy tickets!";
    header("Location: SignInPage.php");
} else {
    $userName = $_SESSION['user_name'];
}
$selectedDate = $selectedSeatCount = "";
include "DatabaseConnection.php";
date_default_timezone_set("Asia/Dhaka");
$currentDate = date("Y-m-d");
$selectedShowTime = $selectedMovie = "";

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buy Tickets | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <style>
        .movieDropBtn {
            width: 100%;
            height: 50px;
            text-align: left;
            font-size: 18px;
            padding-right: 35px;
            border-right: none;
            border-left: none;
            border-top: none;
            border-bottom: 2px dodgerblue solid;
            background: transparent;
        }

        #buyTicketTitle {
            margin-top: 25;
            margin-bottom: 25px;
            background-color: #393f4d;
            height: 100px;
            color: white;
            font-size: 38px;
            padding-top: 20px;
            border-top-left-radius: 25px;
            border-bottom-right-radius: 25px;
        }

        #confirmBtn {
            outline: none;
            background-color: #feda6a;
            width: 50%;
            height: 50px;
            color: black;
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
            border-top-right-radius: 15px;
            border-bottom-left-radius: 15px;
            box-shadow: none;
            border-style: none;
        }

        .myBill {
            width: fit-content;
            margin-left: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .myBill tr {
            width: fit-content;
        }

        .myBill td {
            width: fit-content;
            border-bottom: 1px solid #ddd;
            height: 35px;
            padding-left: 25px;
        }

        .myBill tr:hover {
            background-color: #f5f5f5;
        }
    </style>

    <script>
        var movieName, showID = selectedDate = "";
        selectedDate = "Today";

        function getSelectedDate() {
            selectedDateArray = document.getElementsByName("dateOfPurchase");
            document.getElementById('confirmBtn').style.display = "none";
            if (selectedDateArray[0].checked) {
                selectedDate = selectedDateArray[0].value;
            } else if (selectedDateArray[1].checked) {
                selectedDate = selectedDateArray[1].value;
            }

            elements = document.getElementsByTagName("select")
            for (var i = 0; i < elements.length; i++) {
                elements[i].selectedIndex = 0;
            }

            var select = document.getElementById("showSelectDropDown");
            var length = select.options.length;
            for (i = length - 1; i > 0; i--) {
                select.options[i] = null;
            }

            var select = document.getElementById("seatSelectionDropDown");
            var length = select.options.length;
            for (i = length - 1; i > 0; i--) {
                select.options[i] = null;
            }

            $(document).ready(function() {
                $('#movieNameDropDownSection').load('BuyTicketsStep4.php', {
                    selectedDate: selectedDate
                });
            });
        }


        $(document).ready(function() {


            $(document).on('change', '#movieSelectDropDown', function() {
                document.getElementById('confirmBtn').style.display = "none";
                var x = document.getElementById('movieSelectDropDown');
                movieName = x.options[x.selectedIndex].text;
                document.cookie = "movieName=" + movieName
                $('#ticketingSection').load('BuyTicketsStep2.php', {
                    selectedMovieName: movieName
                });
            });
            $(document).on('change', '#showSelectDropDown', function() {
                document.getElementById('confirmBtn').style.display = "none";
                var x = document.getElementById('showSelectDropDown');
                showID = x.value;
                $('#seatAndPaymentSection').load('BuyTicketsStep3.php', {
                    selectedShowID: showID,
                    selectedMovie: movieName,
                    selectedDate: selectedDate
                });
            });


        });
    </script>
    <script>
        function showBkashForm() {
            document.getElementById('bkashForm').style.display = "block";
            document.getElementById('sCardForm').style.display = "none";
            document.getElementById('dCardForm').style.display = "none";
            document.getElementById('selectPayMethod').style.display = "none";
        }

        function showStandardCharteredForm() {
            document.getElementById('sCardForm').style.display = "block";
            document.getElementById('bkashForm').style.display = "none";
            document.getElementById('dCardForm').style.display = "none";
            document.getElementById('selectPayMethod').style.display = "none";
        }

        function showDBBLForm() {
            document.getElementById('sCardForm').style.display = "none";
            document.getElementById('bkashForm').style.display = "none";
            document.getElementById('dCardForm').style.display = "block";
            document.getElementById('selectPayMethod').style.display = "none";
        }

        function showPaymentPage() {
            document.getElementById('chooseTicketSection').style.display = "none";
            document.getElementById('billContainer').style.display = "block";
            document.getElementById('paymentArea').style.display = "block";


        }
    </script>
</head>

<body>



    <div class="container">
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-auto">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>


            </div>
        </header>
    </div>

    <!--Nav Bar Section-->
    <div class="container">
        <nav class="navbar navbar-expand-sm text-uppercase nav-area">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"> <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav my-navbar">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="MoviesPage.php" class="nav-link"><i class="fas fa-tape"></i> Movies</a>
                    </li>
                    <li class="nav-item">
                        <a href="Showtime.php" class="nav-link"><i class="fas fa-ticket-alt"></i> Showtime</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto my-navbar">
                    <li class="nav-item">
                        <a href="FoodsPage.php" class="nav-link"><i class="fas fa-pizza-slice"></i></i> Foods</a>
                    </li>
                    <li class="nav-item">
                        <a href="CorporatesPage.php" class="nav-link"><i class="fas fa-handshake"></i> Corporates</a>
                    </li>
                    <li class="nav-item">
                        <a href="OfferPage.php" class="nav-link"><i class="fas fa-gift"></i> Offers</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!--Main Body Section-->


        <div class="row mt-3 justify-content-around" id="billZone">
            <div class="col-4">
                <div id="billContainer" style="display: none;">
                    <div id="billBox">
                        <h2>Purchase Order 1</h2>
                    </div>
                    <div>
                        <table class="myBill">
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
                                <td><span>No Time To Die</span></td>
                            </tr>
                            <tr>
                                <td><span>Showtime</span></td>
                                <td>:</td>
                                <td><span>12:30 PM Hall-5 3D</span></td>
                            </tr>
                            <tr>
                                <td><span>Date</span></td>
                                <td>:</td>
                                <td><span>2020-05-14</span></td>
                            </tr>
                            <tr>
                                <td><span>No. of seats</span></td>
                                <td>:</td>
                                <td><span>2</span></td>
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




        <div class="row justify-content-center mt-4" style="background: transparent; height:500px;" id="chooseTicketSection">
            <div class="col-12 col-lg-6 col-md-8">
                <form>
                    <div class="">
                        <div id="buyTicketTitle" class="text-center">
                            <span>Buy Tickets</span>
                        </div>

                        <div class="text-left custom-control custom-radio custom-control-inline mt-3" style="width:50%; margin-left:25px; height:50px;">
                            <input type="radio" class="custom-control-input" id="customRadio" name="dateOfPurchase" value="Today" onclick="getSelectedDate();">
                            <label class="h5 custom-control-label" for="customRadio">Today <br><?php echo "$currentDate"; ?></label>
                        </div>
                        <div class="text-right custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="customRadio2" name="dateOfPurchase" value="Tomorrow" onclick="getSelectedDate();">
                            <label class="h5 custom-control-label" for="customRadio2">Tomorrow <br><?php echo date('Y-m-d', strtotime($currentDate . ' + 1 days')); ?></label>
                        </div>

                        <div class="mt-3" id="movieNameDropDownSection">
                            <select name="movieSelectDropDown" class="movieDropBtn" id="movieSelectDropDown">
                                <option value="" disabled selected>Select a movie.</option>
                            </select>
                        </div>

                        <div id="ticketingSection" class="mt-3">
                            <select name="showSelectDropDown" class="movieDropBtn" id="showSelectDropDown">
                                <option value="" disabled selected>Select a show.</option>
                            </select>
                        </div>
                        <div id="seatAndPaymentSection" class="mt-3">
                            <div>
                                <select name="seatSelectionDropDown" class="movieDropBtn" id="seatSelectionDropDown">
                                    <option value="" disabled selected>Select number of seats.</option>
                                </select>
                            </div>
                            <div class="text-center" id="proceedDiv" style="display:none;">
                                <button id="confirmBtn" type="button">Proceed</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>

    <!--Footer Section-->
    <div class="container">
        <footer>
            <div class="row my-footer">
                <div class="col">
                    <ul>
                        <li>Contact Us</li>
                        <li><img src="..\Images/CineCarnival.png" alt=""></li>
                        <li>info@cinecarnival.com</li>
                        <li>+8801745-987565</li>
                        <li>Dhanmondi, Dhaka</li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between my-footer-ending">
                <div class="col-12 col-md-4">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 developers-tag">
                    <span>Developed by : Group-5</span>
                </div>
                <div class="col-12 col-md-4 stores">
                    <ul>
                        <li><a href="#"><button type="button" class="btn btn-outline-primary" value="Play Store"><i class="fab fa-google-play"></i>Play Store</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-outline-primary" value="App Store"><i class="fab fa-app-store"></i>App Store</button></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>


</body>

</html>