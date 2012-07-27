<?php
abstract class Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    protected $arguments;
    
    public function __construct() {
        
        $this->arguments = array();
    
    }
    
    public function addArgument($argument) {
        
        $this->arguments[] = $argument;
        
        return $this;
        
    }
    
    abstract public function translate(Model_Reader_ReaderInterface $translator);
    
}