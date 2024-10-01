<?php
require("connect.php");
session_start();

if (!isset($_GET['recipeID'])) {
    echo "No recipe selected.";
    exit();
}

$username = $_SESSION['username'] ?? null;

if ($username) {
    $usersql = "SELECT * FROM register WHERE username = ?";
    $stmt_user = $conn->prepare($usersql);
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $userresult = $stmt_user->get_result();

    if (!$userresult) {
        echo "Error fetching user details: (" . mysqli_errno($conn) . ") " . mysqli_error($conn);
        exit();
    }

    $userData = $userresult->fetch_assoc();
    $stmt_user->close();
}

$recipeID = $_GET['recipeID'];
$sql = "SELECT * FROM recipes WHERE recipeID = ?";
$stmt_recipe = $conn->prepare($sql);
$stmt_recipe->bind_param("i", $recipeID);
$stmt_recipe->execute();
$result = $stmt_recipe->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No recipe found.";
    exit();
}

$stmt_recipe->close();
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
<body style="text-align:center">
<div class="iconprofile">
    <span>
        <img class="logo" id="logo" src="../Images/Foodies love.jpg" alt="Logo"/>
        <?php if ($username): ?>
            <?php echo htmlspecialchars($username); ?>
        <?php endif; ?>
    </span>
</div>
<div>
    <h1><?php echo htmlspecialchars($row['recipeName'] ?? ''); ?></h1>
    <div class="displayImage">
        <?php if (!empty($row['foodphoto'])): ?>
            <img src="../photo/<?php echo htmlspecialchars($row['foodphoto']); ?>" width="100" height="100" alt="<?php echo htmlspecialchars($row['recipeName']); ?>">
        <?php endif; ?>
    </div>
    <div>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($row['categoryName'] ?? ''); ?></p>
        <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($row['cookingTime'] ?? ''); ?></p>
        <p><strong>Servings:</strong> <?php echo htmlspecialchars($row['servings'] ?? ''); ?></p>
    </div>
    <div class="details">
        <p><strong>Ingredients:</strong> <?php echo htmlspecialchars($row['ingredients'] ?? ''); ?></p>
        <p><strong>Instructions:</strong> <?php echo htmlspecialchars($row['instructions'] ?? ''); ?></p>
        <p><strong>Recipe By:</strong> <?php echo htmlspecialchars($row['username'] ?? ''); ?></p>
    </div>

    <a href="index.php" class="updateButton" style="margin-top: 10px; margin-bottom: 10px;">Go Back to Main Page</a>
</div>
<?php include "footer.php"; ?>
</body>
</html>
