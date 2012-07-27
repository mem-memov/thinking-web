<?php
/**
 * Ссылочная конструкция. 
 * Связывет текущее уточнение с уточнением в одном из предыдущих предложений. 
 */
class Data_Type_Graph_Cluster_Reference extends Data_Type_Graph_Cluster_Abstract {
    
    private $propositions;
    private $detail;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->propositions = array();
        $this->detail = null;
        
    }
    
    
    
    public function addProposition(
        Data_Type_Graph_Cluster_Proposition $proposition
    ) {
        
        $this->propositions[] = $proposition;
        
    }
    
    public function setDetail(
        Data_Type_Graph_Cluster_Detail $detail
    ) {
        
        if (!is_null($this->detail)) {
            throw new Data_Type_Graph_Cluster_Exception('Ссылочная конструкция может относиться только к одному уточнению.');
        }
        
        $this->detail = $detail;
        
    }
    
}