<?php
class Model_Thought {
    
    private $information;
    private $messageCollection;
    private $scopeFactory;
    
    public function __construct(
        Model_Information $information,
        Model_Graph_Structure_MessageCollection $messageCollection,
        Model_Context_ScopeFactory $scopeFactory
    ) {
        
        $this->information = $information;
        $this->messageCollection = $messageCollection;
        $this->scopeFactory = $scopeFactory;
    
    }
    
    
    public function memorizeInformation() {
        
        $this->information->putIntoMemory($this->messageCollection);
        
    }
    
    public function getContext() {
        
        //$subject = $this->information->getSubject();
        
        //$scope = $this->scopeFactory->makeScope($subject);
        
        //$scope->getObjectDesctiptions();
        
    }
    
}