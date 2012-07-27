<?php
class Data_Type_Graph_Cluster_InteractionFactory extends Data_Type_Graph_Cluster_AbstractFactory {
    
    public function makeCluster() {
        
        return new Data_Type_Graph_Cluster_Interaction($this->makeTypeId());
        
    }
    
}