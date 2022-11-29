<?php 

$host="localhost";
$user="root";
$password="";
$db="competition";

if(isset($_POST['username1']) && isset($_POST['password1'])){
$conn = new mysqli($host, $user, $password, $db, "3306");
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            
    $uname=$_POST['username1'];
    $password=$_POST['password1'];
    
    $sql="select * from Customer where Email='".$uname."'AND Password='".$password."' limit 1";
    
    $result=$conn->query( $sql);
    
    if($result->num_rows==1){
        $name="select Name from Customer where Email='".$uname."'AND Password='".$password."' limit 1";
       $result1=$conn->query($name);
       $row = mysqli_fetch_row($result1);
       echo "Welcome"."    ". $row[0]." !!!";
       
       echo '<br/>'."Submit Your Quotation !!    <a href=\"quote.html\" target=\"_blank\" >CLICK HERE</a>";

       
       echo '<br/>'."History !!    <a href=\"searchps.html\" target=\"_blank\" >CLICK HERE</a>";
    }
    else{
        echo " Invalid Credentials";
        exit();
    }
   }     
}
?>