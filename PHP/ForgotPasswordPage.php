<?php
session_start();
include "DatabaseConnection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email = $emailInDB = $mail = $password = $verificationCode = $currentDateTime =$msg= "";
$currentDateTime = date("Y/m/d");
$fName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchAccountBtn'])) {
    if (isset($_POST['mail']) && !empty($_POST['mail'])) {
        $email = mysqli_real_escape_string($conn, $_POST['mail']);
        $query = "SELECT * FROM login WHERE mail='$email';";
        $result = mysqli_query($conn, $query);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount <= 0) {
            $msg="Sorry could not find your acccount!";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $emailInDB = $row['mail'];
                $password = $row['password'];
                $fName = $row['user_name'];
            }


            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'shohag.cse45@gmail.com';
                $mail->Password   = 'cinecarnival';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('shohag.cse45@gmail.com', 'Cine Carnival');
                $mail->addAddress($emailInDB);

                $currentDateTime = date("Y/m/d");
                $verificationCode = rand(1000, 9999);
                $_SESSION['verificationCode'] = $verificationCode;
                $mail->isHTML(true);
                $mail->Subject = 'Verify Password!';
                $mail->Body    = 'Verificaton Code : <b>' . $verificationCode . '</b>';
                $mail->AltBody = 'Verificaton Code : <b>' . $verificationCode . '</b>';

                $mail->send();
                echo 'Mail has been sent!';
                $_SESSION['mail']=$email;
                $_SESSION['verificationCode']=$verificationCode;
                $_SESSION['firstName']=$fName;
                header("Location: VerifyPasswordPage.php");
            } catch (Exception $e) {
                $msg="Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    } else {
        $msg="Please enter the mail!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Find Account | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <div class="p-2 mr-2">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>
                <div class="p-2 align-self-center d-sm-none d-md-block d-none d-sm-block mr-0 pr-0">
                    <input class="search-box border-primary pt-1 pb-1 pr-5 pl-4 ml-3 mr-0 text-capitalize" style="border-radius: 25px;  background:transparent; color: white;" type="text" placeholder="Search for movies...">
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
                        <a href="#" class="nav-link"><i class="fas fa-tape"></i> Movies</a>
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

        <div class="container">
            <div class="row mt-3">
                <div class="col border-bottom border-primary pb-2">
                    <span class="h4"><i class="fas fa-search"></i> Search Account</span>
                </div>
            </div>
            <div class="row">
                <div class="col=6">
                        <form action="ForgotPasswordPage.php" method="POST" class="forgot-password-form">
                                <table>
                               
                                    <tr>
                                        <th colspan="2" class="forgot-password-title">
                                            <div class="text-left mt-3">
                                                <span class="font-weight-bold  text-left">Find your Cine Carnival account.</span>
                                                <span style="color: red; font-size: 16px; font-weight: bolder;">*<?php echo "$msg";?></span>
                                            </div>
                                        </th>
                                    </tr>
                                    
                                    <tr>
                                        <th colspan="2">
                                            <div class="text-left mb-3">
                                                <span class="font-weight-normal text-left">Enter your mail address.</span>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group ">
                                                <input class="resetPass-inputs"  type="email" name="mail" value="" placeholder="mail@gmail.com" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group ">
                                                <input class="font-weight-bold text-light resetPass-buttons" type="submit" name="searchAccountBtn" value="Search">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </form>
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



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="..\css/bootstrap.min.js"></script>
</body>

</html>