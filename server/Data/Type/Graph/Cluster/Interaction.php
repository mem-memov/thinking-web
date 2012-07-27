<?php
/**
 * Взаимодействие.
 * Сопоставляет действие текущего предложения действию предыдущего предложения. 
 */
class Data_Type_Graph_Cluster_Interaction extends Data_Type_Graph_Cluster_Abstract {
    
    private $propositions;
    private $action;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->propositions = array();
        $this->action = null;
        
    }
    
    
    
    public function addProposition(
        Data_Type_Graph_Cluster_Proposition $proposition
    ) {
        
        $this->propositions[] = $proposition;
        
    }
    
    public function setAction(
        Data_Type_Graph_Cluster_Action $action
    ) {
        
        if (!is_null($this->action)) {
            throw new Data_Type_Graph_Cluster_Exception('Взамодействие может характеризовать только одно действие.');
        }
        
        $this->action = $action;
        
    }
    
}