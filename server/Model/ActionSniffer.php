<?php
class Model_ActionSniffer {
    
    private $actionCollection;
    
    public function __construct(
        Model_Graph_Structure_ActionCollection $actionCollection
    ) {

        $this->actionCollection = $actionCollection;

    }
    
    public function isAction(array $words) {
       
        $isAction = false;
        
        if (empty($words)) {
            return $isAction;
        }
        
        $this->actionCollection instanceof Model_Graph_Structure_Interface_CreatingFromWords;
        $action = $this->actionCollection->createUsingWords($words);
        $isAction = $this->actionCollection->checkExistence($action);
        
        return $isAction;
        
    }
    
    
}