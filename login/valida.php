<?php 

require '../vendor/autoload.php';

use \App\Db\Database;
use \App\Entity\Professor;


if(!isset($_POST['firstname'])){
    header('location: ../');
    exit;
}
  

  strlen($_POST['firstname']) ? $firstname = $_POST['firstname'] : $firstname = '1';
  strlen($_POST['lastname'])  ? $lastname  = $_POST['lastname']  : $lastname  = '1';
  strlen($_POST['email'])     ? $email     = $_POST['email']     : $email     = '1';
  strlen($_POST['cpf'])       ? $cpf       = $_POST['cpf']       : $cpf       = '1';
  strlen($_POST['ca'])        ? $ca        = $_POST['ca']        : $ca        = '1';


$query = "
select
  p.id as id, 
  p.ativo as ativo, 
  p.nome as nome
from 
  userprof p
  inner join ca_ce_co ccc 
     on p.id_colegiado  = ccc.co_id 
where 
  p.nome like '".$firstname." %'
  and p.nome like '% ".$lastname."'
  and p.email  = '".$email."'
  and p.cpf = '".$cpf. "'
  and ccc.ca_id = '".$ca."'
";

class ValidaT{

    public $id;
    public $ativo;
    public $nome;

    public static function q($sql){
        return (new Database())->selectJ($sql)
          ->fetchObject(self::class);  
    }    
}  


$retorno = ValidaT::q($query);

$data = '';
if(!$retorno  instanceof ValidaT){
    $data = 'Os dados informados não encontraram uma relação a uma conta';
} else {
    $senha = date("sa");

    $int = (integer)date("s");
    if((integer)date("s") < 26){
        $int = (integer)date("s") + 65;
    } elseif ((integer)date("s") < 52){
        $int = (integer)date("s") + 39;
    } else {
        $int = (integer)date("s") + 26;
    }
    $senha .= chr($int);
    $senha .= date("d");
    $senha = strtoupper($senha);
    
    $obProfessor = new Professor();
    $obProfessor = $obProfessor::getProfessor($retorno ->id);
    if(!$obProfessor instanceof Professor){
        header('location: ../');
        exit;
    }

    $obProfessor->senha = password_hash($senha, PASSWORD_DEFAULT);
    $obProfessor->atualizar();

  
    if($retorno->ativo == 0){
        $data = '<p>Professor(ª) '. $retorno->nome. ', sua conta está desativada.</p><p>Pavor entre em contato com o seu coordenador de curso.</p>';
    } else {
        $data = '<p>Sua nova senha é </p><p><strong>'.$senha .'</strong></p>';
        $data .= '<p>Clique em Voltar, conecte e troque sua senha.</p>';
    }
    
}


include '../includes/header.php';

echo '  <div class="container">
           <p></p>
           <main>
                <div class="jumbotron text-dark">
                    <section>';


echo $data;

echo '<p><a href="../" class="btn btn-light btn-sm float-right">Voltar</a></p>';
echo '              </section>
                </div>
            </main>
        </div>';

clearstatcache();

include '../includes/footer.php';