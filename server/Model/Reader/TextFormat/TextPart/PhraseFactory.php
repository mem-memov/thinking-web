<?php
class Model_Reader_TextFormat_TextPart_PhraseFactory {

    public function makePhrase($string) {

        return new Model_Reader_TextFormat_TextPart_Phrase($string);

    }

}