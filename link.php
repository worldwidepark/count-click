<?php
$conn = mysqli_connect('localhost','root','12345','test');
$sql = "SELECT * FROM counter_table WHERE ID= {$_GET['id']}" ;

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$filtered = array(
    'link'=>htmlspecialchars($row['link']),
    'count'=>htmlspecialchars($row['count'])
);

#count +1 

$filtered['count']= $filtered['count'] + 1; 

$count_sql = "
UPDATE counter_table SET count = {$filtered['count']}  WHERE ID = {$_GET['id']} 
";

$count_result = mysqli_query($conn,$count_sql);

#linkに飛ばす 
$pos_http= strpos($filtered['link'],'http://');
$pos_https= strpos($filtered['link'],'https://');
if($pos_http === false){
  if($pos_https === false){
echo"
<script>location.replace('http://".$filtered['link']."');</script>"; 
  }
}
else{
echo"
<script>location.replace('".$filtered['link']."');</script>"; 

}

?> 


