<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body class="loginBody">

 <div  class="reg_body">
 <img class="logo" src="../Images/pink logo.png" alt="Logo"/>
    <h1 style=" font-family:scribble; font-style: italic; font-size: 40px">Login Page</h1>
    <?php
    if (isset($_SESSION['status'])) {
        echo "<h3><center><font color='red'>" . $_SESSION['status'] . "</font></center></h3>";
        unset($_SESSION['status']); 
    }
    ?>
    <form class="form" action="login.php" method="post">
    <div >
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
        <button class="form" type="submit">Login</button>
    </form>
    <div class="formAdd">
     <a>Forgot password?</a>
     <a href="registerForm.php" title="Register Page" target="_blank">Create an account</a>
     <a href="index.php" title="Index Page" target="_blank">Go back to Main Page</a>
     <p style="font-size: 12px; color: red;"><i>Foodies Love</i></p>
</div>
</div>

</body>
</html>