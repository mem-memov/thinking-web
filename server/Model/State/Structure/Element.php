<?php
class Model_State_Structure_Element {
    
    private $example;
    private $elements;
    
    private $connections;
    
    private $connectionFactory;
    
    private $humanWords = array();

    
    public function __construct(
        Model_State_Identifier_Identifier $example, 
        array $elements
    ) {
        
        $this->example = $example;
        
        $this->elements = array();
        
        foreach ($elements as $element) {
            
            if (!($element instanceof Model_State_Structure_Element)) {
                throw new Model_State_Structure_Exception('Неверный тип дочернего структурного элемента.');
            }
            
            if (!array_key_exists($element->getType(), $this->elements)) {
                $this->elements[$element->getType()] = array();
            }
            
            if (in_array($element, $this->elements[$element->getType()])) {
                throw new Model_State_Structure_Exception('Нельзя размещать два дочерних элемента одного типа');
            }
            
            $this->elements[$element->getType()] = $element;
            
        }
        
        $this->connections = array();
        
        $this->connectionFactory = null;
        
    }
    
    public function setConnectionFactory(
        Model_State_Connection_ConnectionFactory $connectionFactory
    ) {
        
        $this->connectionFactory = $connectionFactory;
        
        // проходим по дочерним элементам
        foreach ($this->elements as $type => $element) {
            
            $element->setConnectionFactory($connectionFactory);
            
        }
        
    }
    
    public function getOrigin() {
        
        return $this->connections[0]->getOrigin();
        
    }
    
    public function fillUsingConnectionSpace(
        Model_State_Identifier_Identifier $origin,
        Model_State_Connection_Space $space
    ) {
        
        // проверяем, соответствует ли начальный идентификатор образцу данного элемента структуры
        $this->checkOrigin($origin);

        // проходим по дочерним элементам
        foreach ($this->elements as $type => $element) {

            $connections = $space->getConnectionsUsingExample($origin, $element->getExample());

            $this->connections += $connections;
            
            foreach ($connections as $connection) {

                $element->fillUsingConnectionSpace($connection->getTarget(), $space);
                
            }
            
        }
        
    }
    
    public function fillUsingDatasetWielder(
        Model_State_Identifier_Identifier $origin,
        Service_Interface_DatasetWielder $datasetWielder
    ) {
        
        // проверяем, соответствует ли начальный идентификатор образцу данного элемента структуры
        $this->checkOrigin($origin);
        
        // проходим по дочерним элементам
        foreach ($this->elements as $type => $element) {

            $targetIds = $datasetWielder->getTargetIdsUsingExample($origin, $element->getExample());

            $connections = array();
            
            foreach ($targetIds as $targetId) {
                
                $target = clone $element->getExample();
                $target->setId($targetId);
                
                $connections[] = $this->connectionFactory->makeConnection($origin, $target);
                
            }
            
            $this->connections += $connections;

            foreach ($connections as $connection) {

                if ($connection->getTarget()->getType() == 'word') {

                    $this->humanWords[] = $connection->getTarget()->getId();
                }
                
                $element->fillUsingDatasetWielder($connection->getTarget(), $datasetWielder);
                
            }
            
        }

    }
    
    public function getHumanWords() {
        $humanWords = $this->humanWords;
      
        // проходим по дочерним элементам
        foreach ($this->elements as $type => $element) {
            
            $elementHumanWords = $element->getHumanWords();
            
            foreach ($elementHumanWords as $elementHumanWord) {
                $humanWords[] = $elementHumanWord;
            }
            
        }
        
        return $humanWords;
    }
    
    public function isInside(
        Model_State_Structure_Element $bigElement
    ) {

        $isInside = $bigElement->hasConnections($this->connections);

        if (!$isInside) {
            return $isInside;
        }

        $isInside = $isInside && $bigElement->hasTypes(array_keys($this->elements));

        if (!$isInside) {
            return $isInside;
        }
        
        foreach ($this->elements as $type => $childElement) {
            
            $bigChild = $bigElement->getElementByType($type);
            
            $isInside = $isInside && $childElement->isInside($bigChild);

            if (!$isInside) {
                return $isInside;
            }
            
        }

        return $isInside;
        
    }
        
    public function hasConnections(
        array $connections
    ) {

        $hasConnections = true;
        
        foreach ($connections as $connection) {
            
            if (!in_array($connection, $this->connections)) {
                
                $hasConnections = false;
                break;
                
            }
            
        }
  
        return $hasConnections;
        
    } 
    
    public function hasTypes(array $types) {
      
        $difference = array_diff($types, array_keys($this->elements));

        return empty($difference);
        
    }
    
    public function getType() {
        
        return $this->example->getType();
        
    }
    
    public function getExample() {
        
        return $this->example;
        
    }
    
    public function getElementByType($type) {
        
        if (array_key_exists($type, $this->elements)) {
            
            return $this->elements[$type];
            
        } else {
            
            return array();
            
        }
        
    }
    
    private function checkOrigin(
        Model_State_Identifier_Identifier $origin
    ) {
        
        if ($origin->getType() != $this->example->getType()) {
            throw new Model_State_Structure_Exception('Заполнение структуры начато с неверного типа начального элемента.');
        }
        
    }
    
}

