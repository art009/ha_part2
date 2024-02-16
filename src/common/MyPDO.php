<?php

namespace app\common;

use PDO;
use PDOException;

class MyPDO
{
    private ?PDO $dbh = null;
    public function __construct(
        private string $host = 'localhost',
        private string $database = 'test',
        private string $user_name = '',
        private string $password = '',
        private string $charset = 'utf8',
    ) {}

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        if (!$this->dbh) {
            $dsn = sprintf('%s:host=%s;dbname=%s','mysql',$this->host,$this->database);
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => sprintf('SET NAMES %s',$this->charset),
            );
            $this->dbh = new PDO($dsn, $this->user_name, $this->password, $options);
        }

        return $this->dbh;
    }
}