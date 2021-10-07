
<?php
session_start();

?>

<form action="" method="POST">
<input type="text" name="password" placeholder="PASSWORD">
<input type="submit" name="login_button" id="login_button" value="Login">
</form>

<?php
if(isset($_POST['password'])){
   if($_POST['password'] == 1234){
       $_SESSION['password']="";
        header("Location: index.php");
   
    }
    else{
      
    header("Location: login.php?wrong");
    }
}

if(isset($_GET['wrong'])){
echo "正しいパスワードを入力してください。";
}



?>