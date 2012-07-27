<?php
class Model_Context_ScopeFactory {
    
    private $datasetWielder;
    private $structureFactory;
    private $identifierFactory;
    
    public function __construct(
        Service_Interface_DatasetWielder $datasetWielder,
        Model_State_Structure_Factory $structureFactory,
        Model_State_Identifier_Factory $identifierFactory
    ) {
        
        $this->datasetWielder = $datasetWielder;
        $this->structureFactory = $structureFactory;
        $this->identifierFactory = $identifierFactory;
        
        
    }
    
    
    public function makeScope(
        Service_Interface_Identifier $subjectIdentifier
    ) {
        
        return new Model_Context_Scope(
            $subjectIdentifier,
            $this->datasetWielder,
            $this->structureFactory,
            $this->identifierFactory
        );
        
    }
    
    
}