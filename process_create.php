<?php
$conn = mysqli_connect('localhost','root','12345','test');

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
     0
     )
";

$result = mysqli_query($conn,$sql);
$sql="SELECT * FROM counter_table ORDER BY id DESC limit 1";
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
    echo "link.php?id=".$row["ID"]."をSLACKに入力してください。";
}



?>
