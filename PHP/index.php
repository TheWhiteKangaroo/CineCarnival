<?php
session_start();
$userName = "";
if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
} else {
    $userName = "";
}

include "DatabaseConnection.php";
$sql = "SELECT cover_pic FROM movie ORDER BY mv_id DESC LIMIT 6";
$result = mysqli_query($conn, $sql);
$picArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($picArray, $row['cover_pic']);
}

$sql = "SELECT pic,title FROM notice ORDER BY n_id LIMIT 1";
$result = mysqli_query($conn,$sql);
$noticePicArray = array();
$noticeArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($noticePicArray, $row['pic']);
    array_push($noticeArray,$row['title']);
}

$sql = "SELECT pic FROM offer ORDER BY o_id DESC LIMIT 3";
$result = mysqli_query($conn,$sql);
$offerPicArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($offerPicArray, $row['pic']);
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
            if (userName.length <= 2) {
                document.getElementById("ProfileDiv").style.display = "none";
                document.getElementById("SignOutDiv").style.display = "none";
                document.getElementById("SignUpDiv").style.display = "block";
                document.getElementById("SignInDiv").style.display = "block";
            } else {
                document.getElementById("ProfileDiv").style.display = "block";
                document.getElementById("SignOutDiv").style.display = "block";
                document.getElementById("SignUpDiv").style.display = "none";
                document.getElementById("SignInDiv").style.display = "none";
            }

        }
    </script>


    <style>
        #buyTicketBtn {
            width: 75%;
            height: 50px;
            margin-top: 20px;
            outline: none;
            border-style: none;
            background-color: #005180;
            color: white;
            font-size: 18px;
            text-align: left;
            border-left-color: #008AFC;
            border-left: 60px #008AFC solid;
            border-left-style: ridge;
            border-radius: 5px;
        }

        .trendingCard {
            width: 100%;
            height: auto;
            color: black;
            border-bottom: 1px black solid;
        }

        .trendingCard button {
            color: black;
            background-color: white;
            width: 100%;
            text-align: left;
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
            background-color: #2c3e50;
        }

        .card-img-top {
            width: auto;
            height: 18vw;
            object-fit: cover;
        }
    </style>

</head>

<body onload="showProfileSection();">    

<a href="#" class="goTopBtn"><i class="fas fa-arrow-alt-circle-up"></i> </a>
    <div class="container-fluid">
    
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section" style="height: 120px; padding-top:25px;">
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


        <div class="row justify-content-center mt-4 mb-2">
            <div class="col">




                <div id="carouselExampleIndicators" class="carousel slide bg-dark" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" style=" box-shadow: 0 4px 8px 0  #4e5b61, 0 6px 15px 0  #4e5b61 ;">
                    <div class="carousel-item active">
                            <div class="row justify-content-center text-center">
                                    <div class="col-12 col-md-9">
                                        <img src="<?php if (isset($noticePicArray[0])) echo $noticePicArray[0]; ?>" class="w-50"  alt="..." style="height: 350px;">
                                    </div>
                            </div>
                            <div class="carousel-caption d-none d-md-block text-warning">
                                <h1><?php if(isset($noticeArray)) echo $noticeArray[0]; ?></h1>
                            </div>
                        </div>    
                    <div class="carousel-item">
                            <div class="row justify-content-center text-center">
                                <div class="col-12 col-md-3 ">
                                    <img src="<?php if (isset($picArray[0])) echo $picArray[0]; ?>"  class="w-100"   alt="..." style="height: 350px;">
                                </div>
                                <div class="col-12 col-md-3 ">
                                    <img src="<?php if (isset($picArray[1])) echo $picArray[1]; ?>"  class="w-100"  alt="..." style="height: 350px;">
                                </div>
                                <div class="col-12 col-md-3 ">
                                    <img src="<?php if (isset($picArray[2])) echo $picArray[2]; ?>" class="w-100"  alt="..." style="height: 350px;">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row justify-content-center text-center">
                                    <div class="col-12 col-md-3 ">
                                        <img src="<?php if (isset($picArray[3])) echo $picArray[3]; ?>" class="w-100" alt="..." style="height: 350px;">
                                    </div>
                                    <div class="col-12 col-md-3 ">
                                        <img src="<?php if (isset($picArray[4])) echo $picArray[4]; ?>"  class="w-100" alt="..." style="height: 350px;">
                                    </div>
                                    <div class="col-12 col-md-3 ">
                                        <img src="<?php if (isset($picArray[5])) echo $picArray[5]; ?>" class="w-100"  alt="..." style="height: 350px;">
                                    </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row justify-content-center text-center">
                                <div class="col-12 col-md-3 ">
                                    <img src="<?php if (isset($offerPicArray[0])) echo $offerPicArray[0]; ?>"  class="w-100"   alt="..." style="height: 350px;">
                                </div>
                                <div class="col-12 col-md-3 ">
                                    <img src="<?php if (isset($offerPicArray[1])) echo $offerPicArray[1]; ?>"  class="w-100"  alt="..." style="height: 350px;">
                                </div>
                                <div class="col-12 col-md-3 ">
                                    <img src="<?php if (isset($offerPicArray[2])) echo $offerPicArray[2]; ?>" class="w-100"  alt="..." style="height: 350px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>



        </div>
    











    <div class="row mt-3  justify-content-around ">
        <div class="col-12 col-sm-8 col-xl-2 col-lg-3 col-md-4 order-lg-1 order-xl-1 order-lg-1 order-md-2 order-2">
            <div class="row">
                <div class="col">
                    <div class="TrendingListContainer">
                        <div class="TrendingListTitle">
                            <span style="font-size: 18px; color:white;"><i class="fas fa-chart-line"></i> Trending Movies</span>
                        </div>
                        <div class="TrendingBox">
                            <?php
                            $trendingList = array();
                            $sql  = "SELECT DISTINCT movie_id FROM rating ORDER BY rating DESC LIMIT 4";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($trendingList, $row['movie_id']);
                            }
                            if ($trendingList == null) {
                            ?>
                                <div class="trendingCard bg-light text-center text-success mb-2 pt-2">
                                    <h6><i class="fas fa-search"></i> No trending movies found!</h6>
                                </div>
                            <?php
                            } else {
                                $query = "SELECT name,mv_id FROM movie WHERE mv_id='$trendingList[0]' AND status='Now Showing' ";
                                for ($i = 1; $i < count($trendingList); $i++) {
                                    $val = $trendingList[$i];
                                    $query .= " OR mv_id=$val";
                                }
                                $query .= " LIMIT 6;";
                                //echo $query;
                                $result = mysqli_query($conn, $query);
                            }
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                                <div class="trendingCard bg-light mb-2">
                                    <form action="Movies.php" method="GET">
                                        <button type="submit" name="movieNumber" value="<?php echo $row['mv_id']; ?>" id="<?php echo $row['mv_id']; ?>" class="btn btn-link text-dark text-decoration-none font-weight-normal"><?php echo $row['name']; ?></button>
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
                        $query = "SELECT * FROM poll ORDER BY p_id DESC LIMIT 1;";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>





                            <div class="pollTitle">
                                <label id="pollIDText" style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px; display:none;"><i class="fas fa-poll"></i> <?php echo $row['p_id']; ?> </label>
                                <label id="pollTitleText" style="font-size: 18px; color:white; margin-top:15px; margin-bottom:5px;"><i class="fas fa-poll"></i> <?php echo $row['poll_title']; ?> </label>
                            </div>
                            <div class="pollContentArea">
                                <div class="custom-control custom-radio mb-2 ml-3  text-left h6">
                                    <input type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" onclick="contentSubmission('1');">
                                    <label class="custom-control-label text-dark" for="customControlValidation1"><?php echo $row['content1']; ?></label>
                                </div>
                                <div class="custom-control custom-radio mb-2  ml-3  text-left h6">
                                    <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" onclick="contentSubmission('2');">
                                    <label class="custom-control-label text-dark" for="customControlValidation2"><?php echo $row['content2']; ?></label>
                                </div>
                                <div class="custom-control custom-radio mb-2 ml-3 text-left h6">
                                    <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" onclick="contentSubmission('3');">
                                    <label class="custom-control-label text-dark" for="customControlValidation3"><?php echo $row['content3']; ?></label>
                                </div>
                                <div class="custom-control custom-radio mb-2 ml-3  text-left h6">
                                    <input type="radio" class="custom-control-input" id="customControlValidation4" name="radio-stacked" onclick="contentSubmission('4');">
                                    <label class="custom-control-label text-dark" for="customControlValidation4"><?php echo $row['content4']; ?></label>
                                </div>
                            </div>





                        <?php

                        }
                        ?>

                    </div>
                </div>
            </div>

            <div class="row text-center justify-content-center">
                <div class="col  text-center">
                    <a href="BuyTickets.php"><button id="buyTicketBtn">Buy Tickets</button></a>
                </div>
            </div>


        </div>




        <div class="col-12 col-xl-6 col-lg-9 col-md-12 order-lg-2 order-xl-2 order-md-1   order-1">

            <div>
                <div class="nowShowingTile pl-3">
                    <a href="MoviesPage.php"><i class="fas fa-tape"></i> Now Showing</a>
                </div>
                <div class="row justify-content-start ">
                    <?php
                    $query = "SELECT name, cover_pic,mv_id FROM movie WHERE status='Now Showing' ORDER BY mv_id DESC LIMIT 6;";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) == 0) {
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="col-6 col-sm-4 col-lg-3 mt-1  movieReelPanel" style="margin-top: 0px;">
                                <form action="Movies.php" method="GET">
                                    <img src="<?php echo $row['cover_pic'] ?>" class="cardPic" alt="No Cover" style="width:100%; height:250px; margin:0; padding:0;"><br>
                                    <button type="submit" name="movieNumber" value="<?php echo $row['mv_id']; ?>" id="<?php echo $row['mv_id']; ?>" class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0; height:auto; min-height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
                                </form>


                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>

                <div class="nowShowingTile mt-5 pl-3" style="background-color: #2c3e50;">
                    <a href="MoviesPage.php"><i class="fas fa-tape"></i> Up Coming</a>
                </div>
                <div class="row justify-content-start">
                    <?php
                    $query = "SELECT name, cover_pic,mv_id FROM movie WHERE status='Coming Soon' ORDER BY mv_id DESC LIMIT 6;";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) == 0) {
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="col-6 col-sm-4 col-lg-3 mt-1">
                                <div class="movieReelPanel" style="margin-top: 0px;">
                                    <form action="Movies.php" method="GET">
                                        <img src="<?php echo $row['cover_pic'] ?>" class="cardPic" alt="No Cover" style="width:100%; height:250px; margin:0; padding:0;"><br>
                                        <button type="submit" name="movieNumber" value="<?php echo $row['mv_id']; ?>" id="<?php echo $row['mv_id']; ?>" class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0; height:auto;min-height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
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

        <div class="col-12 col-sm-8 col-xl-3 col-lg-9 col-md-8 order-lg-3 order-xl-3 order-md-3  offset-md-0 offset-xl-0 offset-lg-3 order-3">
            <div class="row justify-content-between m-0 p-0" style="width: 100%;">
                <div class="col m-0 p-0">
                    <div class="mt-2 text-justify m-0 p-0">
                        <?php
                        $query = "SELECT DISTINCT title, message, links, pic, date_posted FROM notice WHERE date_posted= (SELECT MAX(date_posted) FROM notice)";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                                    <div class=" . "card text-justify m-0 p-0" . ">
                                        <div class=" . "card-header bg-dark text-center m-0 p-0" . ">
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
                <div class="row justify-content-around my-footer-ending">
                    <div class="col-12 ml-5 pl-3 pl-sm-0 ml-sm-0 col-sm-6 m-0 p-0 text-left">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                    
                    
                    <div class="col-12 mr-5 pr-2 pr-sm-0 mr-sm-0 col-sm-6 stores  text-right m-0 p-0">
                        <ul style="padding-right:95px;">
                            <li><a href="#"><button type="button" class="btn btn-outline-primary" value="Play Store"><i class="fab fa-google-play"></i>Play Store</button></a></li>
                            <li><a href="#"><button type="button" class="btn btn-outline-primary" value="App Store"><i class="fab fa-app-store"></i>App Store</button></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>

</body>

</html>