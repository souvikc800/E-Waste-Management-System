<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username'])  &&
         isset($_POST['mtype']) &&
        isset($_POST['city'])) {
        
        $username = $_POST['username'];
        $type=$_POST['mtype'];
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
            $Select = "SELECT email FROM customer WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO new_recruit(name,type,city_id) values(?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssi",$username,$type,$city);
                if ($stmt->execute()) {
                    echo "New Enquiry added sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
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