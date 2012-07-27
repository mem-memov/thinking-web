<?php
class Model_Reader_TextFormat_CleanText {

    private $text;
    private $lineFactory;
    private $severeErrors;
    private $cleaningDone;
    private $cleaningSuccessful;
    private $lines;

    public function __construct(
        Model_Reader_Message $message,
        Model_Reader_TextFormat_TextPart_LineFactory $lineFactory
    ) {

        $this->text = $message->getText();
        $this->lineFactory = $lineFactory;
        $this->severeErrors = array();
        $this->cleaningDone = false;
        $this->cleaningSuccessful = false;
        $this->linesReady = false;
        $this->lines = array();

    }
    
    
    public function removeDirtySpots(array $formatErrors) {
        
        $this->preventMultipleCleanings();

        foreach ($formatErrors as $errorIndex => $formatError) {
            
            if (!($formatError instanceof Model_Reader_TextFormat_Error_FormatError)) {
                throw new Model_Reader_TextFormat_Exception('Неправильный тип в списке ошибок форматирования.');
            }
            
            switch ($formatError->getNumber()) {
                case 7:
                    $this->removeMultipleSpaces($formatError);
                    break;
                case 11:
                    $this->removeCarriageReturn($formatError);
                    break;
                default :
                    $this->severeErrors[] = $formatError;
                    break;
            }
            
        }
        
        $this->cleaningSuccessful = empty($this->severeErrors);
        
        $this->cleaningDone = true;

    }

    public function getSevereErrors() {
        
        $this->insistOnCleaning();
        
        return $this->severeErrors;
        
    }
    
    public function getLines() {
        
        $this->preventUsingDirtyText();
        
        if ($this->linesReady) {
            return $this->lines;
        }

        foreach (explode("\n", $this->text) as $number => $line) {
            
            $this->lines[] = $this->lineFactory->makeLine($number, $line);

        }
        
        $this->text = null;
        $this->linesReady = true;
        
        return $this->lines;
        
    }
    
    private function removeMultipleSpaces(Model_Reader_TextFormat_Error_FormatError $formatError) {
        
        $this->text = preg_replace('/ +/u', ' ', $this->text);
        
    }

    private function removeCarriageReturn(Model_Reader_TextFormat_Error_FormatError $formatError) {
        
        $this->text = preg_replace('/\r/u', ' ', $this->text);
        
    }

    private function preventUsingDirtyText() {
        
        if (!$this->cleaningSuccessful) {
            throw new Model_Reader_TextFormat_Exception('Обнаружена попытка использовать неочищенный текст в качестве очищенного.');
        }
        
    }
    
    private function insistOnCleaning() {
        
        if (!$this->cleaningDone) {
            throw new Model_Reader_TextFormat_Exception('Нет ясности в отношении того, содержит ли текст ошибки. Проведите очистку.');
        }
        
    }
    
    private function preventMultipleCleanings() {
        
        if ($this->cleaningDone) {
            throw new Model_Reader_TextFormat_Exception('Очистка текста от ошибок форматирования может выполнятся только один раз.');
        }
        
    }
    
    

}