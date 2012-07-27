<?php
class Model_Reader_LexicalAnalysis_Token_DetailToken extends Model_Reader_LexicalAnalysis_Token_AbstractToken {
    
    public function __construct($value) {
        
        $this->name = 'уточнение';
        $this->value = $value;
        
    }
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        $detailIdVariable = $translator->addDetail($this->value);
        
        return $detailIdVariable;
        
    }
    
}