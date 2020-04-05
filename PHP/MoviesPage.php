<?php
include "DatabaseConnection.php";
$movieName = $genre = $cast = "";
$perPage = 9;

$sql = "SELECT * FROM movie LIMIT $perPage";
$result = mysqli_query($conn, $sql);

$totalMoviesQuery = "SELECT COUNT(*) as totalMovies FROM movie";
$resultTotalMovies = mysqli_query($conn, $totalMoviesQuery);
$resultTotalMovies = mysqli_fetch_assoc($resultTotalMovies);

$tm = $resultTotalMovies['totalMovies'];
$np = ceil($tm / $perPage);

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
        $(document).ready(function() {
            var i = 9;

            $("#nowShowingBtn").click(function() {
                $("#movieSection").load("NextMovies.php", {
                    NowShowingPage: 9
                });
            });    

            $("#ldMoreButton").click(function() {
                i = i + 3;
                document.getElementById('searchText').value = "";
                $("#movieSection").load("NextMovies.php", {
                    limitValue: i
                });
            });

            $('#searchText').on('keyup', function() {
                $('#movieSection').load('NextMovies.php', {
                    searchedKeyWord: document.getElementById('searchText').value
                });
            });

            $(document).on('change', '#actionCB', function() {
                if (this.checked) {
                    $('#movieSection').load('NextMovies.php', {
                        actionCBValue: document.getElementById('actionCB').value
                    });
                }
            });

            $(document).on('change', '#comedyCB', function() {
                if (this.checked) {
                    $('#movieSection').load('NextMovies.php', {
                        comedyCBValue: document.getElementById('comedyCB').value
                    });
                }
            });
            $(document).on('change', '#horrorCB', function() {
                if (this.checked) {
                    $('#movieSection').load('NextMovies.php', {
                        horrorCBValue: document.getElementById('horrorCB').value
                    });
                }
            });
            $(document).on('change', '#dramaCB', function() {
                if (this.checked) {
                    $('#movieSection').load('NextMovies.php', {
                        dramaCBValue: document.getElementById('dramaCB').value
                    });
                }
            });

        });
    </script>

 <script>
    let btnNowShowing = document.querySelector('#nowShowingBtn');
    let btnUpComing = document.querySelector('#upcomingBtn');
    let btnExclusive = document.querySelector('#exclusiveBtn');
    btnNowShowing.addEventListener('click', () => btnNowShowing.style.backgroundColor='#337ab7')
    btnNowShowing.addEventListener('click', () => btnNowShowing.style.backgroundColor='')
    btnNowShowing.addEventListener('click', () => btnNowShowing.style.backgroundColor='')
 </script>


</head>

<body>
    <div class="container-fluid">
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-2">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>
                <div class="p-2 align-self-center d-sm-none d-md-block d-none d-sm-block mr-0 pr-0">
                    <input class="search-box border-primary pt-1 pb-1 pr-5 pl-4 ml-3 mr-0 text-capitalize" id="searchText" style="border-radius: 25px; background:transparent; color: white;" name="searchBar" value="" type="text" placeholder="Search for movies...">
                </div>
                <div class="p-2 align-self-center  mr-auto d-sm-none d-md-block d-none d-sm-block ml-0 pl-0">
                    <button class="border-primary  search-button"><i class="fas fa-search"></i></button>
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
        <nav class="navbar navbar-expand-sm text-uppercase nav-area ">
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
                        <a href="#" class="nav-link"><i class="fas fa-pizza-slice"></i></i> Foods</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-handshake"></i> Corporates</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-receipt"></i> Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-gift"></i> Offers</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!--Main Body Section-->
        <div class="container-fluid">
            <div class="row mt-4 mb-2">
                <div class="col pb-2">
                    <form action="MoviesPage.php" method="GET">
                        <ul class="nav nav-tabs   movies-nav">
                            <li class="nav-item"><span>Movies</span></li>
                            <li class="nav-item">
                                <button type="button" name="nowShowingBtn" id="nowShowingBtn" class="border-0 pt-3 pb-2 mr-2" onclick="this.style.color='white';this.style.backgroundColor = '#9400D3'">Now Showing</button>
                            </li>
                            <li class="nav-item">

                                <button type="button" name="upcomingBtn" id="upcomingBtn" class="border-0 pt-3 pb-2 mr-2 " onclick="this.style.color='#white';this.style.backgroundColor = '#9400D3'">Upcoming</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" name="exclusiveBtn" id="exclusiveBtn" class="border-0 pt-3 pb-2 mr-2" onclick="this.style.color='#000000';this.style.backgroundColor = '#9400D3'">Exclusive</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-start justify-content-between">
                <div class="col-2 pt-4 ">
                    <div mb-2>
                    <!-- Default unchecked -->
                        <div class="form-group">
                            <h5 class="border-dark border-bottom pb-2">Genres : </h5>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="actionCB" name="actionCB" value="Action">
                            <span class="ml-5" style="margin-left: 15px;">Action</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="comedyCB" name="comedyCB" value="Comedy">
                            <span class="ml-5" style="margin-left: 15px;">Comedy</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="horrorCB" name="horrorCB" value="Horror">
                            <span class="ml-5" style="margin-left: 15px;">Horror</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="dramaCB" name="dramaCB" value="Drama">
                            <span class="ml-5" style="margin-left: 15px;">Drama</span>
                        </div>
                    </div>
                    <div class="mt-4 mb-2">
                    <div class="form-group">
                            <h5 class="border-dark border-bottom pb-2">Language : </h5>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="banglaCB" name="banglaCB" value="Bangla">
                            <span class="ml-5" style="margin-left: 15px;">Bangla</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="englishCB" name="englishCB" value="English">
                            <span class="ml-5" style="margin-left: 15px;">English</span>
                        </div>
                    </div>

                    <div class="mt-4 mb-2">
                    <div class="form-group">
                            <h5 class="border-dark border-bottom pb-2">Format : </h5>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="2dCB" name="2dCB" value="2D">
                            <span class="ml-5" style="margin-left: 15px;">2D</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="3dCB" name="3dCB" value="3D">
                            <span class="ml-5" style="margin-left: 15px;">3D</span>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="row justify-content-start d-flex mt-5 mb-2" id="movieSection">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                                        <div class=" . "col-4" . ">
                                        <div class=" . "card movieCard-box" . "style=" . "width: 18rem;" . ">
                                            <a href=" . "#" . "><img class=" . "card-img-top" . " src=" . "..\images/NoTimeToDie.jpg" . " alt=" . "Card image cap" . "></a>
                                            <div class=" . "card-body" . ">
                                                <p class=" . "card-text" . ">
                                                    <span><b>" . $row['name'] . "</b></span><br>
                                                        <span>" . $row['genre'] . "</span><br>
                                                    <button class=" . "movieCard-buttons" . ">Showtime</button>
                                                </p>
                                            </div>
                                            </div>
                                            <br>
                                      </div>
                                        ";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-8">
                    <div class="text-center mt-2 mb-2  ldMoreBtn">
                        <button type="button" id="ldMoreButton" name="ldMoreButton" onclick="hideLoadButton()">Show More</button>
                    </div>
                </div>
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
            <div class="row justify-content-between my-footer-ending" style="border-radius: 0px;">
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