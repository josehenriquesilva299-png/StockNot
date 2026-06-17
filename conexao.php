<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "stocknot";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro ao conectar");
}

?>