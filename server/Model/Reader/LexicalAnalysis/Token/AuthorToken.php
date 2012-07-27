<?php
class Model_Reader_LexicalAnalysis_Token_AuthorToken extends Model_Reader_LexicalAnalysis_Token_AbstractToken {
    
    public function __construct($value) {
        
        $this->name = 'автор';
        $this->value = $value;
        
    }
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        $authorIdVariable = $translator->addAuthor($this->value);
        
        return $authorIdVariable;
        
    }
    
}