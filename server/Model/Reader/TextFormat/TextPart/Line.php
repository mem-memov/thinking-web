<?php
class Model_Reader_TextFormat_TextPart_Line {

    private $depthCharacter;
    private $string;
    private $number;
    private $phraseFactory;
    private $depth;
    private $phrase;

    public function __construct(
        $number,
        $string,
        Model_Reader_TextFormat_TextPart_PhraseFactory $phraseFactory
    ) {

        $this->depthCharacter = "\t";
        $this->string = $this->trimString($string);
        $this->number = $number;
        $this->phraseFactory = $phraseFactory;
        $this->setDepth();
        $this->setPhrase();

    }

    public function getDepth() {

        return $this->depth;

    }
    
    public function getPhrase() {
        
        return $this->phrase->getText();
        
    }
    
    public function hasSign() {
        
        return $this->phrase->hasSign();
        
    }
    
    public function getSign() {
        
        return $this->phrase->getSign();
        
    }
    
    public function getNumber() {
        
        return $this->number;
        
    }

    private function trimString($string) {
        return trim($string, "\n\r ");
    }

    private function setDepth() {

        $phraseLength = strlen(
            ltrim($this->string, $this->depthCharacter)
        );

        $lineLength = strlen($this->string);

        $this->depth = $lineLength - $phraseLength;


    }

    private function setPhrase() {

        $this->phrase = $this->phraseFactory->makePhrase(
            ltrim($this->string, $this->depthCharacter)
        );

    }

}