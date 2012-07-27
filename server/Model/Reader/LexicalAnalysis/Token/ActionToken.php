<?php
class Model_Reader_LexicalAnalysis_Token_ActionToken extends Model_Reader_LexicalAnalysis_Token_AbstractToken {
    
    public function __construct($value) {
        
        $this->name = 'действие';
        $this->value = $value;
        
    }
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        $actionIdVariable = $translator->addAction($this->value);
        
        return $actionIdVariable;
        
    }
    
}