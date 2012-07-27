<?php
abstract class Model_Reader_LexicalAnalysis_Token_AbstractToken {
    
    protected $name;
    protected $value;
    
    abstract public function __construct();
    
    public function getName() {
        
        return $this->name;
        
    }
    
    public function getValue() {
        
        return $this->value;
        
    }
    
    public function translate(Model_Reader_ReaderInterface $translator) {}
    
    
}