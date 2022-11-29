<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username'])  &&
         isset($_POST['email']) &&
        isset($_POST['phoneCode']) && isset($_POST['city'])) {
        
        $username = $_POST['username'];
        $password=$_POST['password'];
        $email = $_POST['email'];
        $phoneCode = $_POST['phone'];
        $city = $_POST['citycode'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "competition";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName, "3306");
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM customer WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO customer(name,contact,email,city_id,password) values(?, ?, ?, ?,?)";
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
                $stmt->bind_param("sssis",$username,$phoneCode,$email,$city,$password);
                if ($stmt->execute()) {
                    echo "New user added sucessfully.";
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