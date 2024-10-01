<?php
session_start();
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT password, groupID FROM register WHERE username = ?");
    $stmt->bind_param("s", $username); 
    $stmt->execute();
    $result = $stmt->get_result();
   
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
       
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            
            //$_SESSION['groupID'] = $row['groupID'];

            if ($row['groupID'] == 1) {
               header("Location: admin_dashboard.php");
            } else {
                header("Location: recipeowner_dashboard.php");
            }
            exit();
           
           //header("Location: index.php");
           // exit();
        } else {
            $_SESSION['status'] = "Invalid password";
            header("Location: loginForm.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Invalid username";
        header("Location: loginForm.php");
        exit();
        //echo "<h1><center><font color='red'>Invalid username</font></center></h1>";
    }  
    $stmt->close();
}
$conn->close();
?>

