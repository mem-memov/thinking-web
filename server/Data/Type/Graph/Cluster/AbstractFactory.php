<?php
abstract class Data_Type_Graph_Cluster_AbstractFactory 
implements Data_Type_Graph_Cluster_Interface_TypeFactory
{
    
    protected $plane;
    
    public function __construct(
        Data_Type_Plane_Interface_Named $plane
    ) {
        
        $this->plane = $plane;
        
    }
    
    /**
     *
     * @return Data_Type_Graph_Cluster_Collaborator_TypeId 
     */
    protected function makeTypeId() {
        
        return new Data_Type_Graph_Cluster_Collaborator_TypeId($this->plane);

    }
    
    /**
     *
     * @return Data_Type_Graph_Cluster_Collaborator_OrderedTypeId 
     */
    protected function makeOrderedTypeId() {
        
        return new Data_Type_Graph_Cluster_Collaborator_OrderedTypeId($this->plane);

    }
    
    /**
     *
     * @return Data_Type_Graph_Cluster_Collaborator_HelpfulOrderedTypeId
     */
    protected function makeHelpfulOrderedTypeId() {
        
        return new Data_Type_Graph_Cluster_Collaborator_HelpfulOrderedTypeId($this->plane);

    }
    
}