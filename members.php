<?php
 
session_start();
$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_dbname = 'sikkerhed';
$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
if(!isset($_SESSION['user_id']))
{
    $message = 'You must be logged in to access this page';
}
else
{
    try
    {

        $stmt = $dbh->prepare("SELECT phpro_username FROM phpro_users WHERE phpro_user_id = :phpro_user_id");
        $stmt->bindParam(':phpro_user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $phpro_username = $stmt->fetchColumn();
 
        if($phpro_username == false)
        {
            $message = 'Access Error';
        }
        else
        {
            $message = 'Welcome '.$phpro_username;
        }
    }
    catch (Exception $e)
    {
        $message = 'We are unable to process your request. Please try again later';
    }
}
 
   $getlvl = $dbh->prepare("SELECT brugertype FROM phpro_users WHERE phpro_user_id = " . $_SESSION['user_id']);
   $getlvl->bindParam('brugertype', $id, PDO::PARAM_INT);
   $getlvl->execute();
   $acclvl = $getlvl->fetchColumn();
   if (isset($acclvl)) {
       $id = $acclvl;
   }

   $getuser = $dbh->prepare("SELECT * FROM phpro_users");
   $result = mysql_query($getuser);
?>


<html>
<head>
<title>Members Only Page</title>
</head>
<body>
<h2><?php echo $message; ?></h2>
<?php
if($_SESSION['acclvl']==1) {
    echo "<p>Click <a href=\"logout.php\">here</a> to log out.</p>";
    echo "Din brugertype er 1";
    echo "<br>";
}
elseif ($_SESSION['acclvl']==2) {
    echo "<p>Click <a href=\"logout.php\">here</a> to log out.</p>";
    echo "Din brugertype er 2";
    echo "<br>";
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            echo $row['phpro_username'];
        }
    }
 } 
else {
    echo "<p>Click <a href=\"login.php\">here</a> to log in.</p>";
}
?>
</body>
</html>