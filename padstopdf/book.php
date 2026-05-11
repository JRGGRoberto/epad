<?php

require '../vendor/autoload.php';

use App\Entity\Outros;
use App\Entity\PADAtiv22;
use App\Entity\PADAtiv23;
use App\Entity\PADAtiv24;
use App\Entity\PADAtiv3;
use App\Entity\PADAtiv4;
use App\Entity\Vinculo;
use App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

$co = $_GET['co'];
$ano = $_GET['a'];

if (!(($user['co_id'] == $co) || ($user['config'] = 2))) {
    echo 'Apenas coordenadores ou diretores de centro de área podem executar essa função. ';
    exit;
}

function formaData($dt)
{
    return substr($dt, 8, 2).'/'.substr($dt, 5, 2).'/'.substr($dt, 0, 4);
}

function modal($mo)
{
    switch ($mo) {
        case '10':
            return 'Médico';
            break;
        case '20':
            return 'Doutorado';
            break;
        case '21':
            return 'Mestrado';
            break;
        case '22':
            return 'Pós-Doutorado';
            break;
    }
}

function tipo1($t)
{
    switch ($t) {
        case 't':
            return 'Total';
            break;
        case 'p':
            return 'Parcial';
            break;
    }
}

function gerarPad($id)
{
    $vinc = Vinculo::get($id);
    $where = ' vinculo = "'.$vinc->id.'" ';
    $sql = 'select * from pad21d where '.$where.' order by atividade, disciplina';
    $pad21 = Outros::qry($sql);
    $pad22 = PADAtiv22::get($where);
    $pad23 = PADAtiv23::get($where);
    $pad24 = PADAtiv24::get($where);

    $pad3 = PADAtiv3::get($where);
    $pad4 = PADAtiv4::get($where);

    include __DIR__.'/includes/body1.php';
    include __DIR__.'/includes/pad1.php';

    include __DIR__.'/includes/pad21.php';

    try {
        if (count($pad22) > 0) {
            include __DIR__.'/includes/pad22.php';
        } else {
            $total22 = 0;
        }
    } catch (Throwable $t) {
        $total22 = 0;
        echo 'Erro no geração do PAD nº '.$x.' Etapa 2.2<br>';
    } finally {
    }

    try {
        if (count($pad23) > 0) {
            include __DIR__.'/includes/pad23.php';
        } else {
            $total23 = 0;
        }
    } catch (Throwable $t) {
        $total23 = 0;
        echo 'Erro no geração do PAD nº '.$x.' Etapa 2.3<br>';
    } finally {
    }

    try {
        if (count($pad24) > 0) {
            include __DIR__.'/includes/pad24.php';
        } else {
            $total24 = 0;
        }
    } catch (Throwable $t) {
        $total24 = 0;
        echo 'Erro no geração do PAD nº '.$x.' Etapa 2.4<br>';
    } finally {
    }

    try {
        if (count($pad3) > 0) {
            include __DIR__.'/includes/pad3.php';
        } else {
            $total3 = 0;
        }
    } catch (Throwable $t) {
        $total3 = 0;
        echo 'Erro no geração do PAD nº '.$x.' Etapa 3<br>';
    } finally {
    }

    try {
        if (count($pad4) > 0) {
            include __DIR__.'/includes/pad4.php';
        } else {
            $total4 = 0;
        }
    } catch (Throwable $t) {
        $total4 = 0;
        echo 'Erro no geração do PAD nº '.$x.' Etapa 4<br>';
    } finally {
    }

    include __DIR__.'/includes/pad5.php';
    include __DIR__.'/includes/pad6.php';
    include __DIR__.'/includes/pad7.php';
    include __DIR__.'/includes/footer1.php';
}

$w = "co_id = '".$co."' and  ano = '".$ano."' ";
$o = ' nome ';
$pads = Vinculo::gets($w, $o);

include './includes/hea1.php';

$x = 0;
$totalPDS = count($pads);

foreach ($pads as $pa) {
    echo 'PAD ['.++$x.'/'.$totalPDS.']<hr>';
    gerarPad($pa->id);
}
echo '<hr>Fim de arquivo: '.$x.' geradis de '.$totalPDS;
include __DIR__.'/includes/fim.php';

/***
use Dompdf\Dompdf;
$dompdf = new Dompdf(['enable_remote' => true]);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("documento.pdf", array("Attachment" => false));
//$dompdf->stream("meu_pad.pdf");
*/
