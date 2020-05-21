
<!-- 
<?php
     require_once 'conn.php';
     $id="";

     if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM poll WHERE p_id=$id");
     
    header("location: index.php");
}


?>


