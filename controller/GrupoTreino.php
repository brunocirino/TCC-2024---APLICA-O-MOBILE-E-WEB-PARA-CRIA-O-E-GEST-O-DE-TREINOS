<?php
    require_once('../model/GrupoExistenteDAO.php');
    require_once('../model/userDAO.php');
  
    
    $userDAO = new UserDAO();

    $consulta = new GrupoExistenteDAO();

    $resultado = $consulta->ConsultaGrupoExist();

    header('Content-Type: application/json');

    // Envie os resultados como JSON
    echo trim(json_encode($resultado));

?>