<?php
    include "DatabaseConnection.php";
    $query = "SELECT DISTINCT title, message, links, pic, date_posted FROM notice WHERE date_posted= (SELECT MAX(date_posted) FROM notice)";
    $result = mysqli_query($conn,$query);
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foods | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <!--Header Section-->
        <header>
           <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-auto">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>
               
                <div class="p-2 align-self-center header-anchor">
                    <a href="SignInPage.php" style="text-decoration: none;"><i class="fas fa-user-alt"></i>  Sign In</a>
                </div>
                <div class="p-2 align-self-center">
                    <a href="RegistrationPage.php" style="text-decoration: none;"><i class="fas fa-user-plus"></i>  Sign Up</a>
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
       

        <div class="container">
            <div class="row mt-4 text-left">
                <div class="col-8 mb-4">
                    <div class="foodsHeaderBox">
                        <h1 style="border-bottom: 3px black dotted; margin-bottom:30px; margin-top:50px;">Welcome to <span>CineCarnival<span> foods corner.</h1><br>
                        <span class="text-muted mb-5">The online ordering system is currently unavailable but you can check our food items with prices to shop at the cinema.</span>
                    </div>

                    <div class="card mb-3 mt-5" style="max-width: 800px; padding-right: 60px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="..\images/foods/Coke.jpg" class="card-img" alt="No Image...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body mt-4 ml-5 myFoodsBox">
                                <h4 class="card-title">Pop Corn Combo</h4>
                                <p class="card-text" style="font-size: 18px;">Buy 1 large pop corn with 500 ml fountain coke.</p>
                                <span class="badge badge-pill badge-primary" style="width: 100px; height:25px; font-size: 18px;">150 BDT</span>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3" style="max-width: 800px; padding-right: 60px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="..\images/foods/BurgerCombo1.jpg" class="card-img" alt="No Image...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body mt-4 ml-5 myFoodsBox">
                                <h4 class="card-title">Burger Combo</h4>
                                <p class="card-text" style="font-size: 18px;">Buy 1 regular size burger with 500ml fountain coke.</p>
                                <span class="badge badge-pill badge-primary" style="width: 100px; height:25px; font-size: 18px;">250 BDT</span>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3" style="max-width: 800px; padding-right: 60px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="..\images/foods/sandwich3.jpg" class="card-img" alt="No Image...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body mt-4 ml-5 myFoodsBox">
                                <h4 class="card-title">Sandwich</h4>
                                <p class="card-text" style="font-size: 18px;">Buy combo of 2 sandwiches.</p>
                                <span class="badge badge-pill badge-primary" style="width: 100px; height:25px; font-size: 18px;">180 BDT</span>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3" style="max-width: 800px; padding-right: 60px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="..\images/foods/PotetoSticks.jpg" class="card-img" alt="No Image...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body mt-4 ml-5 myFoodsBox">
                                <h4 class="card-title">French Fries</h4>
                                <p class="card-text" style="font-size: 18px;">Buy french fries.</p>
                                <span class="badge badge-pill badge-primary" style="width: 100px; height:25px; font-size: 18px;">120 BDT</span>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3" style="max-width: 800px; padding-right: 60px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="..\images/foods/Chocolate1.jpg" class="card-img" alt="No Image...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body mt-4 ml-5 myFoodsBox">
                                <h4 class="card-title">Candy</h4>
                                <p class="card-text" style="font-size: 18px;">Buy  chocolates from large collections.</p>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0">
                    <div class="mt-5 text-justify">
                        <?php 
                            while($row=mysqli_fetch_assoc($result)){
                                echo "
                                    <div class="."card text-justify".">
                                        <div class="."card-header text-center".">
                                            Notice
                                            </div>
                                                <div class="."card-body text-justify text-left".">
                                                    <h5 class="."card-title".">".$row['title']."</h5>";
                                                    if($row['pic']!=null || isset($row['pic']) || !empty($row['pic'])){
                                                        echo "
                                                            <img class="."card-img-top"." src="."..\images/NoTimeToDie.jpg"." alt="."No Image..."." style="."margin-bottom:10px; width:200px; height: 100px;".">
                                                        ";
                                                    }
                                                    echo "
                                                    <p class="."card-text text-justify".">".$row['message']."</p>";
                                                    if($row['links']!=null || isset($row['links']) || !empty($row['links'])){
                                                        echo "
                                                            <a href=".$row['links'] ." class="."badge badge-secondary".">Click here</a>
                                                        ";
                                                    }
                                                    echo "
                                                        
                                                </div>
                                            <div class="."card-footer text-muted".">
                                            <span>Posted on : ".$row['date_posted']."</span>
                                        </div>
                                     </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
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

    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>
</body>

</html>