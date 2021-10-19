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
    exit('Erro ao cadastrar: ' . $e->getMessage());
}
