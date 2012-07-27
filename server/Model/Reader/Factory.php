<?php
class Model_Reader_Factory {

    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $actionSniffer;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Model_ActionSniffer $actionSniffer
    ) {
        
        $this->actionSniffer = $actionSniffer;

        $this->uniqueInstances = array();

    }

    public function makeInterpreter($text) {

        $message = $this->makeMessage($text);

        return new Model_Reader_Interpreter(
            $this->makeSyntaxAnalysisFactory()->makeSyntaxAnalysis($message) // TODO
        );

    }

    public function makeTranslator($text) {

        $message = $this->makeMessage($text);

        return new Model_Reader_Translator(
            $this->makeSyntaxAnalysisFactory()->makeSyntaxAnalysis($message) // TODO
        );

    }

    private function makeMessage($text) {

        return new Model_Reader_Message($text);

    }

    private function makeSyntaxAnalysisFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_SyntaxAnalysis_Factory(
                $this->makeLexicalAnalysisFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];

    }

    private function makeLexicalAnalysisFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_LexicalAnalysis_Factory(
                $this->makeTextFormatFactory(),
                $this->actionSniffer
            );
        }

        return $this->uniqueInstances[$instance_key];

    }

    private function makeTextFormatFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_TextFormat_Factory(

            );
        }

        return $this->uniqueInstances[$instance_key];

    }

}