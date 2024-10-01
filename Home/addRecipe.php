<?php
session_start();
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = $_POST["recipeName"];
    $ingredients = $_POST["ingredients"];
    $cookingTime = $_POST["cookingTime"];
    $servings = $_POST["servings"];
    $instructions = $_POST["instructions"];
    $foodphoto = $_FILES["foodphoto"];
    $username = $_POST["username"];
    $categoryName = $_POST["categoryName"];

    if (isset($_FILES["foodphoto"]) && $_FILES["foodphoto"]["error"] == 0) {
        $targetDir = "../photo/";
        $fileName = basename($_FILES["foodphoto"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["foodphoto"]["tmp_name"], $targetFilePath)) {
            $sql = $conn->prepare("INSERT INTO recipes (recipeName, ingredients, cookingTime, servings, instructions, foodphoto, username, categoryName) VALUES (?,?,?,?,?,?,?,?)");
            $sql->bind_param("ssssssss", $recipeName, $ingredients, $cookingTime, $servings, $instructions, $fileName, $username, $categoryName);

            if ($sql->execute()) {
                //$recipeID = $conn->insert_id;
                //$_SESSION['recipeID'] = $recipeID;
                header("Location: recipeDisplay.php?recipeID=" . $conn->insert_id);
                exit();
            } else {
                echo "Error: " . $sql->error;
            }

            $sql->close();
        } else {
            echo "Error: There was an error uploading your file.";
        }
    } else {
        echo "Error: File upload error. Please try again.";
    }
}

$conn->close();
?>
