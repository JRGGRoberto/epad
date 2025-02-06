<?php
require '../../vendor/autoload.php';
use \App\Entity\Vinculo;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $vinc_idps = $data['vinc_idps'];
    $observacao = $data['observacao'];

    // Recuperar o vínculo e adicionar a observação
    $vinc = Vinculo::get($vinc_idps);

    if(!$vinc instanceof Vinculo) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("message" => "Objeto de uma instância não esperada."));
        exit;
    }

    // Aqui você precisa adicionar a lógica para salvar a observação no banco de dados.
    // Por exemplo, adicionar a observação em uma coluna 'observacoes' na tabela 'vinculov'
    $vinc->obscoord = $observacao;
    if($vinc->edtObs()) {
        $response = array("status" => "success", "message" => "Observação adicionada com sucesso.");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Erro ao adicionar observação.");
        echo json_encode($response);
    }

} else {
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
