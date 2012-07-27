<?php
class Model_Reader_SyntaxAnalysis_Error_SyntaxError extends  Model_Reader_AbstractError {

    public function __construct($number, $message) {
        
        $this->type = 'Ошибка в синтаксисе сообщения';
        $this->number = $number;
        $this->message = $message;
    
    }

    
}