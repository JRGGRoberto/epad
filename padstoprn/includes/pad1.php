<?php
?>
<h5>1. Dados do Docente</h5>

<table class="table table-bordered table-sm"> 
    <tr>
        <th colspan="1" style="width:160px">Ano letivo</th>   <td colspan="5"><?=$vinc->ano?></td>
    </tr>
    <tr>
        <th colspan="1">Nome</th>   <td colspan="2"><?=$vinc->nome?></td>    <th colspan="1" style="width:230px">Regime de Trabalho</th>  <td colspan="2"><span id="rt" style="padding-left: 20px;"><?=$vinc->rt?></span></td>
    </tr>
    <tr>
        <th colspan="1">Campus</th> <td colspan="2"><?=$vinc->campus?></td>  <th colspan="1">Centro de área</th>      <td colspan="2"><?=$vinc->codcentro?></td>
    </tr>
    <tr>
        <th colspan="1">Colegiado</th>        <td colspan="2"><?=$vinc->colegiado?></td>     <th colspan="1">Área de concurso</th> <td colspan="2"><?=$vinc->area_concurso?></td>
    </tr>
    <tr>
        <th colspan="1">Maior Titulação</th>             <td colspan="2"><?=$vinc->titulacao?></td>
        <th colspan="1">Data de obtenção do título</th>  <td colspan="2"><?= date_format($vinc->dt_obtn_tit,'d/m/Y') ?></td>
    </tr>
    <tr>
        <th colspan="2">Tempo de docência nos
            componentes curriculares</th>    <td colspan="1"><?=$vinc->tempo_cc?></td>
        <th colspan="2">Tempo efetivo de docência no
            ensino superior na UNESPAR</th>  <td colspan="1"><?=$vinc->tempo_esu?></td>
    </tr>
</table>


