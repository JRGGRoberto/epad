<?php

require '../../../../vendor/autoload.php';
use \App\Entity\PADAtiv4;

use \App\Session\Login;
Login::requireLogin();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

    // Captura o ID do recurso a ser excluído
    $id = $_GET["id"];

    $dis = PADAtiv4::getById($id);

    // Lógica para excluir o recurso com o ID especificado
    if(!$dis instanceof PADAtiv4){
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("message" => "Objeto de uma instancia não esperada."));
        exit;
      }
    
    // Responde com o ID do recurso excluído
    if ($dis->excluir()) {
        header("HTTP/1.1 200 OK");
        echo json_encode(
            array(
            "message" => "Recurso com ID $id foi excluído com sucesso!.", 
            "id" => $id)
        );
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("message" => "Erro ao excluir o recurso."));
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(array("message" => "Método de requisição inválido. Apenas DELETE é permitido."));
}

?>
