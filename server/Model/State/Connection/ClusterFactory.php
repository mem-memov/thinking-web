<?php
class Model_State_Connection_ClusterFactory {
    
    private $connectionFactory;
    
    public function __construct(
        Model_State_Connection_ConnectionFactory $connectionFactory
    ) {
        
        $this->connectionFactory = $connectionFactory;
    
    }
    
    public function makeCluster() {
        
        return new Model_State_Connection_Cluster(
            $this->connectionFactory
        );
        
    }
    
}