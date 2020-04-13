<?php
    include "DatabaseConnection.php";
    date_default_timezone_set("Asia/Dhaka");
    $currentDate = date("Y-m-d");

    if(isset($_POST['selectedDate'])){
        $selectedDate = $_POST['selectedDate'];
        if($selectedDate=="Today"){
            $selectedDate = date("Y-m-d");
           // echo $selectedDate;
        }
        else if($selectedDate=="Tomorrow"){
            $selectedDate = date('Y-m-d', strtotime($currentDate . ' + 1 days'));
            //echo $selectedDate;
        }
        $query= "SELECT DISTINCT m.name FROM movie AS m LEFT JOIN shows AS s ON s.movie_id=m.mv_id WHERE show_date='$selectedDate';";
        $result = mysqli_query($conn,$query);
    }
?>


<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <div class="mt-3" id="movieNameDropDownSection">
                            <select name="movieSelectDropDown" class="movieDropBtn" id="movieSelectDropDown">
                                <option selected disabled>Select a movie.</option>
                                <?php
                                    if(mysqli_num_rows($result)==0){
                                        echo "<option disabled>No movies found.</option>";
                                    }
                                    else{
                                        while($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
    </body>
</html>