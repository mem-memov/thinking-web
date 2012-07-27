<?php
class Model_Reader_LexicalAnalysis_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    private $textFormatFactory;
    
    private $actionSniffer;
    
    public function __construct(
        Model_Reader_TextFormat_Factory $textFormatFactory,
        Model_ActionSniffer $actionSniffer
    ) {

        $this->uniqueInstances = array();
        $this->textFormatFactory = $textFormatFactory;
        $this->actionSniffer = $actionSniffer;

    }
    
    public function makeLexicalAnalysis(Model_Reader_Message $message) {

        return new Model_Reader_LexicalAnalysis_LexicalAnalysis(
            $this->textFormatFactory->makeCleanText($message),
            $this->textFormatFactory->makeTextFormat($message),
            $this->makeTokenFactory(),
            $this->makeActionListFactory()
        );

    }
    
    private function makeActionListFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_LexicalAnalysis_ActionList_ActionListFactory(
                $this->actionSniffer
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    private function makeTokenFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_LexicalAnalysis_Token_TokenFactory(

            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    
}