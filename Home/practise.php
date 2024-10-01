<?php

 $myarray = array(
    array("Ankit","Ram","Shyam"),
    array("Unnao","Trichy","Kanpur")
 );

 echo"<pre>";
 print_r($myarray);
 echo"</pre>";
 
 $people = [
    "Joe" => 22,
    "Adam" => 25,
    "David" => 30
 ];

 echo "<pre>";
 print_r($people);
 echo"</pre>";

 print_r($people["Joe"]. "<br>");

 foreach($people as $name => $age){
    echo "My name is $name, and my age is $age. " ."<br>"; 
 }

 $data = [
    'Game of Thrones'=> ["Jaime Lannister","Catelyn Stark", "Cersei Lannister"],
    'Black Mirror' =>["Nanette Cole", "Selma Telse","Karin Parke"] 
 ];

 echo "<pre>";
 print_r($data);
 echo "</pre>";
  
 echo "<h1>Famous TV Series and Actors</h1>";
 foreach($data as $series => $actors){
    echo "<h2> $series </h2>";
     foreach($actors as $actors){
        echo"<div>$actors</div>";
     }
 };
 ?>
