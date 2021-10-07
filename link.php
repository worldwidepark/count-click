<!DOCTYPE html>
<html>
<head>

<?php
include('password.php');
$conn = mysqli_connect('localhost','root',$password,'test');
$sql = "SELECT * FROM counter_table WHERE id= {$_GET['id']}" ;

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$filtered = array(
    'link'=>htmlspecialchars($row['link']),
    'count'=>htmlspecialchars($row['count'])
);

#count +1

$filtered['count']= $filtered['count'] + 1;

$count_sql = "
UPDATE counter_table SET count = {$filtered['count']}  WHERE id = {$_GET['id']}
";

$count_result = mysqli_query($conn,$count_sql);

#linkの検査
$pos_http= strpos($filtered['link'],'http://');
$pos_https= strpos($filtered['link'],'https://');

if($pos_http === false and $pos_https === false){
$http_link='http://'.$filtered['link'];
}
else{
$http_link=$filtered['link'];
}

$tags = get_meta_tags($http_link);

$title_meta = $tags['twitter:title'];
$url_meta= $tags['twitter:url'];
$description_meta = $tags['description'];
$image_meta = $tags['twitter:image'];

?>

    <meta charset="utf-8">
    <meta name='og:site_name' content='Link share'/>
    <meta property="og:title" content="<?=$title_meta?>"/>
    <meta property="og:url" content="<?=$url_meta?>"/>
    <meta property="og:description" content="<?=$description_meta?>"/>
    <meta property="og:image" content="<?=$image_meta?>"/>

    <?php

if(isset($http_link)){
echo"
<script>location.replace('".$http_link."');</script>";
}
?>

  </head>
<body>
</body>
</html>

