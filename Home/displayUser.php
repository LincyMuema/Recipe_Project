<?php

$pageTitle = "Home Page";
include "header.php";
              
require("connect.php");
echo '<style>
        table {
            width: 100%;
        }
        table, th, td {
            border: 1px double red;
        }
        td {
            padding: 10px;
            text-align: left;
            background-color: #ffe4e1;
        }
        th {
            background-color: #f08080;
            text-align: center;
            padding: 10px;
        }
        img {
            width: 150px;
            height: 100px;
           display: block;
            margin: auto;
        }
        a{
       color: #000000;
       text-decoration: none;
        }
       a:hover {
        color: #f08080;
        text-decoration: underline;
      }
      </style>';

$sql= "SELECT* from register";
$result = mysqli_query($conn,$sql);


if ($result->num_rows > 0) {
    echo "<table>
    <tr>
    <th>User ID</th>
    <th>Name</th>
    <th>Email Address</th>
    <th>Phone Number</th>
    <th>Date of Birth</th>
    <th>User Photo</th>
    <th>Username</th>
    <th>groupID</th>
    <th>Update</th>
    </tr>";
    
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td>".$row["userID"]."</td>
      <td>".$row["F_name"]." ".$row["S_name"]."</td>
      <td>".$row["email"]."</td><td>".$row["phone"]."</td>
      <td>".$row["dob"]."</td>
      <td><img src='" . $row["userphoto"] . "' alt='User Photo'></td>
      <td>".$row["username"]."</td>
      <td>".$row["groupID"]."</td>
      <td><a href='update.php?userID=" . htmlspecialchars($row['userID']) . "'>Edit</a></td>
      
      </tr>";
    }
    echo "</table>";
    
  } else {
    echo "0 results";
  }
?>

    
 

      

