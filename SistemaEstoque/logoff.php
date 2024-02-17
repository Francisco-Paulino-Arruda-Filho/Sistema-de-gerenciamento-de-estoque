<?php
    session_start();
    print_r($_SESSION);
    unset($_SESSION);
    session_destroy();
    header('Location: index.php');
?>