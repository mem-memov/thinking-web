<?php
class Data_Type_Graph_Cluster_SignFactory extends Data_Type_Graph_Cluster_AbstractFactory {
    
    public function makeCluster() {
        
        return new Data_Type_Graph_Cluster_Sign($this->makeTypeId());
        
    }
    
}