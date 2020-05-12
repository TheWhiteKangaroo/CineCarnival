
<!-- 
<?php
     require_once 'conn.php';
     $id="";

     if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM shows WHERE s_id=$id");
     
    header("location: index.php");
}


?>


