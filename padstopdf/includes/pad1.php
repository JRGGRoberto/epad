<?php
$dt_obtn_tit = '';
if (isset($vinc->dt_obtn_tit)) {
    $dt_obtn_tit = date_format(date_create($vinc->dt_obtn_tit), 'd/m/Y');
}

?>

<h5>1. Dados do Docente</h5>

<table class="table table-bordered table-sm"> 
    <tr>
        <th colspan="1" style="width:160px">Ano letivo</th>   <td colspan="5"><?php echo $vinc->ano; ?></td>
    </tr>
    <tr>
        <th colspan="1">Nome</th>   <td colspan="2"><?php echo $vinc->nome; ?></td>    <th colspan="1" style="width:230px">Regime de Trabalho</th>  <td colspan="2"><span id="rt" style="padding-left: 20px;"><?php echo $vinc->rt; ?></span></td>
    </tr>
    <tr>
        <th colspan="1">Campus</th> <td colspan="2"><?php echo $vinc->campus; ?></td>  <th colspan="1">Centro de área</th>      <td colspan="2"><?php echo $vinc->codcentro; ?></td>
    </tr>
    <tr>
        <th colspan="1">Colegiado</th>        <td colspan="2"><?php echo $vinc->colegiado; ?></td>     <th colspan="1">Área de concurso</th> <td colspan="2"><?php echo $vinc->area_concurso; ?></td>
    </tr>
    <tr>
        <th colspan="1">Maior Titulação</th>             <td colspan="2"><?php echo $vinc->titulacao; ?></td>
        <th colspan="1">Data de obtenção do título</th>  <td colspan="2"><?php echo $dt_obtn_tit; ?></td>
    </tr>
    <tr>
        <th colspan="2">Tempo de docência nos
            componentes curriculares</th>    <td colspan="1"><?php echo $vinc->tempo_cc; ?></td>
        <th colspan="2">Tempo efetivo de docência no
            ensino superior na UNESPAR</th>  <td colspan="1"><?php echo $vinc->tempo_esu; ?></td>
    </tr>
</table>