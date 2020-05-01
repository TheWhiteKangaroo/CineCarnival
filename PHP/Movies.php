<?php
session_start();
$userName = $movie_id=$trailer_link=$cover_pic=$movie_id=$movie_name="";
if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
} else {
    $userName = "";
}
include "DatabaseConnection.php";
$query = $result = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['movieNumber'])) {
    $movie_id = $_GET['movieNumber'];

    $query = "SELECT * FROM movie WHERE mv_id='$movie_id';";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result)){
        $movie_id = $row['mv_id'];
        $movie_name= $row['name'];
    }
    $result = mysqli_query($conn, $query);
}

?>













<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        $.sweetModal({
            title: 'Will YouTube Ever Run Out Of Video IDs?',
            content: 'https://www.youtube.com/watch?v=gocwRvLhDf8',
            theme: $.sweetModal.THEME_DARK
        });
    </script>

    <script>
        function contentSubmission(e) {
            var rating = e;
            var movieID = <?php echo json_encode($movie_id); ?>;
            var userName=""; 
            userName = <?php echo json_encode($userName); ?>;
        
            $(document).ready(function() {
                $(".rating-wrapper").load("PollSubmission.php", {
                    rating: rating,
                    movieID: movieID,
                    userName: userName
                });
            });
        }
    </script>
    
    <script>
         function showProfileSection() {
            var userName = <?php echo json_encode($userName); ?>;
            if(userName.length >=2) {
                document.getElementById("ProfileDiv").style.display = "block";
                document.getElementById("SignOutDiv").style.display = "block";
                document.getElementById("SignUpDiv").style.display = "none";
                document.getElementById("SignInDiv").style.display = "none";
            }
            else {
                document.getElementById("ProfileDiv").style.display = "none";
                document.getElementById("SignOutDiv").style.display = "none";
                document.getElementById("SignUpDiv").style.display = "block";
                document.getElementById("SignInDiv").style.display = "block";                
            }

        }
    </script>
    <style>
        .showtimeBtn{
            width: 60%;
            height: 50px;
            margin-bottom: 10px;
            outline: none;
            border-style: none;
            background-color:#005180;
            color:white;
            font-size: 20px;
            text-align: left;
            border-left-color: #008AFC;
            border-left: 110px #008AFC solid;
            border-left-style:ridge;
            border-radius: 5px;
        }
        #starRatingDiv {
            width: 100%;
            height: 100px;
            margin-top: 0px;
        }

        #starRatingDiv span {
            font-size: 22px;
        }

        .rating-wrapper {
            width: 100%;
            height: 75px;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        .rating-wrapper input {
            display: none;
        }

        .rating-wrapper label {
            display: inline-block;
            width: 35px;
            position: relative;
            cursor: pointer
        }

        .rating-wrapper label::before {
            content: "\2605";
            position: absolute;
            font-size: 35px;
            display: inline-block;
            top: 0;
            left: 0;
        }

        .rating-wrapper label::after {
            content: "\2605";
            position: absolute;
            font-size: 35px;
            display: inline-block;
            top: 0;
            left: 0;
            color: #28a745;
            opacity: 0;
        }

        .rating-wrapper label:hover::after,
        .rating-wrapper label:hover~label::after,
        .rating-wrapper input:checked~label::after {
            opacity: 1;
        }
    </style>
</head>

<body onload="showProfileSection();">
    <style>
        #trailerBtn {
            margin-left: 40px;
            height: 30px;
            width: 75%;
            margin-top: 5px;
            padding-bottom: 8px;
            padding-top: 2px;
        }
    </style>
    <div class="container">
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-auto">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>

                   
                <div class="p-2 align-self-center header-anchor" id="ProfileDiv" style="display: none;">
                    <a href="ProfilePage.php" style="text-decoration: none;"><i class="fas fa-user-alt"></i><?php echo $userName; ?></a>
                </div>
                <div class="p-2 align-self-center header-anchor" id="SignInDiv" style="display: none;">
                    <a href="SignInPage.php" style="text-decoration: none;"><i class="fas fa-user-alt"></i> Sign In</a>
                </div>
                <div class="p-2 align-self-center" id="SignUpDiv" style="display: none;">
                    <a href="RegistrationPage.php" style="text-decoration: none;"><i class="fas fa-user-plus"></i> Sign Up</a>
                </div>
                <div class="p-2 align-self-center" id="SignOutDiv" style="display: none;">
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

        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col">
                    <?php
                    date_default_timezone_set("Asia/Dhaka");
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>


                        <div class="card border-primary mb-1" style="max-width: 100%; min-height:1000px;">
                            <div class="card bg-dark text-white mb-3">
                                <img class="card-img inner-image" src="<?php echo $row['cover_pic'];?>" alt="Card image" style="width: 100%; height:500px;filter: blur(30px);-webkit-filter: blur(8px);">
                                <div class="card-img-overlay">
                                    <h2 class="card-title text-light"><?php echo $row['name']; ?></h2>
                                    <span class="card-text h5 text-light font-weight-normal"><i class="fas fa-users"></i> <?php echo $row['cast']; ?></span><br>
                                    <span class="card-text h5 text-light font-weight-normal"><i class="fas fa-tape"></i> <?php echo $row['genre']; ?></span><br>
                                    <span class="card-text h5 text-light font-weight-normal"><i class="far fa-clock"></i> <?php echo substr($row['runtime'], 3, 5) . " hrs"; ?></span>
                                </div>
                            </div>

                            <div class="row mt-0 justify-content-between">
                                <div class="col-12 col-xl-5 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div style=" width:100%; margin-left:10px; padding:3px;">
                                                <div style=" margin-right:10px; margin-top:0px; padding:5px;">
                                                    <span style="font-size:22px; margin-bottom:20px;">Trailer   :</span>
                                                    <div class="mt-4">
                                                        <iframe width="410" height="250" src="<?php echo $row['trailer_link'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius:5px;"></iframe>
                                                    </div>
                                                    
                                                </div>
                                                <h5 style="margin-top:20px;">Plot : </h5><br>
                                                <p class="text-justify"><?php echo $row['plot']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-8">
                                        <div id="starRatingDiv">
                                                <span>Rate the movie :</span>
                                                <div class="rating-wrapper">
                                                    <input type="radio" name="rating" id="star-1" onclick="contentSubmission('5');"><label for="star-1"></label>
                                                    <input type="radio" name="rating" id="star-2" onclick="contentSubmission('4');"><label for="star-2" ></label>
                                                    <input type="radio" name="rating" id="star-3" onclick="contentSubmission('3');"><label for="star-3"></label>
                                                    <input type="radio" name="rating" id="star-4" onclick="contentSubmission('2');"><label for="star-4" ></label>
                                                    <input type="radio" name="rating" id="star-5" onclick="contentSubmission('1');"><label for="star-5" ></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                        <div class="text-right">
                                                <form action="BuyTickets.php" method="POST">
                                                    <button type="submit" name="buyTicketBtn" class="btn btn-outline-success font-weight-bold">Buy Ticket</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div style="border: 1px grey solid; border-radius:5px; margin-right:10px;">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th>Title : </th>
                                                            <td><?php echo $row['name']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Director : </th>
                                                            <td><?php echo $row['director']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cast : </th>
                                                            <td><?php echo $row['cast']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Genre : </th>
                                                            <td><?php echo $row['genre']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Runtime : </th>
                                                            <td><?php echo substr($row['runtime'], 3, 5) . " hrs"; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Release Date : </th>
                                                            <td><?php echo gmdate('F jS, Y', strtotime($row['release_date']));; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mt-5 text-center">
                                                <a href="Showtime.php"><button class="showtimeBtn">Check Shows</button></a>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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
                        <div class="col-4">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-3 developers-tag">
                            <span>Developed by : Group-5</span>
                        </div>
                        <div class="col-3 stores">
                            <ul>
                                <li><a href="#"><button type="button" class="btn btn-outline-primary" value="Play Store"><i class="fab fa-google-play"></i>Play Store</button></a></li>
                                <li><a href="#"><button type="button" class="btn btn-outline-primary" value="App Store"><i class="fab fa-app-store"></i>App Store</button></a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>
</body>

</html>