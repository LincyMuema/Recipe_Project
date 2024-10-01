<?php
session_start();
include("connect.php");
$username= $_SESSION['username'];
$sql= "SELECT* from register where username = '$username'";
$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "No user found";
    exit();
  }
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User DashBoard</title>
</head>
<body>

<div class="iconprofile">
<span style="text-align: center;"> <?php if($row['userphoto']) { ?>
            <img src="<?php echo ($row['userphoto']); ?>" width="100" height="100"><br>
        <?php } ?> 
        <?php echo $row['username']; ?>  
      </span>
</div>
<div>
    <div class="reg_body" >
    <form class="formAdd" >
    <img class="logo" src="../Images/pink logo.png" alt="Logo"/>
    <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
    <a style="font-weight: 800;" href="addRecipeForm.php" title="adding recipes" target="_blank">Add Recipes</a>
    <a style="font-weight: 800;"  href="recipeOwner.php" title="Display Profile" target="_blank">See Profile</a>
    <a   style="font-weight: 800;" href="index.php" title="Home Page" target="_blank">Go Back to Main Page</a>
    <a style="font-weight: 800;" href="logout.php" title="Logout" target="_blank">Logout</a>

    </form>
</div>
</div>
</body>
</html>u7