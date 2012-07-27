<?php
class Model_State_Connection_Cluster {
    
    private $connectionFactory;
    
    private $connections;
    private $originType;
    private $targetType;
    private $targets;
    private $origin;
    private $isProgressive;
    
    public function __construct(
        Model_State_Connection_ConnectionFactory $connectionFactory
    ) {
        
        $this->connectionFactory = $connectionFactory;
        
        $this->connections = array();
        $this->originType = null;
        $this->targetType = null;
        $this->targets = array();
        $this->origin = null;
        $this->isProgressive = null;
        
    }
    
    public function addConnection(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    ) {
        
        // превая связь инициализирует кластер
        if ($this->isEmpty()) {
            $this->origin = $origin;
            $this->originType = $origin->getType();
            $this->targetType = $target->getType();
            $this->isProgressive = $target->isProgressive();
        }
        
        $connection = $this->connectionFactory->makeConnection($origin, $target);
        
        $this->checkTypes($origin, $target);
        
        $this->connections[] = $connection;
        $this->targets[] = $connection->getTarget();
        
        return $connection;
        
    }
    
    public function hasAllTargets(array $targets) {
        
        if (count($this->targets) != count($targets)) {
            return false;
        }
        
        $difference = array_diff($this->targets, $targets);
        
        return (count($difference) == 0);
        
    }
    
    public function getOrigin() {
        
        return $this->origin;
        
    }
    
    public function getTargets() {
        
        return $this->targets;
        
    }
    
    public function getOriginType() {
        
        return $this->originType;
        
    }
    
    public function getTargetType() {
        
        return $this->targetType;
        
    }
    
    /**
     * Возвращает ИСТИНУ, 
     * если в кластере определены все цели, 
     * но не определён источник, хотя это возможно 
     *
     * @return boolean
     */
    public function isVague() {
        
        if ($this->origin->isDefined()) {
            return false;
        }
        
        if ($this->origin->isAftermath()) {
            return false;
        }
        
        foreach ($this->targets as $target) {
            
            if (!$target->isDefined()) {
                
                return false;
                
            }
            
        }
        
        return true;
        
    }
    
    /**
     * Концы связей образуют последовательность 
     */
    public function isProgressive() {
        
        return $this->isProgressive;
        
    }
    
    private function isEmpty() {
        
        return empty($this->connections);
    }
    
    private function checkTypes(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    ) {

        if (
            $this->originType != $origin->getType()
            || $this->targetType != $target->getType()
        ) {
            throw new Model_State_Connection_Exception('В кластер передана связь с неверными типами начального и конечного узлов.');
        }
        
        if ($this->isProgressive !== $target->isProgressive()) {
            throw new Model_State_Connection_Exception('Кластер образует последовательнось. Переданая связь не содержит звена цепочки.');
        }
        
    }
    
}