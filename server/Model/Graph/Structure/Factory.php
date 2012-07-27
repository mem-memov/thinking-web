<?php
class Model_Graph_Structure_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $clusterTypeFactory;
    private $clusterAccessFactory;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Data_Type_Graph_Cluster_Factory $clusterTypeFactory,
        Data_Access_Graph_Cluster_Factory $clusterAccessFactory
    ) {

        $this->clusterTypeFactory = $clusterTypeFactory;
        $this->clusterAccessFactory = $clusterAccessFactory;
        
        $this->uniqueInstances = array();

    }
    
    /**
     *
     * @return Model_Graph_Structure_MessageCollection
     */
    public function makeMessageCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Graph_Structure_MessageCollection(
                $this->makeExecutorFactory(),
                $this->clusterAccessFactory->makeAction(),
                $this->clusterAccessFactory->makeAuthor(),
                $this->clusterAccessFactory->makeCommunication(),
                $this->clusterAccessFactory->makeComposition(),
                $this->clusterAccessFactory->makeDescription(),
                $this->clusterAccessFactory->makeDetail(),
                $this->clusterAccessFactory->makeInteraction(),
                $this->clusterAccessFactory->makeMessage(),
                $this->clusterAccessFactory->makeObject(),
                $this->clusterAccessFactory->makePhrase(),
                $this->clusterAccessFactory->makeProposition(),
                $this->clusterAccessFactory->makeReference(),
                $this->clusterAccessFactory->makeSign(),
                $this->clusterAccessFactory->makeWord()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Model_Graph_Structure_ActionCollection
     */
    public function makeActionCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Graph_Structure_ActionCollection(
                $this->clusterAccessFactory->makeAction(),
                $this->makePhraseCollection()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Model_Graph_Structure_PropositionCollection
     */
    public function makePhraseCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Graph_Structure_PhraseCollection(
                $this->clusterAccessFactory->makePhrase(),
                $this->clusterAccessFactory->makeComposition(),
                $this->clusterAccessFactory->makeWord()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Model_Graph_Structure_PropositionCollection
     */
    public function makePropositionCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Graph_Structure_PropositionCollection(

            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Model_Graph_Structure_ExecutorFactory 
     */
    private function makeExecutorFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Graph_Structure_ExecutorFactory(
                $this->clusterTypeFactory
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}
