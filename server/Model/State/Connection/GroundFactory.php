<?php
class Model_State_Connection_GroundFactory {
    
    private $clusterFactory;
    
    public function __construct(
        Model_State_Connection_ClusterFactory $clusterFactory
    ) {
        
        $this->clusterFactory = $clusterFactory;
    
    }
    
    public function makeGround() {
        
        return new Model_State_Connection_Ground(
            $this->clusterFactory
        );
        
    }
    
}