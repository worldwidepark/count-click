<!DOCTYPE html>
<html lang="ja">
<table border='1'>
    
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
<tr>
     <td>移動先link</td><td>SLACK入力LINK</td><td>descriptin</td><td>click回数</td><td>削除</td><td>（+）クリック数</td><td>（-）クリック数</td>
<?php

if(!isset($_POST['password'])){
    header("Location: login.php");
}
else{ 

    if($_POST['password']== 1234 ){
   exit;
}   
 else{
 header("Location: login.php?wrong");
}
}


$conn = mysqli_connect('localhost','root','qkrguddn1!','test');

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
    　　　    <td>
                <form action="index.php" method="post" >
                    <input type = "hidden" name="plus" value="<?=$filtered['id']?>">
                    <input type="submit" value ="+">
       　　　　 </form>
              </td>
              <td>
                <form action="index.php" method="post" >
                    <input type = "hidden" name="minus" value="<?=$filtered['id']?>">
                    <input type="submit" value ="-">
       　　　　 </form>
              </td>

            

            </tr>
            <?php
     }


     if(isset($_POST['plus'])){
        $plus_sql = "SELECT * FROM counter_table WHERE id= {$_POST['plus']}" ;

        $plus_result = mysqli_query($conn,$plus_sql);
        $row = mysqli_fetch_array($plus_result);
        
        $filtered = array(
            'count'=>htmlspecialchars($row['count'])
        );
        
        #count +1
        
        $filtered['count']= $filtered['count'] + 1;
        
        $pluscount_sql = "
        UPDATE counter_table SET count = {$filtered['count']}  WHERE id = {$_POST['plus']}
        ";

        
        $plus_updateresult = mysqli_query($conn,$pluscount_sql);

     }

     
     if(isset($_POST['minus'])){
        $minus_sql = "SELECT * FROM counter_table WHERE id= {$_POST['minus']}" ;

        $minus_result = mysqli_query($conn,$minus_sql);
        $row = mysqli_fetch_array($minus_result);
        
        $filtered = array(
            'count'=>htmlspecialchars($row['count'])
        );
        
        #count -1
        
        $filtered['count']= $filtered['count'] - 1;
        
        $minuscount_sql = "
        UPDATE counter_table SET count = {$filtered['count']}  WHERE id = {$_POST['minus']}
        ";

        
        $minus_updateresult = mysqli_query($conn,$minuscount_sql);

     }

     ?>




</body>
</html>