<?php

class CModel_Service_Postgresql_Adapter implements CModel_Service_Interface_Sql {
    
    private $server;
    private $port;
    private $user;
    private $password;
    private $database;
    private $shema;

    private $connection;
    private $last_query;
    private $last_resource;

    public function __construct($server, $port, $user, $password, $database, $shema = null) {

        $this->server = $server;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->shema = $shema;

        $this->connection = null;
        $this->last_query = null;
        $this->last_resource = null;

    }
    public function __destruct() {
        if (!is_null($this->connection)) {
            pg_close($this->connection);
        }
    }

    private function connect() {
        
        $this->connection = pg_connect('host='.$this->server.' port='.$this->port.' dbname='.$this->database.' user='.$this->user.' password='.$this->password);
        
        if ($this->connection === false) {
            throw new CModel_Service_Postgresql_Exception ('Не удалось подсоединиться к базе данных: ' . pg_last_error());
        }

        $this->set_schema();

    }
    
    // \service\_interface\sql: START
    
    public function query($query) {
        
        if (is_null($this->connection)) {
            $this->connect();
        }

        $this->last_query = $query;
        $result = @pg_query($this->connection, $query);
        if (!$result) {
            $output = 'Запрос к базе данных вызвал ошибку: '.'<br />'."\n". pg_last_error().'<br />'."\n";
            $output .= 'Последний запрос: '.'<br />'."\n".$this->last_query;
            throw new CModel_Service_Postgresql_Exception ($output);
        }
        $this->last_resource = $result;

        return $result;
        
    }
    
    public function fetch_rows($query) {
        
        $rows = array();

        $result = $this->query ($query);
        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }
        pg_free_result($result);

        return $rows;
        
    }
    
    public function fetch_row($query) {
        
        $rows = $this->fetch_rows($query);

        if (isset($rows[0])) {
            $row = $rows[0];
        }else{
            $row = array();
        }

        return $row;
        
    }
    
    public function fetch_id_rows($query, $id_field) {
        
        $id_rows = array();

        $rows = $this->fetch_rows($query);

        foreach ($rows as $row) {
            $id_rows[$row[$id_field]] = $row;
        }

        return $id_rows;
        
    }
    
    public function fetch_columns($query) {
        
        $columns = array();

        $rows = $this->fetch_rows($query);
        foreach ($rows as $row) {
            foreach ($row as $field => $value) {
                $columns[$field][] = $value;
            }
        }

        return $columns;
        
    }
    
    public function fetch_column($query, $field = null) {
        
        $columns = $this->fetch_columns($query);

        if (count($columns) > 0) {
            if (is_null($field)) {
                $column = array_shift($columns);
            }else{
                if (isset($columns[$field])) {
                    $column = $columns[$field];
                }else{
                    $column = array();
                }
            }
        }else{
            $column = array();
        }

        return $column;
        
    }
    
    public function fetch_value($query, $field = null) {
        
        $row = $this->fetch_row($query);

        if (count($row) > 0) {
            if (is_null($field)) {
                $value = array_shift($row);
            }else{
                if (isset($row[$field])) {
                    $value = $row[$field];
                }else{
                    $value = null;
                }
            }
        }else{
            $value = null;
        }

        return $value;
        
    }
    
    /**
     * @link http://stackoverflow.com/questions/55956/mysql-insert-id-alternative-for-postgresql
     * @return type 
     */
    public function last_id() {
        
        $last_id = $this->fetch_value("SELECT LASTVAL();");

        return $last_id;
        
    }
    
    public function affected_rows() {
        
        $affected_rows = pg_affected_rows($this->last_resource);

        return $affected_rows;    
        
    }
    
    // \service\_interface\sql: END
    
    private function set_schema() {
        
        if (!is_null($this->shema)) {
            $this->query('SET search_path TO '.$this->shema.',public;');
        }
        
    }
    
}

