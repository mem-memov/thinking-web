<?php
class Data_Type_Graph_Cluster_MessageFactory extends Data_Type_Graph_Cluster_AbstractFactory {
    
    public function makeCluster() {
        
        return new Data_Type_Graph_Cluster_Message($this->makeTypeId());
        
    }
    
}