
<!-- 
<?php
     require_once 'conn.php';
     $id="";

     if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM movie WHERE mv_id=$id");
     
    header("location: index.php");
}


?>


