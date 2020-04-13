<?php
session_start();
include "DatabaseConnection.php";
$userName = $_SESSION['userName'];
$userType = $_SESSION['userType'];
$gender = $firstName = $lastName = $mail = $phone = $address = $password = $newPassword = $newPasswordToDB = $confirmPassword = $status = $points = $joiningDate = $msg = "";
$currentDateTime=date("Y/m/d");
$alphabetCheck="/^[A-Za-z]+$/";
$alphanumericCheck="/^[a-zA-Z0-9]*$/";
$numericCheck="/^[0-9]*$/";
$userNameCheck="/@(a+b)*/";

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
    $joiningDate = new DateTime($row['joining_date']);
}
$phone = "0" . (string) $phone;

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
   
    if(!empty($_POST['address'])){
        $address = mysqli_real_escape_string($conn,$_POST['address']);
    }
    if (!empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    } else {
        $msg = "Phone Number cannot be empty!";
    }

    if(!preg_match($alphabetCheck,$firstName)){
        $msg="Use alphabets only for First Name!";
    }
    else if(!preg_match($alphabetCheck,$lastName)){
        $msg="Use alphabets only for Last Name!";
    }
    else if(preg_match($numericCheck,$address)){
        $msg="Invalid Address!";
    }
    else if((strlen((string)$phone))<=10 || (strlen((string)$phone))>=13 || $phone<=0){
        $msg="Invalid digits for phone number!";
    }
    else if (isset($gender) && isset($firstName) && isset($lastName) && isset($phone)) {
        if(!isset($address)){
            $address=" ";
        }
        $query = "UPDATE customer SET gender='$gender', first_name='$firstName', last_name='$lastName', phone='$phone', address='$address' WHERE user_name='$userName' OR mail='$userName';";
        $result = mysqli_query($conn,$query);
        if($result){
            $msg="Info Updated!";
        }
        else{
            $msg="Failed to update mail!";
        }
    }
    else{
        $msg = "Please Fillup All Required Fields!";
    }
}

if(isset($_POST['updateMailBtn'])){
    $userName = $_SESSION['userName'];
    $mailInDB="";
    if (!empty($_POST['mail'])) {
        $mail = mysqli_real_escape_string($conn, $_POST['mail']);
        $gmailPattern="/^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/";
        if(!preg_match($gmailPattern,$mail)){
            $msg="Use only Gmail acccount for registration.";
        }
        else{
            $query="SELECT mail from customer WHERE mail='$userName' OR user_name='$userName';";
            $result = mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($result) ){
                $mailInDB =  $row['mail'];
            }
            if($mail==$mailInDB){
                $msg="Mail already exitst!";
            }
            else{
                $query = "UPDATE customer SET mail='$mail' WHERE user_name='$userName' OR mail='$userName';";
                $result=mysqli_query($conn,$query);
                $query = "UPDATE login SET mail='$mail' WHERE user_name='$userName' OR mail='$userName';";
                $result1=mysqli_query($conn,$query);
                if($result && $result1){
                    $msg="Updated Mail!";
                }
                else{
                    $msg="Failed to update mail!";
                }   
            }
            
        }
    }
    else {
        $msg = "Mail cannot be empty!";
    }
}

if(isset($_POST['updatePassBtn'])){
    if (!empty($_POST['newPassword'])) {
        $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    }
    else {
        $msg="Enter new password!";
    }
    if (!empty($_POST['confirmPassword'])) {
        $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    }
    else {
        $msg="Re-enter new password!";    
    }
    if(isset($newPassword) && isset($confirmPassword)){
        if($newPassword==$confirmPassword){
            $newPassword = password_hash($newPassword,PASSWORD_DEFAULT);
            $query="UPDATE customer set password='$newPassword' WHERE user_name='$userName' OR mail='$userName';";
            $result=mysqli_query($conn,$query);
            $query="UPDATE login set password='$newPassword', last_changed_date='$currentDateTime' WHERE user_name='$userName' OR mail='$userName';";
            $result1=mysqli_query($conn,$query);
            if($result && $result1){
                $msg = "Updated password!";
            }
            else{
                $msg="Failed to update password!";
            }
        }
        else{
            $msg="Passwords did not match!";
        }
    }
    else{
        $msg="Please enter passwords!";
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
            hideMailDiv();
            hidePassDivs();
            showInfoDiv();
            document.getElementById('updatePassBtn').style.display="none";
            document.getElementById('updateMailBtn').style.display="none";
            document.getElementById('updateInfoBtn').style.display="block";
            document.getElementById('changePassBtn').style.display="block";
            document.getElementById('changeMailBtn').style.display="block";
        }

        function hideProfileSection() {
            document.getElementById('profileFormSection').style.display = "none";
        }

        function showPurchaseSection() {
            document.getElementById('purchaseHistorySection').style.display = "block";
        }

        function hidePurchaseSection() {
            document.getElementById('purchaseHistorySection').style.display = "none";
        }
        function showPassDivs() {
            document.getElementById('conPassDiv').style.display = "block";
            document.getElementById('newPassDiv').style.display = "block";
            document.getElementById('updateInfoBtn').style.display="none";
            document.getElementById('updateMailBtn').style.display="none";
            document.getElementById('updatePassBtn').style.display="block";
        }
        function hidePassDivs() {
            document.getElementById('conPassDiv').style.display = "none";
            document.getElementById('newPassDiv').style.display = "none";
        }
        function showMailDiv(){
            document.getElementById('mailProfile').style.display="block";
            document.getElementById('updatePassBtn').style.display="none";
            document.getElementById('updateInfoBtn').style.display="none";
            document.getElementById('updateMailBtn').style.display="block";
        }
        function hideMailDiv(){
            document.getElementById('mailProfile').style.display="none";
        }
        function hideInfoDiv(){
            document.getElementById('genderDiv1').style.display="none";
            document.getElementById('genderDiv2').style.display="none";
            document.getElementById('lNameDiv').style.display="none";
            document.getElementById('fNameDiv').style.display="none";
            document.getElementById('phoneDiv').style.display="none";
            document.getElementById('addressDiv').style.display="none";
        }
        function showInfoDiv(){
            document.getElementById('genderDiv1').style.display="block";
            document.getElementById('genderDiv2').style.display="block";
            document.getElementById('lNameDiv').style.display="block";
            document.getElementById('fNameDiv').style.display="block";
            document.getElementById('phoneDiv').style.display="block";
            document.getElementById('addressDiv').style.display="block";
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

        <div class="container-fluid">
            <div class="row mt-4  text-light welcome-box">
                <div class="col text-center">
                    <div class="welcome-to-profile">
                        <label for="" style="font-size: 40px;">Welcome, <?php echo "$firstName"; ?>!</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-4">
                    <button class="profileBtn" style="border-top-right-radius: 20px; border-bottom-left-radius: 20px;" onclick="showProfileSection();hidePurchaseSection();"><i class="fas fa-edit"></i> Edit Profile</button>

                </div>
                <div class="col-4">
                    <button class="profileBtn" style="background-color:#feda6a;color:black;border-bottom-left-radius: 20px; border-top-right-radius: 20px;" onclick="showPurchaseSection();hideProfileSection();"><i class="fas fa-history"></i> Purchase History</button>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <div id="profileFormSection" style="display: block;">
                        <form action="ProfilePage.php" method="POST">
                            <table style="width: 100%;">
                                <tr>
                                    <th colspan="2">
                                        <div class="form-group text-center mt-5 mb-0">
                                            <span class="font-weight-bold text-center h4"><i class="fas fa-user-alt"></i> Profile</span>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <span style="color: red; font-size: 16px; font-weight: bolder;">*<?php echo "$msg"; ?></span>
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
                                            <input class="form-control border border-primary" type="text" name="firstName" value="<?php echo "$firstName"; ?>" placeholder="First Name" required>
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group inputWithIcon" id="lNameDiv">
                                            <input class="form-control border border-primary" type="text" name="lastName" value="<?php echo "$lastName"; ?>" placeholder="Last Name" required>
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon" id="mailProfile" style="display: none;">
                                            <input class="form-control border border-primary" type="email"  name="mail" value="<?php echo "$mail"; ?> "  placeholder="Mail" required>
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon" id="phoneDiv">
                                            <input class="form-control border border-primary" type="number" name="phone" value="<?php echo "$phone"; ?>" placeholder="Phone" required>
                                            <i class="fas fa-mobile"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon" id="addressDiv">
                                            <textarea name="address" class="form-control border border-primary" cols="30" rows="3" placeholder="Address"><?php echo "$address"; ?></textarea>
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon" id="newPassDiv" style="display: none;">
                                            <input class="form-control border border-primary" type="password" name="newPassword" value="" placeholder="New Password">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon" id="conPassDiv" style="display: none;">
                                            <input class="form-control border border-primary" type="password" name="confirmPassword" value="" placeholder="Confirm Password">
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
                    <div id="purchaseHistorySection" style="display:none;">
                        <h4 class="text-center font-weight-bold"><i class="fas fa-history"></i> Purchase History</h4>
                        <table class="table" id="purchaseHistoryTable">
                            <thead class="thead-dark" style="width: 100%;">
                                <tr>
                                    <th>#</th>
                                    <th>Movie</th>
                                    <th>Date</th>
                                    <th>Showtime</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $x = 0;
                                $query = "SELECT * FROM ticket;";
                                $result1 = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    $query = "SELECT m.name,t.theatre_name,s.show_date,s.show_time FROM shows as s left join movie as m on s.movie_id=m.mv_id left join theatre as t on s.theatre_id=t.theatre_id;";
                                    $result2 = mysqli_query($conn, $query);
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $x++;
                                ?>
                                        <tr>
                                            <th><?php echo $x; ?> </th>
                                            <td><?php echo $row2['name']; ?></td>
                                            <td><?php echo $row2['show_date']; ?></td>
                                            <td><?php echo substr($row2['show_time'],0,5)  . " -" . $row2['theatre_name']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
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