
/*
var ca = document.querySelector("#ca");
var ce = document.querySelector("#ce");
var co = document.querySelector("#co");
*/


const pegarCA = async() => {
  const data = await fetch(`../api/ca.php`)
    .then(resp => resp.json()).catch(error => false)

  if(!data) return;

  ce.innerHTML = ``;

  inserirCA(data);
}

const inserirCA = (data) => {

  ca.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   ca.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });

  ca.addEventListener("change", e => {
    co.innerHTML = '';
    pegarCE(ca.value)
  });
  
}

const pegarCE = async (id) => {

  const data = await fetch(`../api/ce.php?ca=${id}`)
     .then(resp => resp.json()).catch(error => false)

   if(!data) return;

   inserirCE(data);

}


const inserirCE = (data) => {

  ce.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   ce.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });
  ce.addEventListener("change", e => pegarCO(ce.value))
}

const pegarCO = async (id) => {

  const data = await fetch(`../api/co.php?ce=${id}`)
     .then(resp => resp.json()).catch(error => false)

   if(!data) return;

   inserirCO(data);

}


const inserirCO = (data) => {

  co.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   co.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });
}



function selectOpt (pos, id) {
  var el = document.getElementById(pos).value = id;
}

function desativar(pos) {
  document.getElementById(pos).disabled = true;
}


function formatarCPF(cpf){   
  var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}))$/;     
  cpf = cpf.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
  cpf = cpf.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
  //de novo (para o segundo bloco de números)
  cpf = cpf.replace( /(\d{3})(\d{1,2})$/ , "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
			    
  return cpf;
}



const valCPF = async() => {
  let cpf = document.getElementById("cpf");
  let id = document.getElementById("idprf");
  const data = await fetch(`../api/professor.php?wc=c${cpf.value}`)
    .then(resp => resp.json()).catch(error => false);

  console.log(id.value);

  if(!data) return;
  if (data.length === 0){
    console.log('-1');
    cpf.value = formatarCPF(cpf.value);
    return '-1';
  } else {
    if(id.value == data[0].id){
      cpf.value = formatarCPF(cpf.value);
      console.log('-1');
      return '-1';
    } else {
      console.log(data[0]) ;
      mostraDialogo("<strong>Erro!</strong><br>CPF já cadastrado na base.", "danger", 2500);
      cpf.value = '';
      cpf.focus(); 
      return data[0];
    }
  }
}

const valEmail = async() => {
  let email = document.getElementById("email");
  let id = document.getElementById("idprf");
  const data = await fetch(`../api/professor.php?wc=e${email.value}`)
    .then(resp => resp.json()).catch(error => false);

  console.log(id.value);
  console.log(email.value);

  if(!data) return;
  if (data.length === 0){
    console.log('-1');
    return '-1';
  } else {
    if(id.value == data[0].id){
      console.log('-1');
      return '-1';
    } else {
      console.log(data[0]) ;
      var msg = '<strong>Erro! O email já cadastrado na base</strong><br>A conta <strong>' + data[0].email.toString() + '</strong>, está sendo usado por <strong>' + data[0].nome.toString() + '</strong>';
      mostraDialogo(msg, "danger", 3500);
      email.value = '';
      email.focus(); 
      return data[0];
    }
  }
}

function mostraDialogo (mensagem, tipo, tempo) {
  // se houver outro alert desse sendo exibido, cancela essa requisição
  if($("#message").is(":visible")){
      return false;
  }

  // se não setar o tempo, o padrão é 3 segundos
  if(!tempo){
      var tempo = 3000;
  }

  // se não setar o tipo, o padrão é alert-info
  if(!tipo){
      var tipo = "info";
  }

  // monta o css da mensagem para que fique flutuando na frente de todos elementos da página
  var cssMessage = "display: block; position: fixed; top: 150px; right: 20%; width: 30%; padding-top: 10px; z-index: 9999";
  var cssInner = "margin: 0 auto; ";

  // monta o html da mensagem com Bootstrap
  var dialogo = "";
  dialogo += '<div id="message" style="'+cssMessage+'">';
  dialogo += '    <div class="alert alert-'+tipo+' alert-dismissable" style="'+cssInner+'">';
  dialogo += '    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
  dialogo +=          mensagem;
  dialogo += '    </div>';
  dialogo += '</div>';

  // adiciona ao body a mensagem com o efeito de fade
  $("body").append(dialogo);
  $("#message").hide();
  $("#message").fadeIn(200);

  // contador de tempo para a mensagem sumir
  setTimeout(function() {
      $('#message').fadeOut(300, function(){
          $(this).remove();
      });
  }, tempo); // milliseconds

}


//pegarCA();

// pegarCE();
// pegarCO();





