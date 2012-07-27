<?php
abstract class Model_Reader_AbstractError {
    
    protected $type;
    protected $number;
    protected $message;


    public function getType() {
        
        return $this->type;
    }
    
    public function getNumber() {
        
        return $this->number;
    
    }
    
    public function getMessage() {
        
        return $this->message;
        
    }
    
}