<?php
    session_start();
    include "DatabaseConnection.php";
    $perSeatPrice = $showType= $theatreType = $theatreID=$showTime=$showDate=$availableSeats="";
    if(isset($_POST['selectedShowID'])){
        $selectedShowID = $_POST['selectedShowID'];
        $query = "SELECT * FROM shows WHERE s_id='$selectedShowID';";
        $result = mysqli_query($conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $theatreID = $row['theatre_id'];
            $showDate = $row['show_date'];
            $showTime = $row['show_time'];
        }
        $query = "SELECT * FROM theatre WHERE theatre_id = '$theatreID';";
        $result = mysqli_query($conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $availableSeats = $row['available_seat'];
            $theatreType = $row['theatre_type'];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <script>
            function checkAvailableSeat(){
                var x = document.getElementById('seatSelectionDropDown');
                var selectedSeatCount = x.options[x.selectedIndex].text;
                alert(selectedSeatCount);
                var availableSeatCount = '<?php echo $availableSeats ;?>';

                if(selectedSeatCount > availableSeatCount){
                    alert("Not Enough Seats!");
                }
                else if(selectedSeatCount < availableSeatCount){
                    alert("Available!");
                }
            }
        </script>
    </head>
    <body>
    <div id="seatAndPaymentSection">
                            <div>
                                <select name="seatSelectionDropDown" class="movieDropBtn" id="seatSelectionDropDown" onchange="checkAvailableSeat();">
                                    <option value="" disabled selected>Select number of seats</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
    </body>
</html>