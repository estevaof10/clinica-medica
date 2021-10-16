<?php

require "conectaMySQL.php";

$pdo = mysqlConnect();

$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$estado = $_POST["estado"] ?? "";
$cidade = $_POST["cidade"] ?? "";

try {

  $sql = <<<SQL
  INSERT INTO baseAjax (cep, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?)
  SQL;

  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois precisamos
  // cadastrar dados fornecidos pelo usuário 
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $cep,$logradouro, $cidade,
    $estado]);

  header("location: index.html");
  exit();
} 
catch (Exception $e) {  
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
