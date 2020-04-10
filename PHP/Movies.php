<?php
include "DatabaseConnection.php";
$query = $result = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['movieNumber'])) {
    $movie_id = $_GET['movieNumber'];
    $query = "SELECT * FROM movie WHERE mv_id='$movie_id';";
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
    <script>
        $.sweetModal({
            title: 'Will YouTube Ever Run Out Of Video IDs?',
            content: 'https://www.youtube.com/watch?v=gocwRvLhDf8',
            theme: $.sweetModal.THEME_DARK
        });
    </script>
</head>

<body>
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

        <div class="container">
            <div class="row  mt-3">
                <div class="col">
                    <?php
                    date_default_timezone_set("Asia/Dhaka");
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>


                        <div class="card border-primary mb-3" style="max-width: 100%;">
                            <div class="card bg-dark text-white">
                                <img class="card-img inner-image" src="..\images/NoTimeToDie.jpg" alt="Card image" style="width: 100%; height:500px;filter: blur(30px);-webkit-filter: blur(8px);">
                                <div class="card-img-overlay">
                                    <h3 class="card-title"><?php echo $row['name']; ?></h3>
                                    <span class="card-text"><i class="fas fa-users"></i> <?php echo $row['cast']; ?></span><br>
                                    <span class="card-text"><i class="fas fa-tape"></i> <?php echo $row['genre']; ?></span><br>
                                    <span class="card-text"><i class="far fa-clock"></i> <?php echo substr($row['runtime'], 3, 5) . " hrs"; ?></span>
                                </div>
                            </div>
                            <div class="row" style="border-top: 2px DodgerBlue solid; width:100%; margin-top:20px; margin-left:1px;">
                                <div class="col">

                                </div>
                            </div>
                            <div class="row mt-2 justify-content-between mb-5">
                                <div class="col-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div style=" width:100%; margin-left:10px; padding:3px;">
                                                <img src="..\images/NoTimeToDie.jpg" class="img-responsive" alt="No Image.." style="border: 1px grey solid;border-radius:3px; margin:0px; padding:0; width:85%;">
                                                <h5 style="margin-top:50px;">Plot : </h5><br>
                                                <p class="text-justify"><?php echo $row['plot']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" col-sm-12>
                                    <div class="mt-2 mb-5 text-right" style="margin-right:10px;">
                                    <form action="BuyTickets.php" method="POST">
                                        <button type="submit" name="buyTicketBtn" class="btn btn-outline-success">Buy Ticket</button>
                                    </form>
                                    </div>
                                    
                                    <div style="border: 1px grey solid; border-radius:3px; margin-right:10px;">
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
                                    <div style=" margin-right:10px; margin-top:50px; padding:5px;">
                                        <span class="font-weight-bolder">Trailer : </span>
                                        <iframe width="515" height="310" src="https://www.youtube.com/embed/a5SxyQ-9YDA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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