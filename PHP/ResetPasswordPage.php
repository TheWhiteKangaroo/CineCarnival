<?php
session_start();
if(!isset($_SESSION['verification']) ){
    session_destroy();
    header("Location: ForgotPasswordPage.php");
}
include "DatabaseConnection.php";
$msg="";
$currentDateTime = date("Y/m/d");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changePasswordBtn'])) {
    $newPassword = $newPasswordToDB = $confirmPassword = "";
    if (isset($_SESSION['verificationCode'])) {
        if (isset($_SESSION['verification']) && $_SESSION['verification'] == "verified") {
            if (!empty($_POST['password'])) {
                $newPassword = mysqli_real_escape_string($conn, $_POST['password']);
                $newPasswordToDB = password_hash($newPassword, PASSWORD_DEFAULT);
            } else {
                $msg="Please enter new password!";
            }
            if (!empty($_POST['confirmPassword'])) {
                $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
            } else {
                $msg="Please re-enter new password!";
            }
            if (!isset($newPassword) && !isset($confirmPassword) && !isset($verificationCode) && !isset($email)) {
                $msg="Please fillup all criteria!";
            } else if ($newPassword == $confirmPassword) {
                $user = $_SESSION['mail'];
                $query = "SELECT * FROM login WHERE user_name='$user';";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $user = $row['mail'];
                }
                $query = "UPDATE `login` SET `password`='$newPasswordToDB',`last_changed_date`='$currentDateTime' WHERE mail='$user';";
                $result = mysqli_query($conn, $query);
                if ($result == TRUE) {
                    $msg= "Password reset successful!";
                } else {
                    $msg="Failed to reset password!";
                }

                $query = "UPDATE customer SET password='$newPasswordToDB' WHERE mail='$user';";
                $result = mysqli_query($conn, $query);
                
                if ($result == TRUE) {
                    $msg="Password reset successful!";
                    echo "<script>showMessage();</script>";
                    $_SESSION['msg']="Password Reset Successful!";
                    header("Location: SignInPage.php");
                } else {
                    $msg="Failed to reset password!";
                }
            } else {
                $msg="Passwords did not match!";
            }
        } else {
            $msg="Please verify code first!";
        }
    } else {
        header("Location: ForgotPasswordPage.php");
    }
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        function showMessage(){
            Swal.fire({
            title: 'Password Reset Successful!',
            showClass: {
                popup: 'animated fadeInDown faster'
            },
            hideClass: {
                popup: 'animated fadeOutUp faster'
            }
            })
        }
    </script>
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
                    <a href="SignInPage.php" style="text-decoration: none;"><i class="fas fa-user-alt"></i> Sign In</a>
                </div>
                <div class="p-2 align-self-center">
                    <a href="RegistrationPage.php" style="text-decoration: none;"><i class="fas fa-user-plus"></i> Sign Up</a>
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
                        <a href="Movies" class="nav-link"><i class="fas fa-tape"></i> Movies</a>
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
            <div class="row mt-3">
                <div class="col border-bottom border-primary pb-2">
                    <span class="h4"><i class="fas fa-lock"></i> Reset Password</span>
                </div>
            </div>

            <form action="ResetPasswordPage.php" method="POST">
                <table>
                    <tr>
                        <td>
                        <div class="text-left mt-3">
                                <span class="font-weight-normal text-left">Enter new password.</span>
                                <span style="color: red; font-size: 16px; font-weight: bolder;">*<?php echo "$msg";?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                <input class="resetPass-inputs" type="password" name="password" value="" placeholder="Password*" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-left">
                                <span class="font-weight-normal text-left">Re-enter new password.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                <input class="resetPass-inputs" type="password" name="confirmPassword" value="" placeholder="Confirm Password*" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                <input class="font-weight-bold text-light resetPass-buttons" style="width: 150px" type="submit" name="changePasswordBtn" value="Reset Password">
                            </div>
                        </td>
                    </tr>

                </table>
            </form>
        </div>



        <!--Footer Section-->

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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>
</body>

</html>