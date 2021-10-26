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
    'explain_link'=>mysqli_real_escape_string($conn,$_POST['explain_link'])
);

$sql="
INSERT INTO counter_table
(link, explain_link, count )
 VALUES(
     '{$filtered['link']}',
     '{$filtered['explain_link']}',
     -1 
     )
";
#slackでLinkを貼る時は、1回起動させるため、カウントが１上がるため、－1にする。
$result = mysqli_query($conn,$sql);
$sql="SELECT * FROM counter_table ORDER BY id DESC limit 1";
$id_result= mysqli_query($conn,$sql);
$row = mysqli_fetch_array($id_result);

$sql="
UPDATE counter_table
SET
link_to_go= 'link.php?id={$row["id"]}'
     WHERE
      ID={$row["id"]}
     
";
$link_to_go_result= mysqli_query($conn,$sql);


if($id_result === false){
    echo "保存失敗です。朴まで問い合わせてください。.";
    error_log(mysqli_error($conn));
} else{
    echo "<span class='link'>link.php?id=".$row["id"]."</span> をSLACKに入力してください。";
}



?>
</br></br>
<a href = "index.php">戻る</a>
