<form action="index.php" method="POST">
<input type="text" name="password" placeholder="PASSWORD">
<input type="submit" name="login_button" id="login_button" value="Login">

</form>

<?php
if(isset($_GET['wrong'])){

echo "正しいパスワードを入力してください。";

}

?>