<?php
// Verifica se a requisição foi feita usando o método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados do formulário
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $avatar = $_POST["avatar"];
    
    // Aqui você pode realizar as operações necessárias com os dados recebidos
    // Por exemplo, salvar os dados em um banco de dados
    
    // Responde com uma mensagem JSON indicando que os dados foram recebidos com sucesso
    $response = array("status" => "success", "message" => "Dados recebidos com sucesso.");
    echo json_encode($response);
} else {
    // Se a requisição não foi feita usando o método POST, responde com um erro
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
