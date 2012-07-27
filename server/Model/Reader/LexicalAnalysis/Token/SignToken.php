<?php
class Model_Reader_LexicalAnalysis_Token_SignToken extends Model_Reader_LexicalAnalysis_Token_AbstractToken {
    
    public function __construct($value) {
        
        $this->name = 'знак';
        $this->value = $value;
        
    }
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        $signIdVaraiable = $translator->addSign($this->value);
        
        return $signIdVaraiable;
        
    }
    
}