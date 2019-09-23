<?php
session_start();
$connection = ssh2_connect($_SESSION['ip'], 22);
ssh2_auth_password($connection, 'root', '111111');
// Run a command that will probably write to stderr (unless you have a folder named /hom)
$stream = ssh2_exec($connection, "who");

$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);

// Enable blocking for both streams
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);

// Whichever of the two below commands is listed first will receive its appropriate output.  The second command receives nothing
// print_r(stream_get_contents($stream));

$str = stream_get_contents($stream); 
$str_arr = explode (")", $str);

// foreach ($str_arr as $row) {
//     echo $row;
// }
// print_r($str_arr); 

// Close the streams       
fclose($errorStream);
fclose($stream);

?>
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