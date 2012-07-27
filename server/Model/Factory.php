<?php
class Model_Factory {

    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки модели
     *
     * @var array
     */
    private $configuration;
    
    private $dataFactory;
    
    private $serviceFactory;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        array $configuration,
        Data_Factory $dataFactory,
        Service_Factory $serviceFactory
    ) {

        $this->uniqueInstances = array();
        $this->configuration = $configuration;
        $this->dataFactory = $dataFactory;
        $this->serviceFactory = $serviceFactory;

    }

    public function makeTranslator($text) {

        $factory = new Model_Reader_Factory();

        return $factory->makeTranslator($text);

    }

    public function makeThought($text) {
        
        return new Model_Thought(
            $this->makeInformation($text),
            $this->makeGraphFactory()->makeStructureFactory()->makeMessageCollection(),
            $this->makeScopeFactory()
        );
        
        
    }
    
    /**
     *
     * @param string $text
     * @return Model_Information 
     */
    private function makeInformation($text) {

        $interpretor = $this->makeReaderFactory()->makeInterpreter($text);
        $messageCollection = $this->makeGraphFactory()->makeStructureFactory()->makeMessageCollection();
        $messageStructure = $messageCollection->createUsingInterpretor($interpretor);
        
        return new Model_Information($messageStructure);

    }

    /**
     *
     * @return Model_Reader_Factory
     */
    private function makeReaderFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_Factory(
                $this->makeActionSniffer()
            );
        }

        return $this->uniqueInstances[$instance_key];

    }

    /**
     *
     * @return Model_State_Factory
     */
    private function makeSateFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Factory(

            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    
    /**
     *
     * @return Model_ActionSniffer
     */
    private function makeActionSniffer() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_ActionSniffer(
                $this->makeGraphFactory()->makeStructureFactory()->makeActionCollection()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Model_Context_ScopeFactory
     */
    private function makeScopeFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Context_ScopeFactory(
                $this->serviceFactory->makeDatasetWielder(),
                $this->makeSateFactory()->makeStructureFactory(),
                $this->makeSateFactory()->makeIdentifierFactory()
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Model_Graph_Factory
     */
    private function makeGraphFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Graph_Factory(
                $this->dataFactory->makeTypeFactory()->makeGraphFactory()->makeClusterFactory(),
                $this->dataFactory->makeAccessFactory()->makeGraphFactory()->makeClusterFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }


}