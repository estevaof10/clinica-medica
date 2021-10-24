<?php

  function checkPassword($pdo, $email, $senha)
  {
    $sql = <<<SQL
      SELECT funcionario.senhaHash
      FROM funcionario, pessoa
      WHERE pessoa.email = ?
      SQL;

    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$email]);
      $senhaHash = $stmt->fetchColumn();

      if (!$senhaHash) 
        return false;

      if (!password_verify($senha, $senhaHash))
        return false;
        
      return $senhaHash;
    } 
    catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  function checkLogged($pdo)
  {

    if (!isset($_SESSION['emailUsuario'], $_SESSION['loginString']))
      return false;

    $email = $_SESSION['emailUsuario'];

    $sql = <<<SQL
      SELECT funcionario.senhaHash
      FROM funcionario, pessoa
      WHERE pessoa.email = ?
      SQL;

    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$email]);
      $senhaHash = $stmt->fetchColumn();
      if (!$senhaHash) 
        return false;

      $loginStringCheck = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
      if (!hash_equals($loginStringCheck, $_SESSION['loginString']))
        return false;

      return true;
    } 
    catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  function exitWhenNotLogged($pdo)
  {
    if (!checkLogged($pdo)) {
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
      $emails = '';
      
      while ($row = $stmt->fetch()) {                                    
        $emails = htmlspecialchars($row['email']);              

        if($emails == $_SESSION['emailUsuario']){ 
                
          header("Location: ListagemAgendMed/index.php");
          exit();          
        }else{
          header("Location: PaginaHomeRestrita/index.php");
          exit(); 
        } 
      }

    }
  }
?>