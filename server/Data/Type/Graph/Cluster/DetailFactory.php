<?php
class Data_Type_Graph_Cluster_DetailFactory extends Data_Type_Graph_Cluster_AbstractFactory {
    
    public function makeCluster() {
        
        return new Data_Type_Graph_Cluster_Detail($this->makeTypeId());
        
    }
    
}