<?php
    session_start();

    if(!(isset($_SESSION['auth'])) || ($_SESSION['auth'] != 'admin' && $_SESSION['auth'] != 'leader' && $_SESSION['auth'] != 'student')){
        header('Location: ./login/');
    }
    else{
        header('Location: ./dashboard/');
    }
?>