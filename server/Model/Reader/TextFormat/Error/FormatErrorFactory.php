<?php
class Model_Reader_TextFormat_Error_FormatErrorFactory {
    
    public function __construct() {
        ;
    }
    
    public function makeFormatError($number, $description, $startPosition, $endPosition) {
        
        return new Model_Reader_TextFormat_Error_FormatError($number, $description, $startPosition, $endPosition);
        
    }
    
    
}