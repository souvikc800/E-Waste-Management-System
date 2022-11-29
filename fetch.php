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
    if (isset($_POST['mtype'])  &&
         isset($_POST['citycode'])) {
        
        $type = $_POST['mtype'];
        $city = $_POST['citycode'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "manny";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName, "3308");
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $fetch = "Select * from"." ".$type." "."where City_id= "." ".$city;
    
$result = $conn->query($fetch);

if ($result->num_rows > 0) {
// output data of each row
echo "<table> ";
echo "<tr> <th>Name</th> <th>Contact</th> <th>Tariff</th> <th>Rating</th> </tr>";

while ($row = $result->fetch_assoc()) {
echo "<tr ><td>" . $row["Name"]. "</td><td>" . $row["Contact"] . "</td><td>"
. $row["Tariff"]. "</td> <td>" .$row["Rating"]. "</td></tr>";
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