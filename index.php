<?php
    session_start();
    $connection = ssh2_connect($_SESSION['ip'], 22);
    ssh2_auth_password($connection, $_SESSION['user'], $_SESSION['pass']);

    $stream = ssh2_exec($connection, "who");

    $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);

    stream_set_blocking($errorStream, true);
    stream_set_blocking($stream, true);

    $str = stream_get_contents($stream); 
    $str_arr = explode (")", $str);

    fclose($errorStream);
    fclose($stream);

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

    <h1>เครื่องที่เชื่อมทั้งหมด : <?= count($str_arr) - 1 ?></h1>
    <table>
        <thead>
            <tr>
            <th>client</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($str_arr as $row) :
            ?>
                <tr>
                    <td><?= $row ?></td>
                </tr>
            <?php 
                endforeach;
            ?>
        </tbody>
    </table>

    <form method="post">
            <input type="text" name="exe" placeholder="Execute"><br>
            <button type="submit" name="submit"> execute </button>
    </form>
    <?php 
        if(isset($_POST['submit'])){
            $exe = $_POST['exe'];

            $stream = ssh2_exec($connection, $exe);

                    
            stream_set_blocking($stream, true);
            
            while (ob_get_level() > 0) {

                ob_end_clean();
                
            }

            sleep(1);
            
            while($line = fgets($stream)) {
            
                echo $line . "<br>";
                
            }
        }
    ?>

</body>
</html>