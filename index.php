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

if(isset($_POST['modify_go_link'])){
    
    $link=$_POST['modify_go_link'];
    $id=$_POST['modify_link_id'];
    $sql_modify_go_link = "UPDATE counter_table SET link='$link' WHERE id = '$id'";
    $result_modify = mysqli_query($conn, $sql_modify_go_link);
    header('location: index.php?search='.$_GET['search']);
}

if(isset($_POST['modify_go_description'])){
    
    $explan=$_POST['modify_go_description'];
    $id=$_POST['modify_description_id'];
    $sql_modify_go_description = "UPDATE counter_table SET explan = '$explan' WHERE id = '$id'";
    $result_modify = mysqli_query($conn, $sql_modify_go_description);
    header('location: index.php?search='.$_GET['search']);
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
$num = 0;
while($row = mysqli_fetch_array($search_result)){
    $filtered = array(
        'id'=>htmlspecialchars($row['ID']),
        'link'=>htmlspecialchars($row['link']),
        'link_to_go'=>htmlspecialchars($row['link_to_go']),
        'description'=>htmlspecialchars($row['explan']),
        'count'=>htmlspecialchars($row['count'])
    );
    $num=$num+1;
?>

　　　　　　<tr>
             <td><?php
                if(isset($_POST['modify_link'])){
                if($_POST['modify_link']==$num){ ?>
                  <form action="#" method="POST">
                      <input type ="text" name="modify_go_link" value="<?=$filtered['link']?>">
                      <input type = "hidden" name="modify_link_id" value="<?=$filtered['id']?>">
                      <button type="submit">修正開始</button>
                    </form> 
                 <?php }
                    else{
                        echo $filtered['link']; 
                        ?>
                       <form action="#" method="post" >
                           <input type = "hidden" name="modify_link" value="<?=$num?>">
                           <button type="submit" >修正</button>                
                    </form>           
                    <?php } }
                 else{
                    echo $filtered['link']; 
                    ?>
                   <form action="#" method="post" >
                       <input type = "hidden" name="modify_link" value="<?=$num?>">
                       <button type="submit" >修正</button>                
                </form>           
                <?php } ?>
            </td>
             <td><?=$filtered['link_to_go']?></td>
             <td><?php
             if(isset($_POST['modify_description'])){
                 if($_POST['modify_description']==$num){ ?>
                  <form action="#" method="POST">
                      <input type ="text" name="modify_go_description" value="<?=$filtered['description']?>">
                      <input type = "hidden" name="modify_description_id" value="<?=$filtered['id']?>">
                  <button type="submit">修正開始</button> 
                </form> 
                 <?php }
                 else{
                    echo $filtered['description'];?>
                    <form action="#" method="post" >
                    <input type = "hidden" name="modify_description" value="<?=$num?>">
                    <button type="submit" >修正</button>    
                    <?php } 
                }
                 else{
                   echo $filtered['description'];?>
                   <form action="#" method="post" >
                   <input type = "hidden" name="modify_description" value="<?=$num?>">
                   <button type="submit" >修正</button>    
                   <?php } ?>
                     
                           
                </form>  
              </form>
                    </td>
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
            

 
             </tr>
           
 <?php  
}}}

?>
<!--
    <php
$id = $filtered['id']  ;
if(isset($_POST['modify_go'])){

   $link= $filtered['link'] ;
   $explan= $filtered['description'] ;    
   


}

            ?>
-->  
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
                    <?php if(isset($_GET['search'])){ 
                        ?>                
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                        <?php 
                        }?>
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