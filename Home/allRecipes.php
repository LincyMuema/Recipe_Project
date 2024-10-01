<?php
require("connect.php");

$sql = "SELECT * FROM recipes";
$result = mysqli_query($conn, $sql);

$recipes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $recipes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
</head>
<body>
<div>

   <nav>
   <img class="logo" id="logo" src="../Images/Foodies love.jpg" alt="Logo"/>
       <a class="activeLink" href="#index">Home</a>
       <a href = "allRecipes.php">Recipes</a>
       <a>Tips</a>
       <a>About</a>
       <a >Contact</a>
       <?php if(isset($_SESSION['username'])): ?>
           <a href="recipeowner_dashboard.php" title="User Dashboard">Dashboard</a>
          
       <?php else: ?>
           <a href="loginForm.php" title="Login Page" target="_blank">Login</a>
       <?php endif; ?>
   </nav>
       </div>
<div >
        <h2 style=" text-align:center;">Recipes</h2>
        <ul class ="recipe" >
            <div   class="displayImage" >
            <?php foreach ($recipes as $recipe) { ?>
                <li>
                    <a href="recipeView.php?recipeID=<?php echo htmlspecialchars($recipe['recipeID']); ?>">
                        <?php if (!empty($recipe['foodphoto'])) { ?>
                            <img src="../photo/<?php echo htmlspecialchars($recipe['foodphoto']); ?>" width="70" height="70" alt="<?php echo htmlspecialchars($recipe['recipeName']); ?>">
                        <?php } ?>
                        <?php echo htmlspecialchars($recipe['recipeName']); ?>
                    </a>
                </li>
            <?php } ?>
                        </div>
        </ul>
    </div>
    <?php
        include "footer.php";?>
</body>
</html>
