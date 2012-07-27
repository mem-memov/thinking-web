<?php
class Model_State_Connection_Ground {
    
    private $clusterFactory;
    private $clusters;
    private $originType;
    private $producingTypes;
    
    private $origins;
    private $groups;
    
    public function __construct(
        Model_State_Connection_ClusterFactory $clusterFactory
    ) {
        
        $this->clusterFactory = $clusterFactory;
        $this->clusters = array();
        $this->originType = null;
        $this->producingTypes = null;
        
        $this->origins = array();
        $this->groups = array();
        
    }
    
    public function getOriginType() {
        
        if (is_null($this->originType)) {
            throw new Model_State_Connection_Exception('Попытка прочитать неустановленное свойство земли.');
        }
        
        return $this->originType;
        
    }
    
    public function addConnection(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    ) {
        
        // устанавливаем тип земли
        if (is_null($this->originType)) {
            $this->originType = $origin->getType();
        }
        // устанавливаем определяющие типы
        if (is_null($this->producingTypes)) {
            $this->producingTypes = $origin->getProducingTypes();
        }
        
        // пытаемся добавить связь в существующий кластер
        foreach ($this->clusters as $cluster) {
            
            if (
                $cluster->getOrigin() === $origin
                && $cluster->getTargetType() == $target->getType()
            ) {
                
                $connection = $cluster->addConnection($origin, $target);
                
                return $connection;
                
            }
            
        }
        
        // создаём новый кластер
        $newCluster = $this->clusterFactory->makeCluster();
        $connection = $newCluster->addConnection($origin, $target);
        $this->clusters[] = $newCluster;
        $this->addClusterToGroup($newCluster);
        
        return $connection;
        
        
    }
    
    public function getVagueClusters() {
        
        $vagueClusters = array();
        
        foreach ($this->groups as $index => $group) {
            
            $groupOrigin = $this->origins[$index];
            $producigTypes = $groupOrigin->getProducingTypes();
            
            
            
            foreach ($group as $cluster) {
                
                $targetType = $cluster->getTargetType();
                
                if (!in_array($targetType, $producigTypes)) {
                    continue;
                }
                
                if ($cluster->isVague()) {

                    $vagueClusters[$index][] = $cluster;

                }
                
            }
            

            
        }
        
        return $vagueClusters;
        
    }

    public function getProgressiveClusters() {
        
        $progressiveClusters = array();
        
        foreach ($this->clusters as $cluster) {
            
            if ($cluster->isProgressive()) {
                
                $progressiveClusters[] = $cluster;
                
            }
            
        }
        
        return $progressiveClusters;
        
    }

    private function addClusterToGroup(
        Model_State_Connection_Cluster $cluster
    ) {
        
        $clusterOrigin = $cluster->getOrigin();
        
        // пытаемся разместить в существующей группе
        foreach ($this->origins as $index => $origin) {
            
            if ($origin === $clusterOrigin) {
                
                $this->groups[$index][] = $cluster;
                
                return;
                
            }
            
        }
        
        // создаём новую группу
        $newIndex = count($this->origins);
        $this->origins[$newIndex] = $clusterOrigin;
        $this->groups[$newIndex] = array($cluster);
        
    }
    
}