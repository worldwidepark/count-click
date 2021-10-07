<?php
include('password.php');
$conn = mysqli_connect('localhost','root',$password,'test');

settype($_POST['id'],'integer');
$filtered = array(
    'id'=>mysqli_real_escape_string($conn,$_POST['id']),
);


$sql="
DELETE 
 FROM counter_table
 WHERE id = {$filtered['id']}";


$result = mysqli_query($conn,$sql);

  header('location: index.php');



?>