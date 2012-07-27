<?php
class Model_Reader_TextFormat_TextPart_Factory {
    
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
    
    public function makeLineFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_TextFormat_TextPart_LineFactory(
                $this->makePhraseFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];

    }

    private function makePhraseFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_TextFormat_TextPart_PhraseFactory(

            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    
}