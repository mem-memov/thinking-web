<?php
abstract class Data_Access_Graph_Cluster_Abstract 
implements 
    Data_Access_Graph_Cluster_Interface_OriginFinder,
    Data_Access_Graph_Cluster_Interface_Creating,
    Data_Access_Graph_Cluster_Interface_Typed
{
    
    /** @var Service_Interface_DatasetWielder */
    protected $datasetWielder;
    
    /** @var Data_Type_Graph_Cluster_Interface_TypeFactory */
    protected $typeFactory;
    
    /** @var Data_Access_Graph_Cluster_Interface_OriginFinder */
    protected $originFinder;
    
    /** @var Data_Type_Plane_Interface_Named */
    protected $plane;

    public function __construct(
        Service_Interface_DatasetWielder $datasetWielder,
        Data_Type_Graph_Cluster_Interface_TypeFactory $typeFactory,
        Data_Access_Graph_Cluster_Interface_OriginFinder $originFinder,
        Data_Type_Plane_Interface_Named $plane
    ) {
        
        $this->datasetWielder = $datasetWielder;
        
        $this->typeFactory = $typeFactory;
        
        $this->originFinder = $originFinder;
        
        $this->plane = $plane;
        
    }
    
    /**
     * 
     * @return Data_Type_Graph_Cluster_Abstract
     */
    public function create() {
        
        return $this->typeFactory->makeCluster();
        
    }
    
    /**
     * 
     * @return Data_Type_Graph_Cluster_Abstract
     */
    public function read($id) {
        
    }
    
    public function update(
        Data_Type_Graph_Cluster_Abstract $cluster
    ) {
        
    }
    
    public function delete(
        Data_Type_Graph_Cluster_Abstract $cluster
    ) {
        
    }
    
    public function getShortTypeName() {
        
        return $this->plane->getName();
        
    }
    
}