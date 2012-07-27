<?php
class Model_Reader_LexicalAnalysis_Token_LeftBracketToken extends Model_Reader_LexicalAnalysis_Token_AbstractToken {
    
    public function __construct() {
        
        $this->name = '(';
        $this->value = null;
        
    }
    
}