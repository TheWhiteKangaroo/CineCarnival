<?php
session_start();
include "DatabaseConnection.php";
$userName = $userType = "";
date_default_timezone_set('Asia/Dhaka');

if (!isset($_SESSION['user_name'])) {
    header("Locations: SignInPage.php");
} else {
    $userName = $_SESSION['user_name'];
    $userType = $_SESSION['user_type'];
}
$userID = "";
$query  = "SELECT c_id FROM customer WHERE user_name='$userName' OR mail='$userName';";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $userID = $row['c_id'];
}

$gender = $firstName = $lastName = $mail = $phone = $address = $password = $newPassword = $newPasswordToDB = $confirmPassword = $status = $points = $joiningDate = $msg = $joiningPeriod="";
$currentDateTime = date("Y/m/d");
$alphabetCheck = "/^[A-Za-z]+$/";
$alphanumericCheck = "/^[a-zA-Z0-9]*$/";
$numericCheck = "/^[0-9]*$/";
$userNameCheck = "/@(a+b)*/";

$query = "SELECT * FROM customer WHERE user_name='$userName' OR mail='$userName';";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $gender = $row['gender'];
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $userName = $row['user_name'];
    $mail = $row['mail'];
    $phone = $row['phone'];
    $address = $row['address'];
    $password = $row['password'];
    $status = $row['status'];
    $points = $row['points'];
    $joiningDate = $row['joining_date'];
}
$phone = "0" . (string) $phone;

$date1 = new DateTime($currentDateTime);
$date2 = new DateTime($joiningDate);
$joiningPeriod = $date1->diff($date2);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateInfoBtn'])) {
    if (isset($_POST['gender'])) {
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    } else {
        $msg = "Select Gender!";
    }
    if (!empty($_POST['firstName'])) {
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    } else {
        $msg = "First Name cannot be empty!";
    }
    if (!empty($_POST['lastName'])) {
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    } else {
        $msg = "Last Name cannot be empty!";
    }

    if (!empty($_POST['address'])) {
        $address = mysqli_real_escape_string($conn, $_POST['address']);
    }
    if (!empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    } else {
        $msg = "Phone Number cannot be empty!";
    }


    if (preg_match($numericCheck, $address)) {
        $msg = "Invalid Address!";
        echo "<script>alert('Invalid Address!');</script>";
    } else if ((strlen((string) $phone)) <= 10 || (strlen((string) $phone)) >= 13 || $phone <= 0) {
        $msg = "Invalid digits for phone number!";
        echo "<script>alert('Invalid digits for phone number!');</script>";
    } else if (isset($gender) && isset($firstName) && isset($lastName) && isset($phone)) {
        if (!isset($address)) {
            $address = " ";
        }
        $query = "UPDATE customer SET gender='$gender', first_name='$firstName', last_name='$lastName', phone='$phone', address='$address' WHERE user_name='$userName' OR mail='$userName';";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $msg = "Info Updated!";
            echo "<script>alert('Info Updated!');</script>";
        } else {
            $msg = "Failed to update mail!";
            echo "<script>alert('Failed to update mail!');</script>";
        }
    } else {
        $msg = "Please Fillup All Required Fields!";
        echo "<script>alert('Please Fillup All Required Fields!');</script>";
    }
}

if (isset($_POST['updateMailBtn'])) {
    $userName = $_SESSION['user_name'];
    $mailInDB = "";
    if (!empty($_POST['mail'])) {
        $mail = mysqli_real_escape_string($conn, $_POST['mail']);
        $gmailPattern = "/^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/";
        if (!preg_match($gmailPattern, $mail)) {
            $msg = "Nota Gmail email format!"."<br>"."Use only Gmail acccount for registration.";
        } else {
            $query = "SELECT mail from customer WHERE mail='$userName' OR user_name='$userName';";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $mailInDB =  $row['mail'];
            }
            if ($mail == $mailInDB) {
                $msg = "Mail already exitst!";
                echo "<script>alert('Mail already exitst!');</script>";
            } else {
                $query = "UPDATE customer SET mail='$mail' WHERE user_name='$userName' OR mail='$userName';";
                $result = mysqli_query($conn, $query);
                $query = "UPDATE login SET mail='$mail' WHERE user_name='$userName' OR mail='$userName';";
                $result1 = mysqli_query($conn, $query);
                if ($result && $result1) {
                    $msg = "Updated Mail!";
                    echo "<script>alert('Updated Mail!');</script>";
                } else {
                    $msg = "Failed to update mail!";
                    echo "<script>alert('Failed to update mail!');</script>";
                }
            }
        }
    } else {
        $msg = "Mail cannot be empty!";
        echo "<script>alert('Mail cannot be empty!');</script>";
    }
}

if (isset($_POST['updatePassBtn'])) {
    if (!empty($_POST['newPassword'])) {
        $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    } else {
        $msg = "Enter new password!";
    }
    if (!empty($_POST['confirmPassword'])) {
        $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    } else {
        $msg = "Re-enter new password!";
    }
    if (isset($newPassword) && isset($confirmPassword)) {
        if ($newPassword == $confirmPassword) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE customer set password='$newPassword' WHERE user_name='$userName' OR mail='$userName';";
            $result = mysqli_query($conn, $query);
            $query = "UPDATE login set password='$newPassword', last_changed_date='$currentDateTime' WHERE user_name='$userName' OR mail='$userName';";
            $result1 = mysqli_query($conn, $query);
            if ($result && $result1) {
                $msg = "Updated password!";
                echo "<script>alert('Updated password!');</script>";
            } else {
                $msg = "Failed to update password!";
            }
        } else {
            $msg = "Passwords did not match!";
            echo "<script>alert('Passwords did not match!');</script>";
        }
    } else {
        $msg = "Please enter passwords!";
    }
}


?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">

    <script>
        function showProfileSection() {
            document.getElementById('profileFormSection').style.display = "block";
            document.getElementById('welcomeSection').style.display="none";
            hideMailDiv();
            hidePassDivs();
            showInfoDiv();
            document.getElementById('updatePassBtn').style.display = "none";
            document.getElementById('updateMailBtn').style.display = "none";
            document.getElementById('updateInfoBtn').style.display = "block";
            document.getElementById('changePassBtn').style.display = "block";
            document.getElementById('changeMailBtn').style.display = "block";
        }

        function hideProfileSection() {
            document.getElementById('profileFormSection').style.display = "none";
        }

        function showPurchaseSection() {
            document.getElementById('purchaseHistorySection').style.display = "block";
            document.getElementById('welcomeSection').style.display="none";
        }

        function hidePurchaseSection() {
            document.getElementById('purchaseHistorySection').style.display = "none";
        }

        function showPassDivs() {
            document.getElementById('conPassDiv').style.display = "block";
            document.getElementById('newPassDiv').style.display = "block";
            document.getElementById('updateInfoBtn').style.display = "none";
            document.getElementById('updateMailBtn').style.display = "none";
            document.getElementById('updatePassBtn').style.display = "block";
        }

        function hidePassDivs() {
            document.getElementById('conPassDiv').style.display = "none";
            document.getElementById('newPassDiv').style.display = "none";
        }

        function showMailDiv() {
            document.getElementById('mailProfile').style.display = "block";
            document.getElementById('updatePassBtn').style.display = "none";
            document.getElementById('updateInfoBtn').style.display = "none";
            document.getElementById('updateMailBtn').style.display = "block";
        }

        function hideMailDiv() {
            document.getElementById('mailProfile').style.display = "none";
        }

        function hideInfoDiv() {
            document.getElementById('genderDiv1').style.display = "none";
            document.getElementById('genderDiv2').style.display = "none";
            document.getElementById('lNameDiv').style.display = "none";
            document.getElementById('fNameDiv').style.display = "none";
            document.getElementById('phoneDiv').style.display = "none";
            document.getElementById('addressDiv').style.display = "none";
        }

        function showInfoDiv() {
            document.getElementById('genderDiv1').style.display = "block";
            document.getElementById('genderDiv2').style.display = "block";
            document.getElementById('lNameDiv').style.display = "block";
            document.getElementById('fNameDiv').style.display = "block";
            document.getElementById('phoneDiv').style.display = "block";
            document.getElementById('addressDiv').style.display = "block";
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <!--Header Section-->
        <header>
            <div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section ">
                <div class="p-2 mr-auto">
                    <a href="index.php"><img src="..\Images/CineCarnival.png" alt="No Image..."></a>
                </div>

                <div class="p-2 align-self-center">
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

        <div class="container-fluid">
            <div class="row mt-4  text-light welcome-box" id="welcomeSection">
                <div class="col-12  text-right">
                    <div class="label h5">
                    <span style="color: #feda6a;"><i class="fas fa-gift"></i></span> <?php if(isset($points)) echo $points." Points";?>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <div class="welcome-to-profile">
                        <label class="text-capitalize" for="" style="font-family:Arial, Helvetica, sans-serif">
                            <h2>Welcome, <?php echo  $lastName; ?>!</h2>
                        </label>
                    </div>
                </div>

                <div class="col-12 text-center ">
                        <label class="h4 font-weight-normal" style="color:lightgray;font-family:Arial, Helvetica, sans-serif;">Celebrating <?php echo $joiningPeriod->d." Days of your subscription!"; ?> <span class="text-success"><i class="fas fa-glass-cheers"></i></span></label>
                </div>
            </div>
            <div class="row justify-content-center mt-1">
                <div class="col-12 col-sm-6 col-lg-4 mt-3">
                    <button class="profileBtn" style="border-top-right-radius: 20px; border-bottom-left-radius: 20px;" onclick="showProfileSection();hidePurchaseSection();"><i class="fas fa-edit"></i> Edit Profile</button>

                </div>
                <div class="col-12 col-sm-6 col-lg-4 mt-3">
                    <button class="profileBtn" style="background-color:#feda6a;color:black;border-bottom-left-radius: 20px; border-top-right-radius: 20px;" onclick="showPurchaseSection();hideProfileSection();"><i class="fas fa-history"></i> Purchase History</button>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                            <div id="profileFormSection" style="display: block;">
                                <form action="ProfilePage.php" method="POST">
                                    <table style="width:100%;">
                                        <tr>
                                            <th colspan="2">
                                                <div class="form-group text-center mt-5 mb-0">
                                                    <span class="font-weight-bold text-center h4"><i class="fas fa-user-alt"></i> Profile</span>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="row text-left">
                                                    <div class="col">
                                                        <span style="color: red; font-size: 16px; font-weight: bolder;">*<?php echo "$msg"; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="custom-control custom-radio custom-control-inline mt-3" id="genderDiv1">
                                                    <input type="radio" class="custom-control-input" id="customRadio" name="gender" value="male" required <?php if (isset($gender) && $gender == "male") echo "checked"; ?>>
                                                    <label class="custom-control-label" for="customRadio">Mr.</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" id="genderDiv2">
                                                    <input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>>
                                                    <label class="custom-control-label" for="customRadio2">Ms./Mrs.</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group inputWithIcon" id="fNameDiv">
                                                    <input class="form-control border text-capitalize border-primary" type="text" name="firstName" maxlength="30" minlength="3" value="<?php echo "$firstName"; ?>" placeholder="First Name" required>
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group inputWithIcon" id="lNameDiv">
                                                    <input class="form-control border text-capitalize border-primary" type="text" name="lastName" maxlength="30" minlength="3" value="<?php echo "$lastName"; ?>" placeholder="Last Name" required>
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group inputWithIcon" id="mailProfile" style="display: none;">
                                                    <input class="form-control border border-primary" type="email" name="mail" minlength="13" maxlength="50" value="<?php echo "$mail"; ?> " placeholder="Mail" required>
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group inputWithIcon" id="phoneDiv">
                                                    <input class="form-control border border-primary" type="number" name="phone" value="<?php echo "$phone"; ?>" placeholder="Phone" maxlength="11" required>
                                                    <i class="fas fa-mobile"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group inputWithIcon" id="addressDiv">
                                                    <textarea name="address" class="form-control text-capitalize border border-primary" maxlength="100" cols="30" rows="3" placeholder="Address"><?php echo "$address"; ?></textarea>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group inputWithIcon" id="newPassDiv" style="display: none;">
                                                    <input class="form-control border border-primary" type="password" name="newPassword" value="" placeholder="New Password" minlength="8" maxlength="20">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group inputWithIcon" id="conPassDiv" style="display: none;">
                                                    <input class="form-control border border-primary" type="password" name="confirmPassword" value="" placeholder="Confirm Password" minlength="8" maxlength="20">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group"><input class="btn btn-outline-primary btn-block font-weight-bold" type="submit" name="updateInfoBtn" id="updateInfoBtn" value="Update" style="display: none;">
                                                    <div class="form-group"><input class="btn btn-outline-primary btn-block font-weight-bold" type="submit" name="updateMailBtn" id="updateMailBtn" value="Update" style="display: none;">
                                                        <div class="form-group"><input class="btn btn-outline-primary btn-block font-weight-bold" type="submit" name="updatePassBtn" id="updatePassBtn" value="Update" style="display: none;">
                                                        </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-link text-left" onclick="showPassDivs(); hideInfoDiv(); hideMailDiv();" id="changePassBtn" style="display: none;">Change password.</button>
                                                    <button type="button" class="btn btn-link text-right" onclick="showMailDiv(); hideInfoDiv(); hidePassDivs();" id="changeMailBtn" style="display: none;">Change Mail.</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="purchaseHistorySection" style="display:none;">
                        <h4 class="text-center font-weight-bold"><i class="fas fa-history"></i> Purchase History</h4>
                        <table class="table" id="purchaseHistoryTable">
                            <thead class="thead-dark" style="width: 100%;">
                                <tr>
                                    <th>#</th>
                                    <th>Movie</th>
                                    <th>Date</th>
                                    <th>Showtime</th>
                                    <th>Seats</th>
                                    <th>Discount</th>
                                    <th>Price</th>
                                    <th>Payment Method</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $x = 0;
                                $query = "SELECT * FROM ticket WHERE c_id='$userID';";
                                $result1 = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result1)) {
                                    $showID = $row['show_id'];
                                    $query = "SELECT m.name,t.theatre_name,s.show_date,s.show_time FROM shows as s left join movie as m on s.movie_id=m.mv_id left join theatre as t on s.theatre_id=t.theatre_id WHERE s.s_id='$showID';";
                                    $result2 = mysqli_query($conn, $query);
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $x++;
                                ?>
                                        <tr>
                                            <th><?php echo $x; ?> </th>
                                            <td><?php echo $row2['name']; ?></td>
                                            <td><?php echo $row2['show_date']; ?></td>
                                            <td><?php echo substr($row2['show_time'], 0, 5)  . " -" . $row2['theatre_name']; ?></td>
                                            <td><?php echo rtrim($row['seat_number'], ','); ?></td>
                                            <td><?php echo $row['discount'] . " BDT"; ?></td>
                                            <td><?php echo $row['price'] . " BDT"; ?></td>
                                            <td><?php echo $row['payment_method']; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>




        <!--Footer Section-->

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

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="..\css/bootstrap.min.js"></script>
</body>

</html>