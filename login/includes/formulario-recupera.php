<?php 
  $alertaLogin  = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>': '';
  $alertaCadastro = strlen($alertaCadastro) ? '<div class="alert alert-danger">'.$alertaCadastro.'</div>': '';
?>
<p></p>
<div class="jumbotron text-dark">

  <div class="row">

    <div class="col">




    <h2>Recuperação de senha</h2>
    <form method="post"  action="./valida.php">
    <div id="formCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <div class="carousel-inner">
        <!-- Primeiro grupo de perguntas -->
        <div class="carousel-item active">
            <div class="container mt-5">
                <h4>Validação de dados 1</h4>
                
                    <div class="form-group">
                        <label for="firstname">Primeiro nome</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Digite sua resposta" onkeypress="noEnter(event)">
                    </div>
                    <div class="form-group">
                        <label for="email">e-Mail cadastrado</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Digite sua resposta" onkeypress="noEnter(event)">
                    </div>
                    <button class="btn btn-primary next-slide" type="button">Próximo</button>
                
            </div>
        </div>

        <!-- Segundo grupo de perguntas -->
        <div class="carousel-item">
            <div class="container mt-5">
                <h4>Validação de dados 2</h4>
                
                    <div class="form-group">
                        <label for="ca">Campus</label>
                        
                        <select name="ca" id="ca" class="form-control" required="">
                               <option value="987456">Selecione</option>
                               <option value="1836d055-39eb-11ed-9793-0266ad9885bf">Angra</option>
                               <option value="1832d052-39eb-11ed-9793-0266ad9885af">Apucarana</option>
                               <option value="1832e5f1-39eb-11ed-9793-0266ad9885af">Campo Mourão</option>
                               <option value="1832e881-39eb-11ed-9793-0266ad9885af">Curitiba I (EMBAP)</option>
                               <option value="1832e953-39eb-11ed-9793-0266ad9885af">Curitiba II (FAP)</option>
                               <option value="1832e9c1-39eb-11ed-9793-0266ad9885af">Paranaguá</option>
                               <option value="1832ea24-39eb-11ed-9793-0266ad9885af">Paranavaí</option>
                               <option value="1832ea24-39eb-31ed-9793-0266ad8887af">Guanabara</option>
                               <option value="1832ea89-39eb-11ed-9793-0266ad9885af">União da Vitória</option>
                               <option value="1832ea89-39eb-11eb-9793-0266ad7785af">Paraty</option>
                               <option value="1832ea89-39eb-11eb-9793-0266ad7785at">Paquetá</option>
                               <option value="bf5bbf93-bfa4-11ee-801b-0266ad9885af">Loanda</option>
                        </select>
                        

                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF <span class="badge badge-light">digite só os números</span></label>
                        <a href="#" data-toggle="tooltip" title="Informe apenas os números" 
          style="text-decoration:none;"><input type="text" class="form-control" name="cpf" id="cpf" maxlength="11" 
           onfocusout="valCPF()"
           onkeypress="noEnter(event)"></a>

           
                    </div>
                    <button class="btn btn-secondary prev-slide" type="button">Anterior</button>
                    <button class="btn btn-primary next-slide" type="button">Próximo</button>
                
            </div>
        </div>

        <!-- Terceiro grupo de perguntas -->
        <div class="carousel-item">
            <div class="container mt-5">
                <h4>Validação de dados 3</h4>
                
                    <div class="form-group">
                        <label for="lastname">Último nome</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite sua resposta" onkeypress="noEnter(event)">
                    </div>
                    <div class="form-group">
                        <label for="address">Segurança </label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php
                                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                } else {
                                    $ip = $_SERVER['REMOTE_ADDR'];
                                }
                        echo $ip; 
                        echo ' - ';
                        echo date("d-m-Y h:i:sa");
                        echo ' - [';
                        echo $_SERVER['HTTP_USER_AGENT'];
                        echo ']  ';
                        
                        ?> " readonly >
                        



                    </div>
                    <button class="btn btn-secondary prev-slide" type="button">Anterior</button>
                    <button class="btn btn-success" type="submit">Enviar</button>
                
            </div>
        </div>
    </div>
</div>
</form>

<script>
    // JavaScript para navegação entre os slides
    document.querySelectorAll('.next-slide').forEach(button => {
        button.addEventListener('click', () => {
            $('#formCarousel').carousel('next');
        });
    });

    document.querySelectorAll('.prev-slide').forEach(button => {
        button.addEventListener('click', () => {
            $('#formCarousel').carousel('prev');
        });
    });

    function formatarCPF(cpf){   
      var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}))$/;     
      cpf = cpf.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
      cpf = cpf.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
      //de novo (para o segundo bloco de números)
      cpf = cpf.replace( /(\d{3})(\d{1,2})$/ , "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
    			    
      return cpf;
    }

    function valCPF(){
      let cpf = document.getElementById("cpf");
      cpf.value = formatarCPF(cpf.value);
    }


    function noEnter(e){
        if(e.keyCode === 13){
            return e. preventDefault();;
            console.log('teste enter');
        }
    }
</script>

    </div>

  </div>

</div>