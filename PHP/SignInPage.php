<?php
    include "DatabaseConnection.php";
    $msg="";
    session_start();
    if(isset($_SESSION['msg'])){
        $msg = $_SESSION['msg'];
    }
    session_destroy();
    session_start();
    $userName = $mail=$password=$passwordInDB=$userType="";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!empty($_POST['userName']) ){
            $userName=mysqli_real_escape_string($conn,$_POST['userName']);
        }
        else{
            $msg="Invalid User Name or Mail!";
        }
        if(!empty($_POST['userPassword'])){
            $password=mysqli_real_escape_string($conn,$_POST['userPassword']);
        }
        else{
            $msg="Invalid Password!";
        }
        if(!empty($_POST['userName']) && !empty($_POST['userPassword'])){
            $query="SELECT `user_name`, `mail`, `password`, `user_type` FROM `login` WHERE user_name='$userName' OR mail='$userName' ";
            $result=mysqli_query($conn,$query);
            $rowCount=mysqli_num_rows($result);
            if($rowCount < 1){
                $msg="User doesn't exist!";
            }
            else{
                while($row=mysqli_fetch_assoc($result)){
                    $passwordInDB = $row['password'];
                    $userType=$row['user_type'];
                    $userNameInDB=$row['user_name'];
                    $userMailInDB=$row['mail'];
                    if($userMailInDB==$userName){
                        $userName=$userName;   
                    }else if($userName==$userNameInDB){
                        $userName=$userNameInDB;
                    }
                    if(password_verify($password,$passwordInDB)){
                        if($userType==3){
                            $_SESSION['user_name']=$row['user_name'];
                            $_SESSION['user_type']=$row['user_type'];
                            header("Location: ProfilePage.php");
                        }
                    }
                    else{
                        $msg="Invalid Password!";
                    }
                }
            }

        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In | CineCarnival   </title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
</head>

<body>
    <!--Header Section-->
    <div class="container">
        <header>
           <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-auto">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
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
            <div class="row justify-content-center" style="height: 350px; margin-top:70px;">
                <div class="col=6 text-center text-decoration-none">
                    <form action="SignInPage.php" method="POST">
                            <table style="width:100%;">
                                <tr>
                                    <th colspan="2" class="sign-in-title">
                                        <div class="form-group text-center mb-0 mt-3">
                                            <span class="font-weight-bold text-center font-weight-bold h1">Welcome</span>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mt-5 mb-1 inputWithIcon">
                                            <input class="resetPass-inputs" style="width:250px; height:35px;" type="text" name="userName" value="<?php echo "$userName"; ?>" placeholder="User Name/Mail" maxlength="30" minlength="3" required>
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mt-5 mb-1 inputWithIcon">
                                            <input class="resetPass-inputs" style="width:250px; height:35px;"  type="password" name="userPassword" value="" placeholder="Password"  maxlength="20" required>
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="input-group">
                                            <input class="mb-1 font-weight-bold resetPass-buttons" style="color: white; width:500px; height:35px" type="submit" name="signInBtn" value="Sign In">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="mb-1">
                                            <a class="text-decoration-none" href="RegistrationPage.php">Don't have an account? Sign Up.</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="mb-1">
                                            <a class="text-decoration-none" href="ForgotPasswordPage.php">Forgot Password?</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            <span style="color: #d9534f; font-size: 16px; font-weight: bolder;">*<?php echo "$msg";?></span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer Section-->

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
                   <div class="col-12 col-md-4">
                       <ul>
                           <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                           <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                       </ul>
                   </div>
                   <div class="col-12 col-md-3 developers-tag">
                    <span>Developed by : Group-5</span>
                   </div>
                   <div class="col-12 col-md-3 stores">
                        <ul>    
                            <li><a href="#"><button type="button" class="btn btn-outline-primary" value="Play Store"><i class="fab fa-google-play"></i>Play Store</button></a></li>
                           <li><a href="#"><button type="button" class="btn btn-outline-primary" value="App Store"><i class="fab fa-app-store"></i>App Store</button></a></li>
                        </ul>
                   </div>
               </div>
            </footer>
        </div>
    </div>

    
    <!--JS Scripts-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>

</html>
