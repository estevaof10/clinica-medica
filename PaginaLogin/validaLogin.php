<?php

require_once "../conectaMySQL.php";
require_once "../PaginaLogin/autentica.php";
session_start();

class RequestResponse
{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect();//
if ($senhaHash = checkPassword($pdo, $email, $senha)) {

  $_SESSION['emailUsuario'] = $email;
  $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);  

  try {

    $sql = <<<SQL
    SELECT p.email, p.codigo
    FROM medico m, pessoa p
    WHERE p.codigo = m.codigo
    SQL;

    $stmt = $pdo->query($sql);
  } 
  catch (Exception $e) {
      exit('Ocorreu uma falha: ' . $e->getMessage());
  }
  $result_ok = '';
  $emails = '';
  $emailLog = '';
  $emailLog = $_SESSION['emailUsuario'];
  while ($row = $stmt->fetch()) {                                    
    $emails = htmlspecialchars($row['email']);              
    if($emails == $emailLog){ 
      $result_ok = true;
    }
  }
  
  if($result_ok == true){
  $response = new RequestResponse(true, 'PaginaHomeRestrita/index.php');
  }else{
    $response = new RequestResponse(true, 'PaginaHomeRestrita/index.php'); 
  }
} 
else
  $response = new RequestResponse(false, ''); 

echo json_encode($response);
?>