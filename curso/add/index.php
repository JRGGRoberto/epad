<?php
// Verifica se a requisição foi feita usando o método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $avatar = $_POST["avatar"];
    

    $response = array("status" => "success", "message" => "Dados recebidos com sucesso.");
    echo json_encode($response);
} else {

    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
