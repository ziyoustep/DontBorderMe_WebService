<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_GET['submit'])) {
    if (empty($_GET['uid']) || empty($_GET['passwd'])) {
    $error = "Username or Password is invalid";
    }else{
        // Connecting to database
        $connection = mysqli_connect("localhost", "kelvin", "7ujmnhy6", "dontborderme_db");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        // Define $username and $password
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        // To protect MySQL injection for Security purpose
        $username = stripslashes($_GET['uid']);
        $password = stripslashes($_GET['passwd']);
        $username = mysqli_real_escape_string($username);
        $password = mysqli_real_escape_string($password);
        // Selecting Database
        //$db = mysql_select_db("company", $connection);
        // SQL query to fetch information of registerd users and finds user match.
        $sql = "select * from user where password='$password' AND uid='$username'";
        $query = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($query);
        if ($rows == 1) {
            $_SESSION['login_user']=$username; // Initializing Session
            //header("location: profile.php"); // Redirecting To Other Page
        } else {
            $error = "Username or Password is invalid";
        }
        mysqli_close($connection); // Closing Connection
    }
}
?>