<?php
    include('Net/SSH2.php');

    $server = "remotehostip";
    $username = "myusername";
    $password = "mypassword";
    $command = "sh migration.sh";

    $ssh = new Net_SSH2($server);
    if (!$ssh->login($username, $password)) {
        exit('Login Failed');
    }

    echo $ssh->exec($command);
?>
