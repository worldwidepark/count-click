<?php
$conn = mysqli_connect('localhost','root','12345','test');

$read =  'SELECT * FROM counter_table';

$result = mysqli_query($conn,$read);
$row = mysqli_fetch_array($result);
$row['count'] = 10000000;


$sql="
INSERT INTO counter_table
(title, link,count)
 VALUES('good','good',0)
";

$count = mysqli_query($conn,$sql);


?>

