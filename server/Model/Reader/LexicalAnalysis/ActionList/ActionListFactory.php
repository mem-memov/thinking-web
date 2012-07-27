<?php
class Model_Reader_LexicalAnalysis_ActionList_ActionListFactory {
    
    private $actionSniffer;
    
    public function __construct(
        Model_ActionSniffer $actionSniffer
    ) {

        $this->actionSniffer = $actionSniffer;

    }
    
    
    public function makeActionList(array $phrases) {
        
        return new Model_Reader_LexicalAnalysis_ActionList_ActionList(
            $phrases,
            $this->actionSniffer
        );
        
    }
    
}