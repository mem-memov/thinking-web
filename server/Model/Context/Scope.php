<?php
class Model_Context_Scope {
    
    private $subjectIdentifier;
    private $datasetWielder;
    private $structureFactory;
    private $identifierFactory;
    
    public function __construct(
        Service_Interface_Identifier $subjectIdentifier,
        Service_Interface_DatasetWielder $datasetWielder,
        Model_State_Structure_Factory $structureFactory,
        Model_State_Identifier_Factory $identifierFactory
    ) {
        
        $this->subjectIdentifier = $subjectIdentifier;
        $this->datasetWielder = $datasetWielder;
        $this->structureFactory = $structureFactory;
        $this->identifierFactory = $identifierFactory;
        
        
    }
    
    public function getObjectDesctiptions() {
        
        $objectIds = $this->datasetWielder->getTargetIdsUsingExample(
            $this->subjectIdentifier,
            $this->identifierFactory->makeObjectIdentifier()
        );
        
        foreach ($objectIds as $objectId) {
            
            echo 'Объект №'.$objectId.'<br />';
            
            $object = $this->identifierFactory->makeObjectIdentifier();
            $object->setId($objectId);
            
            $tailPropositionIds = $this->datasetWielder->getProgressTailUsingExample(
                    $object, 
                    $this->identifierFactory->makePropositionIdentifier(), 
                    2, 
                    0
            );
            
            foreach ($tailPropositionIds as $tailPropositionId) {
                
                $tailProposition = $this->identifierFactory->makePropositionIdentifier();
                $tailProposition->setId($tailPropositionId);
                
                $humanStructure = $this->structureFactory->makeHumanStructure();
                
                $humanStructure->fillUsingDatasetWielder($tailProposition, $this->datasetWielder);
                
                echo '<br />'.implode(' ', $humanStructure->getHumanWords()).'<br />';
                
            }

        }
        
    }
    
    
}