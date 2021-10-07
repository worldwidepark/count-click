<style>


 .link{
    margin-top: 15px;
    padding:5px;
    background-color: yellow;
    border: 2px solid #666;
    width: auto;
    color: #000000;  
 }

</style>
<?php

include('password.php');
$conn = mysqli_connect('localhost','root',$password,'test');

$filtered = array(
    'link'=>mysqli_real_escape_string($conn,$_POST['link']),
    'description'=>mysqli_real_escape_string($conn,$_POST['description'])
);

$sql="
INSERT INTO counter_table
(link, description, count )
 VALUES(
     '{$filtered['link']}',
     '{$filtered['description']}',
     -1 
     )
";
#slackでLinkを貼る時は、1回起動させるため、カウントが１上がるため、－1にする。
$result = mysqli_query($conn,$sql);
$sql="SELECT * FROM counter_table ORDER BY ID DESC limit 1";
$id_result= mysqli_query($conn,$sql);
$row = mysqli_fetch_array($id_result);

$sql="
UPDATE counter_table
SET
link_to_go= 'link.php?id={$row["ID"]}'
     WHERE
      ID={$row["ID"]}
     
";
$link_to_go_result= mysqli_query($conn,$sql);


if($id_result === false){
    echo "保存失敗です。朴まで問い合わせてください。.";
    error_log(mysqli_error($conn));
} else{
    echo "<span class='link'>link.php?id=".$row["ID"]."</span> をSLACKに入力してください。";
}



?>
</br></br>
<a href = "index.php">戻る</a>
