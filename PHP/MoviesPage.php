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
$perPage = 6;

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
            changeNowShowingBtnColor();
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

        function clearFilters() {
            document.getElementById('actionCB').checked = false;
            document.getElementById('comedyCB').checked = false;
            document.getElementById('dramaCB').checked = false;
            document.getElementById('horrorCB').checked = false;
            document.getElementById('banglaCB').checked = false;
            document.getElementById('englishCB').checked = false;
            document.getElementById('2dCB').checked = false;
            document.getElementById('3dCB').checked = false;
        }

        function changeNowShowingBtnColor() {
            document.getElementById('nowShowingBtn').style.backgroundColor = "#9400D3";
            document.getElementById('upcomingBtn').style.backgroundColor = "BLACK";
            clearFilters();
            status = "Now Showing";
        }

        function changeUpComingBtnColor() {
            document.getElementById('nowShowingBtn').style.backgroundColor = "BLACK";
            document.getElementById('upcomingBtn').style.backgroundColor = "#9400D3";
            clearFilters();
            status = "Coming Soon";
        }

        function getStatus() {
            return status;
        }
    </script>

    <script>
        $(document).ready(function() {
            var i = 6;
            var genre = "";
            var language = "";
            var format = "";


            $("#nowShowingBtn").click(function() {
                $("#movieSection").load("NextMovies.php", {
                    NowShowingPage: 6,
                    selectedStatus: getStatus()
                });
            });

            $("#upcomingBtn").click(function() {
                $("#movieSection").load("NextMovies.php", {
                    UpComingPage: 6,
                    selectedStatus: getStatus()
                });
            });

            $("#ldMoreButton").click(function() {
                i = i + 3;
                clearFilters();
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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
                    document.getElementById('ldMoreButton').style.display = "none";
                    filterMovies();
                    $('#movieSection').load('NextMovies.php', {
                        genre: genre,
                        language: language,
                        format: format,
                        selectedStatus: getStatus()
                    });
                } else {
                    document.getElementById('ldMoreButton').style.display = "block";
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

    <style>
        .card-img-top {
            width: 100%;
            height: 18vw;
            object-fit: cover;
        }


        .moviesBtn{
            background-color: black;
            color: white;
            outline: none;
            height: auto;
            margin: 0;
            border-radius: 2px;
            padding-bottom: 50px;
            padding-top: 50px;
        }

        .moviesBtn :hover, .moviesBtn:active, .moviesBtn:focus{
            background-color: darkviolet;
            color: white;
            outline: none;
            transition: 0.4s;
            transform-style: preserve-3d;
        }
    </style>

    <script>
        function showFiltersDiv(){
            document.getElementById('filtersDiv').style.display="block";
            document.getElementById('showFilterBtn').style.display="none";
            document.getElementById('hideFilterBtn').style.display="block";
        }

        function hideFiltersDiv(){
            document.getElementById('filtersDiv').style.display="none";
            document.getElementById('showFilterBtn').style.display="block";
            document.getElementById('hideFilterBtn').style.display="none";
        }
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
            <div class="row mt-3 ml-1 movies-nav" style="height: auto;">
                <div class="col-12 col-md-2">
                    <span>Movies</span>
                </div>
                <div class="col-12 col-md-7">
                    <form action="MoviesPage.php" method="GET">
                        <button type="button" name="nowShowingBtn" id="nowShowingBtn" class="border-0 pt-3 pb-2 mr-2 text-light moviesBtn" onclick="changeNowShowingBtnColor()">Now Showing</button>
                        <button type="button" name="upcomingBtn" id="upcomingBtn" class="border-0 pt-3 pb-2 mr-2 text-light moviesBtn" onclick="changeUpComingBtnColor()">Coming Soon</button>
                    </form>
                </div>
                <div class="col-12 mt-2 d-block d-md-none" >
                        <button type="button" class="text-light h6 resetPass-buttons" id="showFilterBtn"  onclick="showFiltersDiv();" style="display: none;"><i class="fas fa-plus-circle"></i> Filters</button>
                        <button type="button" class="text-light h6 resetPass-buttons" id="hideFilterBtn"  onclick="hideFiltersDiv();" style="display: block;"><i class="fas fa-minus-circle"></i> Filters</button>
                </div>
            </div>
        </div>

        

        <div class="container-fluid">
            <div class="row align-items-start justify-content-around ml-4" id="moviePageSection">
                <div class="col-11 col-lg-3 col-xl-2 col-md-4 col-sm-6 pt-4 pr-4 m-0 p-0 d-md-block" id="filtersDiv">
                    <div class="inputWithIcon mb-4 mt-1">
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
                            <input type="checkbox" id="horrorCB" class="genre" name="horrorCB" value="Sci-Fi">
                            <span class="ml-5" style="margin-left: 15px;">Sci-Fi</span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="dramaCB" class="genre" name="dramaCB" value="Thriller">
                            <span class="ml-5" style="margin-left: 15px;">Thriller</span>
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
                <div class="col-12 col-lg-9 col-xl-8 col-md-8 col-sm-12">
                    <div class="row  justify-content-start d-flex mt-4 mb-2 pr-5" id="movieSection">

                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <div class="col-12 col-sm-5 col-md-5 col-xl-3 col-lg-3 mt-1">
                                <div class="movieReelPanel" style="margin-top: 2px;">
                                    <form action="Movies.php" method="GET">
                                        <img src="<?php echo $row['cover_pic'] ?>" alt="No Cover" style="width:100%; height:250px; margin:0; padding:0;"><br>
                                        <button type="submit" name="movieNumber" value="<?php echo $row['mv_id']; ?>" id="<?php echo $row['mv_id']; ?>" class="movieCard-buttons" style="margin:0; padding:0; border-top-left-radius:0;  border-top-right-radius:0;height:auto ;min-height:35px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;"><?php echo $row['name']; ?></button>
                                    </form>
                                </div>

                            </div>
                        <?php
                        }
                        ?>

                    </div>

                    <div class="row justify-content-center text-center">
                        <div class="col-12 text-center pr-5  ldMoreBtn" id="btnLoadDiv">
                            <button type="button" id="ldMoreButton" name="ldMoreButton">Show More</button>
                        </div>
                    </div>
                </div>


            </div>

            
        </div>



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

    </div>
    </div>
    </div>

    <!--Footer Section-->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>

</body>

</html>