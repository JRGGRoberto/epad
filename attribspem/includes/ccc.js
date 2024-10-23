

const pegarCA = async() => {
  const data = await fetch(`../api/ca.php`)
    .then(resp => resp.json()).catch(error => false)

  if(!data) return;

  ce = document.querySelector("#ce");
  ce.innerHTML = '';
  inserirCA(data);
}

const inserirCA = (data) => {

  ca = document.querySelector("#ca");
  ca.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   ca.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });

  coIca = document.getElementById('co');
  ca.addEventListener("change", e => {
    coIca.innerHTML = '';
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
  ce = document.querySelector("#ce");
  ce.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   ce.innerHTML += `<option value="${e["id"]}">${e["codigo"]}</option>`
  });

  listaProf = document.getElementById('vinculo');
  listaProf.innerHTML = '';
  ce.addEventListener("change", e => pegarCO(ce.value))
}

const pegarCO = async (id) => {
  const data = await fetch(`../api/co.php?ce=${id}`)
     .then(resp => resp.json()).catch(error => false)

   if(!data) return;
   inserirCO(data);
}


const inserirCO = (data) => {
  coIco = document.getElementById('co');
  coIco.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
    coIco.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });
  coIco.addEventListener("change", e => pegarProfs(coIco.value))
}


const pegarProfs = async (id) => {
  //let ano = '2024';
  let a = id + ano +'d';
  const data = await fetch(`../api/vinculos.php?md=${a}`)
     .then(resp => resp.json()).catch(error => false)

   if(!data) return;
   inserirProfs(data);
   // ok- console.log("AAA: " + ano)
}


const inserirProfs = (data) => {
  listaProf = document.getElementById('vinculo');
  listaProf.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
    listaProf.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });

}



pegarCA();





