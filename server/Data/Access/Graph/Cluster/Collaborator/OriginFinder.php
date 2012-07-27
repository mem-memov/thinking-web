<?php
class Data_Access_Graph_Cluster_Collaborator_OriginFinder 
implements Data_Access_Graph_Cluster_Interface_OriginFinder
{
    
    /** @var Service_Interface_DatasetWielder */
    protected $datasetWielder;

    public function __construct(
        Service_Interface_DatasetWielder $datasetWielder
    ) {
        
        $this->datasetWielder = $datasetWielder;
        
    }
    
    /**
     *
     * @param Data_Type_Graph_Cluster_Interface_Definable $cluster 
     */
    public function defineUsingTargets(
        Data_Type_Graph_Cluster_Interface_Definable $cluster
    ) {

        $originType = $cluster->getShortTypeName();
        list($targetTypes, $targetIds) = $cluster->getDefiningTargetTypesAndIds();

        $originId = $this->datasetWielder->findOriginId($originType, $targetTypes, $targetIds);

        if ($originId === false) {
            
            $ids = $this->datasetWielder->occupyKeys($originType, 1);
            $originId = $ids[0];
            
            foreach ($targetIds as $index => $targetId) {
                
                // создаём прямые связи, чтобы собирать кластер из составных частей
                $this->datasetWielder->connect(
                                                    $originType, 
                                                    $originId, 
                                                    $targetTypes[$index], 
                                                    $targetId
                );
                
                //  создаём обратные связи, чтобы в следующтй раз найти начало по концам
                $this->datasetWielder->connect(
                                                    $targetTypes[$index], 
                                                    $targetId,
                                                    $originType, 
                                                    $originId 
                );
                
            }
        }

        $cluster->setId($originId);
        
    }
    
}
