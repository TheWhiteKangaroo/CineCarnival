<?php
session_start();
$userName = "";
if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
} else {
    $userName = "";
}
include "DatabaseConnection.php";
$movieName = $genre = $cast = "";
$perPage = 9;

$sql = "SELECT * FROM movie WHERE status='Now Showing' ORDER BY mv_id DESC LIMIT $perPage";
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
        function showProfileSection() {
            var userName = <?php echo json_encode($userName); ?>;
            if (userName.length >= 2) {
                document.getElementById("ProfileDiv").style.display = "block";
                document.getElementById("SignOutDiv").style.display = "block";
                document.getElementById("SignUpDiv").style.display = "none";
                document.getElementById("SignInDiv").style.display = "none";
            } else {
                document.getElementById("ProfileDiv").style.display = "none";
                document.getElementById("SignOutDiv").style.display = "none";
                document.getElementById("SignUpDiv").style.display = "block";
                document.getElementById("SignInDiv").style.display = "block";
            }

        }

        var status = "Now Showing";

        function changeNowShowingBtnColor() {
            document.getElementById('nowShowingBtn').style.backgroundColor = "#9400D3";
            document.getElementById('upcomingBtn').style.backgroundColor = "BLACK";
            document.getElementById('actionCB').checked = false;
            document.getElementById('comedyCB').checked = false;
            document.getElementById('dramaCB').checked = false;
            document.getElementById('horrorCB').checked = false;
            document.getElementById('banglaCB').checked = false;
            document.getElementById('englishCB').checked = false;
            document.getElementById('2dCB').checked = false;
            document.getElementById('3dCB').checked = false;
            status = "Now Showing";
        }

        function changeUpComingBtnColor() {
            document.getElementById('nowShowingBtn').style.backgroundColor = "BLACK";
            document.getElementById('upcomingBtn').style.backgroundColor = "#9400D3";
            document.getElementById('actionCB').checked = false;
            document.getElementById('comedyCB').checked = false;
            document.getElementById('dramaCB').checked = false;
            document.getElementById('horrorCB').checked = false;
            document.getElementById('banglaCB').checked = false;
            document.getElementById('englishCB').checked = false;
            document.getElementById('2dCB').checked = false;
            document.getElementById('3dCB').checked = false;
            status = "Coming Soon";
        }

        function getStatus() {
            return status;
        }
    </script>

    <script>
        $(document).ready(function() {
            var i = 9;
            var genre = "";
            var language = "";
            var format = "";


            $("#nowShowingBtn").click(function() {
                $("#movieSection").load("NextMovies.php", {
                    NowShowingPage: 9,
                    selectedStatus: getStatus()
                });
            });

            $("#upcomingBtn").click(function() {
                $("#movieSection").load("NextMovies.php", {
                    UpComingPage: 9,
                    selectedStatus: getStatus()
                });
            });

            $("#ldMoreButton").click(function() {
                i = i + 3;
                document.getElementById('searchText').value = "";
                $("#movieSection").load("NextMovies.php", {
                    limitValue: i,
                    selectedStatus: getStatus()
                });
            });

            $('#searchText').on('keyup', function() {
                var stringValue = document.getElementById('searchText').value;
                if (stringValue == "") {
                    var btnVal = document.getElementById('ldMoreButton').style.display = "block";
                } else {
                    var btnVal = document.getElementById('ldMoreButton').style.display = "none";
                }
                $('#movieSection').load('NextMovies.php', {
                    searchedKeyWord: document.getElementById('searchText').value,
                    selectedStatus: getStatus()
                });
            });

            $(document).on('change', '#actionCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });
            $(document).on('change', '#comedyCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });
            $(document).on('change', '#horrorCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });
            $(document).on('change', '#dramaCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });
            $(document).on('change', '#banglaCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });
            $(document).on('change', '#englishCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });
            $(document).on('change', '#2dCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });
            $(document).on('change', '#3dCB', function() {
                if (this.checked) {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                }
            });


            function filterMovies() {
                var action = 'fetch_data';
                genre = get_filter('genre');
                language = get_filter('language');
                format = get_filter('format');
            }

            function get_filter(className) {
                var filterData = [];
                $('.' + className + ':checked').each(function() {
                    filterData.push($(this).val());
                });
                return filterData;
            }

        });
    </script>
</head>

<body onload="showProfileSection();">
    <div class="container-fluid">
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
            <div class="row mt-4 mb-2">
                <div class="col pb-2">
                    <form action="MoviesPage.php" method="GET">
                        <ul class="nav nav-tabs   movies-nav">
                            <li class="nav-item"><span>Movies</span></li>
                            <li class="nav-item">
                                <button type="button" name="nowShowingBtn" id="nowShowingBtn" class="border-0 pt-3 pb-2 mr-2" onclick="changeNowShowingBtnColor()">Now Showing</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" name="upcomingBtn" id="upcomingBtn" class="border-0 pt-3 pb-2 mr-2 " onclick="changeUpComingBtnColor()">Coming Soon</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row align-items-start justify-content-center" id="moviePageSection">
                <div class="col-2 pt-4 ">
                    <div class="inputWithIcon mb-4 mt-4">
                        <input class="resetPass-inputs" id="searchText" type="text" placeholder="Search for movies..." maxlength="30" minlength="2" style="color: black; width:100%;">
                        <i class="fas fa-search"></i>
                    </div>

                    <div mb-2>
                        <!-- Default unchecked -->
                        <div class="form-group">
                            <h5 class="border-dark border-bottom pb-2">Genres : </h5>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" class="genre" id="actionCB" name="actionCB" value="Action">
                            <span class="ml-5" style="margin-left: 15px;">Action</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="comedyCB" class="genre" name="comedyCB" value="Comedy">
                            <span class="ml-5" style="margin-left: 15px;">Comedy</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="horrorCB" class="genre" name="horrorCB" value="Horror">
                            <span class="ml-5" style="margin-left: 15px;">Horror</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="dramaCB" class="genre" name="dramaCB" value="Drama">
                            <span class="ml-5" style="margin-left: 15px;">Drama</span>
                        </div>
                    </div>
                    <div class="mt-4 mb-2">
                        <div class="form-group">
                            <h5 class="border-dark border-bottom pb-2">Language : </h5>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="banglaCB" class="language" name="banglaCB" value="Bangla">
                            <span class="ml-5" style="margin-left: 15px;">Bangla</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="englishCB" class="language" name="englishCB" value="English">
                            <span class="ml-5" style="margin-left: 15px;">English</span>
                        </div>
                    </div>

                    <div class="mt-4 mb-2">
                        <div class="form-group">
                            <h5 class="border-dark border-bottom pb-2">Format : </h5>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="2dCB" class="format" name="2DCB" value="2D">
                            <span class="ml-5" style="margin-left: 15px;">2D</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="3dCB" class="format" name="3DCB" value="3D">
                            <span class="ml-5" style="margin-left: 15px;">3D</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row justify-content-start d-flex mt-5 mb-2" id="movieSection">

                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row == null || !isset($row)) {
                                echo "Oops, no movies currently to show!";
                            }
                            echo "
                                        <div class=" . "col-4" . ">
                                        <div class=" . "card movieCard-box" . "style=" . "width: 18rem;" . ">
                                        <form action=" . "Movies.php" . " method=" . "GET" . ">
                                            <img class=" . "card-img-top" . " src=" . "..\images/NoTimeToDie.jpg" . " alt=" . "Card image cap" . ">
                                            <div class=" . "card-body" . ">
                                                <p class=" . "card-text" . ">
                                                    <span><b>" . $row['name'] . "</b></span><br>
                                                    <span>" . $row['genre'] . "</span><br>
                                                    <button type=" . "submit" . " name=" . "movieNumber" . " value=" . $row['mv_id'] . " id = " . $row['mv_id'] . " class=" . "movieCard-buttons" . ">Details</button>
                                                </p>
                                            </div>
                                            </form>
                                            </div>
                                            <br>
                                      </div>
                                        ";
                        }
                        ?>

                    </div>
                    <div class=" text-center mt-2 mb-2  ldMoreBtn" id="btnLoadDiv">
                        <button type="button" id="ldMoreButton" name="ldMoreButton">Show More</button>
                    </div>

                </div>
                <div class="col-8">
                    
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