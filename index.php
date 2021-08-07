<?php
$conn = mysqli_connect('localhost','root','12345','parks');

$sql = 'SELECT * FROM topic';
$result = mysqli_query($conn, $sql);
$list="";
while ($row = mysqli_fetch_array($result)){
    $escaped_title = htmlspecialchars($row['title']);
    $list= $list."<li><a
    href=\"index.php?id={$row['id']}\">
    {$escaped_title}</a></li>";
};
$article = array(
    "title"=>"Welcome",
    "description"=>"HELLO, WEB" );
$update_link = '';
$delete_link = '';
$author="";

if(isset($_GET['id'])){$filtered_id = mysqli_real_escape_string($conn,$_GET['id']);
$sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$article['title'] = htmlspecialchars($row['title']);
$article['description'] =htmlspecialchars($row['description']);
$article['name'] =htmlspecialchars($row['name']);
$update_link = '<a href="update.php?id='.$_GET["id"].'">Update</a>';
$delete_link ='
<form action="process_delete.php" method = "post">
 <input type="hidden" name = "id" value= "'.$_GET["id"].'">
<input type="submit" value = "delete">
</form>
';
$author = "<p>by {$article['name']}</p>";

print_r($article);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAGATA　LINK</Label></title>
</head>
<body>
<h1>LINKとLINKの説明を入力してください。</h1>    
<form action="process_create.php" method="POST">
<p><input type = 'text' name='link' placeholder='linkを入力'></p>
<p><textarea name='description' placeholder ='説明'></textarea></p>
<p><input type ='submit' value = ""></p>
</form>



<ol>
<?php
echo $list;
?>
</ol>
<a href='create.php'>Create</a>
<?=$update_link?>
 <?=$delete_link?>
<h2><?=$article['title']?></h2>
<?=$article['description']?>
<?=$author?>
</body>
</html>