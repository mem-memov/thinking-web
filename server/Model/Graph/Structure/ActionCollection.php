<?php
class Model_Graph_Structure_ActionCollection 
implements Model_Graph_Structure_Interface_CreatingFromWords
{
    
    private $actionAccess;
    private $phraseCollection;
    
    public function __construct(
        Data_Access_Graph_Cluster_Action $actionAccess,
        Model_Graph_Structure_PhraseCollection $phraseCollection
    ) {
        
        $this->actionAccess = $actionAccess;
        $this->phraseCollection = $phraseCollection;

    }
    
    private function make(
        Data_Type_Graph_Cluster_Action $action,
        Data_Type_Graph_Cluster_Phrase $phrase,
        array $compositions,
        array $words
            
    ) {
        
        return new Model_Graph_Structure_Action(
            $action,
            $phrase,
            $compositions,
            $words
        );
        
    }
    
    public function createUsingWords(array $words) {
        
        $this->phraseCollection instanceof Model_Graph_Structure_Interface_CreatingFromWords;
        $phraseStructure = $this->phraseCollection->createUsingWords($words);
        
        $action = $this->actionAccess->create();
        $action instanceof Data_Type_Graph_Cluster_Action;
        $action->setPhrase($phraseStructure->getPhrase());
        
        return $this->make(
            $action, 
            $phraseStructure->getPhrase(), 
            $phraseStructure->getCompositions(), 
            $phraseStructure->getWords()
        );
        
    }
    
    public function checkExistence(
        Model_Graph_Structure_Action $actionStructure
    ) {
      
        
        $this->phraseCollection->checkExistence($actionStructure->getPhrase());
        
/*
        $originType = $action->getShortTypeName();
        list($targetTypes, $targetIds) = $action->getDefiningTargetTypesAndIds();
        $originId = $this->datasetWielder->findOriginId($originType, $targetTypes, $targetIds);
        
        if ($originId == false) {
            return false;
        } else  {
            return true;
        }
*/
    }
    
}