<?php
class Model_Graph_Structure_MessageCollection {
    
    private $executorFactory;
    
    private $actionAccess;
    private $authorAccess;
    private $communicationAccess;
    private $compositionAccess;
    private $descriptionAccess;
    private $detailAccess;
    private $interactionAccess;
    private $messageAccess;
    private $objectAccess;
    private $phraseAccess;
    private $propositionAccess;
    private $referenceAccess;
    private $signAccess;
    private $wordAccess;
    
    public function __construct(
        Model_Graph_Structure_ExecutorFactory $executorFactory,
        Data_Access_Graph_Cluster_Action $actionAccess,
        Data_Access_Graph_Cluster_Author $authorAccess,
        Data_Access_Graph_Cluster_Communication $communicationAccess,
        Data_Access_Graph_Cluster_Composition $compositionAccess,
        Data_Access_Graph_Cluster_Description $descriptionAccess,
        Data_Access_Graph_Cluster_Detail $detailAccess,
        Data_Access_Graph_Cluster_Interaction $interactionAccess,
        Data_Access_Graph_Cluster_Message $messageAccess,
        Data_Access_Graph_Cluster_Object $objectAccess,
        Data_Access_Graph_Cluster_Phrase $phraseAccess,
        Data_Access_Graph_Cluster_Proposition $propositionAccess,
        Data_Access_Graph_Cluster_Reference $referenceAccess,
        Data_Access_Graph_Cluster_Sign $signAccess,
        Data_Access_Graph_Cluster_Word $wordAccess
    ) {
        
        $this->executorFactory = $executorFactory;
        
        $this->actionAccess = $actionAccess;
        $this->authorAccess = $authorAccess;
        $this->communicationAccess = $communicationAccess;
        $this->compositionAccess = $compositionAccess;
        $this->descriptionAccess = $descriptionAccess;
        $this->detailAccess = $detailAccess;
        $this->interactionAccess = $interactionAccess;
        $this->messageAccess = $messageAccess;
        $this->objectAccess = $objectAccess;
        $this->phraseAccess = $phraseAccess;
        $this->propositionAccess = $propositionAccess;
        $this->referenceAccess = $referenceAccess;
        $this->signAccess = $signAccess;
        $this->wordAccess = $wordAccess;

    }
    
    public function create() {
        
        $message = new Model_Graph_Structure_Message();
        
        return $message;
        
    }
    
    public function createUsingInterpretor(
        Model_Reader_Interpreter $interpretor
    ) {
        
        $message = $this->create();
        $executor = $this->executorFactory->makeExecutor($message);
        $interpretor->manipulate($executor);
        
        return $message;
        
    }
    
    public function update(
        Model_Graph_Structure_Message $message
    ) {
        
        $this->defineUsingTargets($message->getCompositions(), $this->compositionAccess);
        $this->defineUsingTargets($message->getPhrases(), $this->phraseAccess);
        $this->defineUsingTargets(array($message->getAuthor()), $this->authorAccess);
        $this->defineUsingTargets($message->getActions(), $this->actionAccess);
        $this->defineUsingTargets($message->getDescriptions(), $this->descriptionAccess);
        $this->defineUsingTargets($message->getDetails(), $this->detailAccess);
        $this->defineUsingTargets($message->getPropositions(), $this->propositionAccess);


    }
    
    private function defineUsingTargets(
        array $undefinedClusters, 
        Data_Access_Graph_Cluster_Abstract $clasterAccess
    ) {
        
        do {

            foreach ($undefinedClusters as $index => $cluster) {
                
                $cluster instanceof Data_Type_Graph_Cluster_Interface_Checkable;

                if (!$cluster->canBeDefinedByTargetIds()) {
                    continue;
                }

                $clasterAccess->defineUsingTargets($cluster);

                unset($undefinedClusters[$index]);
                
            }
   
        } while(count($undefinedClusters) > 0);
        
    }
    
}
