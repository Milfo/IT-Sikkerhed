<?php
 
session_start();
 
$_SESSION = array();
 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
 
session_destroy();
?>
<html>
<head>
<title>Logout</title>
</head>
<body>
<p>You are now logged out.</p>
<p>Click <a href="login.php">here</a> to log in.</p>
</body>
</html>