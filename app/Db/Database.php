<?php

namespace App\Db;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PDO;

class Database
{
    /**
     * Host de conexão com o banco de dados.
     *
     * @ var string
     */
    //  public const HOST = 'mariadb';

    /**
     * Nome do banco de dados.
     * Altere os valores para a produção.
     *
     * @ var string
     */
    public const NAME = 'unespar_sistema_t';

    /**
     * Usuário do banco.
     ** Altere os valores para a produção.
     *
     * @ var string
     */
    //  public const USER = 'sistemaproec';

    /**
     * Senha de acesso ao banco de dados.
     ** Altere os valores para a produção.
     *
     * @ var string
     */
    //  public const PASS = 's1proeC';

    private $host;
    private $name;
    private $user;
    private $pass;

    /**
     * Nome da tabela a ser manipulada.
     *
     * @var string
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados.
     *
     * @var \PDO
     */
    private $connection;

    /**
     * Retorna o nome do DBNAME.
     *
     * @ return string
     */
    /*
    public function getDBname()
    {
        return $this->name;
    }
*/
    /**
     * Define a tabela e instancia e conexão.
     *
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $env = new LerDot();
        $this->host = $env::get('HOST');
        $this->name = $env::get('NAME');
        $this->user = $env::get('USER');
        $this->pass = $env::get('PASS');
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados.
     */
    private function setConnection()
    {
        try {
            $this->connection =
              new \PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user, $this->pass,
                  [
                      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                      // PDO::ATTR_PERSISTENT => false,
                      // PDO::ATTR_EMULATE_PREPARES => false,
                      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                  ]
              );
            // $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            exit('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do banco de dados.
     *
     * @param string $query
     * @param array  $params
     *
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (\PDOException $e) {
            exit('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Método responsável por inserir dados no banco.
     *
     * @param array $values [ field => value ]
     *
     * @return int ID inserido
     */
    public function insert($values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        // MONTA A QUERY
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

        // EXECUTA O INSERT
        /* echo $query;
         echo '<pre>';
         print_r($values);
         echo '</pre>';
         exit;*/
        $this->execute($query, array_values($values));

        // RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por inserir dados no banco com suporte a ON DUPLICATE KEY UPDATE.
     *
     * @param array $values       [ field => value ]
     * @param array $ignoreFields [ ] (optional) Campos que não devem ser atualizados no caso de duplicação, padrão ['created_at']
     *
     * @return int ID inserido ou atualizado
     */
    public function insertODK($values, $ignoreFields = ['created_at'])
    {
        // DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        // MONTA A QUERY DE INSERÇÃO
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

        // MONTA A PARTE DO UPDATE
        $updatePairs = [];
        foreach ($values as $field => $value) {
            if (!in_array($field, $ignoreFields)) {
                $updatePairs[] = "$field = VALUES($field)";
            }
        }

        // Se houver campos para atualizar, adiciona a cláusula ON DUPLICATE KEY UPDATE
        if (!empty($updatePairs)) {
            $query .= ' ON DUPLICATE KEY UPDATE '.implode(', ', $updatePairs);
        }

        // EXECUTA O INSERT/UPDATE
        $this->execute($query, array_values($values));

        // RETORNA O ID INSERIDO OU ATUALIZADO
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco.
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     *
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        // DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';
        // MONTA A QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        // EXECUTA A QUERY
        return $this->execute($query);
    }

    /**
     * Método responsável por executar uma consulta no banco com Join.
     *
     * @param string $query
     *
     * @return PDOStatement
     */
    public function selectJ($query)
    {
        // EXECUTA A QUERY
        return $this->execute($query);
    }

    /**
     * Método responsável por executar atualizações no banco de dados.
     *
     * @param string $where
     * @param array  $values [ field => value ]
     *
     * @return bool
     */
    public function update($where, $values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values);

        // MONTA A QUERY
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,', $fields).'=? WHERE '.$where;

        // EXECUTAR A QUERY
        $this->execute($query, array_values($values));

        // RETORNA SUCESSO
        return true;
    }

    /**
     * Método responsável por excluir dados do banco.
     *
     * @param string $where
     *
     * @return bool
     */
    public function delete($where)
    {
        // MONTA A QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        // EXECUTA A QUERY
        $this->execute($query);

        // RETORNA SUCESSO
        return true;
    }
}
