CREATE or REPLACE VIEW `pad21d` AS 
select 
  `p`.`vinculo` AS `vinculo`,
  `p`.`id` AS `id`,
  `p`.`atividade` AS `atividade`,
  `p`.`disciplina` AS `disciplina`,
  `p`.`curso` AS `curso`,
  `p`.`centro` AS `centro`,
  `p`.`campus` AS `campus`,
  `p`.`turno` AS `turno`,
  `p`.`ch` AS `ch`,
  `p`.`cargah` AS `cargah` 
from `pad21` `p` 
union all select 
  `d`.`vinculo` AS `vinculo`,
  `d`.`id` AS `id`,'d' AS `atividade`,
  `d`.`disciplina` AS `disciplina`,
  `d`.`curso` AS `curso`,
  `d`.`centro` AS `centro`,
  `d`.`campus` AS `campus`,' ' AS `turno`,
  `d`.`ch` AS `ch`,
  `d`.`cargah` AS `cargah` 
from `pad21` `d`




CREATE or REPLACE VIEW `proj_inf` AS 
select 
  `prj`.`id` AS `id`,
  `prj`.`ver` AS `ver`,
  `prj`.`regras` AS `regras`,
  `prj`.`titulo` AS `titulo`,
  `prj`.`tipo_exten` AS `tipo_ext`,
  `tp`.`nome` AS `tipo_exten`,
  `prj`.`nome_prof` AS `nome_prof`,
  `prj`.`id_prof` AS `id_prof`,
  `ccc`.`campus` AS `campus`,
  `ccc`.`centros` AS `centros`,
  `ccc`.`colegiado` AS `colegiado`,
  `prj`.`tide` AS `tide`,
  `prj`.`vigen_ini` AS `vigen_ini`,
  `prj`.`vigen_fim` AS `vigen_fim`,
  `prj`.`ch_semanal` AS `ch_semanal`,
  `prj`.`ch_total` AS `ch_total`,
  `prj`.`situacao` AS `situacao`,
  `ac`.`nome` AS `area_cnpq`,
  `at1`.`nome` AS `area_tema1`,
  `at2`.`nome` AS `area_tema2`,
  `cnpq_ga`.`nome` AS `cnpq_garea`,
  `cnpq_ar`.`nome` AS `cnpq_area`,
  `cnpq_sa`.`nome` AS `cnpq_sarea`,
  `ae1`.`nome` AS `area_extensao`,
  `ae2`.`nome` AS `linh_ext`,
  `prj`.`resumo` AS `resumo`,
  `prj`.`descricao` AS `descricao`,
  `prj`.`objetivos` AS `objetivos`,
  `prj`.`metodologia` AS `metodologia`,
  `prj`.`justificativa` AS `justificativa`,
  `prj`.`cronograma` AS `cronograma`,
  `prj`.`referencia` AS `referencia`,
  `prj`.`prodserv_espe` AS `prodserv_espe`,
  `prj`.`contribuicao` AS `contribuicao`,
  `prj`.`contrap_nofinac` AS `contrap_nofinac`,
  `prj`.`n_cert_prev` AS `n_cert_prev`,
  `prj`.`data` AS `data`,
  `prj`.`outs_info` AS `outs_info`,
  `prj`.`para_avaliar` AS `para_avaliar`,
  `prj`.`edt` AS `edt`,
  `prj`.`last_result` AS `last_result`,
  `prj`.`updated_at` AS `updated_at`,
  `prj`.`created_at` AS `created_at` 
from 
   `projetos` `prj` 
    left join `ca_ce_co` `ccc` on `prj`.`para_avaliar` = `ccc`.`co_id` 
    left join `tipo_exten` `tp` on `prj`.`tipo_exten` = `tp`.`id` 
    left join `area_cnpq` `ac` on `prj`.`area_cnpq` = `ac`.`id` 
    left join `area_tematica` `at1` on `prj`.`area_tema1` = `at1`.`id` 
    left join `area_tematica` `at2` on `prj`.`area_tema2` = `at2`.`id` 
    left join `area_extensao` `ae1` on `prj`.`area_extensao` = `ae1`.`id` 
    left join `area_extensao` `ae2` on `prj`.`area_extensao` = `ae2`.`id` 
    left join `cnpq_garea` `cnpq_ga` on `prj`.`cnpq_garea` = `cnpq_ga`.`id` 
    left join `cnpq_area` `cnpq_ar` on `prj`.`cnpq_area` = `cnpq_ar`.`id` 
    left join `cnpq_subarea` `cnpq_sa` on `prj`.`cnpq_sarea` = `cnpq_sa`.`id`

