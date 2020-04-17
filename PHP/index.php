<?php
session_start();
$userName = "";
if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
} else {
    $userName = "";
}
include "DatabaseConnection.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <script>
        function contentSubmission(e) {
            var x = e;
            var y = document.getElementById('pollTitleText').innerText;
            var z = document.getElementById('pollIDText').innerText;

            $(document).ready(function() {
                $(".pollContainer").load("PollSubmission.php", {
                    content: x,
                    pollTitle: y,
                    pollID: z
                });
            });
        }

        function showProfileSection() {
            var userName = <?php echo json_encode($userName); ?>;
            if(userName.length <=2) {
                document.getElementById("ProfileDiv").style.display = "none";
                document.getElementById("SignOutDiv").style.display = "none";
                document.getElementById("SignUpDiv").style.display = "block";
                document.getElementById("SignInDiv").style.display = "block";
            }
            else {
                document.getElementById("ProfileDiv").style.display = "block";
                document.getElementById("SignOutDiv").style.display = "block";
                document.getElementById("SignUpDiv").style.display = "none";
                document.getElementById("SignInDiv").style.display = "none";
            }

        }
    </script>


    <style>
    body{
        background-image: url('curtain.jpg');
    }
    .trendingCard{
    width: 100%;
    height: 40px;
    color: white;
    border-bottom: 1px black solid;
    }
    .trendingCard button{
        color: white;
    }
        .nowShowingTile {
            width: 100%;
            height: 60px;
            background-color: #2c3e50;
            color: white;
            margin-top: 10px;
            padding-top: 10px;
            padding-left: 50px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;

        }

        .nowShowingTile a {
            text-decoration: none;
            color: white;
            font-size: 22px;
            text-align: left;
        }

        .movieCardsShowReel {
            width: 100%;
            border: 1px black solid;
            text-align: center;

            margin-top: 10px;
            border-bottom: 0;
            box-shadow: 5px 10px 10px gray;
        }

        .movieCardsShowReel a {
            text-decoration: none;
            font-size: 20px;
            color: black;
        }



        .TrendingListContainer {
            width: 100%;
            height: auto;
            min-height: 100px;
            border: 1px #2c3e50 solid;
            border-top-left-radius: 17px;
            border-bottom-right-radius: 15px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
   
</head>

<body onload="showProfileSection();">
    <div class="container-fluid">
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section" style="height: 120px; padding-top:25px; margin-top:120px;">
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

        <div class="container-fluid">
            <div class="row mt-3 justify-content-center">
                <div class="col-2">
                    <div class="row">
                        <div class="col">
                            <div class="TrendingListContainer">
                                <div class="TrendingListTitle">
                                    <span style="font-size: 18px; color:white;"><i class="fas fa-chart-line"></i> Trending Movies</span>
                                </div>
                                <div class="TrendingBox">
                                    <?php
                                    $query = "SELECT name,mv_id FROM movie LIMIT 6;";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        
                                            <div class="trendingCard bg-light mb-2">
                                                <form action="Movies.php" method="GET">
                                                    <button type="submit" name="movieNumber" value="<?php echo $row['mv_id']; ?>" id="<?php echo $row['mv_id']; ?>" class="btn btn-link text-dark text-decoration-none font-weight-normal"><?php echo $row['name'];?></button>
                                                </form>
                                            </div>
                                        
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>







                    <div class="row">
                        <div class="col">
                            <div class="pollContainer">
                                <?php
                                $query = "SELECT * FROM poll WHERE p_id='1';";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>





                                    <div class="pollTitle">
                                        <label id="pollIDText" style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px; display:none;"><i class="fas fa-poll"></i> <?php echo $row['p_id']; ?> </label>
                                        <label id="pollTitleText" style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px;"><i class="fas fa-poll"></i> <?php echo $row['poll_title']; ?> </label>
                                    </div>
                                    <div class="pollContentArea">
                                        <div class="custom-control custom-radio mb-2 text-left h6">
                                            <input type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" onclick="contentSubmission('1');">
                                            <label class="custom-control-label text-light" for="customControlValidation1"><?php echo $row['content1']; ?></label>
                                        </div>
                                        <div class="custom-control custom-radio mb-2 text-left h6">
                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" onclick="contentSubmission('2');">
                                            <label class="custom-control-label text-light" for="customControlValidation2"><?php echo $row['content2']; ?></label>
                                        </div>
                                        <div class="custom-control custom-radio mb-2 text-left h6">
                                            <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" onclick="contentSubmission('3');">
                                            <label class="custom-control-label text-light" for="customControlValidation3"><?php echo $row['content3']; ?></label>
                                        </div>
                                        <div class="custom-control custom-radio mb-2 text-left h6">
                                            <input type="radio" class="custom-control-input" id="customControlValidation4" name="radio-stacked" onclick="contentSubmission('4');">
                                            <label class="custom-control-label text-light" for="customControlValidation4"><?php echo $row['content4']; ?></label>
                                        </div>
                                    </div>





                                <?php

                                }
                                ?>

                            </div>
                        </div>
                    </div>


                </div>




                <div class="col-6">

                    <div>
                        <div class="nowShowingTile pl-3">
                            <a href="MoviesPage.php"><i class="fas fa-tape"></i> Now Showing</a>
                        </div>
                        <div class="row justify-content-start">
                            <?php
                            $query = "SELECT name, cover_pic,mv_id FROM movie WHERE status='Now Showing' ORDER BY mv_id DESC LIMIT 4;";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) == 0) {
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                                    <div class="col-3">
                                        <div class="movieReelPanel" style="margin-top: 2px;">
                                            <form action="Movies.php" method="GET">
                                                <img src="<?php echo $row['cover_pic']?>" alt="No Cover" style="width:100%; height:210px; margin:0; padding:0;"><br>
                                                <button type="submit" name="movieNumber" value=" <?php echo $row['mv_id']; ?>  id = " <?php echo $row['mv_id']; ?> class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0; height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
                                            </form>

                                        </div>
                                    </div>

                            <?php
                                }
                            }
                            ?>
                        </div>

                        <div class="nowShowingTile mt-5 pl-3" style="background-color: #2c3e50;">
                            <a href="MoviesPage.php"><i class="fas fa-tape"></i> Up Coming</a>
                        </div>
                        <div class="row justify-content-between">
                            <?php
                            $query = "SELECT name, cover_pic,mv_id FROM movie WHERE status='Coming Soon' ORDER BY mv_id DESC LIMIT 4;";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) == 0) {
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                                    <div class="col-3">
                                        <div class="movieReelPanel" style="margin-top: 2px;">
                                            <form action="Movies.php" method="GET">
                                                <img src="<?php echo $row['cover_pic']?>" alt="No Cover" style="width:100%; height:210px; margin:0; padding:0;"><br>
                                                <button type="submit" name="movieNumber" value=" <?php echo $row['mv_id']; ?>  id = " <?php echo $row['mv_id']; ?> class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0; height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
                                            </form>
                                        </div>

                                    </div>

                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>


                </div>

                <div class="col-2">



                            
                    <div class="row m-0 p-0 justify-content-between" style="width: 100%;">
                        <div class="col m-0 p-0">
                            <div class="mt-2 text-justify">
                                <?php
                                $query = "SELECT DISTINCT title, message, links, pic, date_posted FROM notice WHERE date_posted= (SELECT MAX(date_posted) FROM notice)";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                    <div class=" . "card text-justify" . ">
                                        <div class=" . "card-header bg-dark text-center" . ">
                                            Notice
                                            </div>
                                                <div class=" . "card-body text-justify text-left" . ">
                                                    <h5 class=" . "card-title" . ">" . $row['title'] . "</h5>";
                                    if ($row['pic'] != null || isset($row['pic']) || !empty($row['pic'])) {
                                        echo "
                                                            <img class=" . "card-img-top" . " src=" . $row['pic'] . " alt=" . "No Image..." . " style=" . "margin-bottom:10px; width:200px; height: 100px;" . ">
                                                        ";
                                    }
                                    echo "
                                                    <p class=" . "card-text text-justify" . ">" . $row['message'] . "</p>";
                                    if ($row['links'] != null || isset($row['links']) || !empty($row['links'])) {
                                        echo "
                                                            <a href=" . $row['links'] . " class=" . "badge badge-secondary" . ">Click here</a>
                                                        ";
                                    }
                                    echo "
                                                        
                                                </div>
                                            <div class=" . "card-footer text-muted" . ">
                                            <span>Posted on : " . $row['date_posted'] . "</span>
                                        </div>
                                     </div>
                                ";
                                }
                                ?>
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