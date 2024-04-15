CREATE or REPLACE VIEW `proj_inf` AS 
select `prj`.`id` AS `id`,
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
   


CREATE ALGORITHM=UNDEFINED DEFINER=`sistemaproec`@`%` SQL SECURITY DEFINER VIEW `proj_last` AS 
select `i`.`id` AS `id`,
  `i`.`ver` AS `ver`,
  `i`.`titulo` AS `titulo`,
  `i`.`edt` AS `edt`,
  `i`.`last_result` AS `last_result`,
  `i`.`id_prof` AS `id_prof` 
from `proj_inf` `i` 
where (`i`.`id`, `i`.`ver`) in (select `projetos`.`id`,  max(`projetos`.`ver`) from  `projetos` group by `projetos`.`id`)



CREATE TABLE `projetostb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordenador` varchar(100) NOT NULL,
  `titulo` varchar(230) NOT NULL,
  `campus` varchar(100) NOT NULL,
  `ano` int(11) NOT NULL,
  `arq_projeto` varchar(30) NOT NULL,
  `arq_relatorio` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=666 DEFAULT CHARSET=utf8;


CREATE or REPLACE VIEW `projetostb` AS 
select 
   `n`.`id` AS `id`,
   `n`.`coordenador` AS `coordenador`,
   `n`.`titulo` AS `titulo`,
   `n`.`campus` AS `campus`,
   `n`.`ano` AS `ano`,
   `n`.`arq_projeto` AS `arq_projeto`,
   `n`.`arq_relatorio` AS `arq_relatorio`,
   `n`.`versao` AS `versao` from 
( 
   select 
       `p`.`id` AS `id`,
       `p`.`nome_prof` AS `coordenador`,
       `p`.`titulo` AS `titulo`,
       `p`.`campus` AS `campus`,
       date_format(`p`.`vigen_fim`,'%Y') AS `ano`,concat('../projetos/visualizar.php?id=',`p`.`id`,'&v= ',`p`.`ver`,'&w=nw') AS `arq_projeto`,
       NULL AS `arq_relatorio`,'n' AS `versao` 
   from 
      (`unespar_sistema`.`avaliacoes` `a` 
        join `unespar_sistema`.`proj_inf_lv` `p` on(((`a`.`id_proj` = `p`.`id`) and (`a`.`ver` = `p`.`ver`)))) 
   where ((`a`.`fase_seq` = 6) and (`a`.`resultado` = 'a'))) `n` 
   
   union all 
   
   select 
      `p`.`id` AS `id`,
      `p`.`coordenador` AS `coordenador`,
      `p`.`titulo` AS `titulo`,
      `p`.`campus` AS `campus`,
      `p`.`ano` AS `ano`,
      `p`.`arq_projeto` AS `arq_projeto`,
      `p`.`arq_relatorio` AS `arq_relatorio`,
      'o' AS `versao` 
   from `unespar_sisproec`.`projetostb` `p`



      select 
       `p`.`id` AS `id`,
       `p`.`nome_prof` AS `coordenador`,
       `p`.`titulo` AS `titulo`,
       `p`.`campus` AS `campus`,
       date_format(`p`.`vigen_fim`,'%Y') AS `ano`,concat('../projetos/visualizar.php?id=',`p`.`id`,'&v= ',`p`.`ver`,'&w=nw') AS `arq_projeto`,
       NULL AS `arq_relatorio`,'n' AS `versao` 
   from 
      (`unespar_sistema`.`avaliacoes` `a` 
        join `unespar_sistema`.`proj_inf_lv` `p` on(((`a`.`id_proj` = `p`.`id`) and (`a`.`ver` = `p`.`ver`)))) 
   where ((`a`.`fase_seq` = 6) and (`a`.`resultado` = 'a'))) `n` 



   $valor = 5;
   $echo ($valor ? $valor : 0);