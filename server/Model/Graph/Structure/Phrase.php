<?php
class Model_Graph_Structure_Phrase 
extends Model_Graph_Structure_AbstractStructure
{
    
    private $phrase;
    private $compositions;
    private $words;
    
    public function __construct(
        Data_Type_Graph_Cluster_Phrase $phrase,
        array $compositions,
        array $words
    ) {
        
        $this->phrase = $phrase;
        $this->compositions = $compositions;
        $this->words = $words;
      
    }
    
    public function getPhrase() {
        
        return $this->phrase;
        
    }
    
    public function getCompositions() {
        
        return $this->compositions;
        
    }
    
    public function getWords() {
        
        return $this->words;
        
    }
    
}
