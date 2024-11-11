<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-7">
      <h3>Aprovação -  PAD</h3><sup><?=$subTitle?> - Lista de professores do colegiado de <strong><?=  $nomeCurso .' ['. $anoCurso  .'] '?></strong></sup>
      <div>🔒 - Assinado pela coordenação e dir. centro de área <br>⏳ - Não pode ser assinado pois o carga horária atribuida não corresponte ao RT</div>

      
    </div>
    <div class="col" style="text-align:left">
      <div>
        <span class="badge badge-pill badge-light"> </span>
      </div>
      <div>
        <span style="text-align: right; box-shadow: 3px 3px lightgray; border-radius: 5px; background-color: #ffeeba; border-block-color: #ffdf7e; padding: 5px; font-size:12px;">Faltando horas</span>
        <span style="text-align: right; box-shadow: 3px 3px lightgray; border-radius: 5px; background-color: #c3e6cb; border-block-color: #8fd19e; padding: 5px; font-size:12px;">Ok horas completas</span>
        <span style="text-align: right; box-shadow: 3px 3px lightgray; border-radius: 5px; background-color: #f5c6cb; border-block-color: #ed969e; padding: 5px; font-size:12px;">Extrapolou as horas do RT</span>

        <a class="card-link" href="../ajuda/?help=coord_vpads" aria-expanded="true"><span class="badge badge-warning float-right" hidden>Ajuda</span></a>
      </div>
      <div><hr>🖋️❌ - Já assinado, clique para revomer a assinatura <br>📄🖋️ - Não assinado, clique para assinar  </div>
    </div>
          
  </div>
  <hr>
    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <sub style="line-height: 12px;">
        <strong>Ativ. 2.1</strong>) Total de média semanal anual de carga horária didática;  <strong>Ativ. 2.2</strong>) Total de média semanal anual de carga horária supervisão e orientação;         <strong>Ativ. 3</strong>) Total de carga horária semanal pesquisa/extensão/cultura/programas especiais; <strong>Ativ. 4</strong>)	Total de carga horária semanal de gestão institucional; 
        <strong>Total att</strong>) Total de carga horária semanal; <strong>RT</strong>) Regime de trabalho. 
      </sub>
      <p>O coordenador do curso poderá outorgar os PAD que estiverem de acordo com a <a target="_blank"
        href="https://www.unespar.edu.br/a_reitoria/atos-oficiais/cou-1/resolucoes/2019/resolucao-no-007-regulamento-de-distribuicao-de-carga-horaria-ok.pdf">Resolução Nº 007/2019 - COU/UNESPAR</a></p>

      <div style="max-height: 600px; overflow: scroll;">
        <table id="tabelaPADS" name="tabelaPADS" class="table table-bordered table-sm  table-hover">
          <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
            <tr>
              <th style="display: none;">ID</th>
              <th class="align-top">Professor(ª)</th>
              <th class="align-top" style="text-align: center; width: 35px;">PAD</th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 2.1</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 2.2</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 2.3</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 3</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 4</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Total att</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">RT</th>
              <th class="align-top" style="text-align: center; width: 70px;">🖊️</th>
              <th style="display: none;">🖊️</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>


    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalAtv">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header row">
            <div class="col-1"></div>
            <div class="col"><h4 class="modal-title" id="titleMotal" style="text-align: center;">Aprovação do PAD</h4></div>
            <div class="col-1"><button type="button" class="close" data-dismiss="modal">×</button></div>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body"  style="padding-top: 0px;">
            
            <div style="max-height: 250px;" id="div_tbl">
              <p style="padding: 20px 30px; text-align: justify;"><span class="badge"> &nbsp;  &nbsp; </span> Eu, <strong><?=$user['nome']?></strong>,
               como coordenador(a) do curso de <strong><?=$user['co_nome']?>
            </strong>, aprovo o <strong>PAD</strong> - Plano de Atividades do(a) Docente(a) <strong><span id="titleMotalProf"></span></strong> do ano de <strong><?=$ano?></strong>,
               confirmo que este plano está de acordo com a resolução atual, <a target="_blank"
        href="https://www.unespar.edu.br/a_reitoria/atos-oficiais/cou-1/resolucoes/2019/resolucao-no-007-regulamento-de-distribuicao-de-carga-horaria-ok.pdf">Resolução Nº 007/2019 - COU/UNESPAR</a> 
        e solicito que o Diretor de Centro de Área também outorgue para que seja feita a publicação.</p>

              <div class="row" style="padding: 20px 30px;">
                <div class="col-5" style="display: flex;"><p id="dataHoje" style="margin: 0;">, </p></div>
                <div class="col">
                  <p style="text-align: center; margin: 0;"><button type="button" class="btn btn-light btn-sm" onclick="Aprovar('a')">Assinar 🖋️</button></p>
                  <p style="text-align: center; margin: 0;"><strong><?=$user['nome']?></strong></p>
                  <p style="text-align: center; margin: 0;"><sup>Coordenador do Colegiado de <?=$user['co_nome']?></sup></p>
                </div>
              </div>
              <input type="hidden" name="vinc_idps" id="vinc_idps">
              <input type="hidden" name="vinc_id_co" id="vinc_id_co" value="<?=$user['id']?>">

        
            
            </div> 
            <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModal()">Fechar</button>
            
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal ADD / EDT Fim-->
    


<!-- The Modal DELET-->
<div class="modal fade" id="modalDel">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >Remover autorização</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-group" id="frmDelAtiv" name="frmDelAtiv" method="post">
          <div class="form-group">
          <div  id="msgApagar">Tem certeza que deseja remover a aprovação?</div>
            <div class="d-flex justify-content-center mb-3 font-weight-bold" id="nomeAtivDel">AAA</div>
            
            <input type="hidden" name="vinc_idpsd" id="vinc_idpsd">
            <input type="hidden" name="vinc_id_cod" id="vinc_id_cod" value="<?=$user['id']?>">
           
          </div>

          <center>
            <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
            <button type="submit" class="btn btn-danger btn-sm"  onclick="Aprovar('d')">Apagar</button>
          </center>

        </form>
      </div>
    </div>
  </div>
</div>
<!--  The Modal DELET Fim-->




<script src="./includes/tblasco.js"></script>


