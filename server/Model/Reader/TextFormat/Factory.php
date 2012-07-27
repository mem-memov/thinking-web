<?php
class Model_Reader_TextFormat_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct() {

        $this->uniqueInstances = array();

    }
    
    public function makeTextFormat(Model_Reader_Message $message) {

        return new Model_Reader_TextFormat_TextFormat(
            $message,
            $this->makeFormatErrorFactory() 
        );

    }
    
    public function makeCleanText(Model_Reader_Message $message) {

        return new Model_Reader_TextFormat_CleanText(
                $message,
                $this->makeLineFactory()
        );

    }
    
    private function makeFormatErrorFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_TextFormat_Error_FormatErrorFactory(

            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }

    private function makeLineFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            
            $textPartFactory = new Model_Reader_TextFormat_TextPart_Factory();
            
            $this->uniqueInstances[$instance_key] = $textPartFactory->makeLineFactory();

        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}