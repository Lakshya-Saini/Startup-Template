<?php
	session_start();
	unset($_SESSION['email']);
    unset($_SESSION['name']);
	session_destroy();

    header('Location: login.php');
    exit();

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <script type="text/javascript">
        function preback() {
            window.history.forward();
        }
        setTimeout("preback()", 0);
        window.onunload=function() {null};
    </script>
</body>
</html>