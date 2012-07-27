<?php
class Data_Type_Graph_Cluster_Sign extends Data_Type_Graph_Cluster_Abstract {
    
    private $higherCluster;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->higherCluster = null;
        
    }

    
    
    public function setAction(
        Data_Type_Graph_Cluster_Action $action
    ) {
        
        $this->checkHigherCluster();
        
        $this->higherCluster = $action;
        
    }
    
    public function setDescription(
        Data_Type_Graph_Cluster_Description $description
    ) {
        
        $this->checkHigherCluster();
        
        $this->higherCluster = $description;
        
    }
    
    public function setDetail(
        Data_Type_Graph_Cluster_Detail $detail
    ) {
        
        $this->checkHigherCluster();
        
        $this->higherCluster = $detail;
        
    }
    
    
    
    
    private function checkHigherCluster() {
        
        if (!is_null($this->higherCluster)) {
            throw new Data_Type_Graph_Cluster_Exception('Знак может быть связан лишь с одним членом предложения.');
        }
        
    }
    
}