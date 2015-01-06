<?php
 
session_start();
 
$form_token = md5( uniqid('auth', true) );
 
$_SESSION['form_token'] = $form_token;
?>

<html>
<head>
<title>PHPRO Login</title>
</head>
 
<body>
<h2>Add user</h2>
<form action="adduser_submit.php" method="post">
<fieldset>
<p>
<label for="phpro_username">Username</label>
<input type="text" id="phpro_username" name="phpro_username" value="" maxlength="20" autofocus="1" />
</p>
<p>
<label for="phpro_password">Password</label>
<input type="password" id="phpro_password" name="phpro_password" value="" maxlength="20" />
<p>
<label for="brugertype">Brugertype</label>
<select name="brugertype">
<option value="1">1</option>
<option value="2">2</option>
</select>
</p>
</p>
<p>
<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
<input type="submit" value="OK" />
</p>
</fieldset>
</form>
</body>
</html>
