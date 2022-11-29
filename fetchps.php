<?php
   //include CSS Style Sheet
   echo "<style type='text/css'>
      table{
         height:12%;
         border: 1px solid;
         color: blue;
         font size: 20px;
         text-align: center;
         padding: 15px;
      } 

      /*heading class*/
      .h{
         font size: 20px;
      }
   </style>";

if (isset($_POST['submit'])) {
    if (
         isset($_POST['phone'])) {
        
        
        $com = $_POST['phone'];
       # echo $com;
        $type1="alloc";
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "competition";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName, "3306");
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $fetch = "Select * from"." ".$type1." "."where phone= "." ".$com;
    
$result = $conn->query($fetch);

if ($result->num_rows > 0) {
// output data of each row
echo "<table> ";
echo "<tr> <th>Name</th> <th>Reseller</th> <th>Recycler</th> <th>Refurbisher</th> ";

while ($row = $result->fetch_assoc()) {
echo "The allocation of resources for the firm is:- ";
echo "<tr ><td>" . $row["cname"]. "</td><td>" . $row["Reseller"] . "</td><td>" . $row["Recycler"] . "</td><td>"
. $row["Refurbisher"]. "</td> </tr>";
}
echo "</table>";
}
else { echo "0 results"; }

           
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>