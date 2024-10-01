<?php
require("connect.php");
session_start();

if (!isset($_GET['recipeID'])) {
    echo "No recipe selected.";
    exit();
}

$recipeID = $_GET['recipeID'];
$sql = "SELECT * FROM recipes WHERE recipeID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipeID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
} else {
    echo "No recipe found"; 
    exit();
}

$isOwner = false;
if (isset($_SESSION['username']) && $_SESSION['username'] == $row['username']) {
    $isOwner = true;
}

if ($isOwner && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeName = $_POST['recipeName'];
    $categoryName = $_POST['categoryName'];
    $ingredients = $_POST['ingredients'];
    $cookingTime = $_POST['cookingTime'];
    $servings = $_POST['servings'];
    $instructions = $_POST['instructions'];
    $foodphoto = $_FILES['foodphoto'];

    if (isset($foodphoto) && $foodphoto['error'] == 0) {
        $targetDir = "../photo/";
        $fileName = basename($foodphoto['name']);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($foodphoto['tmp_name'], $targetFilePath);
    } else {
        $fileName = $row['foodphoto'];
    }

    $sql = "UPDATE recipes SET recipeName = ?, categoryName = ?, ingredients = ?, cookingTime = ?, servings = ?, instructions = ?, foodphoto = ? WHERE recipeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $recipeName, $categoryName, $ingredients, $cookingTime, $servings, $instructions, $fileName, $recipeID);
    if ($stmt->execute()) {
        header("Location: recipeDisplay.php?recipeID=" . $recipeID);
        exit();
    } else {
        echo "Error updating recipe: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Display</title>
</head>
<body>
<div class="reg_body">
    <form class="form" method="POST" enctype="multipart/form-data">
   
        <label for="recipeName">Recipe name</label>
        <input type="text" id="recipeName" name="recipeName" value="<?php echo isset($row['recipeName']) ? $row['recipeName'] : ''; ?>">
            <label for="categoryName">Category Name</label>
            <input type="text" id="categoryName" name="categoryName" value="<?php echo isset($row['categoryName']) ? $row['categoryName'] : ''; ?>">
            <label for="ingredients">Ingredients needed</label>
            <textarea id="ingredients" name="ingredients"><?php echo isset($row['ingredients']) ? $row['ingredients'] : ''; ?></textarea>
            <label for="cookingTime">Cooking Time</label>
            <input type="text" id="cookingTime" name="cookingTime" value="<?php echo isset($row['cookingTime']) ? $row['cookingTime'] : ''; ?>">

            <label for="servings">Servings amount</label>
            <input type="text" id="servings" name="servings" value="<?php echo isset($row['servings']) ? $row['servings'] : ''; ?>">
            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions"><?php echo isset($row['instructions']) ? $row['instructions'] : ''; ?></textarea>

            <label for="foodphoto">Kindly insert the photo of the food</label>
            <?php if (!empty($row['foodphoto'])) { ?>
                <img src="../photo/<?php echo $row['foodphoto']; ?>" width="100" height="100"><br>
            <?php } ?>
            <input type="file" id="foodphoto" name="foodphoto">
           
            <input type="submit" value="Update" class="updateButton" >
            <a  class="updateButton" href="recipeView.php?recipeID=<?php echo $recipeID; ?>">View Recipe</a>
    </form>
    
  

</div>
</body>
</html>
