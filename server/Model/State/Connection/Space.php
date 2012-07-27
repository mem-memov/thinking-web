<?php
class Model_State_Connection_Space {
    
    private $groundFactory;
    private $grounds;
    private $identifiers;
    private $connections;
    
    public function __construct(
        Model_State_Connection_GroundFactory $groundFactory
    ) {
        
        $this->groundFactory = $groundFactory;
        $this->grounds = array();
        $this->identifiers = array();
        $this->connections = array();
        
    }
    
    public function addConnection(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    ) {
        
        // ставим идентификаторы на учёт
        $this->addIdentifier($origin);
        $this->addIdentifier($target);
   
        // пытаемся воткнуть в существующие земли
        foreach ($this->grounds as $ground) {

            if ($ground->getOriginType() == $origin->getType()) {

                $this->connections[] = $ground->addConnection($origin, $target);
                return;
                
            }
            
        }
        
        // втыкаем в новую землю
        $newGround = $this->groundFactory->makeGround();
        $this->connections[] = $newGround->addConnection($origin, $target);
        $this->grounds[] = $newGround;

        
    }
    
    public function getConnections() {
        
        return $this->connections;
        
    }
    
    public function getVagueClusters() {
        
        $vagueClusters = array();
        
        foreach ($this->grounds as $ground) {
            
            $groundVagueClusters = $ground->getVagueClusters();

            if (!empty($groundVagueClusters)) {
                
                $vagueClusters += $groundVagueClusters;
                
            }
            
        }

        return $vagueClusters;
        
    }
    
    public function getConnectionsUsingExample(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $example
    ) {
        
        $conections = array();
        
        foreach ($this->connections as $connection) {
       
            if (
                    $origin === $connection->getOrigin()
                &&  $example->getType() == $connection->getTargetType()
            ) {
                
                $conections[] = $connection;

            }

        }

        return $conections;
        
    }

    public function getProgressiveClusters() {
        
        $progressiveClusters = array();
        
        foreach ($this->grounds as $ground) {
            
            $groundProgressiveClusters = $ground->getProgressiveClusters();
            
            if (!empty($groundProgressiveClusters)) {
                
                $progressiveClusters += $groundProgressiveClusters;
                
            }
            
        }
        
        return $progressiveClusters;
        
    }
    
    public function hasReverseConnection(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    ) {
        
        foreach ($this->connections as $connection) {
       
            if (
                    $origin === $connection->getTarget()
                &&  $target == $connection->getOrigin()
            ) {
                
                return true;

            }

        }
        
        return false;
        
    }
    
    private function addIdentifier(
        Model_State_Identifier_Identifier $newIdentifier
    ) {
        
        foreach ($this->identifiers as $identifier) {
            
            if ($newIdentifier === $identifier) {
                return;
            }
            
        }
        
        $this->identifiers[] = $newIdentifier;
        
    }
    
    
}
