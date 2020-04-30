<?php
    session_start();
    include "DatabaseConnection.php";
    $gender = $firstName = $lastName = $userName = $mail = $phone = $address = $password =$confirmPassword = $agreePolicy= $userNameInDB=$mailInDB=$passwordToDB="";
    $msg="";
    $currentDateTime=date("Y/m/d");
    $alphabetCheck="/^[A-Za-z]+$/";
    $alphanumericCheck="/^[a-zA-Z0-9]*$/";
    $numericCheck="/^[0-9]*$/";
    $userNameCheck="/@(a+b)*/";


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['gender'])){
            $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        }
        else{
            $msg="Select Gender!";
        }
        if(!empty($_POST['firstName'])){
            $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
        }
        else{
            $msg = "First Name cannot be empty!";
        }
        if(!empty($_POST['lastName'])){
            $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        }
        else{
            $msg="Last Name cannot be empty!";
        }
        if(!empty($_POST['userName'])){
            $userName = mysqli_real_escape_string($conn, $_POST['userName']);
        }  
        else{
            $msg = "User Name cannot be empty!";
        }
        if(!empty($_POST['mail'])){
            $mail = mysqli_real_escape_string($conn,$_POST['mail']);
        }
        else{
            $msg="Mail cannot be empty!";
        }
        if(!empty($_POST['phone'])){
            $phone = mysqli_real_escape_string($conn,$_POST['phone']);
        }
        else{
            $msg="Phone Number cannot be empty!";
        }
        if(!empty($_POST['address'])){
            $address = mysqli_real_escape_string($conn,$_POST['address']);
        }
        if(!empty($_POST['password'])){
            $password = mysqli_real_escape_string($conn,$_POST['password']);
            $passwordToDB = password_hash($password,PASSWORD_DEFAULT);
        }
        else{
            $msg="Password cannot be empty!";
        }
        if(!empty($_POST['confirmPassword'])){
            $confirmPassword = mysqli_real_escape_string($conn,$_POST['confirmPassword']);
        }
        else{
            $msg="Please Re-Enter Password!";
        }  
        if(isset($_POST['agreePolicy'])){
            $agreePolicy=$_POST['agreePolicy'];
        }
        else{
            $msg="Please check agreement policy!";
        }

        $gmailPattern="/^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/";
        
         if(!preg_match($alphanumericCheck,$userName) && preg_match($numericCheck,$userName)){
            $msg="Use alphanumeric with @ at the front only for User Name!";
        }
        else if(!preg_match($userNameCheck,$userName)){
            $msg="Please put '@' at first character!";
        }
        else if(preg_match($numericCheck,$address)){
            $msg="Invalid Address!";
        }
        else if(!preg_match($alphanumericCheck,$password)){
            $msg="Use alphanumeric only for Password!";
        }
        else if(!preg_match($alphanumericCheck,$confirmPassword)){
            $msg="Use alphanumeric only for Confirm Password!";
        }
        else if(!preg_match($gmailPattern,$mail)){
            $msg="Use only Gmail acccount for registration.";
        }
        else if((strlen((string)$phone))<=10 || (strlen((string)$phone))>=13 || $phone<=0){
            $msg="Invalid digits for phone number!";
        }
        else if(isset($firstName) && isset($lastName) && isset($userName) && isset($mail) && isset($phone) && isset($phone) && isset($password) && isset($confirmPassword) && isset($agreePolicy)){
                $userName = mysqli_real_escape_string($conn, $_POST['userName']);
                $query = "SELECT user_name FROM customer WHERE user_name='$userName';";                        
                $result = mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($result)){
                $userNameInDB = $row['user_name'];
                }
                if($userNameInDB == $userName){
                $msg="User Name already available!<br>Try different User Name!";
                mysqli_close($conn);
                }
                else{
                    $mail = mysqli_real_escape_string($conn,$_POST['mail']);
                    $query = "SELECT mail FROM customer WHERE mail='$mail'";
                    $result=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_assoc($result)){
                        $mailInDB = $row['mail'];
                    }
                    if($mailInDB == $mail){
                        $msg="Mail address already exist!<br>Try different mail address!";
        
                    }
                    else{
                        if($phone<0){
                            $msg="Invalid phone number!";
                        }
                        else if((strlen((string)$phone))>12  || (strlen((string)$phone))<10 ){
                            $msg="Invalid phone number!";
                        }
                        else{
                            if(isset($_POST['agreePolicy'])){
                                if($password == $confirmPassword){
                                    $query = "INSERT INTO `customer`(`c_id`, `gender`, `user_name`, `first_name`, `last_name`, `mail`, `phone`, `address`, `password`, `status`, `points`,`joining_date`, `user_type`) VALUES (0,'$gender','$userName','$firstName','$lastName','$mail','$phone','$address','$passwordToDB','Regular',0,'$currentDateTime',3)";
                                    mysqli_query($conn,$query);
                                    
                                    $query="INSERT INTO `login`(`l_id`, `user_name`, `mail`, `password`, `user_type`) VALUES (0,'$userName','$mail','$passwordToDB',3)";
                                    mysqli_query($conn,$query);
                                    mysqli_close($conn);
                                    $msg="Registration Complete!";
                                    $_SESSION['msg']="Registration was successful!\nWant to sign in?";
                                    header("Location: SignInPage.php");
                                }
                                else{
                                    $msg="Passwords don't match!";
                                }
                            }
                            else{
                                $msg="Please check agreement policy!";
                            }
                            
                        }
                        
                    }
            }
        }
        else{
            $msg="Please fill-up the criteria!";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | CineCarnival</title>
    <link rel="icon" type="image/png" href="..\Images/CineCarnival.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="file:///C:/Users/User/Downloads/fontawesome-free-5.13.0-web/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-10 col-lg-9 col-xl-6">
                    <form action="RegistrationPage.php" method="POST" class="registration-form" style="width:100%;">
                        <div class="">
                            <table>
                                <tr>
                                    <th colspan="2" class="registration-title h1">
                                        <div class="form-group text-center mt-4">
                                            <span class="font-weight-bold text-center">Registration</span>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="text-left">
                                        <span style="color: red; font-size: 16px; font-weight: bolder;">*<?php echo "$msg";?></span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="custom-control custom-radio custom-control-inline mt-3">
                                            <input type="radio" class="custom-control-input" id="customRadio" name="gender" value="male" checked <?php if(isset($gender) && $gender=="male") echo "checked";?>>
                                            <label class="custom-control-label" for="customRadio">Mr.</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="female" <?php if(isset($gender) && $gender=="female") echo "checked";?>>
                                            <label class="custom-control-label" for="customRadio2">Ms./Mrs.</label>
                                          </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group inputWithIcon">
                                            <input class="form-control border text-capitalize border-primary" type="text" name="firstName" value="<?php echo "$firstName"; ?>" placeholder="First Name*" maxlength="30" minlength="3" required>
                                            <i class="fas fa-user"></i>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group inputWithIcon">
                                            <input class="form-control border text-capitalize border-primary" type="text" name="lastName" value="<?php echo "$lastName"; ?>" placeholder="Last Name*" maxlength="30" minlength="3" required>
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon">
                                            <input class="form-control border text-capitalize border-primary" type="text" name="userName" value="<?php echo "$userName"; ?>" placeholder="@User Name*" minlength="3" maxlength="30" required>
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon">
                                            <input class="form-control border  border-primary" type="email" name="mail" value="<?php echo "$mail"; ?>" placeholder="Mail*" minlength="13" maxlength="50" required>
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon"> 
                                            <input class="form-control border border-primary" type="number" name="phone" minlength="10" maxlength="11" value="<?php echo "$phone"; ?>" placeholder="Phone*" required>
                                            <i class="fas fa-mobile"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon">
                                            <textarea name="address" class="form-control text-capitalize border border-primary" cols="30" rows="3" minlength="3" maxlength="100" placeholder="Address"><?php echo "$address"; ?></textarea>
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon">
                                            <input class="form-control border border-primary" type="password" name="password" value="" placeholder="Password*" maxlength="20" required>  
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group inputWithIcon">
                                            <input class="form-control border border-primary" type="password" name="confirmPassword" value="" placeholder="Confirm Password*" maxlength="20" required>
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck" name="agreePolicy" required <?php if(isset($_POST['agreePolicy'])) echo "checked";?>>
                                            <label class="custom-control-label" for="customCheck">By signin up I agree to the terms of services and privacy policy.</label>
                                          </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <input class="btn btn-outline-primary btn-block font-weight-bold" type="submit" name="signUpBtn" value="Sign Up">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="text-center">
                                            <a class="text-decoration-none" href="SignInPage.php" >Already have an account? Sign In.</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
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
                   <div class="col-4">
                       <ul>
                           <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                           <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                       </ul>
                   </div>
                   <div class="col-3 developers-tag">
                    <span>Developed by : Group-5</span>
                   </div>
                   <div class="col-3 stores">
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

