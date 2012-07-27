<?php
class Data_Type_Graph_Cluster_Message extends Data_Type_Graph_Cluster_Abstract {
    
    private $author;
    private $propositions;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->author = null;
        $this->propositions = array();
        
    }
    
    
    
    public function setAuthor(
        Data_Type_Graph_Cluster_Author $author
    ) {
        
        if (!is_null($this->author)) {
            throw new Data_Type_Graph_Cluster_Exception('У сообщения есть только один автор.');
        }
        
        $this->author = $author;
        
    }
    
    public function addProposition(
        Data_Type_Graph_Cluster_Proposition $proposition
    ) {
        
        $this->propositions[] = $proposition;
        
    }
    
}