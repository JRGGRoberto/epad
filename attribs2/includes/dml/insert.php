<?php

require '../../../vendor/autoload.php';
use \App\Entity\PADAtiv22;

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    if(isset($_POST['listaFunc'])){
        echo $_POST['listaFunc'];
        echo '<br>';
        echo $_POST['listaProf'];
        echo '<br>';
        echo $_POST['ano'];
        echo '<br>';
        echo $_POST['co'];
        header('location: ..');
        exit; 
      
    } /*
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    /*
    if($data["id3"] != '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }*/

    $pad = new PADAtiv22;
    $pad->vinculo      = $data["vinculo"];
    $pad->estudante    = $data["estudante"];
    $pad->curso        = $data["curso"];
    $pad->atividade    = $data["atividade"];
    $pad->id_co        = $data["id_co"];
    $pad->serie        = $data["serie"];
    $pad->ch           = $data["ch"];
    $pad->user         = $user["id"];

    $id = $pad->add();
    $pad = PADAtiv22::getById($id);

    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => $pad
        /*
        array (
            "id"        => $id,
            "vinculo"   => $pad->vinculo,
            "atividade" => $pad->atividade,
            "estudante" => $pad->estudante,
            "id_co"     => $pad->id_co,
            "serie"     => $pad->serie,
            "ch"        => $pad->ch,
            "orientador"  => $pad->ch,
            "codcam_orientador"=>  "ap",
            "codcentro_orientador"=>  "CCHE",
            "colegiado_orientador"=> "Legal"
            )*/
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
} 
?>
