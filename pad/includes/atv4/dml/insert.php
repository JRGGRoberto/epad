<?php
require '../../../../vendor/autoload.php';
use \App\Entity\PADAtiv4;

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    if($data["id4"] != '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    $pad = new PADAtiv4;
    $pad->vinculo      = $data["vinc4"];
    $pad->cargo        = $data["cargo4"];
    $pad->alocado      = $data["alocado4"];
    $pad->numdata      = $data["numdata4"];
    $pad->ch           = $data["cargah4"];
    $pad->user         = $user["id"];

   
    $id = $pad->add();

    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id4"          => $id,
            "cargo4"       => $pad->cargo,
            "alocado4"     => $pad->alocado,
            "numdata4"     => $pad->numdata,
            "cargah4"      => $pad->ch
            )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
