<?php
class Model_Reader_TextFormat_Error_FormatError extends  Model_Reader_AbstractError {

    private $startPosition;
    private $endPosition;
    
    public function __construct($number, $message, $startPosition, $endPosition) {
        
        $this->type = 'Ошибка в формате сообщения';
        $this->number = $number;
        $this->message = $message;
        
        $this->startPosition = $startPosition;
        $this->endPosition = $endPosition;
    
    }

    
}