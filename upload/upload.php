<?php

require '../vendor/autoload.php';
use \App\Entity\Arquivo;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("upload_tmp_dir", "/home/sistemaproec/www/teste/tmp");
$tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();

// Flag que indica se há erro ou não
$erro = null;
// Quando enviado o formulário
if (isset($_FILES['arquivo']))
{
    // Configurações
    $extensoes = array(".doc", ".txt", ".pdf", ".docx", ".jpg", ".png");
    
    $caminho = "/home/sistemaproec/www/sistema/upload/uploads/";
    // Recuperando informações do arquivo
    $nome = $_FILES['arquivo']['name']; 
    $temp = $_FILES['arquivo']['tmp_name'];
    // Verifica se a extensão é permitida
    if (!in_array(strtolower(strrchr($nome, ".")), $extensoes)) {
		$erro = 'Extensão inválida';
	}
    // Se não houver erro
    if (!$erro) {
        // Gerando um nome aleatório para a imagem
        $nomeAleatorio = md5(uniqid(time())) . strrchr($nome, ".");
        // Movendo arquivo para servidor
        if (!move_uploaded_file($temp, $caminho . $nomeAleatorio))
            $erro = 'Não foi possível anexar o arquivo';
        else {
            $arq = new Arquivo();
            $arq->nome_orig = $nome;
            $arq->nome_rand = $nomeAleatorio;
            $arq->tipo = $_FILES['arquivo']['type'];
            $arq->size = $_FILES['arquivo']['size'];
            $arq->error = $_FILES['arquivo']['error'];
            $arq->cadastrar();
        }  
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
    <script type="text/javascript">
    $(function($) {
        // Definindo página pai
        var pai = window.parent.document;
        
        <?php if (isset($erro)): // Se houver algum erro ?>
        
            // Exibimos o erro
            alert('<?php echo $erro ?>');
            
        <?php elseif (isset($nome)): // Se não houver erro e o arquivo foi enviado ?>
        
            // Adicionamos um item na lista (ul) que tem ID igual a "anexos"
            $('#anexos', pai).append('<li lang="<?php echo $nomeAleatorio ?>"><?php echo $nome ?><img src="../imgs/remove.png" alt="Remover" class="remover" onclick="removeAnexo(this)" \/> </li>');
            
        <?php endif ?>
        
        // Quando enviado o arquivo
    	$("#arquivo").change(function() {	    
            // Se o arquivo foi selecionado
            if (this.value != "")
            {    
                // Exibimos o loder
                $("#status").show();
                // Enviamos o formulário
                $("#upload").submit();
            }
        });
    });
    </script>
</head>

<body>

<form id="upload" action="upload.php" method="post" enctype="multipart/form-data">
    
    <label>Arquivo: </label>
    <span id="status" style="display: none;">
      <img src="../imgs/loader.gif" alt="Enviando..." />
    </span> <br />
    <input type="file" name="arquivo" id="arquivo" accept=".doc, .txt, .pdf, .docx, .jpg, .png")/>
        
</form>

</body>
</html>