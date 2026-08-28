<?php
$alertaLogin = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>' : '';

?>
<p></p>
<div class="jumbotron text-dark">

  <div class="row">

    <div class="col text-center">

        <h2>UNESPAR</h2>
        <img src="../imgs/logo_unespar.png" width="150" height="160">
        <hr>
        <h3>PLANO DE ATIVIDADES DOCENTES</h3>
        <h4><span class="badge badge-warning">ePAD</span></h4>  
        <span><span style="color: #002661;">PRO</span><span style="color: #007F3D;">GRAD</span></span>

    </div>

    <div class="col">

      <form method="post" enctype="multipart/form-data">

        <h2>Login</h2>
        <?php echo $alertaLogin; ?>

        <div class="form-group">
          <label>E-mail</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="form-group">
          
            
          <button type="submit"  class="btn btn-primary">🔑 Entrar</button>
          <div>&nbsp;</div>
          <div class="alert alert-info col">Usuário = <strong>nome.sobrenome + @unespar.edu.br</strong><br>
          Senha = (senha do Domínio da Rede Local)</div>

        </div> 
        <input type="hidden" name="ipaddress" id="ipaddress" value="<?php
                                                                        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                                            $ip = $_SERVER['HTTP_CLIENT_IP'];
                                                                        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                                            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                                                        } else {
                                                                            $ip = $_SERVER['REMOTE_ADDR'];
                                                                        }
echo $ip; ?>" 
                                                                      >
        <input type="hidden" name="moreInformations" id="moreInformations" value="">
      
      </form>
      <a href="https://senha.unespar.edu.br/" class="btn btn-primary btn-sm float-right">📑 Recuperar senha</a>
<!-- name="acao" value="logar"
      
      <br>
      
      <a href="../projetostb/" class="btn btn-success" id="projEfet">📑 Propostas efetivadas</a>
      <label for="projEfet">Acessar projetos que já passaram por todos os crivos estabelecidos</label>
-->

    </div>
    <script>
  function capturarDadosCliente() {
    const ua = navigator.userAgent;
    
    // 1. Identificar o Navegador
    let navegador = "Desconhecido";
    if (ua.includes("Firefox")) navegador = "Mozilla Firefox";
    else if (ua.includes("SamsungBrowser")) navegador = "Samsung Internet";
    else if (ua.includes("Opera") || ua.includes("OPR")) navegador = "Opera";
    else if (ua.includes("Trident")) navegador = "Internet Explorer";
    else if (ua.includes("Edge") || ua.includes("Edg")) navegador = "Microsoft Edge";
    else if (ua.includes("Chrome")) navegador = "Google Chrome";
    else if (ua.includes("Safari")) navegador = "Apple Safari";

    // 2. Identificar o Sistema Operacional
    let so = "Desconhecido";
    if (ua.includes("Windows NT 10.0")) so = "Windows 10/11";
    else if (ua.includes("Windows NT 6.2")) so = "Windows 8";
    else if (ua.includes("Windows NT 6.1")) so = "Windows 7";
    else if (ua.includes("Android")) so = "Android";
    else if (ua.includes("iPhone") || ua.includes("iPad")) so = "iOS";
    else if (ua.includes("Macintosh")) so = "macOS";
    else if (ua.includes("Linux")) so = "Linux";

    // 3. Coletar outras informações úteis da máquina
    const dadosLog = {
        navegador: navegador,
        sistemaOperacional: so,
        userAgentCompleto: ua,
        idioma: navigator.language || navigator.userLanguage,
        plataformaHardware: navigator.platform, // Arquitetura antiga/base (ex: Win32, MacIntel)
        resolucaoTela: `${window.screen.width}x${window.screen.height}`,
        janelaNavegador: `${window.innerWidth}x${window.innerHeight}`,
        fusoHorario: Intl.DateTimeFormat().resolvedOptions().timeZone,
        cookiesAtivos: navigator.cookieEnabled ? "Sim" : "Não",
        totalCoresProcessador: navigator.hardwareConcurrency || "Não disponível",
        memoriaAproximadaGB: navigator.deviceMemory || "Não disponível",
        dataHoraAcesso: new Date().toISOString()
    };

    return dadosLog;
}

const logConexao = capturarDadosCliente();
const txtData = document.getElementById('moreInformations');
txtData.value = JSON.stringify(logConexao);

document.addEventListener('contextmenu', event => event.preventDefault());
document.addEventListener('keydown', event => {
    if (event.key === 'F12' || 
        (event.ctrlKey && event.shiftKey && ['I', 'C', 'J'].includes(event.key)) || 
        (event.ctrlKey && event.key === 'U') || (event.ctrlKey && event.key === 'u')) {
        event.preventDefault();
    }
});

</script>

  </div>

</div>