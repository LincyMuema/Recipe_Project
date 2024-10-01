<?php
require("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $category=$_POST["categoryName"];
    $sql = $conn->prepare("INSERT INTO category (categoryName) VALUES (?) ");
    $sql->bind_param("s",$category);

    if ($sql->execute()) {
        echo "Data inserted successfully";
        header("Location: admin_dashboard.php");
        exit(); 
    } else {
        echo "Error: " . $sql->error;
    }
    $sql->close();
}
$conn->close();
?>