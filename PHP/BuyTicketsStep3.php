<?php
session_start();
include "DatabaseConnection.php";
$perSeatPrice = $showType = $theatreType = $theatreID = $showTime = $showDate =$theatreName= $availableSeats = "";
if (isset($_POST['selectedShowID'])) {
    $selectedShowID = $_POST['selectedShowID'];
    $query = "SELECT * FROM shows WHERE s_id='$selectedShowID';";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $theatreID = $row['theatre_id'];
        $showDate = $row['show_date'];
        $showTime = $row['show_time'];
    }
    $query = "SELECT * FROM theatre WHERE theatre_id = '$theatreID';";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $availableSeats = $row['available_seat'];
        $theatreType = $row['theatre_type'];
        $theatreName = $row['theatre_name'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        function checkAvailableSeat() {
            var x = document.getElementById('seatSelectionDropDown');
            var selectedSeatCount = x.options[x.selectedIndex].text;
            var availableSeatCount = '<?php echo $availableSeats; ?>';

            if (selectedSeatCount > availableSeatCount) {
                alert("Not Enough Seats!");
            } else if (selectedSeatCount < availableSeatCount) {
                
            }
        }
    </script>
    <script>
        function showPopUp(){
            Swal.fire({
            title: 'You Will Be Redirected To Payment.',
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
        <div class="text-center">
        <button id="confirmBtn" type="button" onclick="showPopUp();">Confirm</button>
    </div>
    </div>
    
</body>

</html>