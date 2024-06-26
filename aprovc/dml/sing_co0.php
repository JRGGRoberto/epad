<?php
require '../../vendor/autoload.php';
use \App\Entity\Vinculo;

use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");

    $data = json_decode($json_data, true); 

    $to_do = $data['to_do'];
    $id_vinc = $data['id_vin'];
    $user_id = $data['id_user'];

 
    $vinc = new Vinculo();
    $vinc = Vinculo::get($id_vinc);
    

    if(!$vinc instanceof Vinculo){
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("message" => "Objeto de uma instancia não esperada."));
        exit;
      }

    $vinc->aprov_co_id = null;  
    $vinc->aprov_co_data = null;  
    
    /*

    if($to_do == 'd'){
        $vinc->aprov_co_id = null;
   } else {
        $response = array("status" => "error", "message" => "Tipo não reconhecido");
        echo json_encode($response);
        exit;
    }
    */
    if(!$vinc->assing_co()){
        $response = array("status" => "error", "message" => "Erro ao assinar.");
        echo json_encode($response);
        exit;
    }

    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "preenchido"  => 'DESassinado',
            "status"      => 'Ok',
            "to_do"       => $to_do
            )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}



?>
