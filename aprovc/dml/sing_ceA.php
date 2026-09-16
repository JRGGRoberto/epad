<?php

require '../../vendor/autoload.php';
use App\Entity\Vinculo;
use App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json_data = file_get_contents('php://input');

    $data = json_decode($json_data, true);

    // $vinc = Vinculo::get($data['id_vin']);
    $id_vinc = $data['id_vin'];
    $user_id = $data['id_user'];
    $toDo = $data['tpTodo'];

    //  $vinc = new Vinculo();
    $vinc = Vinculo::get($id_vinc);

    if (!$vinc instanceof Vinculo) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['message' => 'Objeto de uma instancia não esperada.']);
        exit;
    }

    // Verify se usuário é diretor de centro
    if ($user['config'] != '2') {
        $response = ['status' => 'error', 'message' => 'Operação permitida apenas para Dir Centro Area.'];
        echo json_encode($response);
        exit;
    }

    $msg = '';
    $vinc->aprov_ce_id = $user_id;
    if ($toDo == 'r') {
        $msg = 'Removido a assinatura';
        $vinc->assing_ce_remov();
    /*
    if (!$vinc->assing_ce_remov()) {
        $response = ['status' => 'error', 'message' => 'Erro ao remover assinatura.'];
        echo json_encode($response);
        exit;
    }*/
    } elseif ($toDo == 'a') {
        $msg = 'Assinado';
        if (!$vinc->assing_ce()) {
            $response = ['status' => 'error', 'message' => 'Erro ao assinar.'];
            echo json_encode($response);
            exit;
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Parametro não passado.'];
        echo json_encode($response);
        exit;
    }

    $responseData = [
        'status' => 'success',
        'message' => 'Assinado/Removido: ',
        'data' => [
            'preenchido' => $msg,
            'status' => 'Ok',
            'vinc_id' => $vinc->id,
            'tp' => $toDo,
        ],
    ];

    header('Content-Type: application/json');
    echo json_encode($responseData);
    exit;
} else {
    $response = ['status' => 'error', 'message' => 'Método de requisição inválido.'];
    echo json_encode($response);
    exit;
}
