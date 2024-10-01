<?php
require("connect.php");

echo "Connection Successful.<br>";

// Prepare SQL select statement
$sql = "SELECT recipeName, foodphoto FROM recipes";

// Execute statement
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Recipe Name: " . $row["recipeName"] . "<br>";
        echo "<img src='" . $row["foodphoto"] . "' alt='Food Photo' style='width:300px;height:200px;'><br><br>";
    }
} else {
    echo "No records found.";
}

// Close connection
$conn->close();
?>