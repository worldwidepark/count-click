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
<p><input type = 'text' name='link' placeholder='linkを入力' required></p>
<p><textarea name='explain_link' placeholder ='説明' required></textarea></p>
<p><input type ='submit' value = "入力"></p>
</form>


</br>
<form action=# method="GET">
    <select name="search_category">
    <option value="link">LINKから</option>
    <option value="explain_link">説明から</option>
</select>
<input type = 'text' name="search" placeholder='検索キーワードをいれてください。'>
    <input type ='submit' value = '検索'>

</form>
 

<?php

if(!isset($_SESSION['password'])){
    header("Location: login.php");
}
else{

$conn = mysqli_connect('localhost','root',$password,'test');

$sql = 'SELECT * FROM counter_table order by id desc ' ;
$result = mysqli_query($conn, $sql);
}
if(isset($_POST['search_exit'])){
    header('location: index.php');
}
if(isset($_POST['modify_go_link'])){
    
    $link=$_POST['modify_go_link'];
    $id=$_POST['modify_link_id'];
    $sql_modify_go_link = "UPDATE counter_table SET link='$link' WHERE id = '$id'";
    $result_modify = mysqli_query($conn, $sql_modify_go_link);
    header('location: index.php?search_category='.$_GET['search_category'].'&search='.$_GET['search']);
}

if(isset($_POST['modify_go_description'])){
    
    $explain_link=$_POST['modify_go_description'];
    $id=$_POST['modify_description_id'];
    $sql_modify_go_description = "UPDATE counter_table SET explain_link = '$explain_link' WHERE id = '$id' ";
    $result_modify = mysqli_query($conn, $sql_modify_go_description);
    header('location: index.php?search_category='.$_GET['search_category'].'&search='.$_GET['search']);
}

if(isset($_GET['search'])){
    if($_GET['search']==""){
        echo"<h3>検索キーワードを入力してください。</h3>";
    }
    else{
    $search_category = $_GET['search_category'];
    $search = $_GET['search'];
    $sql_search= "SELECT * FROM counter_table WHERE $search_category LIKE '%$search%'  order by id desc";
  $search_result = mysqli_query($conn, $sql_search);
  $search_result_check = mysqli_fetch_array($search_result);

  ?>
  <form action="#" method="POST">
        <input type="hidden" name="search_exit">
        <button type="submit">検索終了</button>
    </form> 
    <?php
if(!isset($search_result_check['id'])){
    echo "</br><h2>検索結果がありません。<h2>";
  
}
else{ 
    mysqli_data_seek($search_result,0);
    ?>
     <h3>検索結果は以下になります。</h3>
<table border="1">

<tr>
     <td>移動先link</td><td>SLACK入力LINK</td><td>説明</td><td>click回数</td><td>削除</td><td>（+）クリック数</td><td>（-）クリック数</td>

<?php

$num = 0;
while($row = mysqli_fetch_array($search_result)){
    $filtered = array(
        'id'=>htmlspecialchars($row['id']),
        'link'=>htmlspecialchars($row['link']),
        'link_to_go'=>htmlspecialchars($row['link_to_go']),
        'explain_link'=>htmlspecialchars($row['explain_link']),
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
                      <input type ="text" name="modify_go_description" value="<?=$filtered['explain_link']?>">
                      <input type = "hidden" name="modify_description_id" value="<?=$filtered['id']?>">
                  <button type="submit">修正開始</button> 
                </form> 
                 <?php }
                 else{
                    echo $filtered['explain_link'];?>
                    <form action="#" method="post" >
                    <input type = "hidden" name="modify_description" value="<?=$num?>">
                    <button type="submit" >修正</button>    </form>  
                    <?php } 
                }
                 else{
                   echo $filtered['explain_link'];?>
                   <form action="#" method="post" >
                   <input type = "hidden" name="modify_description" value="<?=$num?>">
                   <button type="submit" >修正</button>      </form>
                   <?php } ?>
                     
                           
                
            
                    </td>
             <td><?=$filtered['count']?></td>　
             <td>
                <form action="process_delete.php" method="post" 
                onsubmit="if(!confirm('sure?')){return false;}">
                    <input type = "hidden" name="id" value="<?=$filtered['id']?>">
                   <?php if(isset($_GET['search'])){ 
                     ?>  
                    <input type = "hidden" name="search" value="<?=$search?>">
                    <input type = "hidden" name="search_category" value="<?=$search_category?>">
                    <?php }?>
                    <input type="submit" value ="delete">
       　　　　 </form>
        　　　</td>
    　　　    <td>
                <form action="process_click.php" method="post" >
                    <input type = "hidden" name="plus" value="<?=$filtered['id']?>">               
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                        <input type = "hidden" name="search_category" value="<?=$search_category?>">
                    <input type="submit" value ="+">
       　　　　 </form>
              </td>
              <td>
                <form action="process_click.php" method="post" >
                    <input type = "hidden" name="minus" value="<?=$filtered['id']?>">            
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                        <input type = "hidden" name="search_category" value="<?=$search_category?>">
                    <input type="submit" value ="-">
       　　　　 </form>
              </td>         
            

 
             </tr>
           
 <?php  
}}}}

?>
<!--
    <php
$id = $filtered['id']  ;
if(isset($_POST['modify_go'])){

   $link= $filtered['link'] ;
   $explain_link= $filtered['explain_link'] ;    
   


}

            ?>
-->  
</table>

<h3>目録</h3>

<table border="1">

<tr>
     <td>移動先link</td><td>SLACK入力LINK</td><td>説明</td><td>click回数</td><td>削除</td><td>（+）クリック数</td><td>（-）クリック数</td>

<?php
while($row = mysqli_fetch_array($result)){
    $filtered = array(
        'id'=>htmlspecialchars($row['id']),
        'link'=>htmlspecialchars($row['link']),
        'link_to_go'=>htmlspecialchars($row['link_to_go']),
        'explain_link'=>htmlspecialchars($row['explain_link']),
        'count'=>htmlspecialchars($row['count'])
    );

    ?>
　　　　　　<tr>
             <td><?=$filtered['link']?></td>
             <td><?=$filtered['link_to_go']?></td>
             <td><?=$filtered['explain_link']?></td>
             <td><?=$filtered['count']?></td>　
             <td>
                <form action="process_delete.php" method="post" 
                onsubmit="if(!confirm('sure?')){return false;}">
                    <input type = "hidden" name="id" value="<?=$filtered['id']?>">
                    <?php if(isset($_GET['search'])){ 
                        ?>                
                        <input type = "hidden" name="search" value="<?=$search?>"> 
                        <input type = "hidden" name="search_category" value="<?=$search_category?>">
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
                        <input type = "hidden" name="search_category" value="<?=$search_category?>">
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
                        <input type = "hidden" name="search_category" value="<?=$search_category?>">
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