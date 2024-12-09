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

    $id_vinc = $data['id_vin'];
 
    //  $vinc = new Vinculo();
    $vinc = Vinculo::get($id_vinc);
    
    

    if(!$vinc instanceof Vinculo){
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("message" => "Objeto de uma instancia não esperada."));
        exit;
    }

    // Verify se usuário é coordenador 
  
    if($user['config'] != '1'){
        $response = array("status" => "error", "message" => "Não adm.");
        echo json_encode($response);
        exit;
    }
  
    
    if(!$vinc->assing_co_remove()){
        $response = array("status" => "error", "message" => "Erro ao assinar.");
        echo json_encode($response);
        exit;
    } else {
        $responseData = array( 
            "status" => "success",
            "message" => "Dados recebidos com sucesso.",
            "data" => array (
                "preenchido"  => 'Assinatura removida' ,
                "status"      => 'Ok',
                "vinc_id" =>   $vinc->id,
                "tp" => 'r'
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

?>
