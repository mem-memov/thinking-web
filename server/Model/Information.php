<?php
class Model_Information {
    
    private $messageStructure;

    public function __construct(
        Model_Graph_Structure_Message $messageStructure
    ) {

        $this->messageStructure = $messageStructure;

    }

    public function putIntoMemory(
        Model_Graph_Structure_MessageCollection $messageCollection
    ) {
        
        $messageCollection->update($this->messageStructure);
        
    }

}