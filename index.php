<!DOCTYPE html>
<html lang="ja">
<table border='1'>
 <tr>
     <td>移動先link</td><td>SLACK入力LINK</td><td>descriptin</td><td>click回数</td><td>削除</td>
<?php
$conn = mysqli_connect('localhost','root','12345','test');

$sql = 'SELECT * FROM counter_table';
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
    $filtered = array(
        'id'=>htmlspecialchars($row['ID']),
        'link'=>htmlspecialchars($row['link']),
        'link_to_go'=>htmlspecialchars($row['link_to_go']),
        'description'=>htmlspecialchars($row['description']),
        'count'=>htmlspecialchars($row['count'])
    );
    ?>
　　　　　　<tr>
             <td><?=$filtered['link']?></td>
             <td><?=$filtered['link_to_go']?></td>
             <td><?=$filtered['description']?></td>
             <td><?=$filtered['count']?></td>　
             <td>
                <form action="process_delete.php" method="post" 
                onsubmit="if(!confirm('sure?')){return false;}">
                    <input type = "hidden" name="id" value="<?=$filtered['id']?>">
                    <input type="submit" value ="delete">
       　　　　 </form>
        　　　</td>
            </tr>
            <?php
     }

     ?>



<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAGATA　LINK</title>
</head>
<body>
<h1>LINKとLINKの説明を入力してください。</h1>    
<form action="process_create.php" method="POST">
<p><input type = 'text' name='link' placeholder='linkを入力'></p>
<p><textarea name='description' placeholder ='説明'></textarea></p>
<p><input type ='submit' value = "入力"></p>
</form>

</body>
</html>