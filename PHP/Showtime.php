<?php
include "DatabaseConnection.php";
$perTable = 15;

$title = $showtime = $type = $showID = "";
$showtimeArray = array();
date_default_timezone_set("Asia/Dhaka");
$currentDate = date("Y-m-d");
$query2 = "SELECT DISTINCT m.name, m.mv_id FROM movie AS m left JOIN shows as s on s.movie_id=m.mv_id WHERE show_date='$currentDate'; ";
$result2 = mysqli_query($conn, $query2);
?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Showtime | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <script>
        function myFunction(e) {
            var x = document.getElementById(e).value;
            $(document).ready(function() {
                $("#showtimeSection").load("NextShows.php", {
                    showDate: x
                });
            });
        }
    </script>
    <style>
        .timeLabels{
            border: 1px white solid;
            border-top-right-radius: 7px;
            border-bottom-left-radius: 7px;
            height: 30px;
        }
        
    </style>
</head>

<body>
    <div class="container-fluid">
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
    <div class="container-fluid">
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

        <div class="container-fluid">
            <div class="row mt-5 justify-content-around">
                <div class="col-3">
                    <div id="showCategoriesBox">
                        <h1 class="text-center">Theatre and Pricing</h1>
                        <p>There are three categories of hall or theatres in CineCarnival.</p>
                        <span style="color: #f0ad4e; font-size:16px; text-align:right;"><i class="fas fa-circle"></i></span> <label>Regular Hall</label><br>
                        <span style="color: #5cb85c; font-size:16px; text-align:right;"><i class="fas fa-circle"></i></span> <label>Premium Hall</label><br>
                        <span style="color: #0275d8; font-size:16px; text-align:right;"><i class="fas fa-circle"></i></span> <label>VIP Hall</label><br>

                        <p>Different categories of halls offer some unique theatre experience from each other. The ticket rates vary for different hall shows.</p>
                        <p>The ticket rates are as following.</p>

                        <span style="color: #f0ad4e; font-size:16px; text-align:right;"><i class="fas fa-circle"></i></span> <label>Regular Hall</label><label for=""> - 250 BDT</label><br>
                        <span style="color: #5cb85c; font-size:16px; text-align:right;"><i class="fas fa-circle"></i></span> <label>Premium Hall</label><label for=""> - 450 BDT</label><br>
                        <span style="color: #0275d8; font-size:16px; text-align:right;"><i class="fas fa-circle"></i></span> <label>VIP Hall</label><label for=""> - 600 BDT</label><br>
                    </div>


                </div>
                <div class="col-8">
                    <div class="card text-white bg-dark mb-3" style="max-width: 100%; border-radius:10px;">
                        <div class="card-header text-center font-weight-bold h1"><i class="fas fa-vr-cardboard"></i> Showtime</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="inputWithIcon text-left">
                                        <input type="date" max="<?php echo date('Y-m-d', strtotime($currentDate . ' + 1 days')); ?>" min="<?php echo $currentDate;?>" class="showtime-datepicker" id="showDatePicker" onchange="myFunction(this.id)"><i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right font-weight-normal" >
                                        <span style="color: #f0ad4e; font-size:16px; text-align:right;"><i class="fas fa-circle"></i> <span style="color: White;">Regular</span></span>
                                        <span style="color: #5cb85c; font-size:16px; text-align:right;"><i class="fas fa-circle"></i> <span style="color: White;">Premium</span></span>
                                        <span style="color: #0275d8; font-size:16px; text-align:right;"><i class="fas fa-circle"></i> <span style="color: White;">VIP</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3" id="showtimeSection" style="width: 100%; height:500px;">
                                <div class="col" style="width: 100%;">
                                    <table class="table table-striped table-dark" style="width: 100%;">
                                        <thead style="width: 100%">
                                            <tr style="width: 100%">
                                                <th scope="col" style="width: 200px;">Movie</th>
                                                <th scope="col" >Shows</th>
                                            </tr>
                                        </thead>
                                        <tbody style="width: 100%">
                                            <?php
                                            if (mysqli_num_rows($result2) == 0) {
                                                echo "
                                                    <tr>
                                                        <td colspan=" . "2" . "><span><i class=" . "fas fa-search" . "></i>Sorry, No Shows Found!</span></td>
                                                    </tr>
                                                ";
                                            }
                                            while ($row = mysqli_fetch_assoc($result2)) {

                                                $movieName = $row['name'];
                                                $showtime = "";
                                            ?>
                                                <tr>
                                                    <td><?php echo $movieName; ?></td>
                                                    <?php
                                                    $result4 = mysqli_query($conn, "SELECT show_time FROM shows WHERE movie_id='$row[mv_id]';");
                                                    while ($newRow = mysqli_fetch_assoc($result4)) {
                                                        $tempTime = $newRow['show_time'];
                                                        $result5 = mysqli_query($conn, "SELECT theatre_id,show_type FROM shows WHERE movie_id='$row[mv_id]' AND show_time='$tempTime';");
                                                        while ($lastRow = mysqli_fetch_assoc($result5)) {
                                                            if ($lastRow['theatre_id'] == 1) {
                                                                if (substr($newRow['show_time'], 0, 5) > 12) {
                                                                    $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                                                } else {
                                                                    $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                                                }
                                                                echo " <td><label class=" . "timeLabels" . " style="."background-color:#5cb85c ;".">" . $showtime . "</label></td>";
                                                            } else if ($lastRow['theatre_id'] == 2) {
                                                                if (substr($newRow['show_time'], 0, 5) > 12) {
                                                                    $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                                                } else {
                                                                    $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                                                }
                                                                echo " <td><label class=" . "timeLabels" . " style="."background-color:#0275d8 ;".">" . $showtime . "</label></td>";
                                                            } else if ($lastRow['theatre_id'] == 3) {
                                                                if (substr($newRow['show_time'], 0, 5) > 12) {
                                                                    $showtime = substr($newRow['show_time'], 0, 5) . " PM";
                                                                } else {
                                                                    $showtime = substr($newRow['show_time'], 0, 5) . " AM";
                                                                }
                                                                echo " <td><label class=" . "timeLabels bg-warning" . " style="."background-color:#f0ad4e ;".">" . $showtime . "</label></td>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                                <div class="col">

                                </div>
                            </div>
                </div>
            </div>
        </div>

        <!--Footer Section-->
        <div class="container-fluid">
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