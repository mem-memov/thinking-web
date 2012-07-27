<?php
class Model_Reader_SyntaxAnalysis_Error_SyntaxErrorFactory {
    
    public function __construct() {
        ;
    }
    
    public function makeSyntaxError($number, $description) {
        
        return new Model_Reader_SyntaxAnalysis_Error_SyntaxError($number, $description);
        
    }
    
    
}