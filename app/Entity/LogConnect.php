<?php

namespace App\Entity;

use App\Db\Database;

class LogConnect
{
    public $id;
    public $conta;
    public $sessao;
    public $sistema;
    public $dt_connection;
    public $tp_connection;
    public $ip;
    public $navegador;
    public $so;
    public $coresproc;
    public $mem_aporx_gb;
    public $atividades;

    /**
     * Método responsável por cadastrar uma nova pessoa no banco.
     *
     * @return int
     */
    public function cadastrar()
    {
        // INSERIR A REGISTRO NO BANCO
        $obDatabase = new Database('logconnect');
        $this->mem_aporx_gb == 'Não disponível' ? 'n/a' : $this->mem_aporx_gb;

        return $obDatabase->insert([
            'conta' => $this->conta,
            // 'sessao' => $this->sessao,
            'sistema' => $this->sistema,
            // 'dt_connection'  => $this->dt_connection, get datetime by DB
            'tp_connection' => $this->tp_connection,
            'ip' => $this->ip,
            'navegador' => $this->navegador,
            'so' => $this->so,
            'coresproc' => $this->coresproc,
            'mem_aporx_gb' => $this->mem_aporx_gb,
            'atividades' => $this->atividades,
        ]);
    }

    /**
     * Método responsável por atualizar REGISTRO no banco.
     *
     * @return bool
     */
    public function atualizar()
    {
        return (new Database('logconnect'))->update('id = "'.$this->id.'" ', [
            'conta' => $this->conta,
            'sessao' => $this->sessao,
            'sistema' => $this->sistema,
            // 'dt_connection'  => $this->dt_connection, get datetime by DB
            'tp_connection' => $this->tp_connection,
            'ip' => $this->ip,
            'navegador' => $this->navegador,
            'so' => $this->so,
            'coresproc' => $this->coresproc,
            'mem_aporx_gb' => $this->mem_aporx_gb,
            'atividades' => $this->atividades,
        ]);
    }

    /**
     * Método responsável por excluir a professor do banco.
     *
     * @return bool
     */
    public function excluir()
    {
        return (new Database('logconnect'))->delete('id = '.$this->id);
    }

    /**
     * Método responsável por obter as professores do banco de dados.
     *
     * @param string $order
     * @param string $limit
     *
     * @return array
     */
    public static function gets($where = null, $order = null, $limit = null)
    {
        return (new Database('logconnect'))->select($where, $order, $limit)
                                      ->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por obter as professores do banco de dados.
     *
     * @return array
     */
    public static function get($id)
    {
        $where = ' id = "'.$id.'" ';

        return (new Database('logconnect'))->select($where)
                                         ->fetchObject(self::class);
    }
}
