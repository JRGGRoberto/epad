<?php
require '../../../vendor/autoload.php';
use \App\Entity\PADAtiv22;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    if($data["id"] == '' or $data["idx"] == '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    
    $dis = PADAtiv22::getById($data["id"]);
    $dis->vinculo   = $data["vinc22"];
    $dis->atividade = $data["tpAtiv22"];
    $dis->estudante = $data["nome22F"];
    $dis->curso     = $data["curso22F"];
    $dis->serie     = $data["serie22F"];
    $dis->ch        = '1';
    $dis->user      = $user['id'];

    if(!$dis->atualizar()){
        $response = array("status" => "error", "message" => "Método de requisição inválido 2.");
        echo json_encode($response);
        exit;
    }
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id"        => $dis->id, 
            "idx"       => $data["idx"]
           )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
