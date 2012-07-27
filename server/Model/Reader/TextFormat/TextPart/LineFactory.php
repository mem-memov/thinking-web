<?php
class Model_Reader_TextFormat_TextPart_LineFactory {

    private $phraseFactory;

    public function __construct(
        Model_Reader_TextFormat_TextPart_PhraseFactory $phraseFactory
    ) {

        $this->phraseFactory = $phraseFactory;

    }


    public function makeLine($number, $string) {
        return new Model_Reader_TextFormat_TextPart_Line(
            $number,
            $string,
            $this->phraseFactory
        );
    }

}