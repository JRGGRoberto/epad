<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Projeto{
  
  public $id;
  public $ver;
  public $regras;
  public $id_prof;
  public $nome_prof;
  public $id_colegiado;
  public $tipo_exten;
  public $tipo_ext;


  public $titulo;
  public $tide;
  public $vigen_ini;
  public $vigen_fim;
  public $ch_semanal;
  public $ch_total;
  public $situacao;

  public $cnpq_garea;
  public $cnpq_area;
  public $cnpq_sarea;

  
  public $area_cnpq;
  public $area_tema1;
  public $area_tema2;

  
  public $area_extensao;
  public $linh_ext;
  public $resumo;
  public $descricao;
  public $objetivos;
  public $public_alvo;
  public $metodologia;
  public $prodserv_espe;
  public $contribuicao;
  public $contrap_nofinac;
  public $municipios_abr;
  public $n_cert_prev;
  public $data;
  public $outs_info;
  public $para_avaliar;
  public $last_result;
  public $edt;

  public $acec;
  public $vinculo;
  public $tituloprogvinc;

  public $finac;
  public $finacorgao;
  public $finacval;

  public $justificativa;
  public $cronograma;
  public $referencia;

  public $parceria;
  public $parcaatribuic;
  public $parcanomes;
  
  public $created_at;
  public $updated_at;
  public $user;

  /**
   * Método responsável por cadastrar um novo projeto no banco
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR PROJETO NO BANCO
    $obDatabase = new Database('projetos');
    $newId = exec('uuidgen -r');
    is_null($this->ver) ? $v = 0 : $v = $this->ver;
    is_null($this->id) ? $ida  = $newId : $ida = $this->id;
    is_null($this->edt) ? $edt = 1 : $edt = $this->edt;
    is_null($this->para_avaliar) ? $aval = -1 : $aval = $this->para_avaliar;
    is_null($this->last_result) ? $lr = 'n' : $lr = $this->last_result;

    is_null($this->cnpq_garea) ? $cnpq_garea = 0 :  $cnpq_garea = $this->cnpq_garea;
    is_null($this->cnpq_area) ?  $cnpq_area = 0 :   $cnpq_area = $this->cnpq_area;
    is_null($this->cnpq_sarea) ? $cnpq_sarea = 0 : $cnpq_sarea = $this->cnpq_sarea;
    
    //$this->id = 
    $obDatabase->insert([
                           'id' => $ida,
                           'ver' =>   $v,
                           'regras' =>  "6204ba97-7f1a-499e-a17d-118d305bf7e4", //$this->regras,
                           'id_prof' => $this->id_prof,
                           'nome_prof' => $this->nome_prof,
                           'id_colegiado' => $this->id_colegiado,
                           'tipo_exten' => $this->tipo_exten,
                           'titulo' => $this->titulo,
                           'tide' => $this->tide,
                           'vigen_ini' => $this->vigen_ini,
                           'vigen_fim' => $this->vigen_fim,
                           'ch_semanal' => $this->ch_semanal,
                           'ch_total' => $this->ch_total,
                           'situacao' => $this->situacao,


                           'cnpq_garea' => $cnpq_garea,
                           'cnpq_area' => $cnpq_area,
                           'cnpq_sarea' => $cnpq_sarea,

                           'area_extensao' => $this->area_extensao,
                           'linh_ext' => $this->linh_ext,
                           'resumo' => $this->resumo,
                           'descricao' => $this->descricao,
                           'objetivos' => $this->objetivos,
                           'public_alvo' => $this->public_alvo,
                           'metodologia' => $this->metodologia,
                           'prodserv_espe' => $this->prodserv_espe,
                           'contribuicao' => $this->contribuicao,
                           'contrap_nofinac' => $this->contrap_nofinac,
                           'municipios_abr' => $this->municipios_abr,
                           'n_cert_prev' => $this->n_cert_prev,
                           'data' => $this->data,
                           'edt' => $edt,

                           'acec' => $this->acec,
                           'vinculo' => $this->vinculo,
                           'tituloprogvinc' => $this->tituloprogvinc,

                           'finac' => $this->finac,
                           'finacorgao' => $this->finacorgao,
                           'finacval' => $this->finacval,

                           'justificativa' => $this->justificativa,

                           'cronograma' => $this->cronograma,
                           'referencia' => $this->referencia,

                           'parceria' => $this->parceria,
                           'parcaatribuic' => $this->parcaatribuic,
                           'parcanomes ' => $this->parcanomes,

                           'outs_info' => $this->outs_info,
                           'para_avaliar' => $aval,
                           'last_result' => $lr,
                           'created_at' => date("Y-m-d H:i:s"),
                          // 'updated_at' => date("Y-m-d H:i:s"),
                           'user' => $this->user
                        ]);

    //RETORNAR SUCESSO
    return $ida;
  }

  /**
   * Método responsável por atualizar a PROJETO no banco
   * @return boolean
   */

  // return (new Database('projetos'))->update('id = '.$this->id,[
  public function atualizar(){
    return (new Database('projetos'))->update('(id, ver) = ( "'.$this->id.'", '.$this->ver.' )',
                                     [
                                       'regras' =>  $this->regras,
                                       'id_prof' => $this->id_prof,
                                       'nome_prof' => $this->nome_prof,
                                       'id_colegiado' => $this->id_colegiado,
                                       'tipo_exten' => $this->tipo_exten,
                                       'titulo' => $this->titulo,
                                       'tide' => $this->tide,
                                       'vigen_ini' => $this->vigen_ini,
                                       'vigen_fim' => $this->vigen_fim,
                                       'ch_semanal' => $this->ch_semanal,
                                       'ch_total' => $this->ch_total,
                                       'situacao' => $this->situacao,
                                       'cnpq_garea' => $this->cnpq_garea,
                                       'cnpq_area' => $this->cnpq_area,
                                       'cnpq_sarea' => $this->cnpq_sarea,
                                       'linh_ext' => $this->linh_ext,
                                       'resumo' => $this->resumo,
                                       'descricao' => $this->descricao,
                                       'objetivos' => $this->objetivos,
                                       'public_alvo' => $this->public_alvo,
                                       'metodologia' => $this->metodologia,
                                       'prodserv_espe' => $this->prodserv_espe,
                                       'contribuicao' => $this->contribuicao,
                                       'contrap_nofinac' => $this->contrap_nofinac,
                                       'n_cert_prev' => $this->n_cert_prev,
                                       'data' => $this->data,
                                       'edt' => $this->edt,

                                       'acec' => $this->acec,
                                       'vinculo' => $this->vinculo,
                                       'tituloprogvinc' => $this->tituloprogvinc,

                                       'finac' => $this->finac,
                                       'finacorgao' => $this->finacorgao,
                                       'finacval' => $this->finacval,

                                       'municipios_abr' => $this->municipios_abr,

                                       'justificativa' => $this->justificativa,
                                       'cronograma' => $this->cronograma,
                                       'referencia' => $this->referencia,

                                       'parceria' => $this->parceria,
                                       'parcaatribuic' => $this->parcaatribuic,
                                       'parcanomes ' => $this->parcanomes,

                                       'outs_info' => $this->outs_info,
                                       'para_avaliar' => $this->para_avaliar,
                                       'last_result' => $this->last_result,
                                      // 'created_at' => $this->created_at,
                                       'updated_at' => date("Y-m-d H:i:s"),
                                       'user' => $this->user
                                      ]);
  }

  /**
   * Método responsável por excluir a projeto do banco
   * @return boolean
   */
  public function excluir(){
    (new Database('equipe'))->delete('idproj = "'.$this->id.'"');
    (new Database('equipe'))->delete('idproj = "'.$this->id.'"');
    (new Database('palavras'))->delete('idproj = "'.$this->id.'"');
    return (new Database('projetos'))->delete(' (id, ver) = ("'.$this->id.'", '. $this->ver .')');
  }

  /**
   * Método responsável por obter as projeto do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getRegistros($where = null, $order = null, $limit = null){
    return (new Database('proj_inf_lv'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdRegistros($where = null){
    return (new Database('proj_inf_lv'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }



  /**
   * Método responsável por buscar uma Projeto com base em seu ID e Versão
   * @param  integer $id
   * @return Projeto
   */
  public static function getProjeto($id, $ver){
    return (new Database('projetos'))->select('(id, ver) = ("'.$id.'", '. $ver .')')
                                  ->fetchObject(self::class);
  }

    /**
   * Método responsável por buscar uma Projeto com base em seu ID e Versão
   * @param  integer $id
   * @return Projeto
   */
  public static function getProjetoLast($id){
    return (new Database('proj_last'))->select('id = "'.$id.'"')
                                  ->fetchObject(self::class);
  }


/**
   * Método responsável por buscar uma Projeto com base em seu ID
   * @param  integer $id
   * @return Projeto
   */
  public static function getProjetoView($id, $ver){
    return (new Database('proj_inf'))->select('(id, ver) = ("'. $id .'", '. $ver .')')
                                  ->fetchObject(self::class);
  }


  /**
   * Método responsável por buscar uma Projeto com base em seu titulo
   * @param  string $titulo
   * @return Projeto
   */
  public static function getProjetoTitulo($titulo){
    return (new Database('projetos'))->select('titulo = '.$titulo)
                                  ->fetchObject(self::class);
  }


  /**
   * Método responsável por cadastrar um novo Registro no banco
   * @return boolean
   */
  public function Submeter($para){
    $this->para_avaliar = $para;
    $this->edt = 0;
    $this->atualizar();

    /*
    Quando o projeto é recusado, no professor parecerista escolhido, como é a instancia anterior que define o 
    id_instancia no SelecProf, temos estas 7 linhas a seguir, pois se não não fica definido o id_instancia
    */
    $inst =  "id_instancia";
    $sqla = "select * from avalia_last al WHERE id_proj = '". $this->id ."' limit 1";
    $lastAvalia =  (new Database())->selectJ($sqla)->fetchAll(PDO::FETCH_CLASS);
    $lastAvalia0 = $lastAvalia[0];
    
    if(($lastAvalia0->resultado == 'r') and ($lastAvalia0->tp_instancia == 'pf')){
      $inst = "'". $lastAvalia0->id_instancia ."'";
    } 
    
    $sql = "
          insert into
            avaliacoes 
            ( id, id_proj, ver, regra_def, fase_seq, form, tp_instancia, id_instancia, resultado )
          select 
             id, id_proj, ver, regra_def, fase_seq, form, tp_avaliador, $inst , if(last_result='n', 'e', last_result)  
          from to_avaliar 
          where 
            id_proj = '". $this->id ."' and
            fase_seq = (select IFNULL(max(fase_seq), 1)   from avaliacoes a where id_proj  = '". $this->id ."')";

    $a = new Database(); 
    $a->execute($sql);
    return true;
      // ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar uma Projeto com base em seu ID e Versão
   * @param  integer $id
   * @return Projeto
   */
  public function novaVersao(){
    $this->last_result = 'r';
    $this->edt = 1;
    $this->ver = $this->ver  + 1 ;
    $this->cadastrar();
    return true;
  }


    /**
   * Método responsável por cadastrar um novo Registro no banco
   * @return boolean
   */
  public function nextLevel($id_ins = 'id_instancia'){
    $this->last_result = 'a';
    $this->atualizar();

    if($id_ins == 'id_instancia'){
      $id_instancia = 'id_instancia';
    } else {
      $id_instancia = "'".$id_ins."'";
    }

    $ultimaInst = $this->ultimaInstancia();

    if($ultimaInst == 0) {
      $sql = "
      insert into 
        avaliacoes ( 
          id, id_proj, ver, regra_def, fase_seq, form, tp_instancia, id_instancia, resultado )
      select 
        id, id_proj, ver, regra_def, fase_seq, form, tp_avaliador, ". $id_instancia .", 'e' as resultado
      from to_avaliar toa
      where 
        toa.id_proj = '". $this->id ."' and
        fase_seq = (
             select (fase_seq + 1)  from avalia_last al where (al.id_proj, al.ver) = (toa.id_proj, toa.ver)
        )
      ";
       
      $a = new Database(); 
      $a->execute($sql);
    }
    return true;
      // ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


    /**
   * Método responsável por obter as projeto do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public function ultimaInstancia(){
   $completou = 0;
   $sql = "
    select 
      ifnull(a.fase_seq,(select a.fase_seq from avaliacoes a where ((a.id_proj = l.id) and (a.ver = (i.ver - 1))) order by a.fase_seq desc limit 1)) AS fase_seq,
      (select count(1) from regras_defin rd where (rd.id_reg = i.regras)) AS etapas 
    from 
      proj_last l join proj_inf i on (l.id = i.id) and (l.ver = i.ver) 
      left join avalia_last a on(l.id = a.id_proj) and (l.ver = a.ver)
    where
      l.id    = '". $this->id ."' ";
    $a = (new Database())->selectJ($sql)->fetchObject(self::class);
         //->fetchAll(PDO::FETCH_CLASS,self::class);
    if($a->etapas == $a->fase_seq){
      $completou = 1;
    }
    return $completou;
  }
}
