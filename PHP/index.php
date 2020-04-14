<?php
session_start();
include "DatabaseConnection.php";
$userName="";
if(isset($_SESSION['userName'])){
    $userName = $_SESSION['userName'];
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
        .nowShowingTile {
            width: 100%;
            height: 65px;
            background-color: #1d1e22;
            color: white;
            margin: 0;
            padding-top: 10px;
            padding-left: 50px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;

        }

        .nowShowingTile a {
            text-decoration: none;
            color: white;
            font-size: 28px;
        }

        .movieCardsShowReel {
            width: 100%;
            border: 1px black solid;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin-top: 10px;
            border-bottom: 0;
            box-shadow: 5px 10px 10px gray;
        }

        .movieCardsShowReel a {
            text-decoration: none;
            font-size: 20px;
            color: black;
        }

        .TrendingListBox {
            background-color: #1d1e22;
            width: 100%;
            color: white;
            font-size: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 65px;
            text-align: center;
            padding-top: 15px;

        }

        .TrendingListContainer {
            width: 85%;
            height: auto;
            border-style: inherit;
            border-left: 5px #1d1e22 solid;
            border-right: 5px #1d1e22 solid;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            border-bottom: 20px #1d1e22 solid;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    </style>
    <script type="text/javascript">
        function showProfileDiv(){
            
        }
    </script>
    <?php
        if(isset($userName) && $userName!=null){
            echo '<script type="text/javascript">
            showProfileDiv();
       </script>'; 
        }
    ?>
</head>

<body>
    <div class="container-fluid">
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-auto">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>
                
                <div class="p-2 align-self-center header-anchor" id="ProfileDiv">
                    <a href="ProfilePage.php" style="text-decoration: none;" ><i class="fas fa-user-alt"></i> <?php echo $userName; ?></a>
                </div>
                <div class="p-2 align-self-center header-anchor" id="SignInDiv">
                    <a href="SignInPage.php" style="text-decoration: none;"><i class="fas fa-user-alt"></i> Sign In</a>
                </div>
                <div class="p-2 align-self-center" id="SignUpDiv">
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
            <div class="row mt-4 p-0">
                <div class="col-3 m-0 p-0">
                    <div class="row">
                        <div class="col">
                            <div class="TrendingListContainer">
                                <div class="TrendingListBox">
                                    <h4><i class="fas fa-chart-line"></i> Trending Movies</h4>
                                </div>
                                <div>
                                    <?php
                                    $query = "SELECT name FROM movie LIMIT 5;";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="card" style="width: auto;">
                                            <div class="card-body">
                                                <a href="#" style="text-decoration: none; color:dodgerblue;"><?php echo $row['name']; ?></a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row m-0 p-0 justify-content-between" style="width: 85%;">
                        <div class="col m-0 p-0">
                            <div class="mt-4 text-justify">
                                <?php
                                   $query = "SELECT DISTINCT title, message, links, pic, date_posted FROM notice WHERE date_posted= (SELECT MAX(date_posted) FROM notice)";
                                   $result = mysqli_query($conn,$query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                    <div class=" . "card text-justify" . ">
                                        <div class=" . "card-header bg-dark text-center".">
                                            Notice
                                            </div>
                                                <div class=" . "card-body text-justify text-left" . ">
                                                    <h5 class=" . "card-title" . ">" . $row['title'] . "</h5>";
                                    if ($row['pic'] != null || isset($row['pic']) || !empty($row['pic'])) {
                                        echo "
                                                            <img class=" . "card-img-top" . " src=" . "..\images/NoTimeToDie.jpg" . " alt=" . "No Image..." . " style=" . "margin-bottom:10px; width:200px; height: 100px;" . ">
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
                <div class="col-9 m-0 p-0">
                    <div class="nowShowingTile">
                        <a href="MoviesPage.php">Now Showing</a>
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
                                    <div class="movieReelPanel" style="margin-top: 10px;">
                                        
                                            <form action="Movies.php" method="GET">
                                                <img src="..\images/NoTimeToDie.jpg" alt="No Cover" style="width:100%; height:250px; border-top-right-radius:10px; border-top-left-radius:10px; margin:0; padding:0;"><br>
                                                <button type="submit" name="movieNumber" value=" <?php echo $row['mv_id']; ?>  id = " <?php echo $row['mv_id']; ?>  class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0; height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
                                            </form>
                                        
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="nowShowingTile mt-5" style="background-color: #393f4d;">
                        <a href="MoviesPage.php">Up Coming</a>
                    </div>
                    <div class="row mt-3 justify-content-start">
                        <?php
                        $query = "SELECT name, cover_pic,mv_id FROM movie WHERE status='Coming Soon' ORDER BY mv_id DESC LIMIT 4;";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) == 0) {
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                                <div class="col-3">
                                    <div class="movieReelPanel">
                                    <form action="Movies.php" method="GET">
                                                <img src="..\images/NoTimeToDie.jpg" alt="No Cover" style="width:100%; height:250px; border-top-right-radius:10px; border-top-left-radius:10px; margin:0; padding:0;"><br>
                                                <button type="submit" name="movieNumber" value=" <?php echo $row['mv_id']; ?>  id = " <?php echo $row['mv_id']; ?>  class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0; height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
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



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>
</body>

</html>