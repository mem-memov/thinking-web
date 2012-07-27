<?php
class Data_Type_Graph_Cluster_DescriptionFactory extends Data_Type_Graph_Cluster_AbstractFactory {
    
    public function makeCluster() {
        
        return new Data_Type_Graph_Cluster_Description($this->makeHelpfulOrderedTypeId());
        
    }
    
}