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
  `p`.`disciplina` AS `disciplina`,
  `p`.`curso` AS `curso`,`p`.`turno` AS `turno`,`p`.`ch` AS `ch`,`p`.`cargah` AS `cargah` from `pad21` `p` 
  
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
    case `p`.`atividade`
       when 'e' then 'Estudante envolvido em programas PIC/PIBIC'
       when 'f' then 'Estudante envolvido em programas PIBEX/PIBIS'
       else  `p`.`curso` 
    end AS `curso`,
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
   `v`.`aprov_co_id` AS `aprov_co_id` 
from 
  `pad22` `p` join `vinculov` `v` on`p`.`vinculo` = `v`.`id`
  left join `userprof` `u` on `u`.`id` = `p`.`user`;





    CREATE ALGORITHM=UNDEFINED DEFINER=`sistemaproec`@`%` SQL SECURITY DEFINER VIEW `pad21` AS 
    select 
        d.vinculo AS vinculo,
        d.id AS id,
        md.categ AS atividade,
        d.nome AS disciplina,
        c.nome AS curso,
        md.turno AS turno,
        d.ch AS ch,
        ( case 
            when (d.ch in (30,36,34)) then if((md.categ = 'c'),(1 * 1.5),1) 
            when (d.ch in (60,72,68)) then if((md.categ = 'c'),(2 * 1.5),2) 
            when (d.ch in (90,108,96)) then if((md.categ = 'c'),(3 * 1.5),3) 
            when (d.ch in (120,144)) then if((md.categ = 'c'),(4 * 1.5),4) 
            when (d.ch in (15,18,17)) then if((md.categ = 'c'),(0.5 * 1.5),0.5) 
          else d.ch end) AS cargah 
    from ((disciplinas d join matriz_disc md on((md.id = d.id_matriz))) join colegiados c on((c.id = md.id_curso))) 
    where ((d.vinculo is not null) and (d.vinculo <> ''));


        CREATE or REPLACE VIEW `pad21` AS 
    select 
        d.vinculo AS vinculo,
        d.id AS id,
        md.categ AS atividade,
        d.nome AS disciplina,
        c.nome AS curso,
        md.turno AS turno,
        d.ch AS ch,
        ( case 
	          when (d.ch in (  28,  30,  32,  36,  34                )) then if((md.categ = 'c'),(1   * 1.5),   1) 
            when (d.ch in (  54,  57,  60,  61,  64,  68,  70,  72 )) then if((md.categ = 'c'),(2   * 1.5),   2) 
            when (d.ch in (  80,  85,  88,  90,  96, 100, 108      )) then if((md.categ = 'c'),(3   * 1.5),   3) 
            when (d.ch in ( 122, 120, 132, 136, 144, 150           )) then if((md.categ = 'c'),(4   * 1.5),   4) 
            when (d.ch in ( 170, 180, 204, 216                     )) then if((md.categ = 'c'),(6   * 1.5),   6)
            when (d.ch in ( 288                                    )) then if((md.categ = 'c'),(8   * 1.5),   8)
            when (d.ch in (  15,  17,  18                          )) then if((md.categ = 'c'),(0.5 * 1.5), 0.5)
            when (d.ch in (  40,  42,  44,  45,  50, 51            )) then if((md.categ = 'c'),(1.5 * 1.5), 1.5)
            when (d.ch in (  75,  78                               )) then if((md.categ = 'c'),(2.5 * 1.5), 2.5)
            when (d.ch in ( 102, 105, 112, 113                     )) then if((md.categ = 'c'),(3.5 * 1.5), 3.5)
            when (d.ch in ( 162                                    )) then if((md.categ = 'c'),(4.5 * 1.5), 4.5)
            
          else d.ch end) AS cargah 
    from ((disciplinas d join matriz_disc md on((md.id = d.id_matriz))) join colegiados c on((c.id = md.id_curso))) 
    where ((d.vinculo is not null) and (d.vinculo <> ''))




*Tabela de correspondência*

(  15,  17,  18                          ) => 0.5h
(  28,  30,  32,  36,  34                ) => 1h
(  40,  42,  44,  45,  50, 51            ) => 1.5h
(  54,  57,  60,  61,  64,  68,  70,  72 ) => 2h
(  75,  78                               ) => 2.5h
(  80,  85,  88,  90,  96, 100, 108, 113 ) => 3h
( 102, 105, 112                          ) => 3.5h
( 122, 120, 132, 136, 144, 150           ) => 4h
( 162                                    ) => 4.5h
( 170, 180, 204, 216                     ) => 6h
( 288                                    ) => 8h






Orientação de estudante em PIC/PIBIC
Orientação de estudante em PIBEX/PIBIS
Orientaçaõ de estudante em Monitoria
Orientação de estudante em Dissertação



insert INTO colegiados (id, nome, tipo, centro_id) values 
( UUID(), 'Mestrado Acadêmico Interdisciplinar: Sociedade e Desenvolvimento', 'mestrado', '38423495-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado em História Pública',                                     'mestrado', '38423495-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado em Artes Visuais',                                        'mestrado', '384237d2-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado em Música',                                               'mestrado', '3842402c-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado Profissional em Ensino de História',                      'mestrado', '38423495-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado em Cinema e Artes do Vídeo',                              'mestrado', '38424212-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado Acadêmico em Educação Matemática',                        'mestrado', '38423495-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado Acadêmico em Ensino: Formação Docente Interdisciplinar',  'mestrado', '3842f08d-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Pós-Graduação em Ambientes Litorâneos e Insulares',                'pós',      '3842478f-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado Acadêmico em Ensino: Formação Docente Interdisciplinar',  'mestrado', '3842f08d-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Pós-Graduação em Ambientes Litorâneos e Insulares',                'pós',      '3842478f-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado Profissional em Educação Inclusiva',                      'mestrado', '3842478f-3b45-11ed-9793-0266ad9885af'),
( UUID(), 'Mestrado Profissional em Filosofia',                               'mestrado', '3842f4bb-3b45-11ed-9793-0266ad9885af')




CREATE TABLE `cargos` (
  `id` char(36) NOT NULL,
  `id_vinculo` char(36) NOT NULL,
  `id_colegiado` char(36) NOT NULL,
  `ano` int(4) NOT NULL,
  `tipo` enum('a','b','c','d') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user` char(36) DEFAULT NULL,
  KEY `id_vinculo` (`id_vinculo`),
  KEY `id_colegiado` (`id_colegiado`),
  CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`id_vinculo`) REFERENCES `vinculo` (`id`),
  CONSTRAINT `cargos_ibfk_2` FOREIGN KEY (`id_colegiado`) REFERENCES `colegiados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8




CREATE  or REPLACE  VIEW `mensagens` AS 
select 
  f.sistema AS sistema,p.nome AS solicitante,f.created_at AS data_envio,p.email AS email,concat(upper(v.codcam),' / ',v.codcentro,' - ',v.colegiado) AS local,
  (case 
	 when (f.url = 1) then 'ePAD - Geral' 
     when (f.url = 2) then 'Meu PAD -  Cálculos' 
     when (f.url = 3) then 'Meu PAD -  Item 1' 
     when (f.url = 4) then 'Meu PAD -  Item 2' 
     when (f.url = 5) then 'Meu PAD -  Item 2.2' 
     when (f.url = 6) then 'Meu PAD -  Item 3' 
     when (f.url = 7) then 'Meu PAD -  Item 4' 
     when (f.url = 8) then 'Meu PAD -  Item 6' 
     when (f.url = 9) then 'Coordenação - Matrizes' 
     when (f.url = 10) then 'Coordenação - Distribuição de disciplinas' 
     when (f.url = 11) then 'Coordenação - Atribuição de funções' when (f.url = 12) then 'Coordenação - Relatórios' 
     when (f.url = 13) then 'Edição de dados do professor' when (f.url = 14) then 'Login' end) AS parte,f.assunto AS assunto,
     (case when (f.tipomsg = 1) then 'Elogio' when (f.tipomsg = 2) then 'Dúvidas' when (f.tipomsg = 3) then 'Sugestão' when (f.tipomsg = 4) then 'Erro no sistema' end) AS tp_msg,f.msg AS msg
     
     from faleconosco f join vinculov v on f.user = v.id_prof  join professores p on p.id = v.id_prof 


Orientação de estudante em PIC/PIBIC
Orientação de estudante em PIBEX/PIBIS
Orientaçaõ de estudante em Monitoria
Orientação de estudante em Dissertação



Orientação de estudante em PIC/PIBIC
Orientação de estudante em PIBEX/PIBIS



    when 'a' then 'Estágio Curricular Supervisionado Obrigatório' 
    when 'b' then 'Atividades de aulas práticas em inst da área da saúde' 
    when 'c' then 'Orientação de Trabalhos acadêmicosmicos Obrigatórios (TCCs, dissertações e teses)' 
    when 'd' then 'Orientação de Monitoria' 
    when 'e' then 'Orientação de estudante em PIC/PIBIC' 
    when 'f' then 'Orientação de estudante em PIBEX/PIBIS' 


a - Estágio Curricular Supervisionado Obrigatório
b - Atividades de aulas práticas em inst da área da saúde
c - Orientação de Trabalhos acadêmicosmicos Obrigatórios (TCCs, dissertações e teses)
d - Orientação de Monitoria
e - Orientação de estudante em PIC/PIBIC
f - Orientação de estudante em PIBEX/PIBIS


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
  (
  case `c`.`tipo` 
    when 'a' then 'Estágio Curricular Supervisionado Obrigatório' 
    when 'b' then 'Atividades de aulas práticas em inst da área da saúde' 
    when 'c' then 'Orientação de Trabalhos acadêmicosmicos Obrigatórios (TCCs, dissertações e teses)' 
    when 'd' then 'Orientação de Monitoria' 
    when 'e' then 'Orientação de estudante em PIC/PIBIC' 
    when 'f' then 'Orientação de estudante em PIBEX/PIBIS' 
    else 'Não identificado' end) AS `tipo`,
  `c`.`tipo` AS `tipocod`,
  `v`.`aprov_co_id` AS `aprov_co_id`,
  `u`.`nome` AS `nome_tt`,
  `u`.`codcam` AS `codcam_tt`,
  `u`.`codcentro` AS `codcentro_tt`,
  `u`.`colegiado` AS `colegiado_tt`,
  `u`.`co_id` AS `co_id_tt` 
from 
    `cargos` `c` 
    join `vinculo` `v` on `c`.`id_vinculo` = `v`.`id`
    join `professores` `p` on `p`.`id` = `v`.`id_prof`
    join `ca_ce_co` `ccc` on `ccc`.`co_id` = `p`.`id_colegiado`
    left join `userprof` `u` on `c`.`user` = `u`.`id`

  


CREATE or REPLACE VIEW `mensagens` AS 
select 
  `f`.`id` AS `id`,
  `f`.`sistema` AS `sistema`,
  `p`.`nome` AS `solicitante`,
  `f`.`created_at` AS `data_envio`,
  `p`.`email` AS `email`,
  concat(upper(`v`.`codcam`),' / ',`v`.`codcentro`,' - ',`v`.`colegiado`) AS `local`,
  (case when (`f`.`url` = 1) then 'ePAD - Geral' when (`f`.`url` = 2) then 'Meu PAD -  Cálculos' when (`f`.`url` = 3) then 'Meu PAD -  Item 1' when (`f`.`url` = 4) then 'Meu PAD -  Item 2' when (`f`.`url` = 5) then 'Meu PAD -  Item 2.2' when (`f`.`url` = 6) then 'Meu PAD -  Item 3' when (`f`.`url` = 7) then 'Meu PAD -  Item 4' when (`f`.`url` = 8) then 'Meu PAD -  Item 6' when (`f`.`url` = 9) then 'Coordenação - Matrizes' when (`f`.`url` = 10) then 'Coordenação - Distribuição de disciplinas' when (`f`.`url` = 11) then 'Coordenação - Atribuição de funções' when (`f`.`url` = 12) then 'Coordenação - Relatórios' when (`f`.`url` = 13) then 'Edição de dados do professor' when (`f`.`url` = 14) then 'Login' end) AS `parte`,
  `f`.`assunto` AS `assunto`,
  (case when (`f`.`tipomsg` = 1) then 'Elogio' when (`f`.`tipomsg` = 2) then 'Dúvidas' when (`f`.`tipomsg` = 3) then 'Sugestão' when (`f`.`tipomsg` = 4) then 'Erro no sistema' end) AS `tp_msg`,
  `f`.`msg` AS `msg`,(select count(1) from `respostas` `r` where (`f`.`id` = `r`.`id_falec`)) AS `respostas` 
  
  from 
    `faleconosco` `f` 
    join `vinculov` `v` on `f`.`user` = `v`.`id_prof` 
    join `professores` `p` on`p`.`id` = `v`.`id_prof`


    CREATE TABLE `campi` (
  `id` char(36) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `codigo` varchar(2) DEFAULT NULL,
  `chef_div_id` varchar(36) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela contendo todos os campi'