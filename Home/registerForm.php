<?php
require("connect.php");

$sql = "SELECT * FROM usersgroup";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registering</title>
</head>
<body style="text-align: center; ">
    <div  class="reg_body">
    <img class="logo" src="../Images/pink logo.png" alt="Logo"/>
    <h1>WELCOME TO FOODIES LOVE</h1>
    <p>Join us in this exciting journey of sharing recipes and trying them out as well</p>
    <p>Fill in the details below to be registered</p>
    <form class="form" id="reg_form" method="POST" enctype="multipart/form-data" action="register.php">
        <div class="reg_div">
            <label for="F_name">First Name</label>
            <input type="text" id="F_name" name="F_name" required>
        </div>
        <div class="reg_div">
            <label for="S_name">Second Name</label>
            <input type="text" id="S_name" name="S_name" required>
        </div>
        <div class="reg_div">
            <label for="email">Enter Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="reg_div">
            <label for="phone">Enter your phone number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
        </div>
        <div class="reg_div">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob">
        </div>
        <div class="reg_div">
             <label for="userphoto">Kindly insert your photo</label>
                <input type="file" id="userphoto" name="userphoto">
        </div>
        <div class="reg_div">
            <label for="username">Enter Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="reg_div">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
        <label for="groupID">User Group:</label>
        <select id="groupID" name="groupID" required>
        <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        //if ($row['groupType'] !== 'Admin') {
                     
                        echo "<option value=\"" . $row['groupID'] . "\">" . $row['groupType'] . "</option>";
                    //}
                }
                } else {
                    echo "<option value=\"\">No group type available</option>";
                }
                $conn->close();
                ?>
            </select>
            </div>
            <button class="form" type="submit">Register</button>
        </form>
    </div>
</body>
</html>