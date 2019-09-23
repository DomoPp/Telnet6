<?php
    session_start();
    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $pass = $_POST['password'];

        $connection = ssh2_connect($_SESSION['ip'], 22);
        if (ssh2_auth_password($connection, $user, $pass)) {

            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            
            echo "<script>
                    if(confirm('Authentication Successful!')){
                        location.replace('index.php');
                    }
                </script>";
            } else {
            echo "<script>
                    if(confirm('Authentication Unsuccessful!')){
                        
                    }
                </script>";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" >
        <input type="text" name="user"><br>
        <input type="password" name="password"><br>
        <input type="submit" name="login" value="login">
    
    </form>
</body>
</html>
