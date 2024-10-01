<?php
require("connect.php");
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: loginForm.php");
  exit();
}

$username= $_SESSION['username'];
$sql= "SELECT* from register where username = '$username'";
$result = mysqli_query($conn,$sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
} else {
  echo "No user found";
  exit();
}

$recipes_sql = "SELECT * FROM recipes WHERE username = '$username'";
$recipes_result = mysqli_query($conn, $recipes_sql);
$recipes = [];
if ($recipes_result->num_rows > 0) {
  while ($recipe_row = $recipes_result->fetch_assoc()) {
    $recipes[] = $recipe_row;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $userID = $row['userID'];
  $firstName = $_POST["F_name"];
  $secondName = $_POST["S_name"];
  $email = $_POST["email"];
  $phoneNumber = $_POST["phone"];
  $dateOfBirth = $_POST["dob"];
  $username = $_POST["username"];
  $groupID = $_POST["groupID"];
  $password = $_POST["password"];
 
  if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  } else {
    $hashedPassword = $row['password']; 

  if (isset($_FILES["userphoto"]) && $_FILES["userphoto"]["error"] == UPLOAD_ERR_OK) {
    $targetDir = "../photo/";
    $targetFilePath = $targetDir . basename($_FILES["userphoto"]["name"]);
    move_uploaded_file($_FILES["userphoto"]["tmp_name"], $targetFilePath);
} else {
    $targetFilePath = $row["userphoto"];
}
$update = "UPDATE register SET F_name = '$firstName', S_name = '$secondName', email = '$email', phone = '$phoneNumber', dob = '$dateOfBirth', username = '$username', password = '$hashedPassword', groupID = '$groupID', userphoto = '$targetFilePath' WHERE userID = '$userID'";

  if (mysqli_query($conn, $update)) {
    $_SESSION['username'] = $username;
    $_SESSION['updateSuccess'] = "Profile updated successfully!";
    header("Location: recipeOwner.php"); 
    exit();
  } else {
    echo "Error updating profile: " . mysqli_error($conn);
  }
}
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <div class="iconprofile">

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
        <span style="text-align: center;"> <?php if($row['userphoto']) { ?>
            <img src="<?php echo ($row['userphoto']); ?>" width="100" height="100"><br>
        <?php } ?> 
        <?php echo $row['username']; ?>  
      </span>
    </nav>

</div>

<div  class="userProfile">
  
 <div id="profile">
  
<h2>Profile</h2>

<?php
  if (isset($_SESSION['updateSuccess'])) {
    echo "<p style='color: red;'>" . $_SESSION['updateSuccess'] . "</p>";
    unset($_SESSION['updateSuccess']);
  }
  ?>

<form class="form" action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="F_name">First Name</label><br>
        <input type="text" id="F_name" name="F_name" value="<?php echo ($row['F_name']); ?>"><br><br>
        
        <label for="S_name">Second Name</label><br>
        <input type="text" id="S_name" name="S_name" value="<?php echo ($row['S_name']); ?>"><br><br>
        
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="<?php echo ($row['email']); ?>"><br><br>
        
        <label for="phone">Phone</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo ($row['phone']); ?>"><br><br>
        
        <label for="dob">Date of Birth</label><br>
        <input type="date" id="dob" name="dob" value="<?php echo ($row['dob']); ?>"><br><br>
        
        <label for="username">Username</label><br>
        <input type="text" id="username" name="username" value="<?php echo ($row['username']); ?>"><br><br>
        
        <label for="groupID">Group ID</label><br>
        <input type="text" id="groupID" name="groupID" value="<?php echo ($row['groupID']); ?>"><br><br>
        
        <label for="userphoto">User Photo</label><br>
        <?php if($row['userphoto']) { ?>
            <img src="<?php echo ($row['userphoto']); ?>" width="100" height="100"><br>
        <?php } ?>
        <input type="file" id="userphoto" name="userphoto"><br><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"><br><br>
        
        <input type="hidden" name="userID" value="<?php echo($row['userID']); ?>">
        <input type="submit" value="Update" class="updateButton">
 
        <a href="recipeOwner_dashboard.php" class="formAdd">Go Back to Dashboard</a>
    </form>
        </div>
    <div id= "recipe_profile">
    <h2>Recipes</h2>
  <ul>
    <?php foreach ($recipes as $recipe) { ?>
      <li><a href="recipeDisplay.php?recipeID=<?php echo $recipe['recipeID']; ?>"><?php echo ($recipe['recipeName']); ?></a></li>
    <?php } ?>
  </ul>
    </div>
    <div class="image-container">
    <img src="../Images/Mixed vegetables.jpg" alt="Mixed vegetables"/>
    <img src="../Images/Lasagna.jpg" alt="Lasagna"/>
    <img src="../Images/roasted potatoes.png" alt="Roasted Potatoes"/>
    </div>
        </div>
        <?php
        include "footer.php";?>
</body>
</html>


    
 

      

