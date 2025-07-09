<?php

require '../vendor/autoload.php';

use App\Entity\Usuario;
use App\Session\Login;

function validaMail($email)
{
    $conta = explode('@', $email);

    return $conta[1] == 'unespar.edu.br' ? strtolower($conta[0]) : false;
}

if (isset($_POST['email'])) {
    if (validaMail($_POST['email'])) {
        $url = 'https://aut.unespar.edu.br/ws/autenticar/post/';
        $data = [
            'login' => validaMail($_POST['email']),
            'senha' => $_POST['senha'],
            'hashSistema' => '2f1b19468e9e4a9756e62d892045c89a5a08a06d',
        ];

        $data_string = json_encode($data);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: '.strlen($data_string),
        ]
        );

        $result = curl_exec($ch);
        curl_close($ch);
        $obj = (object) json_decode($result);

        if (property_exists($obj, 'mail')) {
            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
            if ($obUsuario instanceof Usuario) {
                if ($obUsuario->ativo != 1) {
                    $alertaLogin = 'Conta desativada';
                    goto montaTela;
                }
                Login::login($obUsuario);
                exit;   // logou pelo AD e criou a  sessão<<<---
            } else {
                $alertaLogin = 'Autenticação Ok. Porém não há relação no sistema PROEC/ePAD';
                goto montaTela;
            }
        } else {
            $alertaLogin = 'No [LDAP]';
            goto validaSemLDAP;
        }
    } else {
        $alertaLogin = 'E-mail ou senha inválidos - tentar fora do LDAP';
        goto validaSemLDAP;
    }

    validaSemLDAP:
    $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

    if (!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)) {
        $alertaLogin = 'E-mail ou senha inválidos';
        goto montaTela;
    }

    if ($obUsuario->ativo != 1) {
        $alertaLogin = 'Conta desativada';
        goto montaTela;
    }
    Login::login($obUsuario);
}

montaTela:
include '../includes/headers.php';
include __DIR__.'/includes/formulario-login.php';
include '../includes/footer.php';
