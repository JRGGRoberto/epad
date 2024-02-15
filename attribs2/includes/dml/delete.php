<<<<<<< HEAD
<?php

require '../../../vendor/autoload.php';
use \App\Entity\Cargo;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

    // Captura o ID do recurso a ser excluído
    $id = $_GET["id"];

    $dis = Cargo::get($id);

     // Lógica para excluir o recurso com o ID especificado
    if(!$dis instanceof Cargo){
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
=======
<?php

require '../../../vendor/autoload.php';
use \App\Session\Login;
use \App\Entity\PADAtiv22;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

    // Captura o ID do recurso a ser excluído
    $id = $_GET["id"];

    $dis = PADAtiv22::getById($id);

     // Lógica para excluir o recurso com o ID especificado
    if(!$dis instanceof PADAtiv22){
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
>>>>>>> 1e17409070cb1a01cf336dec6f7c35e1e50bf8c2
