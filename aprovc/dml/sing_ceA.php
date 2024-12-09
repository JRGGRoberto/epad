<?php
require '../../vendor/autoload.php';
use \App\Entity\Vinculo;

use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");

    $data = json_decode($json_data, true); 

    $vinc = Vinculo::get($data['id_vin']);

    if(!$vinc instanceof Vinculo){
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("message" => "Objeto de uma instancia não esperada."));
        exit;
    }

    // Verify se usuário é diretor de centro
    if($user['config'] != '2'){
        $response = array("status" => "error", "message" => "Operação permitida apenas para Dir Centro Area.");
        echo json_encode($response);
        exit;
    }
    
    $vinc->aprov_ce_id = $user['id'];

    if(!$vinc->assing_ce()){
        $response = array("status" => "error", "message" => "Erro ao assinar.");
        echo json_encode($response);
        exit;
    } else {
        $responseData = array( 
            "status" => "success",
            "message" => "Assinado.",
            "data" => array (
                    "preenchido" => 'Assinado' ,
                    "status"     => 'Ok',
                    "vinc_id"    =>  $vinc->id,
                    "tp"         => 'a'
                )
            );
            
            header('Content-Type: application/json');
            echo json_encode($responseData);
            exit;
    }
} else {   
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
