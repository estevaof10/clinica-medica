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
  
  function codigo($especialidade, $medico){
    $pdo = mysqlConnect();
    $sql = <<<SQL
          SELECT m.codigo, m.especialidade
          FROM medico m, pessoa p 
          WHERE p.nome = ? 
          AND m.codigo = p.codigo
          SQL;
    try {
      
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$medico]);
    } 
    catch (Exception $e) {
      exit('Ocorreu uma falha durante a execução desse comando: ' . $e->getMessage());
    }
    
    $codigo = '';
    while($row = $stmt->fetch()) {
      if($especialidade == $row['especialidade']);{
        $codigo = htmlspecialchars($row['codigo']);
        return $codigo;
      }
    }
  }

  $especialidade = $medico = '';
  $data = $horario = '';
  $nome = $email = $sexo = '';

  if (isset($_POST["especialidade"])) $especialidade = $_POST["especialidade"];
  if (isset($_POST["medico"])) $medico = $_POST["medico"];
  if (isset($_POST["data"])) $data = $_POST["data"];
  if (isset($_POST["hora"])) $horario = $_POST["hora"];
  if (isset($_POST["nome"])) $nome = $_POST["nome"];
  if (isset($_POST["email"])) $email = $_POST["email"];
  if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];

  $codigo = codigo($especialidade, $medico);

  try {

    $sql = <<<SQL
    
    INSERT INTO agenda(data_agenda, horario, nome, sexo, email, codigoMedico)
    VALUES (?, ?, ?, ?, ?, ?)
    SQL;
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $data, $horario, $nome, $sexo, $email, $codigo
    ]);
    
    $response = new Response(true);
  } 
  catch (Exception $e) {  
      exit('Ocorreu uma falha durante a tentativa de cadastrar os dados: ' . $e->getMessage());
      $response = new Response(false);
  }
  
    echo json_encode($response);
?>