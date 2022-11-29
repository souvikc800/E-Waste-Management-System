<?php 

$host="localhost";
$user="root";
$password="";
$db="competition";


if(isset($_POST['username']) && isset($_POST['password'])){
$conn = new mysqli($host, $user, $password, $db, "3306");
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            
    $uname=$_POST['username'];
    $password=$_POST['password'];
    
    $sql="select * from Admin where Email='".$uname."'AND Password='".$password."' limit 1";
    
    $result=$conn->query( $sql);
    $link_address="searchps.html";
    if($result->num_rows==1){
        echo " Welcome Admin";
      # echo '<br/>'."Check Allocation!!!    <a href=\"\" target=\"_searchps.html\" >CLICK HERE</a>";
      echo '<br/>'."Check Allocation!!!    <a href=".$link_address.">CLICK HERE</a>";
        exit();
    }
    else{
        echo " Invalid Credentials";
        exit();
    }
   }     
}
?>