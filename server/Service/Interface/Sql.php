<?php

interface CModel_Service_Interface_Sql {

    public function query($query);
    public function fetch_rows($query);
    public function fetch_row($query);
    public function fetch_id_rows($query, $id_field);
    public function fetch_columns($query);
    public function fetch_column($query, $field = null);
    public function fetch_value($query, $field = null);
    public function last_id();
    public function affected_rows();
    
}