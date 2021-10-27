<?php

class Response
{
  public $success;

  function __construct($success)
  {
    $this->success = $success;
  }
}

require "../conectaMySQL.php";
$pdo = mysqlConnect();

$codigo = $nome = $sexo = $email = $telefone = "";
$cep = $logradouro = $cidade = $estado = "";
$dataContrato = $salario = $senha = "";
$especialidade = $crm = "";

//Pessoa
if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];
//Funcionário
if (isset($_POST["contrato"])) $dataContrato = $_POST["contrato"];
if (isset($_POST["salario"])) $salario = $_POST["salario"];
if (isset($_POST["senhaFunc"])) $senha = $_POST["senhaFunc"];
//Médico
if (isset($_POST["especialidade"])) $especialidade = $_POST["especialidade"];
if (isset($_POST["crm"])) $crm = $_POST["crm"];

$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

try {
  $sql = <<<SQL
    SELECT codigo FROM pessoa ORDER BY codigo DESC limit 1  
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha durante a execução desse comando: ' . $e->getMessage());
}

while ($row = $stmt->fetch()) {                                    
  $codigo = $row['codigo']+10;
}

$sql1 = <<<SQL
  INSERT INTO pessoa (codigo, nome, sexo, email, telefone, 
                       cep, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO funcionario 
    (codigo, dataContrato, salario, senhaHash)
  VALUES (?, ?, ?, ?)
  SQL;

  $sql3 = <<<SQL
  INSERT INTO medico 
    (codigo, especialidade, crm)
  VALUES (?, ?, ?)
  SQL;

try {

  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $codigo, $nome, $sexo, $email, $telefone,
    $cep, $logradouro, $cidade, $estado
  ])) throw new Exception('Erro na primeira inserção');

  $idNovoFunc = $pdo->lastInsertId();
  $stmt2 = $pdo->prepare($sql2);
  if (!$stmt2->execute([
    $codigo, $dataContrato, $salario, $hashsenha
  ])) throw new Exception('Erro na segunda inserção');

    if(!($especialidade=='' && $crm == '')) {
       $idNovoMed = $pdo->lastInsertId();
       $stmt3 = $pdo->prepare($sql3);
      if (!$stmt3->execute([
        $codigo, $especialidade, $crm
      ])) throw new Exception('Erro na terceira inserção');

    } 

  $pdo->commit();

  header("location: index.html");
  exit();


  $response = new Response(true);
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Erro! Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());

  $response = new Response(false);
}


echo json_encode($response);
?>