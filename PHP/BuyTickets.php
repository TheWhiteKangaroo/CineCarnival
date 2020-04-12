<?php
session_start();
if(!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])){
    session_destroy();
    header("Location: SignInPage.php");
}
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
            border-right:none; 
            border-left:none; 
            border-top:none; 
            border-bottom:2px dodgerblue solid; 
            background: transparent;
        }
        #buyTicketTitle{
            margin-top: 25;
            margin-bottom: 25px;
            background-color:  #393f4d   ;
            height: 100px;
            color: white;
            font-size: 38px;
            padding-top: 20px;
            border-top-left-radius: 25px;
            border-bottom-right-radius: 25px;
        }
        #confirmBtn{
            outline: none;
            background-color: #feda6a;
            width: 50%;
            height:50px;
            color: black;
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
            border-top-right-radius: 15px;
            border-bottom-left-radius: 15px;
            box-shadow: none;
            border-style: none;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(document).on('change', '#movieSelectDropDown', function() {
                var x = document.getElementById('movieSelectDropDown');
                var movieName = x.options[x.selectedIndex].text;
                $('#ticketingSection').load('BuyTicketsStep2.php', {
                    selectedMovieName: movieName
                });
            });
            $(document).on('change', '#showSelectDropDown', function() {
                var x = document.getElementById('showSelectDropDown');
                var showID = x.value;
                $('#seatAndPaymentSection').load('BuyTicketsStep3.php', {
                    selectedShowID: showID
                });
            });
        });
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

                
                <div class="p-2 align-self-center">
                    <a href="SignInPage.php" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
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

        <div class="row justify-content-center mt-4"  style="background: transparent; height:500px;">
            <div class="col-6 col-sm-6">
                <form>
                    <div class="">
                        <div id="buyTicketTitle" class="text-center">
                            <span>Buy Tickets</span>
                        </div>
                        <div>
                            <div class="text-left custom-control custom-radio custom-control-inline mt-3" style="width:50%; margin-left:25px; height:50px;">
                                <input type="radio" class="custom-control-input" id="customRadio" name="dateOfPurchase" value="" checked>
                                <label class="h5 custom-control-label" for="customRadio">Today <br><?php echo "$currentDate"; ?></label>
                            </div>
                            <div class="text-right custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="customRadio2" name="dateOfPurchase" value="">
                                <label class="h5 custom-control-label" for="customRadio2">Tomorrow <br><?php echo date('Y-m-d', strtotime($currentDate . ' + 1 days')); ?></label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <select name="movieSelectDropDown" class="movieDropBtn" id="movieSelectDropDown">
                                <option value="" disabled selected>Select a movie</option>
                                <?php
                                $query = "SELECT DISTINCT m.name FROM movie as m left join shows as s on s.movie_id=m.mv_id; ";

                                $result = mysqli_query($conn, $query);
                                ?>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                <option value=" . $row['name'] . ">" . $row['name'] . "</option>
                                ";
                                }
                                ?>
                            </select>
                        </div>

                        <div id="ticketingSection" class="mt-3">
                            <select name="showSelectDropDown" class="movieDropBtn" id="showSelectDropDown">
                                <option value="" disabled selected>Select a show</option>
                            </select>
                        </div>
                        <div id="seatAndPaymentSection" class="mt-3">
                            <div>
                                <select name="seatSelectionDropDown" class="movieDropBtn" id="seatSelectionDropDown">
                                    <option value="" disabled selected>Select number of seats</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="text-center">
                            <button id="confirmBtn" type="button">Confirm</button>
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
                <div class="col=4">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
                <div class="col=4 developers-tag">
                    <span>Developed by : Group-5</span>
                </div>
                <div class="col=4 stores">
                    <ul>
                        <li><a href="#"><button type="button" class="btn btn-outline-primary" value="Play Store"><i class="fab fa-google-play"></i>Play Store</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-outline-primary" value="App Store"><i class="fab fa-app-store"></i>App Store</button></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    </div>



</body>

</html>