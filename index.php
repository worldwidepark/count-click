<?php
#ob_start();
session_start();
include('password.php');
?>
<!DOCTYPE html>
<html lang="ja">
    
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

<p>
<form action=# method="GET">
    <input type = 'text' name="search" placeholder='description欄から検索'>
    <input type ='submit' value = '検索'>
</form>
    

<?php

if(!isset($_SESSION['password'])){
    header("Location: login.php");
}
else{

$conn = mysqli_connect('localhost','root',$password,'test');

$sql = 'SELECT * FROM counter_table';
$result = mysqli_query($conn, $sql);
}


if(isset($_GET['search'])){
    if($_GET['search']==""){
        echo"<h3>検索ワードを入力してください。</h3>";
    }
    else{

    $search = $_GET['search'];
    $sql_search= "SELECT * FROM counter_table WHERE explan LIKE '%$search%'";
  $search_result = mysqli_query($conn, $sql_search);

  ?>
  <h3>検索結果は以下になります。</h3>
<table border="1">

<tr>
     <td>移動先link</td><td>SLACK入力LINK</td><td>description</td><td>click回数</td><td>削除</td><td>（+）クリック数</td><td>（-）クリック数</td>

<?php
while($row = mysqli_fetch_array($search_result)){
    $filtered = array(
        'id'=>htmlspecialchars($row['ID']),
        'link'=>htmlspecialchars($row['link']),
        'link_to_go'=>htmlspecialchars($row['link_to_go']),
        'description'=>htmlspecialchars($row['explan']),
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
                   <?php if(isset($_GET['search'])){ 
                       ?>
                    <input type = "hidden" name="search" value="<?=$search?>">
                    <?php }?>
                    <input type="submit" value ="delete">
       　　　　 </form>
        　　　</td>
    　　　    <td>
                <form action="process_click.php" method="post" >
                    <input type = "hidden" name="plus" value="<?=$filtered['id']?>">               
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                    <input type="submit" value ="+">
       　　　　 </form>
              </td>
              <td>
                <form action="process_click.php" method="post" >
                    <input type = "hidden" name="minus" value="<?=$filtered['id']?>">            
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                    <input type="submit" value ="-">
       　　　　 </form>
              </td>


              <td>
                <form action="#" method="post" >
                    <?php
                    $input = '<form><input type ="text" value="'.$filtered["link"].'"</form>' ;
?>
                  <!--  <input type = "hidden" name="minus" value="#$filtered['id']?">
                    <input type = "hidden" name="search" value="#$search?>">
                    <input type="submit" value ="-"> -->
                     <input type = "hidden" name="search" 
                     value="<?php $filtered['link']=$input?>">
                    <input type="submit" value ="修正"> 
       　　　　 
                
                
                </form>
              </td>

            

 
             </tr>
           

    <?php
}}}
echo"$input";

             ?>
  </table>

<table border="1">
<tr>
     <td>移動先link</td><td>SLACK入力LINK</td><td>description</td><td>click回数</td><td>削除</td><td>（+）クリック数</td><td>（-）クリック数</td>

<?php
while($row = mysqli_fetch_array($result)){
    $filtered = array(
        'id'=>htmlspecialchars($row['ID']),
        'link'=>htmlspecialchars($row['link']),
        'link_to_go'=>htmlspecialchars($row['link_to_go']),
        'description'=>htmlspecialchars($row['explan']),
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
                    <input type = "hidden" name="search" value="<?=$search?>">
                    <input type="submit" value ="delete">
       　　　　 </form>
        　　　</td>
    　　　    <td>
                <form action="process_click.php" method="post" >
                    <input type = "hidden" name="plus" value="<?=$filtered['id']?>">
                    <?php if(isset($_GET['search'])){ ?>                
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                        <?php 
                    }?>
                    <input type="submit" value ="+">
       　　　　 </form>
              </td>
              <td>
                <form action="process_click.php" method="post" >
                    <input type = "hidden" name="minus" value="<?=$filtered['id']?>">
                   <?php if(isset($_GET['search'])){ ?>                
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                        <?php 
                    }?>
                    <input type="submit" value ="-">
       　　　　 </form>
              </td>

            

            </tr>
          
       <?php
     }

     ?>


</table>

</body>
</html>