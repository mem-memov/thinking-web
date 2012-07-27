<?php
interface Model_State_GettingInterface {
    
    public function getVagueClusters();
    public function getProgressiveClusters();
    public function getObjectsAndPropositionStructuresAndPositionsAndDetails();
    public function getPropositionStructures();
    public function hasReverseConnection(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    );
    public function getTailPropositionStructures(
        Service_Interface_DatasetWielder $datasetWielder  
    );
    public function getSubject();
    public function getConnections();
    
}