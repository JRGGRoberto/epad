<?php

require '../../../vendor/autoload.php';
use \App\Entity\PADAtiv22;
use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    if($data["id22"] == '' or $data["idx22"] == '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }
    
    $dis = PADAtiv22::getById($data["id22"]);
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
            "idx"       => $data["idx22"],
            "vinculo"   => $dis->vinculo,
            "atividade" => $dis->atividade,
            "estudante" => $dis->estudante,
            "curso"     => $dis->curso,
            "serie"     => $dis->serie,
            "ch"        => $dis->ch
           )
        );
    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
