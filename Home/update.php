<?php
require("connect.php");

if (!isset($_GET['userID']) || empty($_GET['userID'])) {
    die("User ID is not provided.");
}

$userID = $_GET['userID'];

$sql = "SELECT * FROM register WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("User not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userID = $_POST['userID'];
    $firstName = $_POST["F_name"];
    $secondName = $_POST["S_name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone"];
    $dateOfBirth = $_POST["dob"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $groupID = $_POST["groupID"];

    if (isset($_FILES["userphoto"]) && $_FILES["userphoto"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "../photo/";
        $targetFilePath = $targetDir . basename($_FILES["userphoto"]["name"]);
        move_uploaded_file($_FILES["userphoto"]["tmp_name"], $targetFilePath);
    } else {
        $targetFilePath = $row["userphoto"];
    }
  
    $sql = "UPDATE register SET F_name=?, S_name=?, email=?, phone=?, dob=?, username=?, groupID=?, userphoto=? WHERE userID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssisi", $firstName, $secondName, $email, $phoneNumber, $dateOfBirth, $username, $groupID, $targetFilePath, $userID);

    if ($stmt->execute()) {
        echo "Record updated successfully";
        header("Location: displayUser.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
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
    <title>Update Profile</title>
</head>
<body>
<div  class="reg_body">
<h2>Update Profile</h2>

<form class="form" action="<?php echo($_SERVER["PHP_SELF"]) . "?userID=" . ($userID); ?>" method="post" enctype="multipart/form-data">
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
        
        <input type="hidden" name="userID" value="<?php echo($userID); ?>">
        <input type="submit" value="Update" class="updateButton">
    </form>
        </div>
</body>
</html>
