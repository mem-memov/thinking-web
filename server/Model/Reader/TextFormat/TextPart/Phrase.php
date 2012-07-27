<?php
class Model_Reader_TextFormat_TextPart_Phrase {

    private $string;
    private $text;
    private $sign;
    private $signs;

    public function __construct($string) {
        $this->string = $string;
        $this->words = array();
        $this->sign = null;
        $this->signs = array('!', '?');
        
        $this->analizeString();
    }

    public function getText() {

        return $this->text;

    }
    
    public function hasSign() {
        
        return (!is_null($this->sign));
        
    }
    
    public function getSign() {
        
        if (!$this->hasSign()) {
            throw new Model_Reader_TextFormat_TextPart_Exception('Перед получением знака следует проверить, есть ли он - hasSign()');
        }
        
        return $this->sign;
        
    }

    private function analizeString() {

        // убираем пробелы в конце фразы
        $cleanString = trim($this->string, "\n\r \t");
        
        foreach ($this->signs as $sign) {
            preg_match('/\\'.$sign.'$/u', $cleanString, $matches);
            if (!empty($matches)) {
                $this->sign = $sign;
                $cleanString = substr($cleanString, 0, strlen($cleanString) - 1);
                break;
            }
        }

        $this->text = $cleanString;

    }


}