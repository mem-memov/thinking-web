<?php
class Service_Mysql_Adapter implements CModel_Service_Interface_Sql {

    private $server;
    private $user;
    private $password;
    private $database;

    private $connection;
    private $last_query;

    public function __construct($server, $user, $password, $database) {

        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connection = null;
        $this->last_query = null;


    }
    public function __destruct() {
            if (!is_null($this->connection)) {
                    mysql_close($this->connection);
            }
    }

    private function connect() {

        $this->connection = mysql_connect($this->server, $this->user, $this->password)
            or die('Could not connect: ' . mysql_error());
        mysql_select_db($this->database, $this->connection)
            or die ('Can\'t use '.$this->database.' : ' . mysql_error());

    }

    public function query($query) {

        if (is_null($this->connection)) {
            $this->connect();
        }

        $this->last_query = $query;
        $result = mysql_query($query, $this->connection);
        if (!$result) {
            $output = 'Database query failed: '.'<br />'."\n".mysql_error().'<br />'."\n";
            $output .= 'Last query:'.'<br />'."\n".$this->last_query;
            die ($output);
        }

        return $result;

    }

    public function fetch_rows($query) {

        $rows = array();

        $result = $this->query ($query);
        while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysql_free_result($result);

        return $rows;

    }
    public function fetch_row($query) {

        $rows = $this->rows($query);

        if (isset($rows[0])) {
            $row = $rows[0];
        }else{
            $row = array();
        }

        return $row;

    }
    public function fetch_id_rows($query, $id_field) {

        $id_rows = array();

        $rows = $this->rows($query);

        foreach ($rows as $row) {
            $id_rows[$row[$id_field]] = $row;
        }

        return $id_rows;

    }
    public function fetch_columns($query) {

        $columns = array();

        $rows = $this->rows($query);
        foreach ($rows as $row) {
            foreach ($row as $field => $value) {
                $columns[$field][] = $value;
            }
        }

        return $columns;

    }
    public function fetch_column($query, $field = null) {

        $columns = $this->columns($query);

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

        $row = $this->row($query);

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

    public function last_id() {

        $last_id = mysql_insert_id($this->connection);

        if ($last_id == 0) {
            $last_id = null;
        }

        return $last_id;

    }

    public function affected_rows() {

        $affected_rows = mysql_affected_rows($this->connection);

        return $affected_rows;

    }

}
