<?php
include "DatabaseConnection.php";
date_default_timezone_set("Asia/Dhaka");
$currentDate = date("Y-m-d");
$selectedShowTime = $selectedMovie = "";

if(isset($_GET['movieSelectDropDown'])){
    $selectedShowTime = $_GET['movieSelectDropDown'];
}
if(isset($_GET['showSelectDropDown'])){
    $selectedShowTime = $_GET['showSelectDropDown'];
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
    <style>
        .movieDropBtn {
            width: 75%;
            height: 35px;
            text-align: right;
            font-size: 18px;
            padding-right: 35px;
            border: 2px dodgerblue solid;
            border-radius: 5px;
        }
    </style>
   
    

</head>

<body>
<script type="text/javascript">
         var movieName =" ";
        function getSelectedMovie(){
             var d= document.getElementById("movieSelectDropDown");
             movieName = d.options[d.selectedIndex].text;
            alert(movieName);
            <?php $selectedMovie = "<script>document.write(movieName)</script>"?>  
        }
    </script>
    <script>
        function getSelectedShow(){
            var d= document.getElementById("showSelectDropDown");
            var showID = d.options[d.selectedIndex].text;
            alert(showID);
        }
    </script>
    
    

    <div class="container">
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-auto">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>

                <div class="p-2 align-self-center header-anchor">
                    <a href="SignInPage.php" style="text-decoration: none;"><i class="fas fa-user-alt"></i> Sign In</a>
                </div>
                <div class="p-2 align-self-center">
                    <a href="RegistrationPage.php" style="text-decoration: none;"><i class="fas fa-user-plus"></i> Sign Up</a>
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
                        <a href="#" class="nav-link"><i class="fas fa-ticket-alt"></i> Showtime</a>
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

        <div class="row justify-content-center" style="background: transparent; height:300px;">
            <div class="col-5">
                <form action="BuyTickets.php" method="GET">
                    <div>
                        <div id="buyTicketTitle">
                            <h2>Buy Tickets</h2>
                        </div>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline mt-3">
                                <input type="radio" class="custom-control-input" id="customRadio" name="dateOfPurchase" value="" checked>
                                <label class="custom-control-label" for="customRadio">Today <br><?php echo "$currentDate"; ?></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="customRadio2" name="dateOfPurchase" value="">
                                <label class="custom-control-label" for="customRadio2">Tomorrow <br><?php echo date('Y-m-d', strtotime($currentDate . ' + 1 days')); ?></label>
                            </div>
                        </div>
                        <div>
                            <select name="movieSelectDropDown" class="movieDropBtn" id="movieSelectDropDown" onchange="getSelectedMovie();">
                                <option value="" disabled selected>Select a movie</option>
                                <?php
                                $query = "SELECT DISTINCT m.name FROM movie as m left join shows as s on s.movie_id=m.mv_id;";
                                $result = mysqli_query($conn, $query);
                                ?>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                <option value=".$row['name'].">" . $row['name'] . "</option>
                                ";
                                }
                                ?>
                            </select>

                        </div>
                        <div>
                            <select name="showSelectDropDown" class="movieDropBtn" id="showSelectDropDown" onchange="getSelectedShow();">
                                <option value="" disabled selected>Select a show</option>
                                <?php
                                $query = "SELECT name FROM movie WHERE name='$selectedMovie'";
                                $result = mysqli_query($conn, $query);
                                ?>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                    <option value=".$row['name'].">".$row['name']."</option>
                                ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-7">

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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>

</body>

</html>