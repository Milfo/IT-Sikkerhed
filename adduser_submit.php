<?php
session_start();
 
if(!isset( $_POST['phpro_username'], $_POST['phpro_password'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and password';
}
elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}
elseif (strlen( $_POST['phpro_username']) > 20 || strlen($_POST['phpro_username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
elseif (strlen( $_POST['phpro_password']) > 20 || strlen($_POST['phpro_password']) < 4)
{
    $message = 'Incorrect Length for Password';
}
elseif (ctype_alnum($_POST['phpro_username']) != true)
{
    $message = "Username must be alpha numeric";
}
elseif (ctype_alnum($_POST['phpro_password']) != true)
{
    $message = "Password must be alpha numeric";
}
else
{
    $phpro_username = filter_var($_POST['phpro_username'], FILTER_SANITIZE_STRING);
    $phpro_password = filter_var($_POST['phpro_password'], FILTER_SANITIZE_STRING);
    $brugertype = filter_var($_POST['brugertype'], FILTER_SANITIZE_STRING);

    $phpro_password = sha1( $phpro_password );
     
    $mysql_hostname = 'localhost';
 
    $mysql_username = 'root';
 
    $mysql_password = '';
 
    $mysql_dbname = 'sikkerhed';
 
    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
 
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
        $stmt = $dbh->prepare("INSERT INTO phpro_users (phpro_username, phpro_password, brugertype ) VALUES (:phpro_username, :phpro_password, :brugertype )");
 
        $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
        $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR, 40);
        $stmt->bindParam(':brugertype', $brugertype, PDO::PARAM_INT);
 
        $stmt->execute();
 
        unset( $_SESSION['form_token'] );
 
        $message = 'New user added';
    }
    catch(Exception $e)
    {
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists';
        }
        else
        {
            $message = 'We are unable to process your request. Please try again later"';
        }
    }
}
?>
 
<html>
<head>
<title>Add user</title>
</head>
<body>
<p><?php echo $message; ?></p>
</body>
</html>