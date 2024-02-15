CREATE ALGORITHM=UNDEFINED DEFINER=sistemaproec@`localhost` SQL SECURITY DEFINER VIEW `pad22v` AS 

select 
  p.id AS id_pad,
  p.atividade AS atividade,
  p.estudante AS estudante,
  p.curso AS curso,
  p.serie AS serie,
  p.ch AS ch,
  p.id_co AS id_co_estudante,
  v.id AS id_vinc,
  v.nome AS prof,
  v.codcam AS codcam_prof,
  v.codcentro AS codcentro_prof,
  v.colegiado AS colegiado_prof,
  v.co_id AS co_idvinc,
  p.user AS user,
  u.nome AS nome_tt,
  u.codcam AS codcam_tt,
  u.codcentro AS codcentro_tt,
  u.colegiado AS colegiado_tt

from 
  pad22 p 
  inner join vinculov v on p.vinculo = v.id 
  left join userprof u on u.id = p.user;

  CREATE ALGORITHM=UNDEFINED DEFINER=`sistemaproec`@`localhost` SQL SECURITY DEFINER VIEW `pad21d` AS 
  
  select `p`.`vinculo` AS `vinculo`,
  `p`.`id` AS `id`,
  `p`.`atividade` AS `atividade`,
  `p`.`disciplina` AS `disciplina`,`p`.`curso` AS `curso`,`p`.`turno` AS `turno`,`p`.`ch` AS `ch`,`p`.`cargah` AS `cargah` from `pad21` `p` 
  
  union all 
  select `d`.`vinculo` AS `vinculo`,`d`.`id` AS `id`,'d' AS `atividade`,`d`.`disciplina` AS `disciplina`,`d`.`curso` AS `curso`,' ' AS `turno`,`d`.`ch` AS `ch`,`d`.`cargah` AS `cargah` from `pad21` `d`;

  CREATE ALGORITHM=UNDEFINED DEFINER=`sistemaproec`@`localhost` SQL SECURITY DEFINER VIEW `pad21` AS select `d`.`vinculo` AS `vinculo`,`d`.`id` AS `id`,`md`.`categ` AS `atividade`,`d`.`nome` AS `disciplina`,`c`.`nome` AS `curso`,`md`.`turno` AS `turno`,`d`.`ch` AS `ch`,case when `d`.`ch` in (30,36,34) then if(`md`.`categ` = 'c',1 * 1.5,1) when `d`.`ch` in (60,72,68) then if(`md`.`categ` = 'c',2 * 1.5,2) when `d`.`ch` in (90,108,96) then if(`md`.`categ` = 'c',3 * 1.5,3) when `d`.`ch` in (120,144) then if(`md`.`categ` = 'c',4 * 1.5,4) when `d`.`ch` in (15,18,17) then if(`md`.`categ` = 'c',0.5 * 1.5,0.5) else `d`.`ch` end AS `cargah` from ((`disciplinas` `d` join `matriz_disc` `md` on(`md`.`id` = `d`.`id_matriz`)) join `colegiados` `c` on(`c`.`id` = `md`.`id_curso`)) where `d`.`vinculo` is not null and `d`.`vinculo` <> ''


  Selecione os professores que orientarão os alunos com suas respectivas funções


Nesta parte, designamos funções* à professores. Feito isso, serão estes selecionaram os professores que orientarão os alunos com suas respectivas funções.

*Funções:

    Orientação ao Estágio;
    Orientação de Aulas Práticas em Saúde;
    Orientação à Trabalhos acadêmicos; e
    Orientação de Monitoria.
CREATE or REPLACE VIEW `cargosv` AS 
select 
  `c`.`id` AS `id`,
  `c`.`id_vinculo` AS `id_vinculo`,
  `p`.`id` AS `id_prof`,
  `p`.`nome` AS `nome`,
  `c`.`id_colegiado` AS `id_colegiado`,
  `ccc`.`codcam` AS `codcam`,
  `ccc`.`codcentro` AS `codcentro`,
  `ccc`.`colegiado` AS `colegiado`,
  `c`.`ano` AS `ano`,
  case `c`.`tipo` 
       when 'a' then 'Estágio Curricular Supervisionado Obrigatório' 
       when 'b' then 'Atividades de aulas práticas em inst da área da saúde' 
       when 'c' then 'Orientação de Trabalhos acadêmicosmicos Obrigatórios (TCCs, dissertações e teses)' 
       when 'd' then 'Orientação de Monitoria' 
       else 'Não identificado' end AS `tipo`,
  `c`.`tipo` AS `tipocod`,
  `v`.`aprov_co_id` AS `aprov_co_id`,
  `u`.`nome` AS `nome_tt`,
  `u`.`codcam` AS `codcam_tt`,
  `u`.`codcentro` AS `codcentro_tt`,
  `u`.`colegiado` AS `colegiado_tt`

from 
   `cargos` `c` 
   join `vinculo` `v` on `c`.`id_vinculo` = `v`.`id` 
   join `professores` `p` on `p`.`id` = `v`.`id_prof`
   join `ca_ce_co` `ccc` on `ccc`.`co_id` = `p`.`id_colegiado` 
   left join `userprof` `u` on `c`.`user` = `u`.`id`


   CREATE or REPLACE VIEW `pad22v` AS 
   select
     `p`.`id` AS `id`,
     `p`.`atividade` AS `atividade`,
     `p`.`estudante` AS `estudante`,
     `p`.`curso` AS `curso`,
     `p`.`serie` AS `serie`,
     `p`.`ch` AS `ch`,
     `p`.`id_co` AS `id_co_estudante`,
     `v`.`id` AS `vinculo`,
     `v`.`nome` AS `orientador`,
     `v`.`codcam` AS `codcam_orientador`,
     `v`.`codcentro` AS `codcentro_orientador`,
     `v`.`colegiado` AS `colegiado_orientador`,
     `v`.`co_id` AS `co_idvinc_orientador`,
     `p`.`user` AS `id_att`,
     `u`.`nome` AS `nome_att`,
     `u`.`codcam` AS `codcam_att`,
     `u`.`codcentro` AS `codcentro_att`,
     `u`.`colegiado` AS `colegiado_att`,
     `v`.`aprov_co_id`
  from 
    `pad22` `p` 
    join `vinculov` `v` on `p`.`vinculo` = `v`.`id`
    left join `userprof` `u` on `u`.`id` = `p`.`user`