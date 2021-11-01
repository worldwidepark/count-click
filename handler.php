<?php

class Handler{


public function modify_handler($handler, $sql_handler){
    global $conn;

    if(isset($_POST[$handler])){
        $link=$_POST[$handler];
        $id=$handler.'_id';
        $handler_id=$_POST[$id];
        $sql_modify_link_go = "UPDATE counter_table SET $sql_handler='$link' WHERE id = '$handler_id'";
        $result_modify = mysqli_query($conn, $sql_modify_link_go);
        header('location: index.php?search_category='.$_GET['search_category'].'&search='.$_GET['search']);
        }}}
        ?>