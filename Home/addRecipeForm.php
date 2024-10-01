<?php
require("connect.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginForm.php");
    exit();
}
$username= $_SESSION['username'];
$usersql= "SELECT* from register where username = '$username'";
$userresult = mysqli_query($conn,$usersql);
if ($userresult->num_rows > 0) {
    $row = $userresult->fetch_assoc();
  } else {
    echo "No user found";
    exit();
  }
$sql = "SELECT categoryName FROM category";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
</head>
<body >

    <nav>
    <img class="logo" id="logo" src="../Images/Foodies love.jpg" alt="Logo"/>
        <a href="index.php">Home</a>
        <a href = "allRecipes.php">Recipes</a>
        <a>Tips</a>
        <a>About</a>
        <a >Contact</a>
        <?php if(isset($_SESSION['username'])): ?>
            <a href="recipeowner_dashboard.php" title="User Dashboard">Dashboard</a>
           
        <?php else: ?>
            <a href="loginForm.php" title="Login Page" target="_blank">Login</a>
        <?php endif; ?>
    
        <span>
             <?php if($row['userphoto']) { ?>
            <img src="<?php echo ($row['userphoto']); ?>" width="100" height="100"><br>
        <?php } ?> 
        <?php echo $row['username']; ?>  </span>
          
    </nav>
    <div class="addDiv">
        <div class="image-container">
            
            <img src="../Images/pastsvodka.avif" alt="Penne alla Vodka"/>
            <img src="../Images/Baked-Cod.jpg" alt="Baked Cod Recipe With Lemon And Garlic"/>
            <img src="../Images/roasted potatoes.png" alt="Roasted Potatoes"/>
        </div>
        <div class="reg_body">
            <form class="form" id="add_form" method="POST" enctype="multipart/form-data" action="addRecipe.php">
                <h1 style="color: red;">Hello Foodie</h1>
                <h2 style="color: #f08080;">Share your amazing recipes with us</h2>
                <div>
                    <label for="recipeName">Recipe name</label>
                    <input type="text" id="recipeName" name="recipeName" required>
                </div>
                <div>
                    <label for="ingredients">Ingredients needed</label>
                    <textarea id="ingredients" name="ingredients" required></textarea>
                </div>
                <div>
                    <label for="cookingTime">Cooking Time</label>
                    <input type="text" id="cookingTime" name="cookingTime" required>
                </div>
                <div>
                    <label for="servings">Servings amount</label>
                    <input type="text" id="servings" name="servings">
                </div>
                <div>
                    <label for="instructions">Instructions</label>
                    <textarea id="instructions" name="instructions"></textarea>
                </div>
                <div>
                    <label for="foodphoto">Kindly insert the photo of the food</label>
                    <input type="file" id="foodphoto" name="foodphoto">
                </div>
                <div>
                    <label for="username">Enter Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="categoryName">Category Name:</label>
                    <select id="categoryName" name="categoryName" required>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value=\"" . $row['categoryName'] . "\">" . $row['categoryName'] . "</option>";
                            }
                        } else {
                            echo "<option value=\"\">No categories available</option>";
                        }
                        ?>
                    </select>
                </div>
                <button class="form" type="submit">Add recipe</button>
            </form>
        </div>
        <div class="image-container">
            <img src="../Images/Caesar-Salad.jpg" alt="Caesar-Salad"/>
            <img src="../Images/dumplings.jpg" alt="Dumplings"/>
            <img src="../Images/Mixed vegetables.jpg" alt="Mixed vegetables"/>
        </div>
    </div>
    <?php
    include "footer.php"; ?>
</body>
</html>