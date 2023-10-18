<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Diversos{

  /**
   * MÉTODO RESPONSÁVEL POR PEGAR INFORMAÇÕES 
   * DO CHEFE DE DIVISÃO ATUAL DE UM CAMPUS PASSADO POR ID
   * @param $id campus
   * @return @array
   */
  public static function getChefeDivisaoCampus($id = -1){
    $sql = "
        select 
           pf.id id_prof,
           ps.nome nome,
           cd.id id_boss, 
           cd.id_campus,
           ca.nome campus,
           'Chefe de divisão' posicao
         from pessoas ps
           inner join professores pf on ps.id = pf.id_pessoa
           inner join chef_divisao_atual cd on pf.id = cd.id_prof
           inner join campi ca on ca.id = pf.id_campus
         where cd.id_campus =  " . $id ;
  
    return (new Database())->selectJ($sql)
      ->fetchObject(self::class);
  }


/**
   * MÉTODO RESPONSÁVEL POR PEGAR INFORMAÇÕES 
   * DO CHEFE DE DIVISÃO ATUAL DE UM CAMPUS PASSADO POR ID
   * @param $id centro
   * @return @array
   */
  public static function getDiretorCentro($id = -1){
    $sql = "
        select 
          pf.id id_prof,
          ps.nome nome,
          cd.id id_boss, 
          cd.id_centro,
          ca.nome campus,
          'Diretor de centro de área' posicao
        from pessoas ps
          inner join professores pf on ps.id = pf.id_pessoa
          inner join diretores_atual cd on pf.id = cd.id_prof
          inner join campi ca on ca.id = pf.id_campus
        where cd.id_centro = " . $id ;
  
    return (new Database())->selectJ($sql)
      ->fetchObject(self::class);
  }

  /**
   * MÉTODO RESPONSÁVEL POR PEGAR INFORMAÇÕES 
   * DO COORDENADOR ATUAL DE UM CAMPUS PASSADO POR ID
   * @param $id campus
   * @return @array
   */
  public static function getCoordenador($id = -1){
    $sql = "
            select 
              pf.id id_prof,
              ps.nome nome,
              cd.id id_boss, 
              ca.nome campus,
              'Coordenador de cusso' posicao,
              cd.id_colegiado,
              co.nome colegiado
            from pessoas ps
              inner join professores pf on ps.id = pf.id_pessoa
              inner join coord_col_atual cd on pf.id = cd.id_prof
              inner join campi ca on ca.id = pf.id_campus
              inner join colegiados co on co.id = cd.id_colegiado
            where cd.id_colegiado = " . $id ;
  
    return (new Database())->selectJ($sql)
      ->fetchObject(self::class);
  }


  
  public static function getResponsavelLocal($id = -1){
    $sql = "select * from responsaveis r where r.id_prof =  " . $id ;
  
    return (new Database())->selectJ($sql)
      ->fetchObject(self::class);
      //->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * MÉTODO RESPONSÁVEL PARA MONTAR UM SELECT OPTION 
   * DAS OPÇÕES DE CAMPUS PARA PROFESSORES
   */
  public static function SelecOptCampiProf($id = -1){
    $sql = "
    select 
      distinct ca.id, ca.nome, 
      IF(IFNULL(pf.id, NULL), 'SELECTED', ' ') sel
    from 
      campi ca
      left join professores pf
      on pf.id_campus = ca.id and pf.id =  " . $id ;

    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


  /**
   * MÉTODO RESPONSÁVEL PARA MONTAR UM SELECT OPTION 
   * LISTAR PROFESORES PARA ASSUMIR O CARGO DE CHEFE DE DIVISÃO
   * DE UM CAMPUS. JÁ SELECTED O ATUAL RESPONSÁVEL
   * PASSAR O ID DO CAMPUS
   */
  public static function SelectProfessorToChefDiv($id = -1){
    $sql = "
            select 
              pf.id id_prof,
              ps.nome,  pf.id_campus,
              IF(IFNULL(c.id, NULL), 'SELECTED', ' ') sel 
            from 
              professores pf
              inner join pessoas ps on ps.id = pf.id_pessoa
              left join chef_divisao_atual c on c.id_prof = pf.id 
            where 
              pf.ativo = 1 and
              pf.id not in (
                select id_prof 
                from responsaveis r 
                where r.id_campus = pf.id_campus and r.nivel_adm <> 1
              ) and 
              pf.id_campus = " . $id ;

    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }
    
  /**
   * MÉTODO RESPONSÁVEL PARA MONTAR UM SELECT OPTION 
   * LISTAR PROFESORES PARA ASSUMIR O CARGO DE DIRETOR DE CENTRO.
   * JÁ SELECTED O ATUAL RESPONSÁVEL.
   * PASSAR O ID DO CAMPUS E O ID CENTRO
   */
  public static function SelectProfessorToDirCentro($id_centro = -1){
    $id_campus = (new Database())->selectJ("select id from ca_ce_co where id_ce =  ". $id_centro . " limit 1")
      ->fetchObject(self::class);

    $sql = "
            select 
              pf.id id_prof,
              ps.nome,  pf.id_campus,
              IF(IFNULL(c.id, NULL), 'SELECTED', ' ') sel
            from 
              professores pf
              inner join pessoas ps on ps.id = pf.id_pessoa
              left join diretores_atual c
                on 
                  c.id_prof = pf.id and
                  c.id_centro = " . $id_centro . "
            where 
              pf.ativo = 1 and
              pf.id_campus = " . $id_campus->id  ."   
              and pf.id not in 
                (
                  select rs.id_prof from responsaveis rs
                  where 
                  rs.id_prof not in 
                  (
                    select r.id_prof
                    from 
                      responsaveis r 
                    where 
                      r.nivel_adm = 3  
                      and r.id_cam_cen_col = " . $id_centro . "
                  )
                )";

    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


   /**
   * MÉTODO RESPONSÁVEL PARA MONTAR UM SELECT OPTION 
   * LISTAR PROFESORES PARA ASSUMIR O CARGO DE COORDENADOR.
   * JÁ SELECTED O ATUAL RESPONSÁVEL.
   * PASSAR O ID DO CAMPUS E O ID COORDENADOR
   */
  public static function SelectProfessorToCoordenador($id_coord = -1){
    $id_campus = (new Database())->selectJ("select id from ca_ce_co where id_co =  ". $id_coord . " limit 1")
    ->fetchObject(self::class);

    $sql = "
            select  
              pf.id id_prof, ps.nome,
              IF(IFNULL(c.id, NULL), 'SELECTED', ' ') sel
            from 
              professores pf
              inner join pessoas ps 
                on ps.id = pf.id_pessoa
              left join coord_col_atual c
                on 
                  c.id_prof = pf.id and
                  c.id_colegiado = " . $id_coord . "
            where 
              pf.id_campus = " . $id_campus->id ."
              and pf.id not in (
            select rs.id_prof from responsaveis rs
                  where 
                  rs.id_prof not in 
                  (
                    select r.id_prof
                    from 
                      responsaveis r 
                    where 
                      r.nivel_adm = 2  
                      and r.id_cam_cen_col = " . $id_coord . "
                  )
          )";

    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }



  /**
   * Método responsável por cadastrar um novo Registro no banco
   * @return boolean
   */
  public static function NovoBoss($nivel, $id_local, $id_prof, $user){
    $sql = '';
    switch($nivel){
      case 1: $sql .= "insert into chefes_div       (id_campus, id_prof, user) ";
        break;
      case 2: $sql .= "insert into diretores_centro (id_centro, id_prof, user) ";
        break;
      case 3: $sql .= "insert into coordenadores    (id_colegiado, id_prof, user) "; 
        break;
      default: header('location: ../index.php?status=error');
        break;
    }
    $sql .= " values ( ".$id_local. ", ". $id_prof . "," . $user. ")";

    $a = new Database();
    echo '<br>'.$sql;
    
    $a->execute($sql);
    return true;
      // ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


  public static function projetosView($id_proj){
    $sql = "select * from proj_inf where id_proj = " . $id_proj ;

    return (new Database())->selectJ($sql)
      ->fetchObject(self::class);
      
  }



  public static function projAvaliados($nivel_adm){
    $table = '';
    switch($nivel_adm){
      case 1: $table = 'avali_chef_div';
        break;
      case 2: $table = 'avali_dir_cent';
        break;
      case 3: $table = 'avali_coord';
        break;
    }

    $sql = "
            select 
              prj.id id_proj,
              prj.titulo,
              ps.nome coord,
              a.*
           from 
             " .$table. " a
             inner join projetos prj on a.id_proj = prj.id
             inner join professores pf on pf.id = prj.id_prof
             inner join pessoas ps on ps.id = pf.id_pessoa ";

    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * MÉTODO RESPONSÁVEL PARA MONTAR UM SELECT OPTION 
   * LISTAR PROFESORES para marcar como parecerista
   * JÁ SELECTED O ATUAL RESPONSÁVEL.
   * PASSAR O ID DO CAMPUS E O ID do projeto
   */
  public static function SelInvidProfToParecer($id_campus = -1, $id_proj){


    $sql = "
            select 
              pf.id id_prof,
              ps.nome,
              IF(IFNULL(pa.id, NULL), 'SELECTED', ' ') sel
            from
             professores pf
             inner join pessoas ps on pf.id_pessoa = ps.id and pf.id_campus = ".$id_campus. "
             left join pareceres pa on pf.id = pa.id_prof and pa.id_proj = " . $id_proj
    ;

    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }





  public static function qry($sql){
    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  public static function q($sql){
    return (new Database())->selectJ($sql)
      ->fetchObject(self::class);  
  }

  
}


