<?php

require '../../vendor/autoload.php';
use \App\Entity\Disciplinas;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 
     
    $dis = new Disciplinas();
    $dis =  $dis::getById($data['id_dis']);
    $dis->vinculo       = $data["id_prof"];
    $dis->vinclogchuser = $user['id'];
    if(!$dis->atribuir()){
        $response = array("status" => "error", "message" => "Método de requisição inválido 2.");
        echo json_encode($response);
        exit;
    }
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id"        => $dis->id, 
            "nome"      => $dis->nome,
            "ch"        => $dis->ch,
            "serie"     => $dis->serie,
            "idx"       => $data["idx"],
            "cpf"       => '094',
            "status"    => 'Super sucesso!'
            )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
