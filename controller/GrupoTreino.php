<?php
    require_once('../model/GrupoExistenteDAO.php');
    //require_once('../model/userDAO.php');
  
    
    $userDAO = new UserDAO();

    $consulta = new GrupoExistenteDAO();

    $resultado = $consulta->ConsultaGrupoExist();

    // Envie os resultados como JSON
    header('Content-Type: application/json');
    return json_encode($resultado);

?>