<?php 
    session_start();

    if(isset($_POST['connect'])){
        $ip = $_POST['ip'];
        $connection = ssh2_connect($ip, 22);
        if($connection){
            
            $_SESSION['ip'] = $ip;

            echo "<script>
                    if(confirm('is connected')){
                        location.replace('login.php');
                    }
            </script>";
        }
        else{
            echo    "<script>
                        alert('Is\'t connected)
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
    <form method="POST">
        <input type="text" name="ip">
        <input type="submit" name="connect" value="Connect">
    </form>
</body>
</html>