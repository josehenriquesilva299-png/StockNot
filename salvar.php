<?php

include("conexao.php");

$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$minimo = $_POST['minimo'];

$sql = "INSERT INTO stock
(nome, quantidade, minimo)
VALUES
('$nome', '$quantidade', '$minimo')";

mysqli_query($conexao, $sql);

header("Location: Stock.php");
exit;

?>