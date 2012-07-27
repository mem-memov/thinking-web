<?php
class Data_Access_Graph_Cluster_Object extends Data_Access_Graph_Cluster_Abstract {
    
    public function defineUsingTargets(
        Data_Type_Graph_Cluster_Interface_Definable $cluster
    ) {
        
        $cluster instanceof Data_Type_Graph_Cluster_Object;

        $this->originFinder->defineUsingTargets($cluster);
        
    }
    
}