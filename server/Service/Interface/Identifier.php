<?php
interface Service_Interface_Identifier {
    
    public function isDefined();
    public function setId($id);
    public function getId();
    public function getType();
    public function isProgressive();
    public function isAftermath();
    public function getProducingTypes();
    
}
