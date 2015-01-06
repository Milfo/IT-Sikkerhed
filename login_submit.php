<?php
 
session_start();
 
if(isset( $_SESSION['user_id'] ))
{
    $message = 'Users is already logged in';
}
if(!isset( $_POST['phpro_username'], $_POST['phpro_password']))
{
    $message = 'Please enter a valid username and password';
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
 
    $phpro_password = sha1( $phpro_password );
     
    $mysql_hostname = 'localhost';
 
    $mysql_username = 'root';
 
    $mysql_password = '';
 
    $mysql_dbname = 'sikkerhed';
 
    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
 
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
        $stmt = $dbh->prepare("SELECT phpro_user_id, phpro_username, phpro_password FROM phpro_users 
                    WHERE phpro_username = :phpro_username AND phpro_password = :phpro_password");
        $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
        $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR, 40);
        $stmt->execute();
        $user_id = $stmt->fetchColumn();
 


        $getlvl = $dbh->prepare("SELECT brugertype FROM phpro_users WHERE phpro_user_id = " . $user_id);
        $getlvl->bindParam('brugertype', $_SESSION['acc_lvl'], PDO::PARAM_INT);
        $getlvl->execute();
        $acclvl = $getlvl->fetchColumn();
        if($user_id == false)
        {
                $message = 'Login Failed';
        }
        else
        {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['acclvl'] = $acclvl;
 
                $message = 'You are now logged in';
        }
 
 
    }
    catch(Exception $e)
    {
        //$message = 'We are unable to process your request. Please try again later';
        $message = $e->getMessage();
    }
}
?>
 
<html>
<head>
<title>Login</title>
</head>
<body>
<p><?php echo $message; ?></p>
<?php
if ($user_id) {
    echo "<p>Click <a href=\"members.php\">here</a> to go to the members page.</p>";
}
?>
</body>
</html>