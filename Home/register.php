<?php
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $firstName = $_POST["F_name"];
    $secondName = $_POST["S_name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone"];
    $dateOfBirth = $_POST["dob"];
    $username = $_POST["username"];
    $userphoto=$_FILES["userphoto"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $groupID = $_POST["groupID"];


    if (isset($_FILES["userphoto"]) && $_FILES["userphoto"]["error"] == 0) {
        $targetDir = "../photo/";
        $fileName = basename($_FILES["userphoto"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["userphoto"]["tmp_name"], $targetFilePath)) {
            
            $sql = $conn->prepare("INSERT INTO register (F_name, S_name, email, phone, dob, userphoto, username, password, groupID) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
            $sql->bind_param("ssssssssi", $firstName, $secondName, $email, $phoneNumber, $dateOfBirth, $targetFilePath, $username, $password,$groupID);

            if ($sql->execute()) {
                echo "Data inserted successfully";
                header("Location: loginForm.php");
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
