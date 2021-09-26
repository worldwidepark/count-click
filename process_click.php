
<?php



$conn = mysqli_connect('localhost','root','12345','test');

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
        header('location: index.php');

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


       header('location: index.php');
     }



?>
