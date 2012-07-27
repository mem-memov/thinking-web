<?php
class Model_Graph_Structure_Action 
extends Model_Graph_Structure_AbstractStructure
{
    
    private $action;
    private $phrase;
    private $compositions;
    private $words;
    
    public function __construct(
        Data_Type_Graph_Cluster_Action $action,
        Data_Type_Graph_Cluster_Phrase $phrase,
        array $compositions,
        array $words
    ) {
        
        $this->action = $action;
        $this->phrase = $phrase;
        $this->compositions = $compositions;
        $this->words = $words;
      
    }
    
    public function getAction() {
        
        return $this->action;
        
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