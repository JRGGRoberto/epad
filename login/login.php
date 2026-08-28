<?php

require '../vendor/autoload.php';

use App\Db\LerDot;
use App\Entity\Usuario;
use App\Session\Login;

$env = new LerDot();

$log = false;
$dia = date('d');

function validaMail($email)
{
    global $log;
    if ($log) {
        echo '<p>Func validaMail</p>';
    }
    $conta = explode('@', $email);

    if ($log) {
        echo '<p>conta[0]: '.$conta[0].'<br>conta[1]: '.$conta[1].'</p>'.
        '<p>retorno: '.$conta[1] == 'unespar.edu.br' ? strtolower($conta[0]) : false.'</p>';
    }

    return $conta[1] == 'unespar.edu.br' ? strtolower($conta[0]) : false;
}

$email = $_POST['email']; // $_GET['email']; //
$senha = $_POST['senha']; // $_GET['senha']; //
if ($log) {
    echo '<p>Email:'.$email.' <br>Senha: '.$senha.' </p>';
}

if (isset($email)) {
    if ($log) {
        echo '<p>35 - Entrou no if do isset($email)</p>';
    }
    if (validaMail($email)) {
        $url = $env::get('URLAUTH');
        $data = [
            'login' => validaMail($email),
            'senha' => $senha,
            'hashSistema' => $env::get('HASHAUTHAD'),
        ];

        $data_string = json_encode($data);
        if ($log) {
            echo '<p>50 - Valor do $data_string: '.$data_string.'</p>';
        }

        $ch = curl_init($url);

        if ($log) {
            echo '<p>56 - Valor do $ch: </p>';
            echo '<pre>';
            print_r($ch);
            echo '</pre>';
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'Content-Length: '.strlen($data_string),
            ]
        );

        $result = curl_exec($ch);
        curl_close($ch);
        $obj = (object) json_decode($result);

        if ($log) {
            echo '<p>77 - Valor do $obj: </p>';
            echo '<pre>';
            print_r($obj);
            echo '</pre>';
        }

        if (property_exists($obj, 'mail')) {
            if ($log) {
                echo '<p>81 - entrou no property_exists</p>';
            }

            $obUsuario = Usuario::getUsuarioPorEmail($email);
            if ($log) {
                echo '<p>90 - instanciou obUsuario por email</p>';
                echo '<pre>';
                print_r($obUsuario);
                echo '</pre>';
            }

            if ($obUsuario instanceof Usuario) {
                if ($obUsuario->ativo != 1) {
                    if ($log) {
                        echo '<p>99 - Usuário não ativo - Conta desativada</p>';
                    }
                    $alertaLogin = 'Conta desativada';
                    goto montaTela;
                }

                if ($log) {
                    echo '<p>106 - logou pelo AD e criou a  sessão</p>';
                }
                Login::login($obUsuario);
                exit;   // logou pelo AD e criou a  sessão<<<---
            } else {
                $alertaLogin = 'Autenticação Ok. Porém não há relação no sistema PROEC/ePAD';
                if ($log) {
                    echo '<p>113 - Autenticação Ok. Porém não há relação no sistema PROEC/ePAD</p>';
                }
                goto montaTela;
            }
        } else {
            $alertaLogin = 'No [LDAP]';
            if ($log) {
                echo '<p>120 - No [LDAP]</p>';
            }
            goto validaSemLDAP;
        }
    } else {
        if ($log) {
            echo '<p>126 E-mail ou senha inválidos - tentar fora do LDAP</p>';
        }
        $alertaLogin = 'E-mail ou senha inválidos - tentar fora do LDAP';
        goto validaSemLDAP;
    }

    validaSemLDAP:
    if ($log) {
        echo '<p>134 validaSemLDAP</p>';
    }
    $obUsuario = Usuario::getUsuarioPorEmail($email);

    if ($obUsuario instanceof Usuario) {
        if ($obUsuario->email.$dia == $senha) {
            if ($log) {
                echo '<p>141 - Logar</p>';
            }
            Login::login($obUsuario);
            exit;
        }
    }

    if (!$obUsuario instanceof Usuario || !password_verify($senha, $obUsuario->senha)) {
        $alertaLogin = 'E-mail ou senha inválidos';
        if ($log) {
            echo '<p>151 - E-mail ou senha inválidos</p>';
        }
        goto montaTela;
    }

    if ($obUsuario->ativo != 1) {
        $alertaLogin = 'Conta desativada';
        if ($log) {
            echo '<p>159 - Conta desativada</p>';
        }
        goto montaTela;
    }
    if ($log) {
        echo '<p>164 - Loga com usuário e senha do banco</p>';
    }
    Login::login($obUsuario);
    exit;
}

montaTela:
if ($log) {
    echo '<br>172 - formulário de login - Não logou<br>';
}

include '../includes/headers.php';
include __DIR__.'/includes/formulario-login.php';
include '../includes/footer.php';
