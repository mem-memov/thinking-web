<?php
class Model_Graph_Structure_ExecutorFactory {
    
    private $typeFactory;
    
    public function __construct(
        Data_Type_Graph_Cluster_Factory $typeFactory
    ) {
        
        $this->typeFactory = $typeFactory;
        
    }
    
    public function makeExecutor(
        Model_Graph_Structure_Message $messageStructure
    ) {
        
        return new Model_Graph_Structure_Executor(
            $messageStructure,
            $this->typeFactory->makeActionFactory(),
            $this->typeFactory->makeAuthorFactory(),
            $this->typeFactory->makeCommunicationFactory(),
            $this->typeFactory->makeCompositionFactory(),
            $this->typeFactory->makeDescriptionFactory(),
            $this->typeFactory->makeDetailFactory(),
            $this->typeFactory->makeInteractionFactory(),
            $this->typeFactory->makeMessageFactory(),
            $this->typeFactory->makeObjectFactory(),
            $this->typeFactory->makePhraseFactory(),
            $this->typeFactory->makePropositionFactory(),
            $this->typeFactory->makeReferenceFactory(),
            $this->typeFactory->makeSignFactory(),
            $this->typeFactory->makeWordFactory()
        );
        
    }
    
}
