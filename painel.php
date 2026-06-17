<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.html");

}

?>

<h1>
    Bem vindo,
    <?php echo $_SESSION['nome']; ?>
</h1>