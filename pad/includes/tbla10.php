<table class="table table-bordered table-sm">
    <tr>
        <th>Ano letivo</th>
        <td colspan="3"><?=$vinc->ano?></td>
    </tr>
    <tr>
        <th>Nome</th>                <td><?=$vinc->nome?></td>
        <th>Regime de Trabalho</th>  <td><span id="rt" style="padding-left: 20px;"><?=$vinc->rt?></span></td>
    </tr>
    <tr>
        <th>Campus</th>          <td><?=$vinc->campus?></td>
        <th>Centro de área</th>  <td><?=$vinc->centros?></td>
    </tr>
    <tr>
        <th>Colegiado</th>        <td><?=$vinc->colegiado?></td>
        <th>Área de concurso</th> <td><?=$vinc->area_concurso?></td>
    </tr>
    <tr>
        <th>Maior Titulação</th>             <td><?=$vinc->titulacao?></td>
        <th>Data de obtenção do título</th>  <td><?=$vinc->dt_obtn_tit?></td>
    </tr>
    <tr>
        <th>Tempo de docência nos
            componentes curriculares</th>    <td><?=$vinc->tempo_cc?></td>
        <th>Tempo efetivo de docência no
            ensino superior na UNESPAR</th>  <td><?=$vinc->tempo_esu?></td>
    </tr>
</table>
