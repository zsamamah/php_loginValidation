<?php

    session_start();
    session_unset();
    session_destroy();

    echo "<a href='index.php'>index now</a>"

?>